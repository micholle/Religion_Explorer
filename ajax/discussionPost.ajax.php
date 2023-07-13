<?php
require_once "../controllers/discussion.controller.php";
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
