<?php

class communityModel{
	static public function mdlGetCommunityData(){

        //sample data only (will be updated once the database is ready)
        $communityData = [
            "photos" => [
                "Photo 1" => [
                    "contentid" => "P1",
                    "file" => "https://placehold.co/200x200",
                    "category" => ["Buddhism", "Religious Traditions", "Social Issues"],
                    "description" => "Description 1",
                    "author" => "Author 1",
                    "date" => "06-01-2023"
                ],
                "Photo 2" => [
                    "contentid" => "P2",
                    "file" => "https://placehold.co/200x200",
                    "category" => ["Christianity", "Historical Context", "Social Issues"],
                    "description" => "Description 2",
                    "author" => "Author 2",
                    "date" => "06-02-2023"
                ],  
                "Photo 3" => [
                    "contentid" => "P3",
                    "file" => "https://placehold.co/200x200",
                    "category" => ["Hinduism", "Theology", "Social Issues"],
                    "description" => "Description 3",
                    "author" => "Author 3",
                    "date" => "06-03-2023"
                ],    
                "Photo 4" => [
                    "contentid" => "P4",
                    "file" => "https://placehold.co/200x200",
                    "category" => ["Islam", "Religious Practices", "Social Issues"],
                    "description" => "Description 4",
                    "author" => "Author 4",
                    "date" => "06-04-2023"
                ],    
                "Photo 5" => [
                    "contentid" => "P5",
                    "file" => "https://placehold.co/200x200",
                    "category" => ["Judaism", "Ethics", "Social Issues"],
                    "description" => "Description 5",
                    "author" => "Author 5",
                    "date" => "06-05-2023"
                ]  
            ],
            "videos" => [
                "Video 1" => [
                    "contentid" => "V1",
                    "file" => "https://joy1.videvo.net/videvo_files/video/free/2016-12/large_watermarked/Binary_numbers_bg_01_Videvo_preview.mp4",
                    "category" => ["Buddhism", "Religious Traditions", "Social Issues"],
                    "description" => "Description 1",
                    "author" => "Author 1",
                    "date" => "06-01-2023"
                ],
                "Video 2" => [
                    "contentid" => "V2",
                    "file" => "https://joy1.videvo.net/videvo_files/video/free/2016-12/large_watermarked/Binary_numbers_bg_01_Videvo_preview.mp4",
                    "category" => ["Christianity", "Historical Context", "Social Issues"],
                    "description" => "Description 2",
                    "author" => "Author 2",
                    "date" => "06-02-2023"
                ],  
                "Video 3" => [
                    "contentid" => "V3",
                    "file" => "https://joy1.videvo.net/videvo_files/video/free/2016-12/large_watermarked/Binary_numbers_bg_01_Videvo_preview.mp4",
                    "category" => ["Hinduism", "Theology", "Social Issues"],
                    "description" => "Description 3",
                    "author" => "Author 3",
                    "date" => "06-03-2023"
                ],    
                "Video 4" => [
                    "contentid" => "V4",
                    "file" => "https://joy1.videvo.net/videvo_files/video/free/2016-12/large_watermarked/Binary_numbers_bg_01_Videvo_preview.mp4",
                    "category" => ["Islam", "Religious Practices", "Social Issues"],
                    "description" => "Description 4",
                    "author" => "Author 4",
                    "date" => "06-04-2023"
                ],    
                "Video 5" => [
                    "contentid" => "V5",
                    "file" => "https://joy1.videvo.net/videvo_files/video/free/2016-12/large_watermarked/Binary_numbers_bg_01_Videvo_preview.mp4",
                    "category" => ["Judaism", "Ethics", "Social Issues"],
                    "description" => "Description 5",
                    "author" => "Author 5",
                    "date" => "06-05-2023"
                ]  
            ],
            "blogs" => [
                "Blog 1" => [
                    "contentid" => "B1",
                    "category" => ["Buddhism", "Religious Traditions", "Social Issues"],
                    "description" => "Blog Content 1",
                    "author" => "Author 1",
                    "date" => "06-01-2023"
                ],
                "Blog 2" => [
                    "contentid" => "B2",
                    "category" => ["Christianity", "Historical Context", "Social Issues"],
                    "description" => "Blog Content 2",
                    "author" => "Author 2",
                    "date" => "06-02-2023"
                ],  
                "Blog 3" => [
                    "contentid" => "B3",
                    "category" => ["Hinduism", "Theology", "Social Issues"],
                    "description" => "Blog Content 3",
                    "author" => "Author 3",
                    "date" => "06-03-2023"
                ],    
                "Blog 4" => [
                    "contentid" => "B4",
                    "category" => ["Islam", "Religious Practices", "Social Issues"],
                    "description" => "Blog Content 4",
                    "author" => "Author 4",
                    "date" => "06-04-2023"
                ],    
                "Blog 5" => [
                    "contentid" => "B5",
                    "category" => ["Judaism", "Ethics", "Social Issues"],
                    "description" => "Blog Content 5",
                    "author" => "Author 5",
                    "date" => "06-05-2023"
                ]
            ]
        ];

        $jsonData = json_encode($communityData);
        header('Content-Type: application/json');
        echo $jsonData;
	}

}

?>