<?php
require_once "../controllers/discussion.controller.php";
require __DIR__ . '/../vendor/autoload.php';
session_start();

class CreatePost {
  public $topicId;
  public $postContent;
  public $accountid;

  public function createPostRecord() {
    $topicId = $this->topicId;
    $postContent = $this->postContent;
    $accountid = $this->accountid;

    $data = array(
      "topicId" => $topicId,
      "postContent" => $postContent,
      "accountid" => $accountid
    );

    $answer = (new ControllerDiscussion)->ctrCreatePost($data);

    if ($answer) {
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

$createPost = new CreatePost();
$createPost->topicId = $_POST["topicId"];
$createPost->postContent = $_POST["postContent"];
$createPost->accountid = $_SESSION["accountid"];

$createPost->createPostRecord();
?>
