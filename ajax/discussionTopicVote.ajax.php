<?php
require_once "../controllers/discussion.controller.php";
session_start();
$id = $_POST['id'];
$voteAction = $_POST['voteAction'];

// Create an instance of the ControllerDiscussion class
$controller = new ControllerDiscussion();

$result = $controller->ctrUpdateVoteCountForTopic($id, $voteAction);

if ($result) {
    echo "success";
} else {
    echo "error";
}
?>