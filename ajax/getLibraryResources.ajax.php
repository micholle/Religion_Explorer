<?php
require_once "../controllers/library.controller.php";

class libraryAjax{
    public function ajaxGetLibraryData(){
        $answer = (new libraryController) -> ctrGetLibraryData();
    }
}

$getLibraryData = new libraryAjax();
$getLibraryData -> ajaxGetLibraryData();

?>