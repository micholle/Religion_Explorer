<?php

require_once "../controllers/calendar.controller.php";

class calendarAjax{
    public function ajaxGetCalendarData(){
        $answer = (new calendarController) -> ctrGetCalendarData();
    }
}

$getCalendarData = new calendarAjax();
$getCalendarData -> ajaxGetCalendarData();

?>