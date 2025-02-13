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
    
        foreach ($reportedContent as $content) {  
            if ($content["reportStatus"] == "Pending") {
                $contentCreator = "";
                $contentLink = "";
                
                if (substr($content["contentid"], 0, 2) == "CC") {
                    $stmt2 = $pdo->prepare("SELECT accountid, filetype FROM communitycreations WHERE creationid = :creationid");
                    $stmt2->bindParam(":creationid", $content["contentid"], PDO::PARAM_STR);
                    $stmt2->execute();
                    $communityCreations = $stmt2->fetchAll(PDO::FETCH_ASSOC);
                    
                    foreach ($communityCreations as $creation) {
                        $contentCreator = $creation["accountid"];
                    
                        if ($creation["filetype"] == "") {
                            $contentLink = "communitySubmissions.php?openTab=communitySubBlogs&view=";
                        } else {
                            if (strpos($creation["filetype"], "image") !== false) {
                                $contentLink = "communitySubmissions.php?openTab=communitySubPhotos&view=";
                            } else if (strpos($creation["filetype"], "video") !== false) {
                                $contentLink = "communitySubmissions.php?openTab=communitySubVideos&view=";
                            }
                        }
                    } 
                } else {
                    $forum_stmt = $pdo->prepare("SELECT t.accountid AS topic_accountid, p.accountid AS post_accountid, r.accountid AS reply_accountid
                                                    FROM topics AS t
                                                    JOIN posts AS p ON t.topicId = p.topicId
                                                    JOIN reply AS r ON p.postId = r.postId
                                                    WHERE t.topicId = :topicId");
                    $forum_stmt->bindParam(":topicId", $content["contentid"], PDO::PARAM_INT);
                    $forum_stmt->execute();
                    $forumInfo = $forum_stmt->fetchAll(PDO::FETCH_ASSOC);

                    $topicAccountID = "";
                    $postAccountID = "";
                    $replyAccountID = "";

                    foreach ($forumInfo as $info) {
                        $topicAccountID = $info["topic_accountid"];
                        $postAccountID = $info["post_accountid"];
                        $replyAccountID = $info["reply_accountid"];

                        if($topicAccountID != "") {
                            $contentCreator = $topicAccountID;
                        } else if ($postAccountID != "") {
                            $contentCreator = $postAccountID;
                        } else if ($replyAccountID != "") {
                            $contentCreator = $replyAccountID;
                        }
                    } 
                    
                    $contentLink = "discussionForumPost.php?topicId=";
                }

                $accounts_stmt = $pdo->prepare("SELECT username FROM accounts WHERE accountid = :accountid");
                $accounts_stmt->bindParam(":accountid", $content["reportedBy"], PDO::PARAM_STR);
                $accounts_stmt->execute();
                $reportedBy = $accounts_stmt->fetchColumn();

                $reportedContents[$content["reportid"]] = [
                    "contentid" => $content["contentid"],
                    "contentCreator" => $contentCreator,
                    "contentLink" => $contentLink,
                    "violation" => $content["contentViolations"],
                    "additionalContext" => $content["additionalContext"],
                    "reportedOn" => $content["reportedOn"],
                    "reportedBy" => $reportedBy
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
            $accountid = "";
            $reportid = "";

            if (substr($contentid, 0, 2) == "CC") {
                $community_select = $pdo->prepare("SELECT * FROM communitycreations");
                $community_select->execute();
                $creationInfo = $community_select->fetchAll(PDO::FETCH_ASSOC);

                foreach ($creationInfo as $info) {
                    if($info['creationid'] == $contentid) {
                        $accountid = $info['accountid'];
                        if (file_exists($info['filedata'])) {
                            unlink($info['filedata']);
                        }
                    }
                }
            } else {
                $topics_select = $pdo->prepare("SELECT * FROM topics");
                $topics_select->execute();
                $topicsInfo = $topics_select->fetchAll(PDO::FETCH_ASSOC);

                foreach ($topicsInfo as $info) {
                    if($info['topicId'] == $contentid) {
                        $accountid = $info['accountid'];
                    }
                }

                $posts_select = $pdo->prepare("SELECT * FROM posts");
                $posts_select->execute();
                $postsInfo = $posts_select->fetchAll(PDO::FETCH_ASSOC);

                foreach ($postsInfo as $info) {
                    if($info['postId'] == $contentid) {
                        $accountid = $info['accountid'];
                    }
                }

                $reply_select = $pdo->prepare("SELECT * FROM reply");
                $reply_select->execute();
                $replyInfo = $reply_select->fetchAll(PDO::FETCH_ASSOC);

                foreach ($replyInfo as $info) {
                    if($info['replyId'] == $contentid) {
                        $accountid = $info['accountid'];
                    }
                }
            }           

            $community_delete = $pdo->prepare("DELETE FROM communitycreations WHERE creationid = :creationid");
            $community_delete->bindParam(":creationid", $contentid, PDO::PARAM_STR);
            $community_delete->execute();

            $topics_delete = $pdo->prepare("DELETE FROM topics WHERE topicId = :topicId");
            $topics_delete->bindParam(":topicId", $contentid, PDO::PARAM_STR);
            $topics_delete->execute();
            
            $posts_delete = $pdo->prepare("DELETE FROM posts WHERE postId = :postId");
            $posts_delete->bindParam(":postId", $contentid, PDO::PARAM_STR);
            $posts_delete->execute();

            $reply_delete = $pdo->prepare("DELETE FROM reply WHERE replyId = :replyId");
            $reply_delete->bindParam(":replyId", $contentid, PDO::PARAM_STR);
            $reply_delete->execute();
            
            $bookmark_delete = $pdo->prepare("DELETE FROM bookmarks WHERE resourceid = :resourceid");
            $bookmark_delete->bindParam(":resourceid", $contentid, PDO::PARAM_STR);
            $bookmark_delete->execute();

            $get_reportid = $pdo->prepare("SELECT reportid FROM reportedcontent WHERE contentid = :contentid");
            $get_reportid->bindParam(":contentid", $contentid, PDO::PARAM_STR);
            $get_reportid->execute();
            $reportid = $get_reportid->fetchColumn();

            $delete_report = $pdo->prepare("UPDATE reportedcontent SET actionTaken = 'Delete', reportStatus = 'Completed' WHERE contentid = :contentid");
            $delete_report->bindParam(":contentid", $contentid, PDO::PARAM_STR);
            $delete_report->execute();

            $notificationDate = date('Y-m-d');

            $notify_user = $pdo->prepare("INSERT INTO notifications(accountid, reportid, notificationSource, notificationDate) VALUES (:accountid, :reportid, :notificationSource, :notificationDate)");
            $notify_user->bindParam(":accountid", $accountid, PDO::PARAM_STR);
            $notify_user->bindParam(":reportid", $reportid, PDO::PARAM_INT);
            $notify_user->bindValue(":notificationSource", "Reported Content", PDO::PARAM_STR);
            $notify_user->bindParam(":notificationDate", $notificationDate, PDO::PARAM_STR);
            $notify_user->execute();
            $pdo->commit();
    
        } catch (Exception $e) {
            $pdo->rollBack();

            return "error";
        }
    
        $pdo = null;
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
    
        foreach ($reportedUser as $user) {  
            if ($user["reportStatus"] == "Pending") {                 
                $reportedUsers[] = [
                    "userid" => $user["accountid"],
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

            $accountStmt = $pdo->prepare("SELECT accountid FROM accounts WHERE username = :username");
            $accountStmt->bindParam(":username", $data['username'], PDO::PARAM_STR);
            $accountStmt->execute();
            $accountid = $accountStmt->fetchColumn();
		
			$stmt = $pdo->prepare("INSERT INTO reportedusers(accountid, userViolations, additionalContext, reportedOn, reportedBy) VALUES (:accountid, :userViolations, :additionalContext, :reportedOn, :reportedBy)");
	
            $stmt->bindParam(":accountid", $accountid, PDO::PARAM_STR);
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

    //report action
    static public function mdlSuspendUser($data) {
        $db = new Connection();
        $pdo = $db->connect();
        switch ($data["suspendusertime"]) {
            case "Hours":
                $interval = "HOUR";
                break;
            case "Days":
                $interval = "DAY";
                break;
            case "Weeks":
                $interval = "WEEK";
                break;
            case "Months":
                $interval = "MONTH";
                break;
            case "Years":
                $interval = "YEAR";
                break;
            default:
                // Default to hours if the unit is not recognized
                $interval = "HOUR";
                break;
        }
    
        try {
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->beginTransaction();
    
            // Check if the user already has a status record in the table
            $stmtCheck = $pdo->prepare("SELECT COUNT(*) FROM accounts_status WHERE accountid = :accountid");
            $stmtCheck->bindParam(":accountid", $data["userid"], PDO::PARAM_STR);
            $stmtCheck->execute();
            $recordExists = $stmtCheck->fetchColumn();
    
            if ($recordExists) {
                // If the user already has a status record, update it
                $stmt = $pdo->prepare("UPDATE accounts_status SET status = 'Suspended', startDate = NOW(), endDate = DATE_ADD(NOW(), INTERVAL :suspenduserval $interval) WHERE accountid = :accountid");
            } else {
                // If the user doesn't have a status record, insert a new one
                $stmt = $pdo->prepare("INSERT INTO accounts_status (accountid, status, startDate, endDate) VALUES (:accountid, 'Suspended', NOW(), DATE_ADD(NOW(), INTERVAL :suspenduserval $interval))");
            }
    
            $stmt->bindParam(":accountid", $data["userid"], PDO::PARAM_STR);
            $stmt->bindParam(":suspenduserval", $data["suspenduserval"], PDO::PARAM_INT);
            $stmt->execute();
    
            // Update the reportedusers table with actionTaken and reportStatus
            $updateStmt = $pdo->prepare("UPDATE reportedusers SET actionTaken = 'Suspend', reportStatus = 'Completed' WHERE accountid = :accountid");
            $updateStmt->bindParam(":accountid", $data["userid"], PDO::PARAM_STR);
            $updateStmt->execute();
    
            $pdo->commit();
            return "ok";
        } catch (Exception $e) {
            $pdo->rollBack();
            return "error";
        } finally {
            $pdo = null;
            $stmt = null;
            $stmtCheck = null;
        }
    }
    
    

    static public function mdlBanUser($data) {
        $db = new Connection();
        $pdo = $db->connect();

        try {
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->beginTransaction();

            $stmtCheck = $pdo->prepare("SELECT COUNT(*) FROM accounts_status WHERE accountid = :accountid");
            $stmtCheck->bindParam(":accountid", $data["userid"], PDO::PARAM_STR);
            $stmtCheck->execute();
            $recordExists = $stmtCheck->fetchColumn();

            if ($recordExists) {
                $stmt = $pdo->prepare("UPDATE accounts_status SET status = 'Banned', startDate = NOW() WHERE accountid = :accountid");
            } else {
                $stmt = $pdo->prepare("INSERT INTO accounts_status (accountid, status, startDate) VALUES (:accountid, 'Banned', NOW())");
            }

            $stmt->bindParam(":accountid", $data["userid"], PDO::PARAM_STR);
            $stmt->execute();

            $updateStmt = $pdo->prepare("UPDATE reportedusers SET actionTaken = 'Ban', reportStatus = 'Completed' WHERE accountid = :accountid");
            $updateStmt->bindParam(":accountid", $data["userid"], PDO::PARAM_STR);
            $updateStmt->execute();

            $pdo->commit();
            return "ok";
        } catch (Exception $e) {
            $pdo->rollBack();
            return "error";
        }

        $pdo = null;
        $stmt = null;
    }

    static public function mdlResolveUser($data) {
        $db = new Connection();
        $pdo = $db->connect();
    
        try {
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->beginTransaction();
    
            $updateStmt = $pdo->prepare("UPDATE reportedusers SET actionTaken = 'Resolve', reportStatus = 'Completed' WHERE accountid = :accountid");
            $updateStmt->bindParam(":accountid", $data["userid"], PDO::PARAM_STR);
            $updateStmt->execute();
    
            $pdo->commit();
            return "ok"; // Return "ok" if the resolution is successful
        } catch (Exception $e) {
            $pdo->rollBack();
            return "error"; // Return "error" if there is an error
        }
    
        $pdo = null;
        $stmt = null;
    }    
}

?>