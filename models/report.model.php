<?php
require_once "connection.php";

class reportContentModel {
	static public function mdlGetReportedContent() {
        $db = new Connection();
        $pdo = $db->connect();
        
        $stmt = $pdo->prepare("SELECT * FROM reportedcontent");
        $stmt->execute();
        $reportedContent = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        $reportedContents = [];
        $contentLink = "";
        $contentCreator = "";
    
        foreach ($reportedContent as $content) {  
            if ($content["reportStatus"] == "Pending") {

                if (substr($content["contentid"], 0, 2) == "CC") {
                    $stmt2 = $pdo->prepare("SELECT creationid, title, username FROM communitycreations");
                    $stmt2->execute();
                    $communityCreations = $stmt2->fetchAll(PDO::FETCH_ASSOC);
        
                    foreach ($communityCreations as $creation) {
                        if ($creation["creationid"] == $content["contentid"]) {
                            $contentLink = $creation["title"];
                            $contentCreator = $creation["username"];
                            break;
                        }
                    }
                }

                $reportedContents[$content["contentid"]] = [
                    "contentCreator" => $contentCreator,
                    "contentLink" => $contentLink,
                    "violation" => $content["contentViolations"],
                    "additionalContext" => $content["additionalContext"],
                    "reportedOn" => $content["reportedOn"],
                    "reportedBy" => $content["reportedBy"]
                ];   
            }
        }
    
        $jsonData = json_encode($reportedContents);
        header('Content-Type: application/json');
        echo $jsonData;
    }  

    static public function mdlSubmitReportContent($data){
        $db = new Connection();
        $pdo = $db->connect();

		try {
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$pdo->beginTransaction();
		
			$stmt = $pdo->prepare("INSERT INTO reportedcontent(contentid, contentViolations, additionalContext, reportedOn, reportedBy) VALUES (:contentid, :contentViolations, :additionalContext, :reportedOn, :reportedBy)");
	
            $stmt->bindParam(":contentid", $data["contentid"], PDO::PARAM_STR);
            $stmt->bindParam(":contentViolations", $data["contentViolations"], PDO::PARAM_STR);
            $stmt->bindParam(":additionalContext", $data["additionalContext"], PDO::PARAM_STR);
            $stmt->bindParam(":reportedOn", $data["reportedOn"], PDO::PARAM_STR);
            $stmt->bindParam(":reportedBy", $data["reportedBy"], PDO::PARAM_STR);
            
			$stmt->execute();
			$pdo->commit();
                        
		} catch (Exception $e) {
			$pdo->rollBack();
			return "error";
		}

		$pdo = null;
		$stmt = null;

    }

    static public function mdlResolveReportContent($contentid) {
        $db = new Connection();
        $pdo = $db->connect();
    
        try {
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->beginTransaction();
    
            $stmt = $pdo->prepare("UPDATE reportedcontent SET actionTaken = 'Resolve', reportStatus = 'Completed' WHERE contentid = :contentid");
            $stmt->bindParam(":contentid", $contentid, PDO::PARAM_STR);
            $stmt->execute();
    
            $pdo->commit();
        } catch (Exception $e) {
            $pdo->rollBack();
            return "error";
        }
    
        $pdo = null;
        $stmt = null;
    }    
    
    static public function mdlDeleteReportedContent($contentid) {
        $db = new Connection();
        $pdo = $db->connect();
    
        try {
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->beginTransaction();

            if (substr($contentid, 0, 2) == "CC") {
                $stmt = $pdo->prepare("SELECT filedata FROM communitycreations WHERE creationid = :contentid");
                $stmt->bindParam(":contentid", $contentid, PDO::PARAM_STR);
                $stmt->execute();
                $filepath = $stmt->fetch(PDO::FETCH_ASSOC);
                if (file_exists($filepath["filedata"])) {unlink($filepath["filedata"]);}

                $stmt2 = $pdo->prepare("DELETE FROM communitycreations WHERE creationid = :contentid");
                $stmt2->bindParam(":contentid", $contentid, PDO::PARAM_STR);
                $stmt2->execute();
            }        
            
            $stmt3 = $pdo->prepare("DELETE FROM bookmarks WHERE resourceid = :contentid");
            $stmt3->bindParam(":contentid", $contentid, PDO::PARAM_STR);
            $stmt3->execute();

            $stmt4 = $pdo->prepare("UPDATE reportedcontent SET actionTaken = 'Delete', reportStatus = 'Completed' WHERE contentid = :contentid");
            $stmt4->bindParam(":contentid", $contentid, PDO::PARAM_STR);
            $stmt4->execute();

    
            $pdo->commit();
        } catch (Exception $e) {
            $pdo->rollBack();
            return "error";
        }
    
        $pdo = null;
        $stmt = null;
        $stmt2 = null;
    } 

}

class reportUserModel {
    static public function mdlGetReportedUsers() {
        $db = new Connection();
        $pdo = $db->connect();
        
        $stmt = $pdo->prepare("SELECT * FROM reportedusers");
        $stmt->execute();
        $reportedUser = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $reportedUsers = [];
        $accountid = "";
    
        foreach ($reportedUser as $user) {  
            if ($user["reportStatus"] == "Pending") {
                $stmt2 = $pdo->prepare("SELECT accountid, username FROM accounts");
                $stmt2->execute();
                $accounts = $stmt2->fetchAll(PDO::FETCH_ASSOC);
        
                foreach ($accounts as $account) {
                    if ($account["username"] == $user["username"]) {
                        $accountid = $account["accountid"];
                        break;
                    }
                }

                $reportedUsers[$accountid] = [
                    "userLink" => $user["username"],
                    "violation" => $user["userViolations"],
                    "additionalContext" => $user["additionalContext"],
                    "reportedOn" => $user["reportedOn"],
                    "reportedBy" => $user["reportedBy"]
                ];   
            }
        }
    
        $jsonData = json_encode($reportedUsers);
        header('Content-Type: application/json');
        echo $jsonData;
    }

    static public function mdlSubmitReportUser($data){
        $db = new Connection();
        $pdo = $db->connect();

		try {
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$pdo->beginTransaction();
		
			$stmt = $pdo->prepare("INSERT INTO reportedusers(username, userViolations, additionalContext, reportedOn, reportedBy) VALUES (:username, :userViolations, :additionalContext, :reportedOn, :reportedBy)");
	
            $stmt->bindParam(":username", $data["username"], PDO::PARAM_STR);
            $stmt->bindParam(":userViolations", $data["userViolations"], PDO::PARAM_STR);
            $stmt->bindParam(":additionalContext", $data["additionalContext"], PDO::PARAM_STR);
            $stmt->bindParam(":reportedOn", $data["reportedOn"], PDO::PARAM_STR);
            $stmt->bindParam(":reportedBy", $data["reportedBy"], PDO::PARAM_STR);
            
			$stmt->execute();
			$pdo->commit();
                        
		} catch (Exception $e) {
			$pdo->rollBack();
			return "error";
		}

		$pdo = null;
		$stmt = null;
    }
}

?>