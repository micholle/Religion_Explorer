<!doctype html>
<html lang="en">
<head>
    <title>Religion Explorer: Discussion Forum</title>
    <link rel="icon" type="image/x-icon" href="../assets/img/applogo.png">
    <script type="text/javascript" src="../assets/js/jquery-3.6.4.min.js"></script>
    <script type="text/javascript" src="../assets/plugins/bootstrap-4.0.0/js/bootstrap.bundle.min.js"></script>

    <script type="text/javascript" src="../js/discussionForum.js"></script>
    <script type="text/javascript" src="../js/script.js"></script>

    <link type="text/css" rel="stylesheet" href="../assets/plugins/bootstrap-4.0.0/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <div id="discussionForumSidebar"></div>

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

        <div class="row pageContent">
            <div class="col-12 d-flex justify-content-center align-items-center">
                <div class="forumSubmitContainer">
                    <div class="d-flex justify-content-start align-items-center flex-column">
                        <img src="../assets/img/editProfile/lamb.png" width="45px">
                    </div>
                    <div class="forumSubmitContent">
                        <form>
                            <input type="text" class="forumSubmitContentTitle" placeholder="Start a Discussion">
                            <textarea placeholder="What do you want to talk about?"></textarea>
                            <div class="row forumSubmitInteractions">
                                <div class="col-12 d-flex justify-content-end align-items-center flex-row">
                                    <p>Post anonymously</p>
                                    <label class="switch">
                                        <input type="checkbox">
                                        <span class="slider round"></span>
                                    </label>
                                    <button type="submit" class="roundedButton">Post</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="forumPostFilter d-flex justify-content-end align-items-center flex-row">
                    <p>Sort by:</p>
                    <button type="button">Top</button>
                    <button type="button">New</button>
                </div>
            </div>
            <div id="topicsContainer" class="col-12 d-flex justify-content-center flex-column align-items-center">
            </div>
        </div>
    </div>
</body>
</html>