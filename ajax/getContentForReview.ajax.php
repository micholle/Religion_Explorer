<?php
require_once "../controllers/contentForReview.controller.php";

class contentAjax{
    public function ajaxGetContentForReview(){
        $answer = (new contentController) -> ctrGetContentForReview();
    }
}

$getContentForReview = new contentAjax();
$getContentForReview -> ajaxGetContentForReview();

?>