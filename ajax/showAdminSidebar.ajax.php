<?php
require_once "../views/modules/adminSidebar.php";

class sidebarAjax{
    public function ajaxShowSidebar(){
        $answer = create_sidebar();
        echo $answer;
    }
}

$getSidebar = new sidebarAjax();
$getSidebar -> ajaxShowSidebar();

?>