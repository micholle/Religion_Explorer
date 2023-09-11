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
        <div id="acctype" hidden><?php echo $_SESSION['acctype']; ?></div>
        <div id="accountUsernamePlaceholder" hidden><?php echo $_SESSION['username']; ?></div>
        <div id="accountidPlaceholder" hidden><?php echo $_SESSION['accountid']; ?></div>
        <div id="bookmarksPlaceholder" hidden></div>

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
                <div class="col-12 col-lg-7">
                    <div class="communitySubmissionsContentBox d-flex justify-content-center align-items-center flex-column">
                        <!--Photos-->
                        <div class="communitySubmissionsContent" id="communitySubPhotos"></div>

                        <!--Videos-->
                        <div class="communitySubmissionsContent" id="communitySubVideos"></div>

                        <!--Reading Materials-->
                        <div class="communitySubmissionsContent communitySubmissionsContentVariant" id="communitySubBlogs"></div>
                    </div>
                </div>
                <div class="col-12 col-lg-5">
                    <div class="row libraryRightContainer">
                        <div class="col-12 libraryRightContBox">
                            <p>Religion:</p>
                            <select id="communityReligionFilter">
                                <option selected value="All Religions">All Religions</option>
                                <option value="Buddhism">Buddhism</option>
                                <option value="Christianity">Christianity</option>
                                <option value="Hinduism">Hinduism</option>
                                <option value="Islam">Islam</option>
                                <option value="Judaism">Judaism</option>
                            </select>
                            <input type="checkbox" class="communityCategoryFilter" id="Religious Traditions" value="Religious Traditions">
                            <label for="Religious Traditions">Religious Traditions</label><br>
                            <input type="checkbox" class="communityCategoryFilter" id="Historical Context" value="Historical Context">
                            <label for="Historical Context">Historical Context</label><br>
                            <input type="checkbox" class="communityCategoryFilter" id="Theology" value="Theology">
                            <label for="Theology">Theology</label><br>
                            <input type="checkbox" class="communityCategoryFilter" id="Religious Practices" value="Religious Practices">
                            <label for="Religious Practices">Religious Practices</label><br>
                            <input type="checkbox" class="communityCategoryFilter" id="Ethics" value="Ethics">
                            <label for="Ethics">Ethics</label><br>
                            <input type="checkbox" class="communityCategoryFilter" id="Social Issues" value="Social Issues">
                            <label for="Social Issues">Social Issues</label>
                        </div>

                        <div class="row commCreationsRightContainer">
                            <h1>Recently Bookmarked</h1>
                            <div class="col-12 commCreationsRightContBox">
                                <div class="commCreationsBoxContent">
                                    <h3>Placeholder Title</h3>
                                    <h2>Placeholder User Contributor</h2>
                                    <img src="../assets/img/placeholder.png" style="width: 100%">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti vel molestiae a praesentium, laudantium labore repellat delectus ipsum, perspiciatis adipisci, sapiente fugit esse.</p>
                                </div>
                                <div class="commCreationsBoxContent">
                                    <h3>Placeholder Title</h3>
                                    <h2>Placeholder User Contributor</h2>
                                    <img src="../assets/img/placeholder.png" style="width: 100%">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti vel molestiae a praesentium, laudantium labore repellat delectus ipsum, perspiciatis adipisci, sapiente fugit esse.</p>
                                </div>
                                <div class="commCreationsBoxContent">
                                    <h3>Placeholder Title</h3>
                                    <h2>Placeholder User Contributor</h2>
                                    <img src="../assets/img/placeholder.png" style="width: 100%">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti vel molestiae a praesentium, laudantium labore repellat delectus ipsum, perspiciatis adipisci, sapiente fugit esse.</p>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="col-12 commCreationsRecoContainer">
                            <h3>Recently Bookmarked</h3>
                            <div class="commCreationsRecoBox">
                                <h3>Placeholder Title</h3>
                                <h2>Placeholder User Contributor</h2>
                                <img src="../assets/img/placeholder.png" style="width: 100%">
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti vel molestiae a praesentium, laudantium labore repellat delectus ipsum, perspiciatis adipisci, sapiente fugit esse.</p>
                            </div>
                        </div> -->
                    </div>
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