<?php
require_once "connection.php";

// Assuming you already have the $_SESSION['accountid'] set correctly
$db = new Connection();
$pdo = $db->connect();

// Get the number of bookmarks for the user
$stmt = $pdo->prepare("SELECT COUNT(*) AS bookmarks_count FROM bookmarks WHERE accountid = :accountid");
$stmt->bindParam(":accountid", $_SESSION['accountid'], PDO::PARAM_STR);
$stmt->execute();
$bookmarksCount = $stmt->fetch(PDO::FETCH_ASSOC)['bookmarks_count'];

if ($bookmarksCount >= 10) {
    if ($bookmarksCount == 10) {
        $achievement = "Tier 1 Scholar Badge";
    } else if ($bookmarksCount == 50) {
        $achievement = "Tier 2 Scholar Badge";
    } else if ($bookmarksCount == 100) {
        $achievement = "Tier 3 Scholar Badge";
    } else if ($bookmarksCount == 250) {
        $achievement = "Tier 4 Scholar Badge";
    } else if ($bookmarksCount == 500) {
        $achievement = "Tier 5 Scholar Badge";
    } else {
        $achievement = "";
    }

    if ($achievement != "") {
        $checkAchievements = $pdo->prepare("SELECT COUNT(*) FROM achievements WHERE accountid = :accountid AND achievement = :achievement");
        $checkAchievements->bindParam(":accountid", $_SESSION['accountid'], PDO::PARAM_STR);
        $checkAchievements->bindParam(":achievement", $achievement, PDO::PARAM_STR);
        $checkAchievements->execute();
    
        $count = $checkAchievements->fetchColumn();
    
        if ($count == 0) {
            $newAchievement = $pdo->prepare("INSERT INTO achievements (accountid, achievement) VALUES (:accountid, :achievement)");
            $newAchievement->bindParam(":accountid", $_SESSION['accountid'], PDO::PARAM_STR);
            $newAchievement->bindParam(":achievement", $achievement, PDO::PARAM_STR);
            $newAchievement->execute();

            $getAchievementId = $pdo->prepare("SELECT achievementid FROM achievements WHERE accountid = :accountid AND achievement = :achievement");
            $getAchievementId->bindParam(":accountid", $_SESSION['accountid'], PDO::PARAM_STR);
            $getAchievementId->bindParam(":achievement", $achievement, PDO::PARAM_STR);
            $getAchievementId->execute();
            $achievementid = $getAchievementId->fetchColumn();

            $notificationDate = date('Y-m-d');

            $addToNotifications = $pdo->prepare("INSERT INTO notifications(accountid, achievementid, notificationSource, notificationDate) VALUES (:accountid, :achievementid, :notificationSource, :notificationDate)");
            $addToNotifications->bindParam(":accountid", $_SESSION['accountid'], PDO::PARAM_STR);
            $addToNotifications->bindParam(":achievementid", $achievementid, PDO::PARAM_INT);
            $addToNotifications->bindValue(":notificationSource", "Achievements", PDO::PARAM_STR);
            $addToNotifications->bindParam(":notificationDate", $notificationDate, PDO::PARAM_STR);
            $addToNotifications->execute();
        }
    }
}


// Get the number of community creations for the user
$stmt = $pdo->prepare("SELECT COUNT(*) AS creations_count FROM communitycreations WHERE accountid = :accountid");
$stmt->bindParam(":accountid", $_SESSION['accountid'], PDO::PARAM_STR);
$stmt->execute();
$creationsCount = $stmt->fetch(PDO::FETCH_ASSOC)['creations_count'];

