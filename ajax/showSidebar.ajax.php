<?php
require_once "../views/modules/sidebar.php";

class sidebarAjax{
    public function ajaxShowSidebar(){
        $answer = create_sidebar();
        echo $answer;
    }
}

$getMapData = new sidebarAjax();
$getMapData -> ajaxShowSidebar();

?>