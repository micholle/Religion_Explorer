<?php
require_once "../models/report.model.php";

class reportContentController{

    static public function ctrSubmitReportContent($data) {
		$answer = (new reportContentModel)->mdlSubmitReportContent($data);
    }

}

?>