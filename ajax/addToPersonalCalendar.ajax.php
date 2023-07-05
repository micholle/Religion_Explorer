<?php
require_once "../controllers/personalCalendar.controller.php";

class personalCalendarAjax {
  public $accountid;
  public $event;
  public $religion;
  public $date;

  public function ajaxAddToPersonalCalendar() {
    $accountid = $this->accountid;
    $event = $this->event;
    $religion = $this->religion;
    $date = $this->date;

    $dateFormat = DateTime::createFromFormat('m-d-Y', $date);
    $formattedDate = $dateFormat->format('Y-m-d');

    $data = array(
      "accountid" => $accountid,
      "event" => $event,
      "religion" => $religion,
      "date" => $formattedDate
    );

    $answer = (new personalCalendarController) -> ctrAddToPersonalCalendar($data);
  }
}

$addToPersonalCalendar = new personalCalendarAjax();
$addToPersonalCalendar->accountid = $_POST["accountid"];
$addToPersonalCalendar->event = $_POST["event"];
$addToPersonalCalendar->religion = $_POST["religion"];
$addToPersonalCalendar->date = $_POST["date"];

$addToPersonalCalendar->ajaxAddToPersonalCalendar();
