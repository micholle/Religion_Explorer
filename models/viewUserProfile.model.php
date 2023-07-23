<?php
require_once "connection.php"; // Assuming connection.php contains the database connection code

function getUserProfileInfo($accountid)
{
    $connection = new Connection();
    $pdo = $connection->connect();

    try {
        // Fetch user data from the accounts table
        $stmt = $pdo->prepare("SELECT 
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

        // Get the number of bookmarks for the user
        $stmt = $pdo->prepare("SELECT COUNT(*) AS bookmarks_count FROM bookmarks WHERE accountid = :accountid");
        $stmt->bindParam(":accountid", $accountid, PDO::PARAM_STR);
        $stmt->execute();
        $bookmarksCount = $stmt->fetch(PDO::FETCH_ASSOC)['bookmarks_count'];

        // Get the number of community creations for the user
        $stmt = $pdo->prepare("SELECT COUNT(*) AS creations_count FROM communitycreations WHERE accountid = :accountid");
        $stmt->bindParam(":accountid", $accountid, PDO::PARAM_STR);
        $stmt->execute();
        $creationsCount = $stmt->fetch(PDO::FETCH_ASSOC)['creations_count'];

        // Get the number of posts for the user
        $stmt = $pdo->prepare("SELECT COUNT(*) AS posts_count FROM posts WHERE accountid = :accountid");
        $stmt->bindParam(":accountid", $accountid, PDO::PARAM_STR);
        $stmt->execute();
        $postsCount = $stmt->fetch(PDO::FETCH_ASSOC)['posts_count'];

        // Get the accountDate for the user
        $stmt = $pdo->prepare("SELECT accountDate FROM accounts WHERE accountid = :accountid");
        $stmt->bindParam(":accountid", $accountid, PDO::PARAM_STR);
        $stmt->execute();
        $accountDate = $stmt->fetch(PDO::FETCH_ASSOC)['accountDate'];

        // Function to check if accountDate is less than one year from the current date
        function isAccountDateLessThanOneYear($accountDate) {
            $accountDateTime = strtotime($accountDate);
            $oneYearAgo = strtotime('-1 year');

            return $accountDateTime > $oneYearAgo;
        }
        $accountDateBadge = isAccountDateLessThanOneYear($accountDate) ? 'style="filter: grayscale(1);"' : '';

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

        // Put all data into an array
        $userProfileInfo = array(
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
            'accountDate' => $accountDate,
            'bookmarkBadge10' => $bookmarksCount < 10 ? 'style="filter: grayscale(1);"' : '',
            'bookmarkBadge50' => $bookmarksCount < 50 ? 'style="filter: grayscale(1);"' : '',
            'bookmarkBadge100' => $bookmarksCount < 100 ? 'style="filter: grayscale(1);"' : '',
            'bookmarkBadge250' => $bookmarksCount < 250 ? 'style="filter: grayscale(1);"' : '',
            'bookmarkBadge500' => $bookmarksCount < 500 ? 'style="filter: grayscale(1);"' : '',
            'postBadge10' => $postsCount < 10 ? 'style="filter: grayscale(1);"' : '',
            'postBadge50' => $postsCount < 50 ? 'style="filter: grayscale(1);"' : '',
            'postBadge100' => $postsCount < 100 ? 'style="filter: grayscale(1);"' : '',
            'postBadge250' => $postsCount < 250 ? 'style="filter: grayscale(1);"' : '',
            'postBadge500' => $postsCount < 500 ? 'style="filter: grayscale(1);"' : '',
            'creationBadge5' => $creationsCount < 5 ? 'style="filter: grayscale(1);"' : '',
            'creationBadge25' => $creationsCount < 25 ? 'style="filter: grayscale(1);"' : '',
            'creationBadge50' => $creationsCount < 50 ? 'style="filter: grayscale(1);"' : '',
            'creationBadge75' => $creationsCount < 75 ? 'style="filter: grayscale(1);"' : '',
            'creationBadge100' => $creationsCount < 100 ? 'style="filter: grayscale(1);"' : '',
            'explorerBadge250' => $explorerPoints < 250 ? 'style="filter: grayscale(1);"' : '',
            'explorerBadge500' => $explorerPoints < 500 ? 'style="filter: grayscale(1);"' : '',
            'explorerBadge1000' => $explorerPoints < 1000 ? 'style="filter: grayscale(1);"' : '',
            'explorerBadge2500' => $explorerPoints < 2500 ? 'style="filter: grayscale(1);"' : '',
            'explorerBadge5000' => $explorerPoints < 5000 ? 'style="filter: grayscale(1);"' : '',
            'accountDateBadge' => $accountDateBadge
        );

        // Return the user profile information array
        return $userProfileInfo;
    } catch (PDOException $e) {
        die("Error occurred while fetching user data: " . $e->getMessage());
    }
}
?>
