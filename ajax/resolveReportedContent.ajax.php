<?php
require_once "../controllers/report.controller.php";

class resolveReportContentAjax {
    public $contentid;

    public function ajaxResolveReportContent() {
        $contentid = $this->contentid;
        
        $answer = (new reportContentController)->ctrResolveReportContent($contentid);
    }
}

$resolveReport = new resolveReportContentAjax();
$resolveReport->contentid = $_POST["contentid"];
$resolveReport->ajaxResolveReportContent();
?>