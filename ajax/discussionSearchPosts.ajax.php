<?php
require_once "../controllers/discussion.controller.php";
session_start();

$query = isset($_GET['query']) ? $_GET['query'] : '';

$controller = new ControllerDiscussion();
$posts = $controller->ctrSearchPosts($query);

$html = '';
foreach ($posts as $post) {
    $html .= '<div class="forumPostViewComments d-flex flex-column" data-post-id="' . $post['postId'] . '">';
    $html .= '  <div class="d-flex justify-content-start align-items-start flex-row">';
    $html .= '    <img src="data:image/png;base64,'.base64_encode($post['avatar']).'" class="discussionForumAvatarComment">';
    $html .= '    <div class="forumPostViewContent">';
    $html .= '      <div class="row">';
    $html .= '        <div class="col-12 d-flex flex-row">';
    $html .= '          <h2>' . $post['username'] . '</h2><h2>•</h2><h2>' . $post['postDate'] . '</h2>';
    $html .= '        </div>';
    $html .= '      </div>';
    $html .= '      <div class="forumPostViewContentBox">';
    $html .= '        <p class="contentEditable" contenteditable="false">' . $post['postContent'] . '</p>';
    $html .= '        <div class="col-12 d-flex flex-row forumPostViewContentInt">';
    $html .= '          <div class="forumPostViewMainInt d-flex justify-content-center align-items-center flex-row">';
    $hasUpvotedPost = $controller->ctrGetPostVoteByUser($post['postId'], $_SESSION['accountid']) === 'upvote';
    $hasDownvotedPost = $controller->ctrGetPostVoteByUser($post['postId'], $_SESSION['accountid']) === 'downvote';
    $html .= '            <img src="../assets/img/discussionForum/upvote' . ($hasUpvotedPost ? '-active' : '') . '.png" class="upvoteButton" data-type="post" data-id="' . $post['postId'] . '">';
    $html .= '            <p class="forumPostViewMainCount forumPostViewMainVote">' . $post['upvotes'] . '</p>';
    $html .= '            <img src="../assets/img/discussionForum/downvote' . ($hasDownvotedPost ? '-active' : '') . '.png" class="downvoteButton" data-type="post" data-id="' . $post['postId'] . '">';
    $html .= '          </div>';
    $html .= '          <div class="forumPostViewMainInt d-flex justify-content-center align-items-center flex-row">';
    $html .= '            <img src="../assets/img/discussionForum/comments.png" class="commentIcon">';
    $html .= '            <p class="forumPostViewMainCount forumPostViewMainComment" onclick="initializeReplyButtons(' . $post['postId'] . ')" value="' . $post['postId'] . '">Reply</p>';
    $html .= '          </div>';
    if ($post['accountid'] === $_SESSION['accountid']) {
        $html .= '          <div class="forumPostViewMainInt d-flex justify-content-center align-items-center flex-row">';
        $html .= '            <img src="../assets/img/discussionForum/edit.png" class="commentIcon">';
        $html .= '            <p class="forumPostViewMainCount forumPostViewMainVote editButton" value="' . $post['postId'] . '">Edit</p>';
        $html .= '          </div>';
    }
    $html .= '          <div class="forumPostViewMainInt d-flex justify-content-center align-items-center flex-row" id="reportCommentBtn">';
    $html .= '            <img src="../assets/img/discussionForum/report.png" class="commentIcon">';
    $html .= '            <p class="forumPostViewMainCount forumPostViewMainReport">Report</p>';
    $html .= '          </div>';
    // Add the delete button only if the account ID matches the session account ID
    if ($post['accountid'] === $_SESSION['accountid']) {
        $html .= '<div class="forumPostViewMainInt d-flex justify-content-center align-items-center flex-row" data-post-id="' . $post['postId'] . '">';
        $html .= '    <img src="../assets/img/discussionForum/delete.png" class="commentIcon">';
        $html .= '<p class="forumPostViewMainCount forumPostViewMainDeletePost" value="' . $post['postId'] . '">Delete</p>';
        $html .= '</div>';
    }
    $html .= '        </div>';
    $html .= '      </div>';
    $html .= '    </div>';
    $html .= '  </div>';
    $html .= '</div>';

    // Display replies
    $replies = $controller->ctrGetRepliesByPostId($post['postId']);
    foreach ($replies as $reply) {
        $html .= '<div class="forumPostViewComments forumPostViewCommentReply d-flex flex-column">'; // Start of reply container
        $html .= '  <div class="d-flex justify-content-start align-items-start flex-row">';
        $html .= '    <img src="data:image/png;base64,'.base64_encode($reply['avatar']).'" class="discussionForumAvatarComment">';
        $html .= '    <div class="forumPostViewContent">';
        $html .= '      <div class="row">';
        $html .= '        <div class="col-12 d-flex flex-row">';
        $html .= '          <h2>' . $reply['username'] . '</h2><h2>•</h2><h2>' . $reply['replyDate'] . '</h2>';
        $html .= '        </div>';
        $html .= '      </div>';
        $html .= '      <div class="forumPostViewContentBox">';
        $html .= '        <p class="contentEditable" contenteditable="false">' . $reply['replyContent'] . '</p>';
        $html .= '        <div class="col-12 d-flex flex-row forumPostViewContentInt">';
        $html .= '          <div class="forumPostViewMainInt d-flex justify-content-center align-items-center flex-row">';
        $hasUpvotedReply = $controller->ctrGetReplyVoteByUser($reply['replyId'], $_SESSION['accountid']) === 'upvote';
        $hasDownvotedReply = $controller->ctrGetReplyVoteByUser($reply['replyId'], $_SESSION['accountid']) === 'downvote';
        $html .= '            <img src="../assets/img/discussionForum/upvote' . ($hasUpvotedReply ? '-active' : '') . '.png" class="upvoteButton" data-type="reply" data-id="' . $reply['replyId'] . '">';
        $html .= '            <p class="forumPostViewMainCount forumPostViewMainVote">' . $reply['upvotes'] . '</p>';
        $html .= '            <img src="../assets/img/discussionForum/downvote' . ($hasDownvotedReply ? '-active' : '') . '.png" class="downvoteButton" data-type="reply" data-id="' . $reply['replyId'] . '">';
        $html .= '          </div>';
        $html .= '          <div class="forumPostViewMainInt d-flex justify-content-center align-items-center flex-row">';
        $html .= '            <img src="../assets/img/discussionForum/comments.png" class="commentIcon">';
        $html .= '            <p class="forumPostViewMainCount forumPostViewMainComment" onclick="initializeReplyButtons(' . $post['postId'] . ')" value="' . $post['postId'] . '">Reply</p>';
        $html .= '          </div>';
        if ($reply['accountid'] === $_SESSION['accountid']) {
            $html .= '          <div class="forumPostViewMainInt d-flex justify-content-center align-items-center flex-row">';
            $html .= '            <img src="../assets/img/discussionForum/edit.png" class="commentIcon">';
            $html .= '            <p class="forumPostViewMainCount forumPostViewMainVote editButton" value="' . $reply['replyId'] . '">Edit</p>';
            $html .= '          </div>';
        }
        $html .= '          <div class="forumPostViewMainInt d-flex justify-content-center align-items-center flex-row" id="reportCommentBtn">';
        $html .= '            <img src="../assets/img/discussionForum/report.png" class="commentIcon">';
        $html .= '            <p class="forumPostViewMainCount forumPostViewMainReport">Report</p>';
        $html .= '          </div>';
        // Add the delete button only if the account ID matches the session account ID
        if ($reply['accountid'] === $_SESSION['accountid']) {
            $html .= '<div class="forumPostViewMainInt d-flex justify-content-center align-items-center flex-row" data-reply-id="' . $reply['replyId'] . '">';
            $html .= '    <img src="../assets/img/discussionForum/delete.png" class="commentIcon">';
            $html .= '<p class="forumPostViewMainCount forumPostViewMainDeleteReply" value="' . $reply['replyId'] . '">Delete</p>';
            $html .= '</div>';
        }
        $html .= '        </div>';
        $html .= '      </div>';
        $html .= '    </div>';
        $html .= '  </div>';
        $html .= '</div>'; // End of reply container
    }
}

echo $html;
?>
