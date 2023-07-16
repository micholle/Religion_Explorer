<?php session_start(); ?>
<!doctype html>
<html lang="en">
    <head>
        <title>Religion Explorer: Community Creations</title>
        <link rel="icon" type="image/x-icon" href="../assets/img/applogo.png">
        <script type="text/javascript" src="../assets/js/jquery-3.6.4.min.js"></script>
        <script type="text/javascript" src="../assets/plugins/bootstrap-4.0.0/js/bootstrap.bundle.min.js"></script>

        <script type="text/javascript" src="../js/community.js"></script>
        <script type="text/javascript" src="../js/communitySubmissions.js"></script>
        <script type="text/javascript" src="../js/script.js"></script>

        <link type="text/css" rel="stylesheet" href="../assets/plugins/bootstrap-4.0.0/css/bootstrap.min.css">
        <link type="text/css" rel="stylesheet" href="../assets/css/styles.css">
    </head>
    <body>
        <div id="communitySidebar"></div>
        <div id="usernamePlaceholder" hidden><?php echo $_SESSION['username']; ?></div>

        <div class="pageContainer">
            <div class="container mw-100 mh-100">
                <div class="row d-flex justify-content-center align-items-center pageHeader">
                    <div class="col-4 d-flex justify-content-start align-items-center">
                        <a href="community.php" class="pageHeaderLink"><h1>Community Creations</h1></a>
                    </div>
                    <div class="col-8 d-flex justify-content-start align-items-center">
                        <!-- <input type="search" id="communitySearch" name="communitySearch" placeholder="Search the Community"> -->
                    </div>
                </div>
            <div>
            <div class="row pageContent">
                <div class="col-12 d-flex justify-content-center align-items-center flex-column createSubmissionsBox">
                    <img src="../assets/img/commcreations.png">
                    <h1>Start Creating Submissions</h1>
                    <button id="communityCreate" class="roundedButton">Create New</button>
                </div>
                <div class="col-12 d-flex justify-content-center align-items-center submissionsContainer">
                    <div>
                        <h1>Photos</h1>
                        <div class="col-12 d-flex justify-content-center align-items-center flex-column submissionsBox">
                            <div id="communityPhotos" class="communityPhotos"></div>
                            <button id="communityPhotosMore" class="roundedButton">See More</button>
                        </div>
                    </div>
                </div>
                <div class="col-12 d-flex justify-content-center align-items-center submissionsContainer">
                    <div>
                        <h1>Videos</h1>
                        <div class="col-12 d-flex justify-content-center align-items-center flex-column submissionsBox">
                            <div id="communityVideos" class="communityVideos"></div>
                            <button id="communityVideosMore" class="roundedButton">See More</button>
                        </div>
                    </div>
                </div>
                <div class="col-12 d-flex justify-content-center align-items-center submissionsContainer">
                    <div>
                        <h1>Reading Materials</h1>
                        <div class="col-12 d-flex justify-content-center align-items-center flex-column submissionsBox">
                            <div id="communityReadingMaterials"></div>
                            <button id="communityBlogsMore" class="roundedButton">See More</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="communityModal">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-0 text-center">
                        <h5 class="modal-title w-100">Submit a Creation</h5>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <form id="communityForm" method="post" enctype="multipart/form-data">
                                <div class="communityUploadArea d-flex justify-content-center align-items-center flex-column">
                                    <input type="file" class="communityUpload" id="communityUpload" multiple accept="image/*, video/*">
                                    <label class="button text-center" for="communityUpload">
                                        <img src="../assets/img/community-upload.png" class="commUploadImg"><br>
                                        <p>Choose a file or drag it here.</p>
                                    </label>
                                </div>
                                <div class="row communityUploadDetails">
                                    <div class="col-8 d-flex justify-content-center align-items-center">
                                        <input id="communityTitle" name="communityTitle" placeholder="Title" required>
                                    </div>
                                    <div class="col-4 d-flex justify-content-center align-items-center">
                                        <select id="communityCategory">
                                            <option selected hidden disabled>Religion</option>
                                            <option value="Buddhism">Buddhism</option>
                                            <option value="Christianity">Christianity</option>
                                            <option value="Hinduism">Hinduism</option>
                                            <option value="Islam">Islam</option>
                                            <option value="Judaism">Judaism</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row communityUploadDetails">
                                    <div class="col-12 d-flex justify-content-center align-items-center flex-column">
                                        <textarea id="communityDescription" name="communityDescription" placeholder="Description"></textarea>
                                        <button type="button" id="communityPublish" class="roundedButton">Publish</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<<<<<<< HEAD
=======

        <!-- <div class="modal fade" id="communityDisplayModal">
            <div class="modal-dialog modal-xs modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                        <div class="modal-body" id="communityDisplayContent"></div>
                    </div>
                </div>
            </div>
        </div> -->

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
>>>>>>> parent of b8e3b71 (community creations edits w/ database)

        <div class="modal fade" id="communityNoticeModal">
            <div class="modal-dialog modal-xs modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header" id="communityNoticeHeader"></div>
                    <div class="modal-body" id="communityNoticeContent"></div>
                </div>
            </div>
        </div>
    </body>
</html>