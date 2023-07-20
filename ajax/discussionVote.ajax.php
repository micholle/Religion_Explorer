<?php
require_once "../controllers/discussion.controller.php";
require __DIR__ . '/../vendor/autoload.php';
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
    $pusher = new Pusher\Pusher('a314fc475591f42fbafc', '196919a3969393c05a8f', '1638211', [
        'cluster' => 'ap1',
        'useTLS' => true,
      ]);
      
      // Trigger the event on the 'discussion-channel'
    $pusher->trigger('religionExplorer', 'new-post-event', ['message' => 'A new post/reply/vote has been created.']);
} else {
    echo "error";
}
?>
