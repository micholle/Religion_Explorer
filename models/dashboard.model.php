<?php
require_once "connection.php";

class dashboardModel {

    static public function mdlGetDashboardData() {
        $dashboardData = [
            "todayNewUsers" => 46,
            "online" => 12,
            "visitors" => 27,
            "registeredUsers" => 194,

            "bookmarks" => 123,
            "communityUploads" => 56,
            "forumPosts" => 543,
            "celebratedEvents" => 47,

            //users by religion
            "registeredBuddhists" => 65,
            "registeredChristians" => 59,
            "registeredHindus" => 80,
            "registeredIslams" => 81,
            "registeredJews" => 56,
            "registeredOtherReligions" => 55,
            "registeredNonReligious" => 40,

            //users by month (2022)
            "januaryUsers2022" => 75,
            "februaryUsers2022" => 62,
            "marchUsers2022" => 89,
            "aprilUsers2022" => 78,
            "mayUsers2022" => 55,
            "juneUsers2022" => 63,
            "julyUsers2022" => 48,
            "augustUsers2022" => 71,
            "septemberUsers2022" => 92,
            "octoberUsers2022" => 80,
            "novemberUsers2022" => 67,
            "decemberUsers2022" => 70,

            //users by month (2023)
            "januaryUsers2023" => 65,
            "februaryUsers2023" => 59,
            "marchUsers2023" => 80,
            "aprilUsers2023" => 81,
            "mayUsers2023" => 56,
            "juneUsers2023" => 55,
            "julyUsers2023" => 40,
            "augustUsers2023" => 70,
            "septemberUsers2023" => 85,
            "octoberUsers2023" => 90,
            "novemberUsers2023" => 75,
            "decemberUsers2023" => 63
        ];
        
        $jsonData = json_encode($dashboardData);
        header('Content-Type: application/json');
        echo $jsonData;
    }     

}

?>