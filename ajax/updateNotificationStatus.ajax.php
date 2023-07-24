<?php
require_once "../controllers/notifications.controller.php";

class updateNotificationsAjax {
    public $accountid;
  
    public function ajaxUpdateNotifications() {
      $accountid = $this->accountid;

      $answer = (new notificationsController)->ctrUpdateNotifications($accountid);
    }
}

$updateNotifications = new updateNotificationsAjax();
$updateNotifications->accountid = $_POST["accountid"];
$updateNotifications->ajaxUpdateNotifications();
?>