if ($creationsCount >= 5) {
    if ($creationsCount < 25) {
        $achievement = "Tier 1 Creator Badge";
    } else if ($creationsCount >= 25) {
        $achievement = "Tier 2 Creator Badge";
    } else if ($creationsCount >= 50) {
        $achievement = "Tier 3 Creator Badge";
    } else if ($creationsCount >= 75) {
        $achievement = "Tier 4 Creator Badge";
    } else if ($creationsCount >= 100) {
        $achievement = "Tier 5 Creator Badge";
    } else {
        $achievement = "";
    }

    if ($achievement != "") {
        $checkAchievements = $pdo->prepare("SELECT COUNT(*) FROM achievements WHERE accountid = :accountid AND achievement = :achievement");
        $checkAchievements->bindParam(":accountid", $_SESSION['accountid'], PDO::PARAM_STR);
        $checkAchievements->bindParam(":achievement", $achievement, PDO::PARAM_STR);
        $checkAchievements->execute();
        $count = $checkAchievements->fetchColumn();
    
        if ($count == 0) {
            $newAchievement = $pdo->prepare("INSERT INTO achievements (accountid, achievement) VALUES (:accountid, :achievement)");
            $newAchievement->bindParam(":accountid", $_SESSION['accountid'], PDO::PARAM_STR);
            $newAchievement->bindParam(":achievement", $achievement, PDO::PARAM_STR);
            $newAchievement->execute();

            $getAchievementId = $pdo->prepare("SELECT achievementid FROM achievements WHERE accountid = :accountid AND achievement = :achievement");
            $getAchievementId->bindParam(":accountid", $_SESSION['accountid'], PDO::PARAM_STR);
            $getAchievementId->bindParam(":achievement", $achievement, PDO::PARAM_STR);
            $getAchievementId->execute();
            $achievementid = $getAchievementId->fetchColumn();

            $notificationDate = date('Y-m-d');

            $addToNotifications = $pdo->prepare("INSERT INTO notifications(accountid, achievementid, notificationSource, notificationDate) VALUES (:accountid, :achievementid, :notificationSource, :notificationDate)");
            $addToNotifications->bindParam(":accountid", $_SESSION['accountid'], PDO::PARAM_STR);
            $addToNotifications->bindParam(":achievementid", $achievementid, PDO::PARAM_INT);
            $addToNotifications->bindValue(":notificationSource", "Achievements", PDO::PARAM_STR);
            $addToNotifications->bindParam(":notificationDate", $notificationDate, PDO::PARAM_STR);
            $addToNotifications->execute();
        }
    }
}

// Get the number of posts for the user
$stmt = $pdo->prepare("SELECT COUNT(*) AS posts_count FROM posts WHERE accountid = :accountid");
$stmt->bindParam(":accountid", $_SESSION['accountid'], PDO::PARAM_STR);
$stmt->execute();
$postsCount = $stmt->fetch(PDO::FETCH_ASSOC)['posts_count'];

if ($postsCount >= 10) {
    if ($postsCount == 10) {
        $achievement = "10 Posts Badge";
    } else if ($postsCount == 50) {
        $achievement = "50 Posts Badge";
    } else if ($postsCount == 100) {
        $achievement = "100 Posts Badge";
    } else if ($postsCount == 250) {
        $achievement = "250 Posts Badge";
    } else if ($postsCount == 500) {
        $achievement = "500 Posts Badge";
    } else {
        $achievement = "";
    }

    if ($achievement != "") {
        $checkAchievements = $pdo->prepare("SELECT COUNT(*) FROM achievements WHERE accountid = :accountid AND achievement = :achievement");
        $checkAchievements->bindParam(":accountid", $_SESSION['accountid'], PDO::PARAM_STR);
        $checkAchievements->bindParam(":achievement", $achievement, PDO::PARAM_STR);
        $checkAchievements->execute();
    
        $count = $checkAchievements->fetchColumn();
    
        if ($count == 0) {
            $newAchievement = $pdo->prepare("INSERT INTO achievements (accountid, achievement) VALUES (:accountid, :achievement)");
            $newAchievement->bindParam(":accountid", $_SESSION['accountid'], PDO::PARAM_STR);
            $newAchievement->bindParam(":achievement", $achievement, PDO::PARAM_STR);
            $newAchievement->execute();

            $getAchievementId = $pdo->prepare("SELECT achievementid FROM achievements WHERE accountid = :accountid AND achievement = :achievement");
            $getAchievementId->bindParam(":accountid", $_SESSION['accountid'], PDO::PARAM_STR);
            $getAchievementId->bindParam(":achievement", $achievement, PDO::PARAM_STR);
            $getAchievementId->execute();
            $achievementid = $getAchievementId->fetchColumn();

            $notificationDate = date('Y-m-d');

            $addToNotifications = $pdo->prepare("INSERT INTO notifications(accountid, achievementid, notificationSource, notificationDate) VALUES (:accountid, :achievementid, :notificationSource, :notificationDate)");
            $addToNotifications->bindParam(":accountid", $_SESSION['accountid'], PDO::PARAM_STR);
            $addToNotifications->bindParam(":achievementid", $achievementid, PDO::PARAM_INT);
            $addToNotifications->bindValue(":notificationSource", "Achievements", PDO::PARAM_STR);
            $addToNotifications->bindParam(":notificationDate", $notificationDate, PDO::PARAM_STR);
            $addToNotifications->execute();
        }
    }
}

