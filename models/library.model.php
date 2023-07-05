<?php
require_once "../views/assets/data/libraryData.php";

class libraryModel{
	static public function mdlGetBasicInfo($religion){
        $basicInfo = (new libraryData) -> getBasicInfo();
        $allBasicInfo = [];

        foreach ($basicInfo as $index => $basicInfoDetails) {
            if ($index == $religion) {
                $data = [
                    "borderLeftImg" => $basicInfoDetails["borderLeftImg"],
                    "borderRightImg" => $basicInfoDetails["borderRightImg"],
                    "religionDesc" => $basicInfoDetails["religionDesc"],
                    "sacredScripture" => $basicInfoDetails["sacredScripture"],
                    "sacredScriptureImg" => $basicInfoDetails["sacredScriptureImg"],
                    "sacredScriptureDesc" => $basicInfoDetails["sacredScriptureDesc"],
                    "placeOfWorship" => $basicInfoDetails["placeOfWorship"],
                    "placeOfWorshipImg" => $basicInfoDetails["placeOfWorshipImg"],
                    "placeOfWorshipDesc" => $basicInfoDetails["placeOfWorshipDesc"],
                    "sacredSymbol" => $basicInfoDetails["sacredSymbol"],
                    "sacredSymbolImg" => $basicInfoDetails["sacredSymbolImg"],
                    "sacredSymbolDesc"=> $basicInfoDetails["sacredSymbolDesc"]
                ];
    
                $allBasicInfo += [$index => $data];
            }
        }

        $jsonData = json_encode($allBasicInfo);
        header('Content-Type: application/json');
        echo $jsonData;
	}

    static public function mdlGetLibraryData(){
        $resources = (new libraryData) -> getResources();

        $jsonData = json_encode($resources);
        header('Content-Type: application/json');
        echo $jsonData;
    }

}

?>