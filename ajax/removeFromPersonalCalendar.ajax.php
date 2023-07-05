<?php

require_once "../controllers/personalCalendar.controller.php";

class personalCalendarAjax{
    public $personaleventid;

    public function ajaxRemoveFromPersonalCalendar(){
        $personaleventid = $this->personaleventid;
        $answer = (new personalCalendarController) -> ctrRemoveFromPersonalCalendar($personaleventid);
    }
}

$removeFromPersonalCalendar = new personalCalendarAjax();
$removeFromPersonalCalendar->personaleventid = $_POST["personaleventid"];
$removeFromPersonalCalendar -> ajaxRemoveFromPersonalCalendar();

?>