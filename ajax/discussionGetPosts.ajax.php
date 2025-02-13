<?php
require_once "../controllers/discussion.controller.php";
session_start();
if ($_SESSION['acctype'] === "guest") {
    // Apply the "pointer-events: none;" style
    $pointerEventsStyle = 'style="pointer-events: none;"';
} else {
    // Do not apply the "pointer-events: none;" style
    $pointerEventsStyle = '';
}


$sort = isset($_GET['sort']) ? $_GET['sort'] : '';
$topicId = isset($_GET['topicId']) ? $_GET['topicId'] : '';
$controller = new ControllerDiscussion();
$posts = $controller->ctrGetAllPosts($sort, $topicId);
$userTimezoneOffsetMinutes = $_GET['userTimezoneOffsetMinutes'];

$html = '';
foreach ($posts as $post) {
    $postDateTimestamp = strtotime($post['postDate']);
    $localizedPostDateTimestamp = $postDateTimestamp + (-($userTimezoneOffsetMinutes) * 60);
    $localizedPostDate = date('F d, Y', $localizedPostDateTimestamp);
    $localizedPostTime = date('H:i', $localizedPostDateTimestamp);
    if ($post['downvotes'] < 50){
    $html .= '<div class="forumPostViewComments d-flex flex-column" data-post-id="' . $post['postId'] . '">';
    $html .= '  <div class="d-flex justify-content-start align-items-start flex-row">';
    $html .= '<img src="data:image/png;base64,' . base64_encode($post['avatar']) . '" class="discussionForumAvatarComment" data-accountid="' . $post['accountid'] . '">';
    $html .= '    <div class="forumPostViewContent">';
    $html .= '      <div class="row">';
    $html .= '        <div class="col-12 d-flex flex-row">';
    $html .= '          <h2 class="discussionForumUsernameComment" data-accountid="' . $post['accountid'] . '">' . $post['username'] . '</h2><h2>•</h2><h2 class="postDate" data-postdate="' . $post['postDate'] . '">' . $localizedPostDate . ' • ' . $localizedPostTime . '</h2>';
    $html .= '        </div>';
    $html .= '      </div>';
    $html .= '      <div class="forumPostViewContentBox">';
    $html .= '        <p class="contentEditable" contenteditable="false">' . $post['postContent'] . '</p>';
    $html .= '        <div class="col-12 d-flex flex-row forumPostViewContentInt">';
    $html .= '          <div class="forumPostViewMainInt d-flex justify-content-center align-items-center flex-row">';
    $hasUpvotedPost = $controller->ctrGetPostVoteByUser($post['postId'], $_SESSION['accountid']) === 'upvote';
    $hasDownvotedPost = $controller->ctrGetPostVoteByUser($post['postId'], $_SESSION['accountid']) === 'downvote';
    $html .= '            <img src="../assets/img/discussionForum/upvote' . ($hasUpvotedPost ? '-active' : '') . '.png" class="upvoteButton" data-type="post" data-id="' . $post['postId'] . '" '. $pointerEventsStyle .'>';
    $html .= '            <p class="forumPostViewMainCount forumPostViewMainVote upvotes">' . $post['upvotes'] . '</p>';
    $html .= '            <img src="../assets/img/discussionForum/downvote' . ($hasDownvotedPost ? '-active' : '') . '.png" class="downvoteButton" data-type="post" data-id="' . $post['postId'] . '" '. $pointerEventsStyle .'>';
    $html .= '          </div>';
    if ($_SESSION['acctype'] === 'regular') {
    $html .= '          <div class="forumPostViewMainInt d-flex justify-content-center align-items-center flex-row">';
    $html .= '            <img src="../assets/img/discussionForum/comments.png" class="commentIcon">';
    $html .= '            <p class="forumPostViewMainCount forumPostViewMainComment" onclick="initializeReplyButtons(' . $post['postId'] . ')" value="' . $post['postId'] . '">Reply</p>';
    $html .= '          </div>';
    }
    $html .= '<div class="forumPostViewMainInt d-flex justify-content-center align-items-center flex-row" id="dropdownMenuComment">';
    $html .= '    <img src="../assets/img/discussionForum/menu.png" class="commentIcon">';
    $html .= '</div>';
    $html .= '<div id="dropdownContentComment" class="dropdown-content" style="display: none;">';
    $html .= '    <div class="dropdown-buttons-container-var">';
    if ($post['accountid'] === $_SESSION['accountid']) {
        $html .= '          <div class="forumPostViewMainInt d-flex justify-content-center align-items-center flex-row">';
        $html .= '            <img src="../assets/img/discussionForum/edit.png" class="commentIcon">';
        $html .= '            <p class="forumPostViewMainCount forumPostViewMainVote editButton" value="' . $post['postId'] . '">Edit</p>';
        $html .= '          </div>';
    }
    if ($_SESSION['acctype'] === 'regular' && $post['accountid'] != $_SESSION['accountid']) {
    $html .= '          <div class="forumPostViewMainInt d-flex justify-content-center align-items-center flex-row" onclick="reportContent(\'' . $topicId . '\')">';
    $html .= '            <img src="../assets/img/discussionForum/report.png" class="commentIcon">';
    $html .= '            <p class="forumPostViewMainCount forumPostViewMainReport">Report</p>';
    $html .= '          </div>';
    }
    $html .= '<div class="forumPostViewMainInt d-flex justify-content-center align-items-center" id="forumCommentViewHistory">';
    $html .= '<img src="../assets/img/discussionForum/time.png" class="commentIcon">';
    $html .= '<p class="forumPostViewMainCount forumPostViewMainHistory" value="'.$topicId.'" class="historyButton">History</p>';
    $html .= '</div>';
    // Add the delete button only if the account ID matches the session account ID
    if ($post['accountid'] === $_SESSION['accountid']) {
        $html .= '<div class="forumPostViewMainInt d-flex justify-content-center align-items-center flex-row" data-post-id="' . $post['postId'] . '">';
        $html .= '    <img src="../assets/img/discussionForum/delete.png" class="commentIcon">';
        $html .= '<p class="forumPostViewMainCount forumPostViewMainDeletePost" value="' . $post['postId'] . '">Delete</p>';
        $html .= '</div>';
    }
    $html .= '    </div>';
    $html .= '</div>';
    $html .= '        </div>';
    $html .= '      </div>';
    $html .= '    </div>';
    $html .= '  </div>';
    $html .= '</div>';
    }

    // Display replies
    $replies = $controller->ctrGetRepliesByPostId($post['postId']);
    foreach ($replies as $reply) {
        if ($reply['downvotes'] < 50){
        $html .= '<div class="forumPostViewComments forumPostViewCommentReply d-flex flex-column" data-reply-id="' . $reply['replyId'] . '">'; // Start of reply container
        $html .= '  <div class="d-flex justify-content-start align-items-start flex-row">';
        $html .= '<img src="data:image/png;base64,' . base64_encode($reply['avatar']) . '" class="discussionForumAvatarComment" data-accountid="' . $reply['accountid'] . '">';
        $html .= '    <div class="forumPostViewContent">';
        $html .= '      <div class="row">';
        $html .= '        <div class="col-12 d-flex flex-row">';
        $html .= '          <h2 class="discussionForumUsernameComment" data-accountid="' . $post['accountid'] . '">' . $reply['username'] . '</h2><h2>•</h2><h2>' . date('F d, Y', strtotime($reply['replyDate'])) . ' • ' . date('H:i', strtotime($reply['replyDate'])) . '</h2>';
        $html .= '        </div>';
        $html .= '      </div>';
        $html .= '      <div class="forumPostViewContentBox">';
        $html .= '        <p class="contentEditable" contenteditable="false">' . $reply['replyContent'] . '</p>';
        $html .= '        <div class="col-12 d-flex flex-row forumPostViewContentInt">';
        $html .= '          <div class="forumPostViewMainInt d-flex justify-content-center align-items-center flex-row">';
        $hasUpvotedReply = $controller->ctrGetReplyVoteByUser($reply['replyId'], $_SESSION['accountid']) === 'upvote';
        $hasDownvotedReply = $controller->ctrGetReplyVoteByUser($reply['replyId'], $_SESSION['accountid']) === 'downvote';
        $html .= '            <img src="../assets/img/discussionForum/upvote' . ($hasUpvotedReply ? '-active' : '') . '.png" class="upvoteButton" data-type="reply" data-id="' . $reply['replyId'] . '" '. $pointerEventsStyle .'>';
        $html .= '            <p class="forumPostViewMainCount forumPostViewMainVote upvotes">' . $reply['upvotes'] . '</p>';
        $html .= '            <img src="../assets/img/discussionForum/downvote' . ($hasDownvotedReply ? '-active' : '') . '.png" class="downvoteButton" data-type="reply" data-id="' . $reply['replyId'] . '" '. $pointerEventsStyle .'>';
        $html .= '          </div>';
        if ($_SESSION['acctype'] === 'regular') {
        $html .= '          <div class="forumPostViewMainInt d-flex justify-content-center align-items-center flex-row">';
        $html .= '            <img src="../assets/img/discussionForum/comments.png" class="commentIcon">';
        $html .= '            <p class="forumPostViewMainCount forumPostViewMainComment" onclick="initializeReplyButtons(' . $post['postId'] . ')" value="' . $post['postId'] . '">Reply</p>';
        $html .= '          </div>';
        }
        $html .= '<div class="forumPostViewMainInt d-flex justify-content-center align-items-center flex-row" id="dropdownMenuComment">';
        $html .= '    <img src="../assets/img/discussionForum/menu.png" class="commentIcon">';
        $html .= '</div>';
        $html .= '<div id="dropdownContentComment" class="dropdown-content" style="display: none;">';
        $html .= '    <div class="dropdown-buttons-container-var">';
        if ($reply['accountid'] === $_SESSION['accountid']) {
            $html .= '          <div class="forumPostViewMainInt d-flex justify-content-center align-items-center flex-row">';
            $html .= '            <img src="../assets/img/discussionForum/edit.png" class="commentIcon">';
            $html .= '            <p class="forumPostViewMainCount forumPostViewMainVote editButton" value="' . $reply['replyId'] . '">Edit</p>';
            $html .= '          </div>';
        }
        if ($_SESSION['acctype'] === 'regular' && $reply['accountid'] != $_SESSION['accountid']) {
            $html .= '          <div class="forumPostViewMainInt d-flex justify-content-center align-items-center flex-row" onclick="reportContent(\'' . $topicId . '\')">';
            $html .= '            <img src="../assets/img/discussionForum/report.png" class="commentIcon">';
            $html .= '            <p class="forumPostViewMainCount forumPostViewMainReport">Report</p>';
            $html .= '          </div>';
        }
        $html .= '<div class="forumPostViewMainInt d-flex justify-content-center align-items-center" id="forumReplyViewHistory">';
        $html .= '<img src="../assets/img/discussionForum/time.png" class="commentIcon">';
        $html .= '<p class="forumPostViewMainCount forumPostViewMainHistory" value="'.$topicId.'" class="historyButton">History</p>';
        $html .= '</div>';
        // Add the delete button only if the account ID matches the session account ID
        if ($reply['accountid'] === $_SESSION['accountid']) {
            $html .= '          <div class="forumPostViewMainInt d-flex justify-content-center align-items-center flex-row" data-reply-id="' . $reply['replyId'] . '">';
            $html .= '              <img src="../assets/img/discussionForum/delete.png" class="commentIcon">';
            $html .= '              <p class="forumPostViewMainCount forumPostViewMainDeleteReply" value="' . $reply['replyId'] . '">Delete</p>';
            $html .= '          </div>';
        }
        $html .= '              </div>';
        $html .= '          </div>';
        $html .= '        </div>';
        $html .= '      </div>';
        $html .= '    </div>';
        $html .= '  </div>';
        $html .= '</div>'; // End of reply container
        }
    }
}

echo $html;
?>
