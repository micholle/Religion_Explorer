<?php

require_once "../controllers/personalCalendar.controller.php";

class personalCalendarAjax{
    public $accountid;

    public function ajaxGetPersonalCalendarData(){
        $accountid = $this->accountid;
        $answer = (new personalCalendarController) -> ctrGetPersonalCalendarData($accountid);
    }
}

$getPersonalCalendarData = new personalCalendarAjax();
$getPersonalCalendarData->accountid = $_POST["accountid"];
$getPersonalCalendarData -> ajaxGetPersonalCalendarData();

?>