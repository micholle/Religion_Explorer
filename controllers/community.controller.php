<?php
require_once "../models/community.model.php";

class communityController{

	static public function ctrGetCommunityData(){
		$answer = (new communityModel)->mdlGetCommunityData();
	}

	static public function ctrSubmitCreation($data){
		$answer = (new communityModel)->mdlSubmitCreation($data);
	}

}

?>