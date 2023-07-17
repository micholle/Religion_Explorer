<?php
require_once "../controllers/report.controller.php";

class submitReportContentAjax {
    public $contentid;
    public $contentViolations;
    public $additionalContext;
    public $reportedOn;
    public $reportedBy;
  
    public function ajaxSubmitReportContent() {
      $data = array(
        "contentid" => $this->contentid,
        "contentViolations" => $this->contentViolations,
        "additionalContext" => $this->additionalContext,
        "reportedOn" => $this->reportedOn,
        "reportedBy" => $this->reportedBy
      );
  
      $answer = (new reportContentController)->ctrSubmitReportContent($data);
    }
}

$submitReport = new submitReportContentAjax();
$submitReport->contentid = $_POST["contentid"];
$submitReport->contentViolations = $_POST["contentViolations"];
$submitReport->additionalContext = $_POST["additionalContext"];
$submitReport->reportedOn = $_POST["reportedOn"];
$submitReport->reportedBy = $_POST["reportedBy"];
$submitReport->ajaxSubmitReportContent();
?>