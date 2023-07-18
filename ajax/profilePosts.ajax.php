<?php
require_once "../controllers/discussion.controller.php";
session_start();

// Create an instance of the ControllerDiscussion class
$controller = new ControllerDiscussion();

// Fetch topics using the controller with the sort criteria
$topics = $controller->ctrGetAllTopics('');
$posts = $controller->ctrGetProfilePosts();

$html = '';
foreach ($posts as $post){
    foreach ($topics as $topic) {
        if ($topic['topicId'] = $post['topicId']){
        $html .= '
        <div class="forumPostContainer">
        <div class="d-flex justify-content-start align-items-center flex-column forumInteractions">
            <img src="../assets/img/discussionForum/upvote.png">
            <p class="upvotes">'.$topic['upvotes'].'</p>
            <img src="../assets/img/discussionForum/downvote.png">
            <img src="../assets/img/discussionForum/comments.png" class="commentIcon">
            <p>0</p>
        </div>
        <div class="forumContentContainer">
            <div class="forumContent">
                <h1>'.$topic['topicTitle'].'</h1>
                <div class="row">
                    <div class="col-12 d-flex flex-row">
                        <h2>'.$topic['username'].'</h2><h2>•</h2><h2>'.$topic['topicDate'].'</h2>
                    </div>
                </div>
                <p>'.$topic['topicContent'].'</p>
            </div>
            <div class="forumPostContainer">
                <div class="d-flex justify-content-start align-items-center flex-column forumInteractions">
                    <img src="../assets/img/discussionForum/upvote.png">
                    <p class="upvotes">'.$post['upvotes'].'</p>
                    <img src="../assets/img/discussionForum/downvote.png">
                </div>
                <div class="forumContent">
                    <div class="row">
                        <div class="col-12 d-flex flex-row">
                            <h2>'.$post['username'].'</h2><h2>•</h2><h2>'.$post['postDate'].'</h2>
                        </div>
                    </div>
                    <p>'.$post['postContent'].'</p>
                </div>
            </div>
        </div>
    </div>
        ';
        }
    }
}

echo $html;
?>