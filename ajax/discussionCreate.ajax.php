<?php
require_once "../controllers/discussion.controller.php";
session_start();

class CreateDiscussion {
    public $topicTitle;
    public $topicContent;
    public $accountid;
    public $anonymous; // Add the anonymous property

    public function createDiscussionRecord() {
        $topicTitle = $this->topicTitle;
        $topicContent = $this->topicContent;
        $accountid = $this->accountid;
        $anonymous = $this->anonymous; // Get the value of the anonymous checkbox

        $data = array(
            "topicTitle" => $topicTitle,
            "topicContent" => $topicContent,
            "accountid" => $accountid,
            "anonymous" => $anonymous // Add the anonymous value to the data array
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
$createDiscussion->anonymous = $_POST["anonymous"]; // Set the value of the anonymous checkbox

$createDiscussion->createDiscussionRecord();
?>
