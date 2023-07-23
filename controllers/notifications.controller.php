<?php
require_once "../models/notifications.model.php";

class notificationsController {
  
    static public function ctrGetNotifications($username) {
        $answer = (new notificationsModel)->mdlGetNotifications($username);
    }

    static public function ctrUpdateNotifications($accountid) {
        $answer = (new notificationsModel)->mdlUpdateNotifications($accountid);
    }

}

?>