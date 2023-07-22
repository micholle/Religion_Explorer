<?php
require_once "../controllers/report.controller.php";

if (isset($_POST["action"])) {
    if ($_POST["action"] === "suspend") {
        if (isset($_POST["userid"]) && isset($_POST["duration"]) && isset($_POST["unit"])) {
            $userID = $_POST["userid"];
            $suspendUserVal = $_POST["duration"];
            $suspendUserTime = $_POST["unit"];

            $data = array(
                "userid" => $userID,
                "suspenduserval" => $suspendUserVal,
                "suspendusertime" => $suspendUserTime
            );

            $answer = reportUserController::ctrSuspendUser($data);

            if ($answer === "ok") {
                echo "ok";
            } else {
                echo "error";
            }
        } else {
            echo "error";
        }
    } elseif ($_POST["action"] === "ban") {
        if (isset($_POST["userid"])) {
            $userID = $_POST["userid"];

            $data = array(
                "userid" => $userID
            );

            $answer = reportUserController::ctrBanUser($data);

            if ($answer === "ok") {
                echo "ok";
            } else {
                echo "error";
            }
        } else {
            echo "error";
        }
    } elseif ($_POST["action"] === "resolve") {
        if (isset($_POST["userid"])) {
            $userID = $_POST["userid"];

            $data = array(
                "userid" => $userID
            );

            $answer = reportUserController::ctrResolveUser($data);

            if ($answer === "ok") {
                echo "ok";
            } else {
                echo "error";
            }
        } else {
            echo "error";
        }
    } else {
        echo "invalid_action";
    }
}
?>
