<?php
require_once "../controllers/discussion.controller.php";
session_start();

// Check if accountid is available in $_GET
if (isset($_GET['accountid'])) {
    $accountid = $_GET['accountid'];

    // Create an instance of the ControllerDiscussion class
    $controller = new ControllerDiscussion();

    // Fetch topics using the controller with the sort criteria
    $topics = $controller->ctrGetProfileTopics($accountid);

    $html = '';
    foreach ($topics as $topic) {
        $html .= '
            <div class="forumPostContainer">
                <div class="d-flex justify-content-start align-items-center flex-column forumInteractions">
                    <img src="../assets/img/discussionForum/upvote.png">
                    <p class="upvotes">'. $topic['upvotes'] .'</p>
                    <img src="../assets/img/discussionForum/downvote.png">
                    <img src="../assets/img/discussionForum/comments.png" class="commentIcon">
                    <p>0</p>
                </div>
                <div class="forumContent">
                    <h1>' . $topic['topicTitle'] . '</h1>
                    <div class="row">
                        <div class="col-12 d-flex flex-row">
                            <h2>' . $topic['username'] . '</h2><h2>•</h2><h2>' . $topic['topicDate'] . '</h2>
                        </div>
                    </div>
                    <p>' . $topic['topicContent'] . '</p>
                </div>
            </div>
        ';
    }

    echo $html;
} else {
    // Handle the case when accountid is not available
    echo "Error: accountid is missing.";
}
?>
