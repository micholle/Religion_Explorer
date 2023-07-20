<?php
require_once "../controllers/discussion.controller.php";
require __DIR__ . '/../vendor/autoload.php';
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
        $pusher = new Pusher\Pusher('a314fc475591f42fbafc', '196919a3969393c05a8f', '1638211', [
            'cluster' => 'ap1',
            'useTLS' => true,
          ]);
          
          // Trigger the event on the 'discussion-channel'
        $pusher->trigger('religionExplorer', 'new-post-event', ['message' => 'A new post/reply/vote has been created.']);
    } else {
        $response = 'error';
    }
} elseif ($type === 'reply') {
    $result = $controller->ctrUpdateReply($id, $content);
    if ($result) {
        $response = 'success';
        $pusher = new Pusher\Pusher('a314fc475591f42fbafc', '196919a3969393c05a8f', '1638211', [
            'cluster' => 'ap1',
            'useTLS' => true,
          ]);
          
          // Trigger the event on the 'discussion-channel'
        $pusher->trigger('religionExplorer', 'new-post-event', ['message' => 'A new post/reply/vote has been created.']);
    } else {
        $response = 'error';
    }
} else {
    $response = 'error';
}

echo $response;
?>
