<?php
require_once "../controllers/map.controller.php";

class mapAjax{

    public function ajaxGetMapPinsData(){
        $answer = (new mapController) -> ctrGetMapPinsData();
    }
}

$getMapPinsData = new mapAjax();
$getMapPinsData -> ajaxGetMapPinsData();

?>