<!doctype html>
<html lang="en">
    <head>
        <title>Religion Explorer: Community Creations</title>
        <link rel="icon" type="image/x-icon" href="../assets/img/applogo.png">
        <script type="text/javascript" src="../assets/js/jquery-3.6.4.min.js"></script>
        <script type="text/javascript" src="../assets/plugins/bootstrap-4.0.0/js/bootstrap.bundle.min.js"></script>

        <script type="text/javascript" src="../js/community.js"></script>
        <script type="text/javascript" src="../js/script.js"></script>

        <link type="text/css" rel="stylesheet" href="../assets/plugins/bootstrap-4.0.0/css/bootstrap.min.css">
        <link type="text/css" rel="stylesheet" href="../assets/css/styles.css">
    </head>
    <body>
        <div id="communitySidebar"></div>

        <div class="pageContainer">
            <div class="container mw-100 mh-100">
                <div class="row d-flex justify-content-center align-items-center pageHeader">
                    <div class="col-4 d-flex justify-content-start align-items-center">
                        <h1>Community Creations</h1>
                    </div>
                    <div class="col-8 d-flex justify-content-start align-items-center">
                        <input type="search" id="communitySearch" name="communitySearch" placeholder="Search the Community">
                    </div>
                </div>
            <div>
                <!-- Community Creations
                <input type="search" id="communitySearch" name="communitySearch" placeholder="Search">
            </div> -->
            <div class="row pageContent">
                <div class="col-12 d-flex justify-content-center align-items-center flex-column createSubmissionsBox">
                    <!-- <div id="communityScreen"> -->
                    <img src="../assets/img/commcreations.png">
                    <h1>Start Creating Submissions</h1>
                    <p>Drafts expire after 30 days. After that, those drafts are deleted.</p>
                    <button id="communityCreate" class="roundedButton">Create New</button>
                </div>
                <div class="col-12 d-flex justify-content-center align-items-center submissionsContainer">
                    <div>
                        <h1>Photos</h1>
                        <div class="col-12 d-flex justify-content-center align-items-center flex-column submissionsBox">
                            <div id="communityPhotos"></div>
                            <button id="communityPhotosMore" class="roundedButton">See More</button>
                        </div>
                    </div>
                </div>
                <div class="col-12 d-flex justify-content-center align-items-center submissionsContainer">
                    <div>
                        <h1>Videos</h1>
                        <div class="col-12 d-flex justify-content-center align-items-center flex-column submissionsBox">
                            <div id="communityVideos"></div>
                            <button id="communityVideosMore" class="roundedButton">See More</button>
                        </div>
                    </div>
                </div>
                <div class="col-12 d-flex justify-content-center align-items-center submissionsContainer">
                    <div>
                        <h1>Reading Materials</h1>
                        <div class="col-12 d-flex justify-content-center align-items-center flex-column submissionsBox">
                            <div id="communityBlogs"></div>
                            <button id="communityVideosMore" class="roundedButton">See More</button>
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
                        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <form id="communityForm" method="post">
                                <div class="communityUploadArea d-flex justify-content-center align-items-center flex-column">
                                    <input type="file" class="communityUpload" id="communityUpload" multiple accept="image/*, video/*" onchange="handleFiles(this.files)">
                                    <label class="button text-center" for="communityUpload">
                                        <img src="../assets/img/community-upload.png" class="commUploadImg"><br>
                                        <p>Choose a file or drag it here.</p>
                                    </label>
                                </div>
                                <div class="row communityUploadDetails">
                                    <div class="col-8 d-flex justify-content-center align-items-center">
                                        <input id="communityTitle" name="communityTitle" placeholder="Title">
                                    </div>
                                    <div class="col-4 d-flex justify-content-center align-items-center">
                                        <select id="communityCategory" name="communityCategory">
                                            <option selected hidden disabled>Category</option>
                                            <optgroup label="Religion">
                                                <option value="">Buddhism</option>
                                                <option value="">Christianity</option>
                                                <option value="">Hinduism</option>
                                                <option value="">Islam</option>
                                                <option value="">Judaism</option>
                                            </optgroup>
                                            <optgroup label="Topic">
                                                <option value="saab">Religious Traditions</option>
                                                <option value="mercedes">Historical Context</option>
                                                <option value="mercedes">Theology</option>
                                                <option value="mercedes">Religious Practices</option>
                                                <option value="mercedes">Ethics</option>
                                                <option value="mercedes">Social Issues</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                <br>
                                <textarea id="communityDescription" name="communityDescription" placeholder="Description"></textarea>
                                <br>
                                <button type="button" id="communityPublish">Publish</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="communityDisplayModal">
            <div class="modal-dialog modal-xs modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                        <div class="modal-body" id="communityDisplayContent"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="reportContentModal">
            <div class="modal-dialog modal-xs modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        Report Content
                        <div id="reportContentHeader"></div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <form id="reportContentForm" method="post">
                            As accurately as you can, please tell us what happened. <br>
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
                            <label for="others">Others, Specify:</label><br>
                            <input id="othersSpecify" name="othersSpecify"><br>
                            <textarea id="reportContentAdditional" name="reportContentAdditional" placeholder="Give additional context."></textarea><br>
                            <button type="button" id="submitReportContent">Send</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

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