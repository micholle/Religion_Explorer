<?php
session_start(); 
require_once "connection.php";

$connection = new Connection();
$db = $connection->connect();

try {
    $stmt = $db->prepare("SELECT 
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
    $explorerPoints = $topicUpvotes + $replyUpvotes + $postUpvotes;
} catch (PDOException $e) {
    die("Error occurred while fetching user data: " . $e->getMessage());
}
?>
