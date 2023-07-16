<?php
require_once "../controllers/discussion.controller.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the POST parameters
    $topicId = $_POST['topicId'];
    $updatedTitle = $_POST['updatedTitle'];
    $updatedContent = $_POST['updatedContent'];

    // Create an instance of the ControllerDiscussion class
    $controller = new ControllerDiscussion();

    // Call the controller function to update the topic
    $result = $controller->ctrUpdateTopic($topicId, $updatedTitle, $updatedContent);

    if ($result) {
        echo 'success';
    } else {
        echo 'error';
    }
}
?>
