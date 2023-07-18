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
                $notificationMessage = "";
                $notificationIcon = "";
    
                if ($notif["notificationSource"] == "Calendar") {
                    $notification = $notif["calendarEvent"];
                    $notificationMessage = " starts today.";
                    $notificationIcon = "../assets/img/feat-calendar.png";
                }
    
                $notificationDate = date('m-d-Y', strtotime($notif["notificationDate"]));
                $notificationsList[$notificationDate] = [
                    "notification" => $notification,
                    "notificationMessage" => $notificationMessage,
                    "notificationIcon" => $notificationIcon,
                    "notificationDate" => $notificationDate
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