<?php session_start(); 
if (!isset($_SESSION['accountid']) || empty($_SESSION['accountid'])) {
    // Redirect the user to splash.php
    header("Location: splash.php");
    exit(); // Terminate the script to prevent further execution
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Religion Explorer: Discussion Forum</title>
    <link rel="icon" type="image/x-icon" href="../assets/img/applogo.png">
    <script type="text/javascript" src="../assets/js/jquery-3.6.4.min.js"></script>
    <script type="text/javascript" src="../assets/plugins/bootstrap-4.0.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pusher/7.0.3/pusher.min.js"></script>
    <script type="text/javascript" src="../assets/plugins/googleapis/apis.google.com_js_api.js"></script>

    <script type="text/javascript" src="../js/discussionForum.js"></script>
    <script type="text/javascript" src="../js/script.js"></script>

    <link type="text/css" rel="stylesheet" href="../assets/plugins/bootstrap-4.0.0/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <div id="discussionForumSidebar"></div>
    <div id="accountidPlaceholder" hidden><?php echo $_SESSION['accountid']; ?></div>
    <div id="accountUsernamePlaceholder" hidden><?php echo $_SESSION['username']; ?></div>

    <div class="pageContainer">
        <div class="container mw-100 mh-100">
            <div class="row d-flex justify-content-center align-items-center pageHeader pl-0 pr-0">
                <div class="col-12 col-lg-4 d-flex justify-content-center justify-content-lg-start justify-content-lg-start align-items-center pl-0">
                    <a href="discussionForum.php" class="pageHeaderLink"><h1>Discussion Forum</h1></a>
                </div>
                <div class="col-12 col-lg-8 d-flex pr-0 pl-0">
                    <input type="search" id="forumSearch" name="forumSearch" placeholder="Search the Forum">
                </div>
            </div>
        </div>

        <div class="row pageContent">
            <?php
            if ($_SESSION['acctype'] === 'regular'){
                        echo'<div class="col-12 d-flex justify-content-center align-items-center">';
                        echo    '<div class="forumSubmitContainer flex-column flex-lg-row">';
                        echo        '<div class="forumSubmitContainerAvatar d-flex justify-content-start align-items-center flex-column">';
                        echo            '<img src="data:image/png;base64,' . base64_encode($_SESSION['avatar']) . '" class="discussionForumAvatarPost">';
                        echo        '</div>';
                        echo        '<div class="forumSubmitContent">';
                        echo            '<form>';
                        echo                '<input type="text" id="topicTitle" class="forumSubmitContentTitle" placeholder="Start a Discussion" autocomplete="off">';
                        echo                '<textarea id="topicContent" placeholder="What do you want to talk about?"></textarea>';
                        echo                '<div class="row forumSubmitInteractions d-flex justify-content-center justify-content-lg-center align-items-center">';
                        echo                     '<div class="col-12 d-flex justify-content-center justify-content-lg-end align-items-center flex-row forumSwitchContainer">';
                        echo                         '<p>Post anonymously</p>';
                        echo                         '<label class="switch">';
                        echo                             '<input id="anonymousCheckbox" type="checkbox">';
                        echo                             '<span class="slider round"></span>';
                        echo                         '</label>';
                        echo                     '</div>';
                        echo                     '<div class="col-12 d-flex justify-content-center justify-content-lg-end align-items-center">';
                        echo                         '<button type="submit" class="roundedButton">Post</button>';
                        echo                     '</div>';
                        echo                 '</div>';
                        echo            '</form>';
                        echo        '</div>';
                        echo    '</div>';
                        echo'</div>';
            }
            ?>
            <div class="col-12">
                <div class="forumPostFilter d-flex justify-content-center justify-content-lg-end align-items-center flex-row">
                    <p>Sort by:</p>
                    <button type="button" id="top">Popularity</button>
                    <button type="button" id="new">New</button>
                </div>
            </div>
            <div id="topicsContainer" class="col-12 d-flex justify-content-center flex-column align-items-center">
            </div>
        </div>

        <!--Modal-->
        <div class="modal fade" id="topicCreatedModal">
            <div class="modal-dialog modal-xs modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 d-flex justify-content-center align-items-center flex-column">
                                    <img id="modalIcon" src="../assets/img/verification-check.png" height="80px" width="80px">
                                    <h5 id="modalHeader" class="modal-title w-100">Topic Created Successfully!</h5>
                                    <p id="modalContent" class="text-center"></p>
                                    <button type="button" id="closeTopicCreatedModal" class="registrationSubmitButton" data-dismiss="modal">Nice!</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="toast" class="toast"></div>
    </div>
</body>
</html>
