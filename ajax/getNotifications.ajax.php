<?php
require_once "../controllers/notifications.controller.php";

class notificationsAjax{
    public $accountid;

    public function ajaxGetNotifications(){
        $accountid = $this->accountid;
        $answer = (new notificationsController) -> ctrGetNotifications($accountid);
    }
}

$getMapData = new notificationsAjax();
$getMapData->accountid = $_POST["accountid"];
$getMapData -> ajaxGetNotifications();

?>