<?php
require_once "../controllers/discussion.controller.php";

$controller = new ControllerDiscussion();
$topics = $controller->ctrGetAllTopics();

$html = '';
foreach ($topics as $topic) {
  $html .= '<div class="forumPostContainer">';
  $html .= '<div class="d-flex justify-content-start align-items-center flex-column forumInteractions">';
  $html .= '<img src="../assets/img/discussionForum/upvote.png">';
  $html .= '<p>0</p>';
  $html .= '<img src="../assets/img/discussionForum/downvote.png">';
  $html .= '<img src="../assets/img/discussionForum/comments.png" class="commentIcon">';
  $html .= '<p>0</p>';
  $html .= '</div>';
  $html .= '<div class="forumContent">';
  $html .= '<h1>' . $topic['topicTitle'] . '</h1>';
  $html .= '<div class="row">';
  $html .= '<div class="col-12 d-flex flex-row">';
  $html .= '<h2>by ' . $topic['accountid'] . '</h2>';
  $html .= '<h2>•</h2>';
  $html .= '<h2>' . $topic['topicDate'] . '</h2>';
  $html .= '</div>';
  $html .= '</div>';
  $html .= '<p>' . $topic['topicContent'] . '</p>';
  $html .= '</div>';
  $html .= '</div>';

}

echo $html;
