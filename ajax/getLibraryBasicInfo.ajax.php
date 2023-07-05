<?php

require_once "../controllers/library.controller.php";

class libraryAjax{
    public $religion;

    public function ajaxGetBasicInfo(){
        $religion = $this->religion;
        $answer = (new libraryController) -> ctrGetBasicInfo($religion);
    }
}

$getBasicInfo = new libraryAjax();
$getBasicInfo->religion = $_POST["religion"];
$getBasicInfo -> ajaxGetBasicInfo();

?>