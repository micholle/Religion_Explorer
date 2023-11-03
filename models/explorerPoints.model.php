<?php
session_start(); 
require_once "connection.php";

$connection = new Connection();
$db = $connection->connect();

try {
    $stmt = $db->prepare("SELECT 
                            (SELECT COALESCE(SUM(points), 0) FROM explorerpoints WHERE accountid = :accountid) AS explorerPoints,
                            (SELECT COALESCE(SUM(upvotes), 0) FROM topics WHERE accountid = :accountid) AS topicUpvotes,
                            (SELECT COALESCE(SUM(upvotes), 0) FROM reply WHERE accountid = :accountid) AS replyUpvotes,
                            (SELECT COALESCE(SUM(upvotes), 0) FROM posts WHERE accountid = :accountid) AS postUpvotes,
                            notifications, displayCalendar, displayNickname, displayBookmark, displayReligion, displayPage
                        FROM accounts 
                        WHERE accountid = :accountid");
    $stmt->bindValue(':accountid', $_SESSION['accountid']);
    $stmt->execute();
    $userData = $stmt->fetch(PDO::FETCH_ASSOC);

    $topicUpvotes = $userData['topicUpvotes'] ?? 0;
    $replyUpvotes = $userData['replyUpvotes'] ?? 0;
    $postUpvotes = $userData['postUpvotes'] ?? 0;

    $displayNotifications = $userData['notifications'];
    $displayCalendar = $userData['displayCalendar'];
    $displayNickname = $userData['displayNickname'];
    $displayBookmark = $userData['displayBookmark'];
    $displayReligion = $userData['displayReligion'];
    $pageDisplayAfterLogin = $userData['displayPage'];

    // Calculate explorer points
    $explorerPoints = $userData['explorerPoints'] ?? 0;
} catch (PDOException $e) {
    die("Error occurred while fetching user data: " . $e->getMessage());
}

class explorerPointsModel{
    static public function mdlAddExplorerPoints($data){
        $db = new Connection();
        $pdo = $db->connect();
        
        try {
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->beginTransaction();
    
            $datetime = date("Y-m-d H:i:s");
    
            $stmt = $pdo->prepare("INSERT INTO explorerpoints(accountid, pointsource, points, datetime) VALUES (:accountid, :pointsource, :points, :datetime)");
    
            $stmt->bindParam(":accountid", $data["accountid"], PDO::PARAM_STR);
            $stmt->bindParam(":pointsource", $data["pointsource"], PDO::PARAM_STR);
            $stmt->bindParam(":points", $data["points"], PDO::PARAM_INT);
            $stmt->bindParam(":datetime", $datetime, PDO::PARAM_STR);
            
            $stmt->execute();
            $pdo->commit();
            
            return "success";
        } catch (Exception $e) {
            echo $e->getMessage();
            $pdo->rollBack();
            return "error";
        }
    
        $pdo = null;
        $stmt = null;
    }
    
}

?>
