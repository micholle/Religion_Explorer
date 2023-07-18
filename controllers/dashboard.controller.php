<?php
require_once "../models/dashboard.model.php";

class dashboardController {
  
    static public function ctrGetDashboardData() {
        $answer = (new dashboardModel)->mdlGetDashboardData();
    }

}

?>