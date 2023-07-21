<?php
session_start();
require_once "../../models/discussionForumPost.model.php";
if (!isset($_SESSION['accountid']) || empty($_SESSION['accountid'])) {
    // Redirect the user to splash.php
    header("Location: splash.php");
    exit(); // Terminate the script to prevent further execution
}
?>




<!doctype html>
<html lang="en">
    <head>
        <title>Religion Explorer: Discussion Forum</title>
        <link rel="icon" type="image/x-icon" href="../assets/img/applogo.png">
        <script type="text/javascript" src="../assets/js/jquery-3.6.4.min.js"></script>
        <script type="text/javascript" src="../assets/plugins/bootstrap-4.0.0/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pusher/7.0.3/pusher.min.js"></script>

        <script type="text/javascript" src="../js/discussionForumPost.js"></script>
        <script type="text/javascript" src="../js/script.js"></script>

        <link type="text/css" rel="stylesheet" href="../assets/plugins/bootstrap-4.0.0/css/bootstrap.min.css">
        <link type="text/css" rel="stylesheet" href="../assets/css/styles.css">
    </head>
    <body>
        <div id="discussionForumPostSidebar"></div>
        <div id="accountUsernamePlaceholder" hidden><?php echo $_SESSION['username']; ?></div>

        <div class="pageContainer">
            <div class="container mw-100 mh-100">
                <div class="row d-flex justify-content-center align-items-center pageHeader">
                    <div class="col-4 d-flex justify-content-start align-items-center">
                        <a href="discussionForum.php" class="pageHeaderLink"><h1>Discussion Forum</h1></a>
                    </div>  
                    <div class="col-8 d-flex justify-content-start align-items-center">
                        <input type="search" id="forumSearch" name="forumSearch" placeholder="Search the Forum">
                    </div>
                </div>
            </div>

            <div class="row pageContent forumPostViewContainer">
                <div class="col-9 d-flex justify-content-center align-items-start">
                    <div class="forumPostViewBox">
                        <div class="forumPostViewMain" id="TopTopic">
                            <input type="hidden" id="topicId" value="<?php echo $topicId; ?>">
                            <div class="row">
                            <div class="col-12 d-flex flex-column">
                                <?php if ($accountid === $_SESSION['accountid']) { ?>
                                    <h1 id="topicTitle" class="editable" contenteditable="false"><?php echo $topicTitle; ?></h1>
                                <?php } else { ?>
                                    <h1><?php echo $topicTitle; ?></h1>
                                <?php } ?>
                                    <div class="row">
                                        <div class="col-12 d-flex flex-row">
                                            <?php
                                            if ($anonymous == 1) {
                                                echo '                <h2>by Anonymous</h2>';
                                            } else {
                                                echo '                <h2>by ' . $username . '</h2>';
                                            }
                                            ?>
                                            <h2>•</h2><h2><?php echo $topicDate; ?></h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                <?php if ($accountid === $_SESSION['accountid']) { ?>
                                    <p id="topicContent" class="editable" contenteditable="false"><?php echo $topicContent; ?></p>
                                <?php } else { ?>
                                    <p id="topicContent"><?php echo $topicContent; ?></p>
                                <?php } ?>
                                </div>
                                <div class="col-12 d-flex flex-row">
                                    
                                    <div class="forumPostViewMainInt d-flex justify-content-center align-items-center flex-row" id="votes">
                                        <?php
                                        if ($_SESSION['acctype'] === 'regular'){
                                        echo '<img src="../assets/img/discussionForum/upvote' . ($hasUpvotedTopic ? '-active' : '') . '.png" class="upvoteButton" data-type="topic" data-id="' . $topicId . '">';
                                        echo '<p class="forumPostViewMainCount forumPostViewMainVote upvotes" id="upvotes">'. $upvotes .'</p>';
                                        echo '<img src="../assets/img/discussionForum/downvote' . ($hasDownvotedTopic ? '-active' : '') . '.png" class="downvoteButton" data-type="topic" data-id="' . $topicId . '">';                                        
                                        } else {
                                        echo '<img src="../assets/img/discussionForum/upvote' . ($hasUpvotedTopic ? '-active' : '') . '.png" class="upvoteButton" data-type="topic" data-id="' . $topicId . '" style="pointer-events: none;">';
                                        echo '<p class="forumPostViewMainCount forumPostViewMainVote upvotes" id="upvotes">'. $upvotes .'</p>';
                                        echo '<img src="../assets/img/discussionForum/downvote' . ($hasDownvotedTopic ? '-active' : '') . '.png" class="downvoteButton" data-type="topic" data-id="' . $topicId . '" style="pointer-events: none;">';       
                                        }
                                        ?>
                                    </div>
                                    <div class="forumPostViewMainInt d-flex justify-content-center align-items-center flex-row" id="comments">
                                        <img src="../assets/img/discussionForum/comments.png" class="commentIcon">
                                        <p class="forumPostViewMainCount forumPostViewMainComment"><?php echo $commentCount; ?></p>
                                    </div>
                                    <?php 
                                    if ($accountid === $_SESSION['accountid']) {
                                        echo '<div class="forumPostViewMainInt d-flex justify-content-center align-items-center flex-row">';
                                        echo    '<img src="../assets/img/discussionForum/edit.png" class="commentIcon">';
                                        echo    '<p class="forumPostViewMainCount forumPostViewMainVote" value="'.$topicId.'" class="editButton" id="editButton">Edit</p>';
                                        echo '</div>';
                                    }
                                    if ($_SESSION['acctype'] === 'regular') {
                                        echo '<div class="forumPostViewMainInt d-flex justify-content-center align-items-center flex-row" id="reportPostBtn">';
                                        echo '<img src="../assets/img/discussionForum/report.png" class="commentIcon">';
                                        echo '<p class="forumPostViewMainCount forumPostViewMainReport">Report</p>';
                                        echo '</div>';
                                    }
                                    if ($accountid === $_SESSION['accountid']) {
                                        echo '<div class="forumPostViewMainInt d-flex justify-content-center align-items-center flex-row" id="forumDeletePost">';
                                        echo     '<img src="../assets/img/discussionForum/delete.png" class="commentIcon">';
                                        echo     '<p class="forumPostViewMainCount forumPostViewMainDelete" value="'.$topicId.'">Delete</p>';
                                        echo '</div>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div class="forumPostFilter d-flex justify-content-end align-items-center flex-row">
                            <p >Sort comments by:</p>
                            <button type="button" id="top">Top</button>
                            <button type="button" id="new">New</button>
                        </div>
                        <?php
                        if ($_SESSION['acctype'] === 'regular'){
                        echo'<div class="col-12 d-flex justify-content-center align-items-center forumCommentMargin">';
                        echo    '<div class="forumCommentContainer">';
                        echo        '<div class="forumCommentContent">';
                        echo            '<form>';
                        echo                '<textarea placeholder="What are your thoughts?" id="postContent"></textarea>';
                        echo                '<div class="row">';
                        echo                    '<div class="col-12 d-flex justify-content-end align-items-center flex-row">';
                        echo                        '<button type="submit" class="roundedButton">Comment</button>';
                        echo                    '</div>';
                        echo                '</div>';
                        echo            '</form>';
                        echo        '</div>';
                        echo    '</div>';
                        echo'</div>';
                        }
                        ?>
                        <div id="postContainer"></div>
                    </div>
                </div>

                <div class="col-3">
                    <div class="forumPostRecoContainer" id="forumPostRecoContainer">
                    
                    </div>
                </div>
            </div>
            
            <!--Modals-->
            <div class="modal fade" id="confirmDeleteModal">
                <div class="modal-dialog modal-xs modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-center align-items-center flex-column">
                                        <h5 class="modal-title w-100">Delete Content?</h5>
                                        <p>Are you sure you want this gone?</p>
                                        <div class="row">
                                            <div class="col-12 d-flex flex-row">
                                                <button type="button" class="roundedButtonVariant" data-dismiss="modal">Cancel</button>
                                                <button type="button" class="roundedButton" id="confirmDelete">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="reportContentModal">
                <div class="modal-dialog modal-xs modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header text-center">
                            <div class="container d-flex justify-content-center align-items-center flex-column">
                                <h5 class="modal-title w-100">Report Content</h5>
                                <div id="reportContentHeader"></div>
                            </div>
                        </div>

                        <div class="modal-body">
                            <div class="container">
                                <form id="reportContentForm" method="post">
                                    <div class="row">
                                        <div class="col-12">
                                            <p class="reportDescription">As accurately as you can, please tell us what happened.</p>
                                            <input type="checkbox" id="privacy violation" name="privacy violation" value="privacy violation">
                                            <label for="privacy violation">Privacy Violation</label><br>
                                            <input type="checkbox" id="misinformation" name="misinformation" value="misinformation">
                                            <label for="misinformation">Misinformation</label><br>
                                            <input type="checkbox" id="graphic content" name="graphic content" value="graphic content">
                                            <label for="graphic content">Graphic Content</label><br>
                                            <input type="checkbox" id="offensive language" name="offensive language" value="offensive language">
                                            <label for="offensive language">Offensive Language</label><br>
                                            <input type="checkbox" id="spam" name="spam" value="spam">
                                            <label for="spam">Spam or Unwanted Content</label><br>
                                            <input type="checkbox" id="others" name="others" value="others">
                                            <label for="others">Others, specify:</label><br>
                                            <input id="othersSpecify" class="inputVariant" name="othersSpecify"><br>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 d-flex justify-content-center align-items-center flex-column">
                                            <textarea id="reportContentAdditional" name="reportContentAdditional" placeholder="Give additional context."></textarea><br>
                                            <button type="button" id="submitReportContent" class="roundedButton">Send</button>
                                        </div>
                                    </div>
                                </form>    
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="toast" class="toast"></div>
        </div>
    </body>
</html>
