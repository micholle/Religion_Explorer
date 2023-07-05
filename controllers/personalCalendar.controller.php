<?php
require_once "../models/personalCalendar.model.php";

class personalCalendarController{
	static public function ctrGetPersonalCalendarData($accountid) {
		$answer = (new personalCalendarModel)->mdlGetPersonalCalendarData($accountid);
	}

	static public function ctrAddToPersonalCalendar($data){
		$answer = (new personalCalendarModel)->mdlAddToPersonalCalendar($data);
	}

	static public function ctrRemoveFromPersonalCalendar($personaleventid) {
		$answer = (new personalCalendarModel)->mdlRemoveFromPersonalCalendar($personaleventid);
	}

}

?>