<?php
require_once "connection.php";

class communityModel{
	static public function mdlGetCommunityData(){
		$db = new Connection();
        $pdo = $db->connect();
        
        $stmt = $pdo->prepare("SELECT creationid, accountid, title, religion, topics, description, filename, filetype, filesize, LOAD_FILE(filedata) AS filedata, status, date FROM communitycreations");
        $stmt->execute();
        $creations = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $creationPhotos = [];
        $creationVideos = [];
        $creationReadingMaterials = [];
    
        foreach ($creations as $creation) {
            if (strpos($creation["filetype"], "image") !== false) {
                $creationPhotos += [
                    $creation["title"] => [
                        "creationid" => $creation["creationid"],
                        "author" => $creation["accountid"],
                        "file" => "data:" . $creation["filetype"] . ";base64," .  base64_encode($creation["filedata"]),
                        "religion" => $creation["religion"],
                        "topics" => $creation["topics"],
                        "description" => $creation["description"],
                        "date" => $creation["date"]
                    ]
                ];
            } else if (strpos($creation["filetype"], "video") !== false) {
                $creationVideos += [
                    $creation["title"] => [
                        "creationid" => $creation["creationid"],
                        "author" => $creation["accountid"],
                        "file" => "data:" . $creation["filetype"] . ";base64," .  base64_encode($creation["filedata"]),
                        "religion" => $creation["religion"],
                        "topics" => $creation["topics"],
                        "description" => $creation["description"],
                        "date" => $creation["date"]
                    ]
                ];
            } else if ($creation["filetype"] == ""){
                $creationReadingMaterials += [
                    $creation["title"] => [
                        "creationid" => $creation["creationid"],
                        "author" => $creation["accountid"],
                        "religion" => $creation["religion"],
                        "topics" => $creation["topics"],
                        "description" => $creation["description"],
                        "date" => $creation["date"]
                    ]
                ];
            }
        }

        //sample data only (will be updated once the database is ready)
        $communityData = [
            "photos" => [$creationPhotos],
            "videos" => [$creationVideos],
            "readingMaterials" => [$creationReadingMaterials]
        ];

        $jsonData = json_encode($communityData);
        header('Content-Type: application/json');
        echo $jsonData;
	}

    static public function mdlSubmitCreation($data){
        $db = new Connection();
        $pdo = $db->connect();

        $creationid = "CC" . rand(1111111111, 9999999999);

		try {
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$pdo->beginTransaction();
		
			$stmt = $pdo->prepare("INSERT INTO communitycreations(creationid, username, title, religion, topics, description, filename, filetype, filesize, filedata, status, date) VALUES (:creationid, :username, :title, :religion, :topics, :description, :filename, :filetype, :filesize, :filedata, :status, :date)");
	
            $stmt->bindParam(":creationid", $creationid, PDO::PARAM_STR);
            $stmt->bindParam(":username", $data["username"], PDO::PARAM_STR);
            $stmt->bindParam(":title", $data["title"], PDO::PARAM_STR);
            $stmt->bindParam(":religion", $data["religion"], PDO::PARAM_STR);
            $stmt->bindParam(":topics", $data["topics"], PDO::PARAM_STR);
            $stmt->bindParam(":description", $data["description"], PDO::PARAM_STR);
            $stmt->bindParam(":filename", $data["filename"], PDO::PARAM_STR);
            $stmt->bindParam(":filetype", $data["filetype"], PDO::PARAM_STR);
            $stmt->bindParam(":filesize", $data["filesize"], PDO::PARAM_INT);
            $stmt->bindParam(":filedata", $data['filedata'], PDO::PARAM_LOB);
            $stmt->bindParam(":status", $data["status"], PDO::PARAM_STR);
            $stmt->bindParam(":date", $data["date"], PDO::PARAM_STR);
            
			$stmt->execute();
	
			$pdo->commit();
			return "success";
		} catch (Exception $e) {
			$pdo->rollBack();
			return "error";
		}

		$pdo = null;
		$stmt = null;
    }

}

?>