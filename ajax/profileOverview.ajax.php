<?php
require_once "../controllers/discussion.controller.php";
require_once "../controllers/bookmark.controller.php";
session_start();

// Check if the 'accountid' is set in the POST data
if (isset($_GET['accountid'])) {
    $accountid = $_GET['accountid'];

    // Create an instance of the ControllerDiscussion class
    $controller = new ControllerDiscussion();

    // Fetch topics using the controller with the sort criteria
    $topics = $controller->ctrGetAllTopics('new');
    $posts = $controller->ctrGetProfilePosts($accountid);

    // Merge topics and posts into a single array
    $mergedArray = array_merge($topics, $posts);

    // Sort the merged array by date (assuming the date key is 'topicDate' for topics and 'postDate' for posts)
    usort($mergedArray, function ($a, $b) {
        $aDate = $a['itemType'] === 'topic' ? $a['topicDate'] : $a['postDate'];
        $bDate = $b['itemType'] === 'topic' ? $b['topicDate'] : $b['postDate'];

        return strtotime($bDate) - strtotime($aDate);
    });

    $html = '';
    $processedTopicIds = array();
    $processedPostIds = array();
    foreach ($mergedArray as $item) {
        // Check if the item is a topic or a post
        if ($item['itemType'] === 'post') {
            // Find the corresponding topic for the post
            $topic = null;
            foreach ($topics as $topicItem) {
                if ($topicItem['topicId'] == $item['topicId']) {
                    $topic = $topicItem;
                    break;
                }
            }

            // Check if the post has not been processed already
            if (!in_array($item['postId'], $processedPostIds)) {
                $html .= '
                <a href="discussionForumPost.php?topicId='. $topic['topicId'] . '" style="text-decoration:none">
                    <div class="forumPostContainer">
                        <div class="d-flex justify-content-start align-items-center flex-column forumInteractions">
                            <img src="../assets/img/discussionForum/upvote.png">
                            <p class="upvotes">' . $topic['upvotes'] . '</p>
                            <img src="../assets/img/discussionForum/downvote.png">
                            <img src="../assets/img/discussionForum/comments.png" class="commentIcon">
                            <p>0</p>
                        </div>
                        <div class="forumContentContainer">
                            <div class="forumContent">
                                <h1>' . $topic['topicTitle'] . '</h1>
                                <div class="row">
                                    <div class="col-12 d-flex flex-row">
                                        <h2>' . $topic['username'] . '</h2><h2>•</h2><h2>' . $topic['topicDate'] . '</h2>
                                    </div>
                                </div>
                                <p>' . $topic['topicContent'] . '</p>
                            </div>
                            <div class="forumPostContainer">
                                <div class="d-flex justify-content-start align-items-center flex-column forumInteractions">
                                    <img src="../assets/img/discussionForum/upvote.png">
                                    <p class="upvotes">' . $item['postUpvotes'] . '</p>
                                    <img src="../assets/img/discussionForum/downvote.png">
                                </div>
                                <div class="forumContent">
                                    <div class="row">
                                        <div class="col-12 d-flex flex-row">
                                            <h2>' . $item['username'] . '</h2><h2>•</h2><h2>' . $item['postDate'] . '</h2>
                                        </div>
                                    </div>
                                    <p>' . $item['postContent'] . '</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    </a>
                ';

                // Add the processed post ID to the array to avoid duplicating posts
                $processedPostIds[] = $item['postId'];
            }
        } else {
            // Check if the topic belongs to the given accountid and has not been processed already
            if ($item['accountid'] === $accountid && !in_array($item['topicId'], $processedTopicIds)) {
                $html .= '
                <a href="discussionForumPost.php?topicId='. $item['topicId'] . '" style="text-decoration:none">
                    <div class="forumPostContainer">
                        <div class="d-flex justify-content-start align-items-center flex-column forumInteractions">
                            <img src="../assets/img/discussionForum/upvote.png">
                            <p class="upvotes">' . $item['upvotes'] . '</p>
                            <img src="../assets/img/discussionForum/downvote.png">
                            <img src="../assets/img/discussionForum/comments.png" class="commentIcon">
                            <p>0</p>
                        </div>
                        <div class="forumContent">
                            <h1>' . $item['topicTitle'] . '</h1>
                            <div class="row">
                                <div class="col-12 d-flex flex-row">
                                    <h2>' . $item['username'] . '</h2><h2>•</h2><h2>' . $item['topicDate'] . '</h2>
                                </div>
                            </div>
                            <p>' . $item['topicContent'] . '</p>
                        </div>
                    </div>
                    </a>
                ';

                // Add the processed topic ID to the array to avoid duplicating topics
                $processedTopicIds[] = $item['topicId'];
            }
        }
    }

    echo $html;
} else {
    // If 'accountid' is not set in the POST data, display an error message or handle accordingly.
    echo "Error: 'accountid' not provided in the POST data.";
}
?>
