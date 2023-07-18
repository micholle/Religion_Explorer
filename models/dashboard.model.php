<?php
require_once "connection.php";

class dashboardModel {

    static public function mdlGetDashboardData() {
        $dashboardData = [
            "todayNewUsers" => 46,
            "visitors" => 27,
            "registeredUsers" => 194,
            "registeredBuddhists" => 65,
            "registeredChristians" => 59,
            "registeredHindus" => 80,
            "registeredIslams" => 81,
            "registeredJews" => 56,
            "registeredOtherReligions" => 55,
            "registeredNonReligious" => 40,
            "januaryUsers" => 65,
            "februaryUsers" => 59,
            "marchUsers" => 80,
            "aprilUsers" => 81,
            "mayUsers" => 56,
            "juneUsers" => 55,
            "julyUsers" => 40,
            "augustUsers" => 70,
            "septemberUsers" => 85,
            "octoberUsers" => 90,
            "novemberUsers" => 75,
            "decemberUsers" => 63
        ];
        
        $jsonData = json_encode($dashboardData);
        header('Content-Type: application/json');
        echo $jsonData;
    }     

}

?>