<?php
require_once "../controllers/report.controller.php";

class reportedUsersAjax{
    public function ajaxGetReportedUsers(){
        $answer = (new reportUserController) -> ctrGetReportedUsers();
    }
}

$getReportedUsers = new reportedUsersAjax();
$getReportedUsers -> ajaxGetReportedUsers();

?>