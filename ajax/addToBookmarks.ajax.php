<?php
require_once "../controllers/bookmark.controller.php";

class bookmarkAjax{
    public $accountid;
    public $resourceid;
    public $resourceTitle;

    public function ajaxAddToBookmarks(){
        $accountid = $this->accountid;
        $resourceid = $this->resourceid;
        $resourceTitle = $this->resourceTitle;

        $answer = (new bookmarkController) -> ctrAddToBookmarks($accountid, $resourceid, $resourceTitle);
    }
}

$addToBookmarks = new bookmarkAjax();
$addToBookmarks->accountid = $_POST["accountid"];
$addToBookmarks->resourceid = $_POST["resourceid"];
$addToBookmarks->resourceTitle = $_POST["resourceTitle"];
$addToBookmarks -> ajaxAddToBookmarks();

?>