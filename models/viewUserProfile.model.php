<?php
require_once "connection.php"; // Assuming connection.php contains the database connection code

function getUserProfileInfo($accountid)
{
    $connection = new Connection();
    $db = $connection->connect();

    try {
        $stmt = $db->prepare("SELECT 
                                (SELECT COALESCE(SUM(upvotes), 0) FROM topics WHERE accountid = :accountid) AS topicUpvotes,
                                (SELECT COALESCE(SUM(upvotes), 0) FROM reply WHERE accountid = :accountid) AS replyUpvotes,
                                (SELECT COALESCE(SUM(upvotes), 0) FROM posts WHERE accountid = :accountid) AS postUpvotes,
                                notifications, displayCalendar, displayNickname, displayBookmark, displayReligion, displayPage,
                                avatar, nickname, religion, accountDate, username
                            FROM accounts 
                            WHERE accountid = :accountid");
        $stmt->bindValue(':accountid', $accountid);
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

        // Additional user information
        $avatar = $userData['avatar'];
        $nickname = $userData['nickname'];
        $username = $userData['username'];
        $religion = $userData['religion'];
        $accountDate = $userData['accountDate'];

        // Return an array containing user information
        return array(
            'explorerPoints' => $explorerPoints,
            'displayNotifications' => $displayNotifications,
            'displayCalendar' => $displayCalendar,
            'displayNickname' => $displayNickname,
            'displayBookmark' => $displayBookmark,
            'displayReligion' => $displayReligion,
            'pageDisplayAfterLogin' => $pageDisplayAfterLogin,
            'avatar' => $avatar,
            'nickname' => $nickname,
            'username' => $username,
            'religion' => $religion,
            'accountDate' => $accountDate
        );
    } catch (PDOException $e) {
        die("Error occurred while fetching user data: " . $e->getMessage());
    }
}
?>
