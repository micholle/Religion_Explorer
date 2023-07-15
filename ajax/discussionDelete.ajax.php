<?php
require_once "../controllers/discussion.controller.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["postId"])) {
        $postId = $_POST["postId"];

        $controller = new ControllerDiscussion();
        $result = $controller->ctrDeletePost($postId);

        if ($result) {
            echo "success";
        } else {
            echo "error";
        }
    } elseif (isset($_POST["topicId"])) {
        $topicId = $_POST["topicId"];

        $controller = new ControllerDiscussion();
        $result = $controller->ctrDeleteTopic($topicId);

        if ($result) {
            echo "success";
        } else {
            echo "error";
        }
    } elseif (isset($_POST["replyId"])) {
        $replyId = $_POST["replyId"];

        $controller = new ControllerDiscussion();
        $result = $controller->ctrDeleteReply($replyId);

        if ($result) {
            echo "success";
        } else {
            echo "error";
        }
    }
}
?>
