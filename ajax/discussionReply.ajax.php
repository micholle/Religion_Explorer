<?php
require_once "../controllers/discussion.controller.php";
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
