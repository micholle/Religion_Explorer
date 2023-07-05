<?php
require_once "../models/library.model.php";

class libraryController{

	static public function ctrGetBasicInfo($religion){
		$answer = (new libraryModel)->mdlGetBasicInfo($religion);
	}

	static public function ctrGetLibraryData(){
		$answer = (new libraryModel)->mdlGetLibraryData();

	}

}

?>