<?php
require_once "../controllers/discussion.controller.php";
require __DIR__ . '/../vendor/autoload.php';
session_start();


$id = $_POST['id'];
$voteAction = $_POST['voteAction'];

// Create an instance of the ControllerDiscussion class
$controller = new ControllerDiscussion();

$result = $controller->ctrUpdateVoteCountForTopic($id, $voteAction);

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