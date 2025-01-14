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
        <script type="text/javascript" src="../assets/plugins/googleapis/apis.google.com_js_api.js"></script>

        <script type="text/javascript" src="../js/script.js"></script>
        <script type="text/javascript" src="../js/community.js"></script>
        <script type="text/javascript" src="../js/communitySubmissions.js"></script>

        <link type="text/css" rel="stylesheet" href="../assets/plugins/bootstrap-4.0.0/css/bootstrap.min.css">
        <link type="text/css" rel="stylesheet" href="../assets/css/styles.css">
    </head>
    <body>
        <div id="communitySidebar"></div>
        <div id="accountidPlaceholder" hidden><?php echo $_SESSION['accountid']; ?></div>
        <div id="accountUsernamePlaceholder" hidden><?php echo $_SESSION['username']; ?></div>

        <div class="pageContainer">
            <div class="container mw-100 mh-100">
                <div class="row d-flex justify-content-center align-items-center pageHeader">
                    <div class="col-12 col-lg-4 d-flex justify-content-center justify-content-lg-start align-items-center pl-0 pr-0">
                        <a href="community.php" class="pageHeaderLink"><h1>Community Creations</h1></a>
                    </div>
                    <div class="col-12 col-lg-8 d-flex pr-0 pl-0">
                    </div>
                </div>

                <div class="row pageContent">
                    <div class="col-12 d-flex justify-content-center align-items-center flex-column createSubmissionsBox">
                        <img src="../assets/img/commcreations.png">
                        <h1>Start Creating Submissions</h1>
                        <button id="communityCreate" class="roundedButton">Create New</button>
                    </div>

                    <div class="col-12 d-flex justify-content-center align-items-center submissionsContainer"> 
                        <div class="submissionsWidth">
                            <h1>Photos</h1>
                            <div class="col-12 d-flex justify-content-center align-items-center flex-column submissionsBox">
                                <div id="communityPhotos" class="communityPhotos"></div>
                                <button id="communityPhotosMore" class="roundedButton">See More</button>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 d-flex justify-content-center align-items-center submissionsContainer">
                        <div class="submissionsWidth">
                            <h1>Videos</h1>
                            <div class="col-12 d-flex justify-content-center align-items-center flex-column submissionsBox">
                                <div id="communityVideos" class="communityVideos"></div>
                                <button id="communityVideosMore" class="roundedButton">See More</button>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 d-flex justify-content-center align-items-center submissionsContainer">
                        <div class="submissionsWidth">
                            <h1>Reading Materials</h1>
                            <div class="col-12 d-flex justify-content-center align-items-center flex-column submissionsBox">
                                <div id="communityReadingMaterials"></div>
                                <button id="communityBlogsMore" class="roundedButton">See More</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="toast" class="toast"></div>

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
                                <div id="communityUploadArea" class="communityUploadArea d-flex justify-content-center align-items-center flex-column">
                                    <input type="file" class="communityUpload" id="communityUpload" name="communityUpload" onchange="handleFiles()" accept="image/*, video/*" hidden>
                                    <label class="button text-center" for="communityUpload">
                                        <img src="../assets/img/community-upload.png" class="commUploadImg"><br>
                                        <p>Choose a file or drag it here.</p>
                                    </label>
                                    <div id="uploadedFilename">&nbsp;</div>
                                </div>
                                <div class="row communityUploadDetails">
                                    <div class="col-12 col-lg-8 d-flex justify-content-center align-items-center">
                                        <input id="communityTitle" name="communityTitle" placeholder="Title" required>
                                    </div>
                                    <div class="col-12 col-lg-4 d-flex justify-content-center align-items-center communityUploadSelect">
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
                                        <div class="communityAddFilters">
                                            <div id="Religious_Traditions" class="communityFilterCategory">Religious Traditions</div>
                                            <div id="Historical_Context" class="communityFilterCategory">Historical Context</div>
                                            <div id="Theology" class="communityFilterCategory">Theology</div>
                                            <div id="Religious_Practices" class="communityFilterCategory">Religious Practices</div>
                                            <div id="Ethics" class="communityFilterCategory">Ethics</div>
                                            <div id="Social_Issues" class="communityFilterCategory">Social Issues</div>
                                        </div>
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

        <div id="communityNoticeModal" class="modal fade">
            <div class="modal-dialog modal-xs modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 d-flex justify-content-center align-items-center flex-column">
                                    <img id="communityNoticeIcon" src="../assets/img/verification-check.png" height="80px" width="80px">
                                    <h5 id="communityNoticeHeader" class="modal-title w-100"></h5>
                                    <p id="communityNoticeContent" class="text-center"></p>
                                    <button type="button" id="communityNoticeButton" class="roundedButton" data-dismiss="modal" style="display: none">Thanks!</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

<script>
        function handleFiles() {
        const fileName = $("#communityUpload")[0].files[0].name;
        $("#uploadedFilename").text(fileName);
    }
</script>