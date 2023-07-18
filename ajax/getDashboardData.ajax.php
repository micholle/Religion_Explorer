<?php
require_once "../controllers/dashboard.controller.php";

class dashboardAjax{
    public $username;

    public function ajaxGetDashboardData(){
        $answer = (new dashboardController) -> ctrGetDashboardData();
    }
}

$getDashboardData = new dashboardAjax();
$getDashboardData -> ajaxGetDashboardData();

?>