//Get explorer points
if ($explorerPoints >= 250) {
    if ($explorerPoints == 250) {
        $achievement = "Tier 1 Explorer Badge";
    } else if ($explorerPoints == 500) {
        $achievement = "Tier 2 Explorer Badge";
    } else if ($explorerPoints == 1000) {
        $achievement = "Tier 3 Explorer Badge";
    } else if ($explorerPoints == 2500) {
        $achievement = "Tier 4 Explorer Badge";
    } else if ($explorerPoints == 5000) {
        $achievement = "Tier 5 Explorer Badge";
    } else {
        $achievement = "";
    }

    if ($achievement != "") {
        $checkAchievements = $pdo->prepare("SELECT COUNT(*) FROM achievements WHERE accountid = :accountid AND achievement = :achievement");
        $checkAchievements->bindParam(":accountid", $_SESSION['accountid'], PDO::PARAM_STR);
        $checkAchievements->bindParam(":achievement", $achievement, PDO::PARAM_STR);
        $checkAchievements->execute();
    
        $count = $checkAchievements->fetchColumn();
    
        if ($count == 0) {
            $newAchievement = $pdo->prepare("INSERT INTO achievements (accountid, achievement) VALUES (:accountid, :achievement)");
            $newAchievement->bindParam(":accountid", $_SESSION['accountid'], PDO::PARAM_STR);
            $newAchievement->bindParam(":achievement", $achievement, PDO::PARAM_STR);
            $newAchievement->execute();

            $getAchievementId = $pdo->prepare("SELECT achievementid FROM achievements WHERE accountid = :accountid AND achievement = :achievement");
            $getAchievementId->bindParam(":accountid", $_SESSION['accountid'], PDO::PARAM_STR);
            $getAchievementId->bindParam(":achievement", $achievement, PDO::PARAM_STR);
            $getAchievementId->execute();
            $achievementid = $getAchievementId->fetchColumn();

            $notificationDate = date('Y-m-d');

            $addToNotifications = $pdo->prepare("INSERT INTO notifications(accountid, achievementid, notificationSource, notificationDate) VALUES (:accountid, :achievementid, :notificationSource, :notificationDate)");
            $addToNotifications->bindParam(":accountid", $_SESSION['accountid'], PDO::PARAM_STR);
            $addToNotifications->bindParam(":achievementid", $achievementid, PDO::PARAM_INT);
            $addToNotifications->bindValue(":notificationSource", "Achievements", PDO::PARAM_STR);
            $addToNotifications->bindParam(":notificationDate", $notificationDate, PDO::PARAM_STR);
            $addToNotifications->execute();
        }
    }
}

// Get the accountDate for the user
$stmt = $pdo->prepare("SELECT accountDate FROM accounts WHERE accountid = :accountid");
$stmt->bindParam(":accountid", $_SESSION['accountid'], PDO::PARAM_STR);
$stmt->execute();
$accountDate = $stmt->fetch(PDO::FETCH_ASSOC)['accountDate'];

$accountDateTime = strtotime($accountDate);
$oneYearAgo = strtotime('-1 year');

