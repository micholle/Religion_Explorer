<?php
session_start(); 
require_once "connection.php";

$connection = new Connection();
$db = $connection->connect();

try {
    $stmt = $db->prepare("SELECT 
                            (SELECT COALESCE(SUM(upvotes), 0) FROM topics WHERE accountid = :accountid) AS topicUpvotes,
                            (SELECT COALESCE(SUM(upvotes), 0) FROM reply WHERE accountid = :accountid) AS replyUpvotes,
                            (SELECT COALESCE(SUM(upvotes), 0) FROM posts WHERE accountid = :accountid) AS postUpvotes");
    $stmt->bindValue(':accountid', $_SESSION['accountid']);
    $stmt->execute();
    $votesData = $stmt->fetch(PDO::FETCH_ASSOC);
  
    $topicUpvotes = $votesData['topicUpvotes'] ?? 0;
    $replyUpvotes = $votesData['replyUpvotes'] ?? 0;
    $postUpvotes = $votesData['postUpvotes'] ?? 0;
  
    $explorerPoints = $topicUpvotes + $replyUpvotes + $postUpvotes;
} catch (PDOException $e) {
    die("Error occurred while calculating explorer points: " . $e->getMessage());
}

// try {
//     $stmt = $db->prepare("SELECT * FROM accounts WHERE accountid = :accountid");
//     $stmt->bindValue(':accountid', $_SESSION['accountid']);
//     $stmt->execute();
//     $votesData = $stmt->fetch(PDO::FETCH_ASSOC);
  
//     $displayNotifications = $displayNotifications['notification'];
//     $displayCalendar = $displayCalendar['displayCalendar'];
//     $displayNickname = $displayNickname['displayNickname'];
//     $displayBookmark = $displayBookmark['displayBookmark'];
//     $displayReligion = $displayReligion['displayReligion'];
  
//     $explorerPoints = $topicUpvotes + $replyUpvotes + $postUpvotes;
// } catch (PDOException $e) {
//     die("Error occurred while calculating explorer points: " . $e->getMessage());
// } 
?>
