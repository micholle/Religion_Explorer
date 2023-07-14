<?php
require_once "../models/reportedUsers.model.php";

class reportedUsersController{

	static public function ctrGetReportedUsers(){
		$answer = (new reportedUsersModel)->mdlGetReportedUsers();
	}

}

?>