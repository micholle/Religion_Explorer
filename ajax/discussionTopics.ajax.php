<?php
require_once "../controllers/discussion.controller.php";
session_start();

$sort = isset($_GET['sort']) ? $_GET['sort'] : ''; // Get the sort criteria from the request

// Create an instance of the ControllerDiscussion class
$controller = new ControllerDiscussion();

// Fetch topics using the controller with the sort criteria
$topics = $controller->ctrGetAllTopics($sort);

$html = '';
foreach ($topics as $topic) {
    if ($topic['downvotes'] < 50){
    $hasUpvotedReply = $controller->ctrGetTopicVoteByUser($topic['topicId'], $_SESSION['accountid']) === 'upvote';
    $hasDownvotedReply = $controller->ctrGetTopicVoteByUser($topic['topicId'], $_SESSION['accountid']) === 'downvote';
    $html .= '<div class="forumPostContainer">';
    $html .= '    <div class="d-flex justify-content-start align-items-center flex-column forumInteractions">';
    $html .= '        <img src="../assets/img/discussionForum/upvote' . ($hasUpvotedReply ? '-active' : '') . '.png" class="upvoteButton" data-type="reply" data-id="' . $topic['topicId'] . '">';
    $html .= '        <p class="upvotes">' . $topic['upvotes'] . '</p>';
    $html .= '        <img src="../assets/img/discussionForum/downvote' . ($hasDownvotedReply ? '-active' : '') . '.png" class="downvoteButton" data-type="reply" data-id="' . $topic['topicId'] . '">';
    $html .= '        <img src="../assets/img/discussionForum/comments.png" class="commentIcon">';
    $html .= '        <p>' . $topic['commentCount'] . '</p>';
    $html .= '    </div>';
    $html .= '    <div class="forumContent">';
    $html .= '        <h1>' . $topic['topicTitle'] . '</h1>';
    $html .= '        <div class="row">';
    $html .= '            <div class="col-12 d-flex flex-row">';
    
    if ($topic['anonymous'] == 1) {
        $html .= '                <h2>by Anonymous</h2>';
    } else {
        $html .= '                <h2>by ' . $topic['username'] . '</h2>';
    }
    
    $html .= '                <h2>•</h2>';
    $html .= '                <h2>' . date('F d, Y', strtotime($topic['topicDate'])) . ' • ' . date('H:i', strtotime($topic['topicDate'])) . '</h2>';
    $html .= '            </div>';
    $html .= '        </div>';
    $html .= '        <p>' . $topic['topicContent'] . '</p>';
    $html .= '        <input type="hidden" class="topicId" id="topicId" value="' . $topic['topicId'] . '">';
    $html .= '    </div>';
    $html .= '</div>';
    }
}

echo $html;
?>
