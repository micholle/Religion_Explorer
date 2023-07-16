<?php
require_once "../controllers/discussion.controller.php";
session_start();

$type = $_POST['type'];
$id = $_POST['id'];
$voteAction = $_POST['voteAction']; // Updated variable name to match the AJAX request

$controller = new ControllerDiscussion();
if ($type === 'topic'){
    $result = $controller->ctrUpdateVoteCountForTopic($id, $voteAction);
}else {
    $result = $controller->ctrUpdateVoteCount($type, $id, $voteAction);
}


if ($result) {
    echo "success";
} else {
    echo "error";
}
?>
