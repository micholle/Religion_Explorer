<?php
require_once "../controllers/discussion.controller.php";
require __DIR__ . '/../vendor/autoload.php';
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

$createDiscussion = new CreateDiscussion();
$createDiscussion->topicTitle = $_POST["topicTitle"];
$createDiscussion->topicContent = $_POST["topicContent"];
$createDiscussion->accountid = $_SESSION["accountid"];
$createDiscussion->anonymous = $_POST["anonymous"]; // Set the value of the anonymous checkbox

$createDiscussion->createDiscussionRecord();
?>
