<?php
require_once "../controllers/report.controller.php";

class submitReportUserAjax {
    public $username;
    public $userViolations;
    public $additionalContext;
    public $reportedOn;
    public $reportedBy;
  
    public function ajaxSubmitReportUser() {
      $data = array(
        "username" => $this->username,
        "userViolations" => $this->userViolations,
        "additionalContext" => $this->additionalContext,
        "reportedOn" => $this->reportedOn,
        "reportedBy" => $this->reportedBy
      );
  
      $answer = (new reportUserController)->ctrSubmitReportUser($data);
    }
}

$submitReport = new submitReportUserAjax();
$submitReport->username = $_POST["username"];
$submitReport->userViolations = $_POST["userViolations"];
$submitReport->additionalContext = $_POST["additionalContext"];
$submitReport->reportedOn = $_POST["reportedOn"];
$submitReport->reportedBy = $_POST["reportedBy"];
$submitReport->ajaxSubmitReportUser();
?>