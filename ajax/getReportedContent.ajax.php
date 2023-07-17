<?php
require_once "../controllers/report.controller.php";

class contentAjax{
    public function ajaxGetContentForReview(){
        $answer = (new reportContentController) -> ctrGetReportedContent();
    }
}

$getContentForReview = new contentAjax();
$getContentForReview -> ajaxGetContentForReview();

?>