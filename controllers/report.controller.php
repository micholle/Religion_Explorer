<?php
require_once "../models/report.model.php";

class reportContentController {
  
  static public function ctrGetReportedContent() {
    $answer = (new reportContentModel)->mdlGetReportedContent();
	}

  static public function ctrSubmitReportContent($data) {
		$answer = (new reportContentModel)->mdlSubmitReportContent($data);
  }

  static public function ctrResolveReportContent($contentid) {
		$answer = (new reportContentModel)->mdlResolveReportContent($contentid);
  }

  static public function ctrDeleteReportedContent($contentid) {
		$answer = (new reportContentModel)->mdlDeleteReportedContent($contentid);
  }

}

class reportUserController {

	static public function ctrGetReportedUsers(){
		$answer = (new reportUserModel)->mdlGetReportedUsers();
	}

  static public function ctrSubmitReportUser($data){
	  $answer = (new reportUserModel)->mdlSubmitReportUser($data);
  }
}

?>