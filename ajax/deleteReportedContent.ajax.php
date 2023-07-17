<?php
require_once "../controllers/report.controller.php";

class deleteReportedContentAjax {
    public $contentid;

    public function ajaxDeleteReportedContent() {
        $contentid = $this->contentid;
        
        $answer = (new reportContentController)->ctrDeleteReportedContent($contentid);
    }
}

$deleteReportedContent = new deleteReportedContentAjax();
$deleteReportedContent->contentid = $_POST["contentid"];
$deleteReportedContent->ajaxDeleteReportedContent();
?>