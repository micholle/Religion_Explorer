<?php
require_once "../controllers/discussion.controller.php";
session_start();

$type = $_POST['type'];
$id = $_POST['id'];
$content = $_POST['content'];

$controller = new ControllerDiscussion();
$response = '';

if ($type === 'post') {
    $result = $controller->ctrUpdatePost($id, $content);
    if ($result) {
        $response = 'success';
    } else {
        $response = 'error';
    }
} elseif ($type === 'reply') {
    $result = $controller->ctrUpdateReply($id, $content);
    if ($result) {
        $response = 'success';
    } else {
        $response = 'error';
    }
} else {
    $response = 'error';
}

echo $response;
?>
