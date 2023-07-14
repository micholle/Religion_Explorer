<?php

class reportedUsersModel {

    public function mdlGetReportedUsers() {
        $reportedUsers = [
            "1" => [
                "userLink" => "user link 1",
                "violation" => ["Harrasment or Bullying", "Offensive Language"],
                "reportedOn" => "07-15-2023",
                "reportedBy" => "reporter 1"
            ],
            "2" => [
                "userLink" => "user link 2",
                "violation" => ["Community Guidelines Violation", "Spam"],
                "reportedOn" => "07-16-2023",
                "reportedBy" => "reporter 2"
            ],
            "3" => [
                "userLink" => "user link 3",
                "violation" => ["Community Guidelines Violation", "Suspicious or Fake Account"],
                "reportedOn" => "07-17-2023",
                "reportedBy" => "reporter 3"
            ]
        ];

        $jsonData = json_encode($reportedUsers);
        header('Content-Type: application/json');
        echo $jsonData;
    }
}
