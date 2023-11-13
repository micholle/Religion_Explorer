<?php
require_once "../controllers/discussion.controller.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postId = $_POST['replyId'];

    $controller = new ControllerDiscussion();

    // Call the controller function to get all topic history entries
    $result = $controller->ctrGetAllReplyHistory($replyId);

    if ($result) {
        // Encode the avatar data as base64 before sending it in the response
        foreach ($result as &$historyItem) {
            if (isset($historyItem['avatar'])) {
                $historyItem['avatar'] = base64_encode($historyItem['avatar']);
            }
        }

        echo json_encode($result);
    } else {
        echo json_encode(['error' => 'No topic history found']);
    }
}
