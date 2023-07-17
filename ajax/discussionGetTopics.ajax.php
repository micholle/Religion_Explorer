<?php
require_once "../controllers/discussion.controller.php";
session_start();

// Create an instance of the ControllerDiscussion class
$controller = new ControllerDiscussion();

// Fetch topics using the controller with the sort criteria
$topics = $controller->ctrGetTopics();

$html = '';
$counter = 0; // Counter variable to limit the loop

foreach ($topics as $topic) {
    $html .= '<div class="forumPostRecoBox">';
    $html .= '  <h3>' . $topic['topicTitle'] . '</h3>';
    $html .= '  <p>' . substr($topic['topicContent'], 0, 100) . '... <a href="#">See more</a></p>';
    $html .= '  <div class="row">';
    $html .= '    <div class="col-12 d-flex flex-row">';
    $html .= '      <h2>' . $topic['upvotes'] . '</h2><h2>•</h2><h2>' . $topic['commentCount'] . '</h2>';
    $html .= '    </div>';
    $html .= '  </div>';
    $html .= '</div>';


    $counter++; // Increment the counter

    if ($counter >= 10) {
        break; // Break the loop when the counter reaches 10
    }
}

echo $html;
?>
