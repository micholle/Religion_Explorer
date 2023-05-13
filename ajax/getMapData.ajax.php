<?php
require_once "../controllers/map.controller.php";

class mapAjax{
    //Get data for map
    public function ajaxGetMapData(){
        $answer = (new mapController) -> ctrGetMapData();
    }
}

$getMapData = new mapAjax();
$getMapData -> ajaxGetMapData();

?>