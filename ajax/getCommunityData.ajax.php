<?php

require_once "../controllers/community.controller.php";

class communityAjax{
    public function ajaxGetCommunityData(){
        $answer = (new communityController) -> ctrGetCommunityData();
    }
}

$getCommunityData = new communityAjax();
$getCommunityData -> ajaxGetCommunityData();

?>