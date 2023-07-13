<?php
require_once "../controllers/discussion.controller.php";
session_start();

class CreateDiscussion {
  public $topicTitle;
  public $topicContent;
  public $accountid;

  public function createDiscussionRecord() {
    $topicTitle = $this->topicTitle;
    $topicContent = $this->topicContent;
    $accountid = $this->accountid;

    $data = array(
      "topicTitle" => $topicTitle,
      "topicContent" => $topicContent,
      "accountid" => $accountid
    );

    $answer = (new ControllerDiscussion)->ctrCreateDiscussion($data);

    if ($answer) {
      echo "success";
    } else {
      echo "error";
    }
  }
}

$createDiscussion = new CreateDiscussion();
$createDiscussion->topicTitle = $_POST["topicTitle"];
$createDiscussion->topicContent = $_POST["topicContent"];
$createDiscussion->accountid = $_SESSION["accountid"];

$createDiscussion->createDiscussionRecord();
?>
