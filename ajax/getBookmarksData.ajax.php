<?php

require_once "../controllers/bookmark.controller.php";

class bookmarkAjax{
    public $accountid;

    public function ajaxGetBookmarksData(){
        $accountid = $this->accountid;
        $answer = (new bookmarkController) -> ctrGetBookmarkData($accountid);
    }
}

$getBookmarkData = new bookmarkAjax();
$getBookmarkData->accountid = $_POST["accountid"];
$getBookmarkData -> ajaxGetBookmarksData();

?>