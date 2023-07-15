<?php
require_once "../controllers/discussion.controller.php";

$sort = isset($_GET['sort']) ? $_GET['sort'] : '';
$topicId = isset($_GET['topicId']) ? $_GET['topicId'] : '';
$controller = new ControllerDiscussion();
$posts = $controller->ctrGetAllPosts($sort, $topicId);

$html = '';
foreach ($posts as $post) {
    $html .= '<div class="forumPostViewComments d-flex flex-column">';
    $html .= '<div class="d-flex justify-content-start align-items-start flex-row">'; // Modified this line
    $html .= '<img src="../assets/img/editProfile/lion.png">';
    $html .= '<div class="forumPostViewContent">'; // Moved the opening div tag here
    $html .= '<div class="row">';
    $html .= '<div class="col-12 d-flex flex-row">';
    $html .= '<h2>' . $post['username'] . '</h2><h2>•</h2><h2>' . $post['postDate'] . '</h2>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '<div class="forumPostViewContentBox">';
    $html .= '<p>' . $post['postContent'] . '<p>';
    $html .= '<div class="col-12 d-flex flex-row forumPostViewContentInt">';
    $html .= '<div class="forumPostViewMainInt d-flex justify-content-center align-items-center flex-row">';
    $html .= '<img src="../assets/img/discussionForum/upvote.png">';
    $html .= '<p class="forumPostViewMainCount forumPostViewMainVote">' . $post['upvotes'] . '</p>';
    $html .= '<img src="../assets/img/discussionForum/downvote.png">';
    $html .= '</div>';
    $html .= '<div class="forumPostViewMainInt d-flex justify-content-center align-items-center flex-row">';
    $html .= '<img src="../assets/img/discussionForum/comments.png" class="commentIcon">';
    $html .= '<p class="forumPostViewMainCount forumPostViewMainComment" onclick="handleReply(' . $post['postId'] . ')">Reply</p>'; // Added onclick event
    $html .= '</div>';
    $html .= '<div class="forumPostViewMainInt d-flex justify-content-center align-items-center flex-row">';
    $html .= '<img src="../assets/img/discussionForum/edit.png" class="commentIcon">';
    $html .= '<p class="forumPostViewMainCount forumPostViewMainVote">Edit</p>';
    $html .= '</div>';
    $html .= '<div class="forumPostViewMainInt d-flex justify-content-center align-items-center flex-row">';
    $html .= '<img src="../assets/img/discussionForum/report.png" class="commentIcon">';
    $html .= '<p class="forumPostViewMainCount forumPostViewMainReport">Report</p>';
    $html .= '</div>';
    $html .= '<div class="forumPostViewMainInt d-flex justify-content-center align-items-center flex-row" id="forumDeleteComment">';
    $html .= '<img src="../assets/img/discussionForum/delete.png" class="commentIcon">';
    $html .= '<p class="forumPostViewMainCount forumPostViewMainDelete">Delete</p>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '<div id="forumPostViewCommentReplySubmit">';
    $html .= '</div>';
}


echo $html;
