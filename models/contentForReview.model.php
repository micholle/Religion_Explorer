<?php

class contentModel {

    public function mdlGetContentForReview() {
        $contentForReview = [
            "1" => [
                "contentLink" => "content link 1",
                "violation" => ["Privacy Violation", "Offensive Language"],
                "reportedOn" => "07-15-2023",
                "reportedBy" => "reporter 1"
            ],
            "2" => [
                "contentLink" => "content link 2",
                "violation" => ["Misinformation", "Spam or Unwanted Content"],
                "reportedOn" => "07-16-2023",
                "reportedBy" => "reporter 2"
            ],
            "3" => [
                "contentLink" => "content link 3",
                "violation" => ["Misinformation", "Offensive Language"],
                "reportedOn" => "07-17-2023",
                "reportedBy" => "reporter 3"
            ]
        ];

        $jsonData = json_encode($contentForReview);
        header('Content-Type: application/json');
        echo $jsonData;
    }
}
