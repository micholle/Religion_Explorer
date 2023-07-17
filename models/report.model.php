<?php
require_once "connection.php";

class reportContentModel{
	static public function mdlGetReportedContent() {
		// $db = new Connection();
        // $pdo = $db->connect();
        
        // $stmt = $pdo->prepare("SELECT creationid, username, title, religion, description, filename, filetype, filesize, filedata, status, date FROM communitycreations");
        // $stmt->execute();
        // $creations = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // $creationPhotos = [];
        // $creationVideos = [];
        // $creationReadingMaterials = [];
    
        // foreach ($creations as $creation) {
        //     if (strpos($creation["filetype"], "image") !== false) {
        //         $creationPhotos += [
        //             $creation["title"] => [
        //                 "creationid" => $creation["creationid"],
        //                 "author" => $creation["username"],
        //                 "filedata" => "data:" . $creation["filetype"] . ";base64," . base64_encode($creation["filedata"]),
        //                 "filename" => $creation["filename"],
        //                 "religion" => $creation["religion"],
        //                 "description" => $creation["description"],
        //                 "date" => $creation["date"]
        //             ]
        //         ];

        //     } else if (strpos($creation["filetype"], "video") !== false) {
        //         $creationVideos += [
        //             $creation["title"] => [
        //                 "creationid" => $creation["creationid"],
        //                 "author" => $creation["username"],
        //                 "filedata" => "data:" . $creation["filetype"] . ";base64," . base64_encode($creation["filedata"]),
        //                 "filename" => $creation["filename"],
        //                 "religion" => $creation["religion"],
        //                 "description" => $creation["description"],
        //                 "date" => $creation["date"]
        //             ]
        //         ];

        //     } else if ($creation["filetype"] == ""){
        //         $creationReadingMaterials += [
        //             $creation["title"] => [
        //                 "creationid" => $creation["creationid"],
        //                 "author" => $creation["username"],
        //                 "religion" => $creation["religion"],
        //                 "description" => $creation["description"],
        //                 "date" => $creation["date"]
        //             ]
        //         ];
        //     }
        // }

        // $communityData = [
        //     "photos" => [$creationPhotos],
        //     "videos" => [$creationVideos],
        //     "readingMaterials" => [$creationReadingMaterials]
        // ];

        // $jsonData = json_encode($communityData);
        // header('Content-Type: application/json');
        // echo $jsonData;
	}

    static public function mdlSubmitReportContent($data){
        $db = new Connection();
        $pdo = $db->connect();

		try {
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$pdo->beginTransaction();
		
			$stmt = $pdo->prepare("INSERT INTO reportedcontent(contentid, contentViolations, additionalContext, reportedOn, reportedBy) VALUES (:contentid, :contentViolations, :additionalContext, :reportedOn, :reportedBy)");
	
            $stmt->bindParam(":contentid", $data["contentid"], PDO::PARAM_STR);
            $stmt->bindParam(":contentViolations", $data["contentViolations"], PDO::PARAM_STR);
            $stmt->bindParam(":additionalContext", $data["additionalContext"], PDO::PARAM_STR);
            $stmt->bindParam(":reportedOn", $data["reportedOn"], PDO::PARAM_STR);
            $stmt->bindParam(":reportedBy", $data["reportedBy"], PDO::PARAM_STR);
            
			$stmt->execute();
			$pdo->commit();
                        
		} catch (Exception $e) {
			$pdo->rollBack();
			return "error";
		}

		$pdo = null;
		$stmt = null;

    }

}

?>