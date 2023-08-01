<?php
require_once "../views/assets/data/mapData.php";

class mapModel{
	static public function mdlGetMapData() {
        $mapPopulation = (new mapData) -> getMapPopulation2010();

        $allCountries = [];

        foreach ($mapPopulation as $country => $population) {
            $data = [
                "Buddhism" => $population["Buddhism"],
                "Christianity" => $population["Christianity"],
                "Hinduism" => $population["Hinduism"],
                "Islam" => $population["Islam"],
                "Judaism" => $population["Judaism"],
                "Other Religions" => $population["Other Religions"],
                "Non-Religious" => $population["Non-Religious"]
            ];

            $allCountries += [$country => $data];
            $religionPopulation = ["2010 CE" => $allCountries];
        }

        $jsonData = json_encode($religionPopulation);
        header('Content-Type: application/json');
        echo $jsonData;
	}

    static public function mdlGetMapPinsData() {
        $mapPins = (new mapData) -> getMapPins();
        $allPins = [];

        foreach ($mapPins as $index => $pin) {
            $data = [
                "pinTitle" => $pin["pinTitle"],
                "pinType" => $pin["pinType"],
                "religion" => $pin["religion"],
                "country" => $pin["country"],
                "timelineDate" => $pin["timelineDate"],
                "displayDate" => $pin["displayDate"],
                "pinVid" => $pin["pinVid"],
                "pinImg1" => $pin["pinImg1"],
                "pinImg2" => $pin["pinImg2"],
                "source" => $pin["source"]
            ];

            $allPins += [$index => $data];
        }

        $jsonData = json_encode($allPins);
        header('Content-Type: application/json');
        echo $jsonData;
    }

}

?>