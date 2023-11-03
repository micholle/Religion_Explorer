<?php
require_once "../controllers/explorerPoints.controller.php";

class explorerPointsAjax{
    public $accountid;
    public $pointsource;
    public $points;

    public function ajaxAddExplorerPoints(){
        $accountid = $this->accountid;
        $pointsource = $this->pointsource;
        $points = $this->points;

        $data = array(
            "accountid" => $accountid,
            "pointsource" => $pointsource,
            "points" => $points,
          );

        $answer = (new explorerPointsController) -> ctrAddExplorerPoints($data);
    }
}

$addExplorerPoints = new explorerPointsAjax();
$addExplorerPoints->accountid = $_POST["accountid"];
$addExplorerPoints->pointsource = $_POST["pointsource"];
$addExplorerPoints->points = $_POST["points"];
$addExplorerPoints -> ajaxAddExplorerPoints();

?>