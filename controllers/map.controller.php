<?php
require_once "../models/map.model.php";

class mapController{

	static public function ctrGetMapData() {
		$answer = (new mapModel)->mdlGetMapData();
	}

	static public function ctrGetMapPinsData() {
		$answer = (new mapModel)->mdlGetMapPinsData();
	}

}

?>