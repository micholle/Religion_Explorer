<?php
require_once "connection.php";

class bookmarkModel{

	static public function mdlGetBookmarkData($accountid) {
		$db = new Connection();
        $pdo = $db->connect();

		try {
            $stmt = $pdo->prepare("SELECT * FROM bookmarks WHERE accountid = :accountid");
            $stmt->bindParam(":accountid", $accountid, PDO::PARAM_STR);
            $stmt->execute();
            $bookmarks = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $bookmarkList = [];
    
            foreach ($bookmarks as $bookmark) {
				$bookmarkList[] = $bookmark;
            }

            $jsonData = json_encode($bookmarkList);
            header('Content-Type: application/json');
            echo $jsonData;
            return "success";
        } catch (Exception $e) {
            return "error";
        }
	}

	static public function mdlAddToBookmarks($accountid, $resourceid, $resourceTitle){
        $db = new Connection();
        $pdo = $db->connect();

		try {
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$pdo->beginTransaction();
		
			$stmt = $pdo->prepare("INSERT INTO bookmarks(accountid, resourceid, resourceTitle) VALUES (:accountid, :resourceid, :resourceTitle)");
			$stmt->bindParam(":accountid", $accountid, PDO::PARAM_STR);
			$stmt->bindParam(":resourceid", $resourceid, PDO::PARAM_STR);
			$stmt->bindParam(":resourceTitle", $resourceTitle, PDO::PARAM_STR);
			$stmt->execute();

            $stmt2 = $pdo->prepare("SELECT username FROM accounts WHERE accountid = :accountid");
            $stmt2->bindParam(":accountid", $accountid, PDO::PARAM_STR);
            $stmt2->execute();
            $username = $stmt2->fetchColumn();

            $stmt3 = $pdo->prepare("SELECT username FROM communitycreations WHERE creationid = :creationid");
            $stmt3->bindParam(":creationid", $resourceid, PDO::PARAM_STR);
            $stmt3->execute();
            $personInvolved = $stmt3->fetchColumn();
    
            $stmt4 = $pdo->prepare("INSERT INTO notifications(username, creationid, personInvolved, notificationSource, notificationDate) VALUES (:username, :creationid, :personInvolved, :notificationSource, :notificationDate)");
            $stmt4->bindParam(":username", $username, PDO::PARAM_STR);
            $stmt4->bindParam(":creationid", $resourceid, PDO::PARAM_STR);
            $stmt4->bindParam(":personInvolved", $personInvolved, PDO::PARAM_STR);
            $stmt4->bindValue(":notificationSource", "Community Creations", PDO::PARAM_STR);
            $stmt4->bindParam(":notificationDate", date('Y-m-d'), PDO::PARAM_STR);
            $stmt4->execute();
	
			$pdo->commit();
			return "success";
		} catch (Exception $e) {
			$pdo->rollBack();
			return "error";
		}

		$pdo = null;
		$stmt = null;
	}

	static public function mdlRemoveFromBookmarks($bookmarkid) {
		$db = new Connection();
        $pdo = $db->connect();
    
        try {
            $stmt = $pdo->prepare("DELETE FROM bookmarks WHERE bookmarkid = :bookmarkid");
            $stmt->bindParam(":bookmarkid", $bookmarkid, PDO::PARAM_INT);
            $stmt->execute();

            $stmt2 = $pdo->prepare("SELECT resourceid FROM bookmarks WHERE bookmarkid = :bookmarkid");
            $stmt2->bindParam(":bookmarkid", $bookmarkid, PDO::PARAM_STR);
            $stmt2->execute();
            $resourceid = $stmt2->fetchColumn();

            $stmt3 = $pdo->prepare("DELETE FROM notifications WHERE creationid = :creationid");
            $stmt3->bindParam(":creationid", $resourceid, PDO::PARAM_INT);
            $stmt3->execute();

            return "success";
        } catch (Exception $e) {
            return "error";
        }
	}

}

?>