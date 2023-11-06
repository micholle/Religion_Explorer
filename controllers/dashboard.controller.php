<?php
require_once "../models/dashboard.model.php";

class dashboardController {
  
    static public function ctrGetDashboardData($data) {
        $answer = (new dashboardModel)->mdlGetDashboardData($data);
    }

}

?>