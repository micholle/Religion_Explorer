<?php
require_once "connection.php";

class notificationsModel {

    static public function mdlGetNotifications($username) {
        $db = new Connection();
        $pdo = $db->connect();
    
        $stmt = $pdo->prepare("SELECT * FROM notifications ORDER BY notificationDate DESC");
        $stmt->execute();
        $userNotifications = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $notificationsList = [];
    
        $currentTimestamp = time();
        $today = date('Y-m-d', $currentTimestamp);
    
        foreach ($userNotifications as $notif) {
            if (($notif["username"] == $username) && ($notif["notificationDate"] <= $today)) {
    
                $notification = "";
                $notificationIcon = "";
    
                if ($notif["notificationSource"] == "Calendar") {
                    $notification = $notif["calendarEvent"];
                    $notificationIcon = "../assets/img/feat-calendar.png";
                } else if ($notif["notificationSource"] == "Community Creations") {
                    $stmt2 = $pdo->prepare("SELECT title FROM communitycreations WHERE creationid = :creationid");
                    $stmt2->bindParam(":creationid", $notif["creationid"], PDO::PARAM_STR);
                    $stmt2->execute();
                    $title = $stmt2->fetchColumn();

                    $notification = $title;
                    $notificationIcon = "../assets/img/diversity.png";
                }
    
                $notificationDate = date('m-d-Y', strtotime($notif["notificationDate"]));
                $notificationsList[$notif["notificationid"]] = [
                    "uniqueid" => $notif["creationid"],
                    "notification" => $notification,
                    "notificationIcon" => $notificationIcon,
                    "notificationDate" => $notificationDate,
                    "personInvolved" => $notif["personInvolved"],
                    "notificationSource" => $notif["notificationSource"]
                ];
            }
        }
    
        krsort($notificationsList);
        
        $jsonData = json_encode($notificationsList);
        header('Content-Type: application/json');
        echo $jsonData;
    }     

}

?>