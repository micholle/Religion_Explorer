<?php
require_once "../controllers/notifications.controller.php";

class notificationsAjax{
    public $username;

    public function ajaxGetNotifications(){
        $username = $this->username;
        $answer = (new notificationsController) -> ctrGetNotifications($username);
    }
}

$getMapData = new notificationsAjax();
$getMapData->username = $_POST["username"];
$getMapData -> ajaxGetNotifications();

?>