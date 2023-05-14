<?php
require_once "connection.php";

class mapModel{

    //Get data for map
	static public function mdlGetMapData(){
        $stmt = (new Connection) -> connect() -> prepare("SELECT * FROM religionbycountry ORDER BY countryID");
		$stmt -> execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //dictionary for all country dictionaries
        $allCountries = [];

        foreach($results as $row) {
            $data = [
                "Buddhism" => intval($row["buddhism"]),
                "Christianity" => intval($row["christianity"]),
                "Hinduism" => intval($row["hinduism"]),
                "Islam" => intval($row["islam"]),
                "Judaism" => intval($row["judaism"]),
                "Other Religions" => intval($row["otherReligions"]),
                "Non-Religious" => intval($row["nonReligious"])
            ];
            $allCountries += [$row["country"] => $data];
        } 

        $jsonData = json_encode($allCountries);
        header('Content-Type: application/json');
        echo $jsonData;
	}

}

?>