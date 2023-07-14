<?php
require_once "../models/contentForReview.model.php";

class contentController{

	static public function ctrGetContentForReview(){
		$answer = (new contentModel)->mdlGetContentForReview();
	}

}

?>