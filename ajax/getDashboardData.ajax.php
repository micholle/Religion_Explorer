<?php
require_once "../controllers/dashboard.controller.php";

class dashboardAjax{
    public $adminDashboardMonth;
    public $adminDashboardWeek;
    public $adminDashboardYear;

    public function ajaxGetDashboardData(){
        $data = array(
            "adminDashboardMonth" => $this->adminDashboardMonth,
            "adminDashboardWeek" => $this->adminDashboardWeek,
            "adminDashboardYear" => $this->adminDashboardYear
          );

        $answer = (new dashboardController) -> ctrGetDashboardData($data);
    }
}

$getDashboardData = new dashboardAjax();
$getDashboardData->adminDashboardMonth = $_POST["adminDashboardMonth"];
$getDashboardData->adminDashboardWeek = $_POST["adminDashboardWeek"];
$getDashboardData->adminDashboardYear = $_POST["adminDashboardYear"];
$getDashboardData -> ajaxGetDashboardData();

?>