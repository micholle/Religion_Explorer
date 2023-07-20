<?php
require_once "../controllers/discussion.controller.php";
require __DIR__ . '/../vendor/autoload.php';
session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    class CreateReply {
        public $postId;
        public $replyContent;
        public $accountid;

        public function createReplyRecord() {
            $postId = $this->postId;
            $replyContent = $this->replyContent;
            $accountid = $this->accountid;

            $data = array(
                "postId" => $postId,
                "replyContent" => $replyContent,
                "accountid" => $accountid
            );

            $result = (new ControllerDiscussion)->ctrCreateReply($data);

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

    $createReply = new CreateReply();
    $createReply->postId = $_POST["postId"];
    $createReply->replyContent = $_POST["replyContent"];
    $createReply->accountid = $_SESSION["accountid"];

    $createReply->createReplyRecord();
}
?>
