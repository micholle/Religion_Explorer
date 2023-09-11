<?php
require_once "connection.php";

class notificationsModel {

    static public function mdlGetNotifications($accountid) {
        $db = new Connection();
        $pdo = $db->connect();

        $notifications_stmt = $pdo->prepare("SELECT * FROM notifications WHERE accountid = :accountid ORDER BY notificationDate DESC");
        $notifications_stmt->bindParam(":accountid", $accountid, PDO::PARAM_STR);
        $notifications_stmt->execute();
        $userNotifications = $notifications_stmt->fetchAll(PDO::FETCH_ASSOC);
        $notificationsList = [];
        
        date_default_timezone_set('Asia/Singapore');
        $today = date("Y-m-d H:i:s");

        foreach ($userNotifications as $notif) {
            if ($notif["notificationDate"] <= $today) {
                $uniqueid = "";
                $notification = "";
                $notificationIcon = "";
                $personInvolved = "";
                $upvotesCount = 0;
                $contentViolations = "";
                $notificationStatus = "";
                $avatar = "";
    
                if ($notif["notificationSource"] == "Calendar") {
                    $stmt = $pdo->prepare("SELECT c.event, n.notificationStatus
                                          FROM notifications AS n
                                          JOIN personalcalendar AS c ON n.personaleventid = c.personaleventid
                                          WHERE n.notificationid = :notificationid");
                    $stmt->bindParam(":notificationid", $notif["notificationid"], PDO::PARAM_STR);
                    $stmt->execute();
                    $notificationInfo = $stmt->fetch(PDO::FETCH_ASSOC);
                    
                    $notification = $notificationInfo["event"];
                    $notificationIcon = "../assets/img/feat-calendar.png";
                    $notificationStatus = $notificationInfo["notificationStatus"];
                } else if ($notif["notificationSource"] == "Community Creations") {
                    $uniqueid = $notif["creationid"];
                    
                    $stmt = $pdo->prepare("SELECT cc.title, a.username, n.notificationStatus
                                          FROM notifications AS n
                                          LEFT JOIN personalcalendar AS c ON n.personaleventid = c.personaleventid
                                          JOIN communitycreations AS cc ON n.creationid = cc.creationid
                                          LEFT JOIN accounts AS a ON n.personInvolved = a.accountid
                                          WHERE n.notificationid = :notificationid");
                    $stmt->bindParam(":notificationid", $notif["notificationid"], PDO::PARAM_STR);
                    $stmt->execute();
                    $notificationInfo = $stmt->fetch(PDO::FETCH_ASSOC);
                    
                    $notification = $notificationInfo["title"];
                    $notificationIcon = "../assets/img/diversity.png";
                    $personInvolved = $notificationInfo["username"];
                    $notificationStatus = $notificationInfo["notificationStatus"];
                } else if ($notif["notificationSource"] == "Discussion Forum Posts") {
                    $stmt = $pdo->prepare("SELECT p.topicId, t.topicTitle, a.username, n.notificationStatus, a.avatar
                                            FROM notifications AS n
                                            LEFT JOIN posts AS p ON n.postid = p.postId
                                            LEFT JOIN topics AS t ON p.topicId = t.topicId
                                            LEFT JOIN accounts AS a ON n.personInvolved = a.accountid
                                            WHERE n.notificationid = :notificationid");
                    $stmt->bindParam(":notificationid", $notif["notificationid"], PDO::PARAM_STR);
                    $stmt->execute();
                    $notificationInfo = $stmt->fetch(PDO::FETCH_ASSOC);
                    
                    $uniqueid = $notificationInfo["topicId"];
                    $notification = $notificationInfo["topicTitle"];
                    $notificationIcon = "../assets/img/discussionForum/comments.png";
                    $personInvolved = $notificationInfo["username"];
                    $notificationStatus = $notificationInfo["notificationStatus"];
                    $avatar = $notificationInfo["avatar"];
                } else if ($notif["notificationSource"] == "Discussion Forum Replies") {
                    $stmt = $pdo->prepare("SELECT p.topicId, t.topicTitle, a.username, n.notificationStatus, a.avatar
                                            FROM notifications AS n
                                            LEFT JOIN reply AS r ON n.replyid = r.replyId
                                            LEFT JOIN posts AS p ON r.postid = p.postId
                                            LEFT JOIN topics AS t ON p.topicId = t.topicId
                                            LEFT JOIN accounts AS a ON n.personInvolved = a.accountid
                                            WHERE n.notificationid = :notificationid");
                    $stmt->bindParam(":notificationid", $notif["notificationid"], PDO::PARAM_STR);
                    $stmt->execute();
                    $notificationInfo = $stmt->fetch(PDO::FETCH_ASSOC);
                    
                    $uniqueid = $notificationInfo["topicId"];
                    $notification = $notificationInfo["topicTitle"];
                    $notificationIcon = "../assets/img/discussionForum/comments.png";
                    $personInvolved = $notificationInfo["username"];
                    $notificationStatus = $notificationInfo["notificationStatus"];
                    $avatar = $notificationInfo["avatar"];
                } else if ($notif["notificationSource"] == "Discussion Forum Topics Upvote") {
                    $stmt = $pdo->prepare("SELECT n.topicid, t.topicTitle, t.upvotes, a.username, n.notificationStatus, a.avatar
                                            FROM notifications AS n
                                            LEFT JOIN topics AS t ON n.topicid = t.topicId
                                            LEFT JOIN accounts AS a ON n.personInvolved = a.accountid
                                            WHERE n.notificationid = :notificationid");
                    $stmt->bindParam(":notificationid", $notif["notificationid"], PDO::PARAM_STR);
                    $stmt->execute();
                    $notificationInfo = $stmt->fetch(PDO::FETCH_ASSOC);
                    
                    $uniqueid = $notificationInfo["topicid"];
                    $notification = $notificationInfo["topicTitle"];
                    $notificationIcon = "../assets/img/discussionForum/upvote-active.png";
                    $personInvolved = $notificationInfo["username"];
                    $upvotesCount = $notificationInfo["upvotes"];
                    $notificationStatus = $notificationInfo["notificationStatus"];
                    $avatar = $notificationInfo["avatar"];
                } else if ($notif["notificationSource"] == "Discussion Forum Posts Upvote") {
                    $stmt = $pdo->prepare("SELECT p.topicId, p.postContent, p.upvotes, a.username, n.notificationStatus, a.avatar
                                            FROM notifications AS n
                                            LEFT JOIN posts AS p ON n.postid = p.postId
                                            LEFT JOIN accounts AS a ON n.personInvolved = a.accountid
                                            WHERE n.notificationid = :notificationid");
                    $stmt->bindParam(":notificationid", $notif["notificationid"], PDO::PARAM_STR);
                    $stmt->execute();
                    $notificationInfo = $stmt->fetch(PDO::FETCH_ASSOC);
                    
                    $uniqueid = $notificationInfo["topicId"];
                    $notification = $notificationInfo["postContent"];
                    $notificationIcon = "../assets/img/discussionForum/upvote-active.png";
                    $personInvolved = $notificationInfo["username"];
                    $upvotesCount = $notificationInfo["upvotes"];
                    $notificationStatus = $notificationInfo["notificationStatus"];
                    $avatar = $notificationInfo["avatar"];
                } else if ($notif["notificationSource"] == "Discussion Forum Replies Upvote") {
                    $stmt = $pdo->prepare("SELECT p.topicId, r.replyContent, r.upvotes, a.username, n.notificationStatus, a.avatar
                                            FROM notifications AS n
                                            LEFT JOIN reply AS r ON n.replyid = r.replyId
                                            LEFT JOIN posts AS p ON r.postId = p.postId
                                            LEFT JOIN accounts AS a ON n.personInvolved = a.accountid
                                            WHERE n.notificationid = :notificationid");
                    $stmt->bindParam(":notificationid", $notif["notificationid"], PDO::PARAM_STR);
                    $stmt->execute();
                    $notificationInfo = $stmt->fetch(PDO::FETCH_ASSOC);
                    
                    $uniqueid = $notificationInfo["topicId"];
                    $notification = $notificationInfo["replyContent"];
                    $notificationIcon = "../assets/img/discussionForum/upvote-active.png";
                    $personInvolved = $notificationInfo["username"];
                    $upvotesCount = $notificationInfo["upvotes"];
                    $notificationStatus = $notificationInfo["notificationStatus"];
                    $avatar = $notificationInfo["avatar"];
                } else if ($notif["notificationSource"] == "Reported Content") {
                    $stmt = $pdo->prepare("SELECT n.reportid, r.contentid, r.contentViolations, n.notificationStatus
                                            FROM notifications AS n
                                            LEFT JOIN reportedcontent AS r ON n.reportid = r.reportid
                                            WHERE n.notificationid = :notificationid AND r.actionTaken = :actionTaken");
                    $stmt->bindParam(":notificationid", $notif["notificationid"], PDO::PARAM_STR);
                    $stmt->bindValue(":actionTaken", "Delete", PDO::PARAM_STR);
                    $stmt->execute();
                    $notificationInfo = $stmt->fetch(PDO::FETCH_ASSOC);
                    
                    $notificationIcon = "../assets/img/discussionForum/report.png";
                    $contentViolations = $notificationInfo["contentViolations"];
                    $notificationStatus = $notificationInfo["notificationStatus"];
                } else if ($notif["notificationSource"] == "Achievements") {
                    $stmt = $pdo->prepare("SELECT n.achievementid, a.achievement, n.notificationStatus
                    FROM notifications AS n
                    JOIN achievements AS a ON n.achievementid = a.achievementid
                    WHERE n.notificationid = :notificationid");
                    $stmt->bindParam(":notificationid", $notif["notificationid"], PDO::PARAM_STR);
                    $stmt->execute();
                    $notificationInfo = $stmt->fetch(PDO::FETCH_ASSOC);
                    $notification = $notificationInfo["achievement"];
                    $notificationIcon = "";

                    if (preg_match("/Posts (10|50|100|250|500)/", $notification)) {
                        $notificationIcon = "../assets/img/userProfile/achievements/forum-\\1.png";
                    } else if (preg_match("/Explorer/", $notification)) {
                        $tierNumber = $notification[5];
                        $notificationIcon = "../assets/img/userProfile/achievements/explorer-tier" . $tierNumber . ".png";
                    } else if (preg_match("/Scholar/", $notification)) {
                        $tierNumber = $notification[5];
                        $notificationIcon = "../assets/img/userProfile/achievements/scholar-tier" . $tierNumber . ".png";
                    } else if (preg_match("/Creator/", $notification)) {
                        $tierNumber = $notification[5];
                        $notificationIcon = "../assets/img/userProfile/achievements/creator-tier" . $tierNumber . ".png";
                    } else if (preg_match("/Anniversary/", $notification)) {
                        $notificationIcon = "../assets/img/userProfile/achievements/1-year-anniv.png";
                    }

                    $notificationStatus = $notificationInfo["notificationStatus"];
                }

                $stmt = $pdo->prepare("SELECT notifications FROM accounts WHERE accountid = :accountid");
                $stmt->bindParam(':accountid', $accountid, PDO::PARAM_STR);
                $stmt->execute();
                $displayNotifications = $stmt->fetch(PDO::FETCH_ASSOC)['notifications'];
                
                $notificationDate = date('m-d-Y H:i', strtotime($notif["notificationDate"]));
                $notificationsList[$notif["notificationid"]] = [
                    "uniqueid" => $uniqueid,
                    "notification" => $notification,
                    "notificationIcon" => $notificationIcon,
                    "notificationDate" => $notificationDate,
                    "personInvolved" => $personInvolved,
                    "notificationSource" => $notif["notificationSource"],
                    "upvotesCount" => $upvotesCount,
                    "contentViolations" => $contentViolations,
                    "notificationStatus" => $notificationStatus,
                    "displayNotifications" => $displayNotifications,
                    "avatar" => base64_encode($avatar)
                ];
            }
        }
        
        $jsonData = json_encode($notificationsList);
        header('Content-Type: application/json');
        echo $jsonData;
    }   

    static public function mdlUpdateNotifications($accountid) {
        $db = new Connection();
        $pdo = $db->connect();

        try {
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->beginTransaction();
    
            $stmt = $pdo->prepare("UPDATE notifications SET notificationStatus = 'Read' WHERE accountid = :accountid");
            $stmt->bindParam(":accountid", $accountid, PDO::PARAM_STR);
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