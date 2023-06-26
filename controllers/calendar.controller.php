<?php
require_once "../models/calendar.model.php";

class calendarController{

	static public function ctrGetCalendarData(){
		$answer = (new calendarModel)->mdlGetCalendarData();
	}

}

?>