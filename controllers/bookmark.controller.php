<?php
require_once "../models/bookmark.model.php";

class bookmarkController{

    static public function ctrGetBookmarkData($accountid) {
		$answer = (new bookmarkModel)->mdlGetBookmarkData($accountid);
    }

	static public function ctrAddToBookmarks($accountid, $resourceid, $resourceTitle){
		$answer = (new bookmarkModel)->mdlAddToBookmarks($accountid, $resourceid, $resourceTitle);
	}

	static public function ctrRemoveFromBookmarks($bookmarkid) {
		$answer = (new bookmarkModel)->mdlRemoveFromBookmarks($bookmarkid);
	}
}

?>