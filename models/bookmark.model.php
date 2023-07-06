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

            return "success";
        } catch (Exception $e) {
            return "error";
        }
	}

}

?>