if ($accountDateTime == $oneYearAgo) {
    $achievement = "1-year Anniversary Badge";
    
    $checkAchievements = $pdo->prepare("SELECT COUNT(*) FROM achievements WHERE accountid = :accountid AND achievement = :achievement");
    $checkAchievements->bindParam(":accountid", $_SESSION['accountid'], PDO::PARAM_STR);
    $checkAchievements->bindParam(":achievement", $achievement, PDO::PARAM_STR);
    $checkAchievements->execute();

    $count = $checkAchievements->fetchColumn();

    if ($count == 0) {
        $newAchievement = $pdo->prepare("INSERT INTO achievements (accountid, achievement) VALUES (:accountid, :achievement)");
        $newAchievement->bindParam(":accountid", $_SESSION['accountid'], PDO::PARAM_STR);
        $newAchievement->bindParam(":achievement", $achievement, PDO::PARAM_STR);
        $newAchievement->execute();

        $getAchievementId = $pdo->prepare("SELECT achievementid FROM achievements WHERE accountid = :accountid AND achievement = :achievement");
        $getAchievementId->bindParam(":accountid", $_SESSION['accountid'], PDO::PARAM_STR);
        $getAchievementId->bindParam(":achievement", $achievement, PDO::PARAM_STR);
        $getAchievementId->execute();
        $achievementid = $getAchievementId->fetchColumn();

        $notificationDate = date('Y-m-d');

        $addToNotifications = $pdo->prepare("INSERT INTO notifications(accountid, achievementid, notificationSource, notificationDate) VALUES (:accountid, :achievementid, :notificationSource, :notificationDate)");
        $addToNotifications->bindParam(":accountid", $_SESSION['accountid'], PDO::PARAM_STR);
        $addToNotifications->bindParam(":achievementid", $achievementid, PDO::PARAM_INT);
        $addToNotifications->bindValue(":notificationSource", "Achievements", PDO::PARAM_STR);
        $addToNotifications->bindParam(":notificationDate", $notificationDate, PDO::PARAM_STR);
        $addToNotifications->execute();
    }
}

$bookmarkBadge10 = $bookmarksCount < 10 ? 'style="filter: grayscale(1);"' : '';
$bookmarkBadge50 = $bookmarksCount < 50 ? 'style="filter: grayscale(1);"' : '';
$bookmarkBadge100 = $bookmarksCount < 100 ? 'style="filter: grayscale(1);"' : '';
$bookmarkBadge250 = $bookmarksCount < 250 ? 'style="filter: grayscale(1);"' : '';
$bookmarkBadge500 = $bookmarksCount < 500 ? 'style="filter: grayscale(1);"' : '';

$postBadge10 = $postsCount < 10 ? 'style="filter: grayscale(1);"' : '';
$postBadge50 = $postsCount < 50 ? 'style="filter: grayscale(1);"' : '';
$postBadge100 = $postsCount < 100 ? 'style="filter: grayscale(1);"' : '';
$postBadge250 = $postsCount < 250 ? 'style="filter: grayscale(1);"' : '';
$postBadge500 = $postsCount < 500 ? 'style="filter: grayscale(1);"' : '';

$creationBadge5 = $creationsCount < 5 ? 'style="filter: grayscale(1);"' : '';
$creationBadge25 = $creationsCount < 25 ? 'style="filter: grayscale(1);"' : '';
$creationBadge50 = $creationsCount < 50 ? 'style="filter: grayscale(1);"' : '';
$creationBadge75 = $creationsCount < 75 ? 'style="filter: grayscale(1);"' : '';
$creationBadge100 = $creationsCount < 100 ? 'style="filter: grayscale(1);"' : '';

$explorerBadge250 = $explorerPoints < 250 ? 'style="filter: grayscale(1);"' : '';
$explorerBadge500 = $explorerPoints < 500 ? 'style="filter: grayscale(1);"' : '';
$explorerBadge1000 = $explorerPoints < 1000 ? 'style="filter: grayscale(1);"' : '';
$explorerBadge2500 = $explorerPoints < 2500 ? 'style="filter: grayscale(1);"' : '';
$explorerBadge5000 = $explorerPoints < 5000 ? 'style="filter: grayscale(1);"' : '';

function isAccountDateLessThanOneYear($accountDate) {
    $accountDateTime = strtotime($accountDate);
    $oneYearAgo = strtotime('-1 year');

    return $accountDateTime > $oneYearAgo;
}
$accountDateBadge = isAccountDateLessThanOneYear($accountDate) ? 'style="filter: grayscale(1);"' : '';
?>
