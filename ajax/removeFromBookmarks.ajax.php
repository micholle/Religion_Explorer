<?php
require_once "../controllers/bookmark.controller.php";

class bookmarkAjax{
    public $bookmarkid;

    public function ajaxRemoveFromBookmarks(){
        $bookmarkid = $this->bookmarkid;

        $answer = (new bookmarkController) -> ctrRemoveFromBookmarks($bookmarkid);
    }
}

$addToBookmarks = new bookmarkAjax();
$addToBookmarks->bookmarkid = $_POST["bookmarkid"];
$addToBookmarks -> ajaxRemoveFromBookmarks();

?>