<?php
require_once "../views/modules/reportUser.php";

class reportUserAjax{
    public function ajaxShowReportUser(){
        $answer = createReportUserModal();
        echo $answer;
    }
}

$showReportUser = new reportUserAjax();
$showReportUser -> ajaxShowReportUser();

?>