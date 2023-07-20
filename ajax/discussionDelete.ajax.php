<?php
require_once "../controllers/discussion.controller.php";
require __DIR__ . '/../vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["postId"])) {
        $postId = $_POST["postId"];

        $controller = new ControllerDiscussion();
        $result = $controller->ctrDeletePost($postId);

        if ($result) {
            echo "success";
            $pusher = new Pusher\Pusher('a314fc475591f42fbafc', '196919a3969393c05a8f', '1638211', [
                'cluster' => 'ap1',
                'useTLS' => true,
              ]);
              
              // Trigger the event on the 'discussion-channel'
            $pusher->trigger('religionExplorer', 'new-post-event', ['message' => 'A new post/reply/vote has been created.']);
        } else {
            echo "error";
        }
    } elseif (isset($_POST["topicId"])) {
        $topicId = $_POST["topicId"];

        $controller = new ControllerDiscussion();
        $result = $controller->ctrDeleteTopic($topicId);

        if ($result) {
            echo "success";
            $pusher = new Pusher\Pusher('a314fc475591f42fbafc', '196919a3969393c05a8f', '1638211', [
                'cluster' => 'ap1',
                'useTLS' => true,
              ]);
              
              // Trigger the event on the 'discussion-channel'
            $pusher->trigger('religionExplorer', 'new-post-event', ['message' => 'A new post/reply/vote has been created.']);
        } else {
            echo "error";
        }
    } elseif (isset($_POST["replyId"])) {
        $replyId = $_POST["replyId"];

        $controller = new ControllerDiscussion();
        $result = $controller->ctrDeleteReply($replyId);

        if ($result) {
            echo "success";
            $pusher = new Pusher\Pusher('a314fc475591f42fbafc', '196919a3969393c05a8f', '1638211', [
                'cluster' => 'ap1',
                'useTLS' => true,
              ]);
              
              // Trigger the event on the 'discussion-channel'
            $pusher->trigger('religionExplorer', 'new-post-event', ['message' => 'A new post/reply/vote has been created.']);
        } else {
            echo "error";
        }
    }
}
?>
