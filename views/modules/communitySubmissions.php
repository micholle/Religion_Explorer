<!doctype html>
<html lang="en">
    <head>
        <title>Religion Explorer: Community Creations</title>
        <link rel="icon" type="image/x-icon" href="../assets/img/applogo.png">
        <script type="text/javascript" src="../assets/js/jquery-3.6.4.min.js"></script>
        <script type="text/javascript" src="../assets/plugins/bootstrap-4.0.0/js/bootstrap.bundle.min.js"></script>

        <script type="text/javascript" src="../js/communitySubmissions.js"></script>
        <script type="text/javascript" src="../js/script.js"></script>

        <link type="text/css" rel="stylesheet" href="../assets/plugins/bootstrap-4.0.0/css/bootstrap.min.css">
        <link type="text/css" rel="stylesheet" href="../assets/css/styles.css">
    </head>
    <body>
        <div id="communitySubmissionsSidebar"></div>

        <div class="pageContainer">
            <div class="container mw-100 mh-100">
                <div class="row d-flex justify-content-center align-items-center pageHeader">
                    <div class="col-4 d-flex justify-content-start align-items-center">
                        <a href="community.php" class="pageHeaderLink"><h1>Community Creations</h1></a>
                    </div>
                    <div class="col-8 d-flex justify-content-start align-items-center">
                        <input type="search" id="communitySearch" name="communitySearch" placeholder="Search the Community">
                    </div>
                </div>
            <div>

            <div class="row pageContent">
                <div class="communitySubmissionsTab">
                    <button class="communitySubmissionsTabBtn" data-tab="communitySubPhotos">Photos</button>
                    <button class="communitySubmissionsTabBtn" data-tab="communitySubVideos">Videos</button>
                    <button class="communitySubmissionsTabBtn" data-tab="communitySubBlogs">Reading Materials</button>
                </div>
                <div class="communitySubmissionsContentBox col-12 d-flex justify-content-center align-items-center flex-column">
                    <!--Photos-->
                    <div class="communitySubmissionsContent" id="communitySubPhotos"></div>

                    <!--Videos-->
                    <div class="communitySubmissionsContent" id="communitySubVideos"></div>

                    <!--Reading Materials-->
                    <div class="communitySubmissionsContent communitySubmissionsContentVariant" id="communitySubBlogs"></div>
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
    </body>
</html>