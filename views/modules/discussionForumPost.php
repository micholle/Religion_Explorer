<?php
require_once "../../models/discussionForumPost.model.php";
?>



<!doctype html>
<html lang="en">
    <head>
        <title>Religion Explorer: Discussion Forum</title>
        <link rel="icon" type="image/x-icon" href="../assets/img/applogo.png">
        <script type="text/javascript" src="../assets/js/jquery-3.6.4.min.js"></script>
        <script type="text/javascript" src="../assets/plugins/bootstrap-4.0.0/js/bootstrap.bundle.min.js"></script>

        <script type="text/javascript" src="../js/discussionForumPost.js"></script>
        <script type="text/javascript" src="../js/script.js"></script>

        <link type="text/css" rel="stylesheet" href="../assets/plugins/bootstrap-4.0.0/css/bootstrap.min.css">
        <link type="text/css" rel="stylesheet" href="../assets/css/styles.css">
    </head>
    <body>
        <div id="discussionForumPostSidebar"></div>

        <div class="pageContainer">
            <div class="container mw-100 mh-100">
                <div class="row d-flex justify-content-center align-items-center pageHeader">
                    <div class="col-4 d-flex justify-content-start align-items-center">
                        <h1>Discussion Forum</h1>
                    </div>  
                    <div class="col-8 d-flex justify-content-start align-items-center">
                        <input type="search" id="communitySearch" name="communitySearch" placeholder="Search the Community">
                    </div>
                </div>
            </div>

            <div class="row pageContent forumPostViewContainer">
                <div class="col-9 d-flex justify-content-center align-items-center">
                    <div class="forumPostViewBox">
                        <div class="forumPostViewMain">
                            <div class="row">
                            <div class="col-12 d-flex flex-column">
                                    <h1><?php echo $topicTitle; ?></h1>
                                    <div class="row">
                                        <div class="col-12 d-flex flex-row">
                                            <h2>by <?php echo $username; ?></h2><h2>•</h2><h2><?php echo $topicDate; ?></h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <p><?php echo $topicContent; ?></p>
                                </div>
                                <div class="col-12 d-flex flex-row">
                                    <div class="forumPostViewMainInt d-flex justify-content-center align-items-center flex-row">
                                        <img src="../assets/img/discussionForum/upvote.png">
                                        <p class="forumPostViewMainCount forumPostViewMainVote" id="upvotes" data-upvotes="<?php echo $upvotes; ?>"></p>
                                        <img src="../assets/img/discussionForum/downvote.png">
                                    </div>
                                    <div class="forumPostViewMainInt d-flex justify-content-center align-items-center flex-row">
                                        <img src="../assets/img/discussionForum/comments.png" class="commentIcon">
                                        <p class="forumPostViewMainCount forumPostViewMainComment">0</p>
                                    </div>
                                    <div class="forumPostViewMainInt d-flex justify-content-center align-items-center flex-row">
                                        <img src="../assets/img/discussionForum/report.png" class="commentIcon">
                                        <p class="forumPostViewMainCount forumPostViewMainReport">Report</p>
                                    </div>
                                    <div class="forumPostViewMainInt d-flex justify-content-center align-items-center flex-row" id="forumDeletePost">
                                        <img src="../assets/img/discussionForum/delete.png" class="commentIcon">
                                        <p class="forumPostViewMainCount forumPostViewMainDelete">Delete</p>
                                        <input type="hidden" class="topicId" id="topicId" value="<?php echo $topicId; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="forumPostFilter d-flex justify-content-end align-items-center flex-row">
                            <p >Sort comments by:</p>
                            <button type="button">Top</button>
                            <button type="button">New</button>
                        </div>

                        <div class="col-12 d-flex justify-content-center align-items-center forumCommentMargin">
                            <div class="forumCommentContainer">
                                <div class="forumCommentContent">
                                    <form>
                                        <textarea placeholder="What are your thoughts?" id="postContent"></textarea>
                                        <div class="row">
                                            <div class="col-12 d-flex justify-content-end align-items-center flex-row">
                                                <button type="submit" class="roundedButton">Comment</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div id="postContainer"></div>
                        
                                <!-- <div class="forumPostViewComments">
                                    <div class="d-flex justify-content-start align-items-center flex-column">
                                        <img src="../assets/img/editProfile/lion.png">
                                    </div>
                                    <div class="forumPostViewContent">
                                        <div class="row">
                                            <div class="col-12 d-flex flex-row">
                                            <h2>[Placeholder User]</h2><h2>•</h2><h2>[Placeholder Time]</h2>
                                            </div>
                                        </div>
                                        <div class="forumPostViewContentBox">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc ultricies eros id malesuada porta. Sed id vulputate purus. Vestibulum non luctus nisi, vel tincidunt leo. Phasellus scelerisque metus sit amet est pulvinar, efficitur molestie elit laoreet.</p>
                                            <div class="col-12 d-flex flex-row forumPostViewContentInt">
                                                <div class="forumPostViewMainInt d-flex justify-content-center align-items-center flex-row">
                                                    <img src="../assets/img/discussionForum/upvote.png">
                                                    <p class="forumPostViewMainCount forumPostViewMainVote">0</p>
                                                    <img src="../assets/img/discussionForum/downvote.png">
                                                </div>
                                                <div class="forumPostViewMainInt d-flex justify-content-center align-items-center flex-row">
                                                    <img src="../assets/img/discussionForum/comments.png" class="commentIcon">
                                                    <p class="forumPostViewMainCount forumPostViewMainComment">Reply</p>
                                                </div>
                                                <div class="forumPostViewMainInt d-flex justify-content-center align-items-center flex-row">
                                                    <img src="../assets/img/discussionForum/report.png" class="commentIcon">
                                                    <p class="forumPostViewMainCount forumPostViewMainReport">Report</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->

                        

                    </div>
                </div>

                <div class="col-3">
                    <div class="forumPostRecoContainer">
                        <div class="forumPostRecoBox">
                            <h3>[Placeholder Title]</h3>
                            <div class="row">
                                <div class="col-12 d-flex flex-row">
                                    <h2>[Upvotes]</h2><h2>•</h2><h2>[Comments]</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
        </div>
    </body>
</html>
