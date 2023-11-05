<?php
require_once "../models/explorerPoints.model.php";

class explorerPointsController{

    static public function ctrAddExplorerPoints($data) {
		$answer = (new explorerPointsModel)->mdlAddExplorerPoints($data);
    }

}

?>