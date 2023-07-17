<?php
require_once "connection.php";

class reportContentModel{
	static public function mdlGetReportedContent() {
        $db = new Connection();
        $pdo = $db->connect();
        
        $stmt = $pdo->prepare("SELECT * FROM reportedcontent");
        $stmt->execute();
        $reportedContent = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        $reportedContents = [];
        $contentLink = "";
    
        foreach ($reportedContent as $content) {  
            
            if ($content["reportStatus"] == "Pending") {

                if (substr($content["contentid"], 0, 2) == "CC") {
                    $stmt2 = $pdo->prepare("SELECT creationid, title FROM communitycreations");
                    $stmt2->execute();
                    $communityCreations = $stmt2->fetchAll(PDO::FETCH_ASSOC);
        
                    foreach ($communityCreations as $creation) {
                        if ($creation["creationid"] == $content["contentid"]) {
                            $contentLink = $creation["title"];
                            break;
                        }
                    }
                }

                $reportedContents[$content["contentid"]] = [
                    "contentLink" => $contentLink,
                    "violation" => $content["contentViolations"],
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

}

?>