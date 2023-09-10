<?php
require_once "connection.php";

class communityModel{
	static public function mdlGetCommunityData() {
		$db = new Connection();
        $pdo = $db->connect();
        
        $stmt = $pdo->prepare("SELECT cc.creationid, a.username, cc.title, cc.religion, cc.description, cc.filename, cc.filetype, cc.filesize, cc.filedata, cc.status, cc.date 
                                FROM communitycreations cc
                                INNER JOIN accounts a ON cc.accountid = a.accountid");
        $stmt->execute();
        $creations = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $creationPhotos = [];
        $creationVideos = [];
        $creationReadingMaterials = [];
    
        foreach ($creations as $creation) {
            if (strpos($creation["filetype"], "image") !== false) {
                $creationPhotos += [
                    $creation["creationid"] => [
                        "creationid" => $creation["creationid"],
                        "title" => $creation["title"],
                        "author" => $creation["username"],
                        "filedata" => $creation["filedata"],
                        // "filedata" => "data:" . $creation["filetype"] . ";base64," . base64_encode($creation["filedata"]),
                        "filename" => $creation["filename"],
                        "filetype" => $creation["filetype"],
                        "filesize" => $creation["filesize"],
                        "religion" => $creation["religion"],
                        "description" => nl2br(htmlspecialchars_decode($creation["description"])),
                        "date" => $creation["date"]
                    ]
                ];

            } else if (strpos($creation["filetype"], "video") !== false) {
                $creationVideos += [
                    $creation["creationid"] => [
                        "creationid" => $creation["creationid"],
                        "title" => $creation["title"],
                        "author" => $creation["username"],
                        "filedata" => $creation["filedata"],
                        // "filedata" => "data:" . $creation["filetype"] . ";base64," . base64_encode($creation["filedata"]),
                        "filename" => $creation["filename"],
                        "filetype" => $creation["filetype"],
                        "filesize" => $creation["filesize"],
                        "religion" => $creation["religion"],
                        "description" => nl2br(htmlspecialchars_decode($creation["description"])),
                        "date" => $creation["date"]
                    ]
                ];

            } else if ($creation["filetype"] == ""){
                $creationReadingMaterials += [
                    $creation["creationid"] => [
                        "creationid" => $creation["creationid"],
                        "title" => $creation["title"],
                        "author" => $creation["username"],
                        "filesize" => $creation["filesize"],
                        "filetype" => "",
                        "religion" => $creation["religion"],
                        "description" => nl2br(htmlspecialchars_decode($creation["description"])),
                        "date" => $creation["date"]
                    ]
                ];
            }
        }

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
        
		try {
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$pdo->beginTransaction();
		
			$stmt = $pdo->prepare("INSERT INTO communitycreations(creationid, accountid, title, religion, description, filename, filetype, filesize, filedata, filters, status, date) VALUES (:creationid, :accountid, :title, :religion, :description, :filename, :filetype, :filesize, :filedata, :filters, :status, :date)");
	
            $stmt->bindParam(":creationid", $data["creationid"], PDO::PARAM_STR);
            $stmt->bindParam(":accountid", $data["accountid"], PDO::PARAM_STR);
            $stmt->bindParam(":title", $data["title"], PDO::PARAM_STR);
            $stmt->bindParam(":religion", $data["religion"], PDO::PARAM_STR);
            $stmt->bindParam(":description", nl2br(htmlspecialchars($data["description"])), PDO::PARAM_STR);
            $stmt->bindParam(":filename", $data["filename"], PDO::PARAM_STR);
            $stmt->bindParam(":filetype", $data["filetype"], PDO::PARAM_STR);
            $stmt->bindParam(":filesize", $data["filesize"], PDO::PARAM_INT);
            $stmt->bindParam(":filedata", $data["filedata"], PDO::PARAM_STR);
            $stmt->bindParam(":filters", $data["filters"], PDO::PARAM_STR);
            $stmt->bindParam(":status", $data["status"], PDO::PARAM_STR);
            $stmt->bindParam(":date", $data["date"], PDO::PARAM_STR);
            
			$stmt->execute();
			$pdo->commit();
            
			return "success";
		} catch (Exception $e) {
            echo $e->getMessage();
			$pdo->rollBack();
			return "error";
		}

		$pdo = null;
		$stmt = null;

    }

}

?>