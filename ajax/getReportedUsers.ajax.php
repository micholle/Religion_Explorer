<?php
require_once "../controllers/reportedUsers.controller.php";

class reportedUsersAjax{
    public function ajaxGetReportedUsers(){
        $answer = (new reportedUsersController) -> ctrGetReportedUsers();
    }
}

$getReportedUsers = new reportedUsersAjax();
$getReportedUsers -> ajaxGetReportedUsers();

?>