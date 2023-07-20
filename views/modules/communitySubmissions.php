<?php session_start(); ?>
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
        <div id="accountUsernamePlaceholder" hidden><?php echo $_SESSION['username']; ?></div>
        <div id="accountidPlaceholder" hidden><?php echo $_SESSION['accountid']; ?></div>

        <div class="pageContainer">
            <div class="container mw-100 mh-100">
                <div class="row d-flex justify-content-center align-items-center pageHeader">
                    <div class="col-4 d-flex justify-content-start align-items-center">
                        <a href="community.php" class="pageHeaderLink"><h1>Community Creations</h1></a>
                    </div>
                    <div class="col-8 d-flex justify-content-start align-items-center">
                        <input type="search" id="communitySearch" name="communitySearch" placeholder="Search the Community">
                    </div>
                    <div id="viewContent" hidden></div>
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
        <div id="toast" class="toast"></div>

        <!--Modals-->
        <div class="modal fade" id="confirmDeleteCreationModal">
            <div class="modal-dialog modal-xs modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 d-flex justify-content-center align-items-center flex-column">
                                    <div id="deleteContentid" hidden></div>
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
                            <div id="reportContentid" hidden></div>
                        </div>
                    </div>

                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <form id="reportContentForm" method="post" required>
                                        <p class="reportDescription">As accurately as you can, please tell us what happened.</p>
                                        <input type="checkbox" id="contentPrivacyViolation" name="contentPrivacyViolation" value="Privacy Violation">
                                        <label for="contentPrivacyViolation">Privacy Violation</label><br>
                                        <input type="checkbox" id="contentMisinformation" name="contentPrivacyViolation" value="Misinformation">
                                        <label for="contentMisinformation">Misinformation</label><br>
                                        <input type="checkbox" id="contentGraphicContent" name="contentPrivacyViolation" value="Graphic Content">
                                        <label for="contentGraphicContent">Graphic Content</label><br>
                                        <input type="checkbox" id="contentOffensiveLanguage" name="contentPrivacyViolation" value="Offensive Language">
                                        <label for="contentOffensiveLanguage">Offensive Language</label><br>
                                        <input type="checkbox" id="contentSpam" name="contentPrivacyViolation" value="Spam or Unwanted Content">
                                        <label for="contentSpam">Spam or Unwanted Content</label><br>
                                        <label for="contentOthers">Others, specify:</label><br>
                                        <input id="contentOthers" class="inputVariant"><br>
                                    </form>    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 d-flex justify-content-center align-items-center flex-column">
                                    <textarea id="reportContentAdditional" placeholder="Give additional context."></textarea><br>
                                    <button type="submit" id="submitReportContent" class="roundedButton">Send</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="reportContentNotice">
            <div id class="modal-dialog modal-xs modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 d-flex justify-content-center align-items-center flex-column">
                                    <img id="reportContentIcon" src="" height="80px" width="80px">
                                    <h5 id="reportContentStatus" class="modal-title w-100"></h5>
                                    <p  id="reportContentMessage" class="text-center"></p>
                                    <button type="button" id="reportContentNoticeButton" class="roundedButton" data-dismiss="modal">Thanks!</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>