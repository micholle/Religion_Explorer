<!doctype html>
<html lang="en">
    <head>
        <title>Religion Explorer: Community Creations</title>
        <link rel="icon" type="image/x-icon" href="../assets/img/applogo.png">
        <script type="text/javascript" src="../assets/js/jquery-3.6.4.min.js"></script>
        <script type="text/javascript" src="../assets/plugins/bootstrap-4.0.0/js/bootstrap.bundle.min.js"></script>

        <script type="text/javascript" src="../js/communityView.js"></script>
        <script type="text/javascript" src="../js/script.js"></script>

        <link type="text/css" rel="stylesheet" href="../assets/plugins/bootstrap-4.0.0/css/bootstrap.min.css">
        <link type="text/css" rel="stylesheet" href="../assets/css/styles.css">
    </head>
    <body>
        <div id="communityViewSidebar"></div>

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

            <div class="row pageContent">
                <div class="communityViewTab">
                    <button class="communityViewTabBtn">Photos</button>
                    <button class="communityViewTabBtn">Videos</button>
                    <button class="communityViewTabBtn">Reading Materials</button>
                </div>
                <div class="communityViewContentBox col-12 d-flex justify-content-center align-items-center flex-column">
                    <!--Photos-->
                    <div class="communityViewContent">
                        <div id="" class="d-flex flex-column libraryMediaContainer libraryWideContainer">
                            <div class="row d-flex justify-content-center align-items-center">
                                <div class="col-12 libraryMediaHeader">
                                    <div class="row">
                                        <div class="col-12">
                                            <h1>[Placeholder Title]</h1>
                                            <p>[Placeholder User]</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 d-flex justify-content-center align-items-center">
                                    <img src="../assets/img/placeholder.png">
                                </div>
                            </div>

                            <div class="row d-flex justify-content-start align-items-center flex-row libraryMediaInteractions">
                                <div class="col-11 d-flex justify-content-start align-items-center mediaInteractionsLeft">
                                    <img class="libraryActions" src="../assets/img/download.png">
                                    <img class="libraryActions" src="../assets/img/alert.png">
                                    <img class="libraryActions" src="../assets/img/broken-link.png">
                                </div>
                                <div class="col-1 d-flex justify-content-end align-items-center mediaInteractionsRight">
                                    <img class="libraryActions" src="../assets/img/bookmark-white.png">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <p>Placeholder Description.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--Videos-->
                    <div class="communityViewContent">
                        <div id="" class="d-flex flex-column libraryMediaContainer libraryWideContainer">
                            <div class="row d-flex justify-content-center align-items-center">
                                <div class="col-12 libraryMediaHeader">
                                    <div class="row">
                                        <div class="col-12">
                                            <h1>[Placeholder Title]</h1>
                                            <p>[Placeholder User]</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 d-flex justify-content-center align-items-center">
                                    <img src="../assets/img/placeholder.png">
                                </div>
                            </div>

                            <div class="row d-flex justify-content-start align-items-center flex-row libraryMediaInteractions">
                                <div class="col-11 d-flex justify-content-start align-items-center mediaInteractionsLeft">
                                    <img class="libraryActions" src="../assets/img/download.png">
                                    <img class="libraryActions" src="../assets/img/alert.png">
                                    <img class="libraryActions" src="../assets/img/broken-link.png">
                                </div>
                                <div class="col-1 d-flex justify-content-end align-items-center mediaInteractionsRight">
                                    <img class="libraryActions" src="../assets/img/bookmark-white.png">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <p>Placeholder Description.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--Reading Materials-->
                    <div class="communityViewContent communityViewContentVariant">
                        <div id="" class="d-flex flex-column libraryMediaContainer libraryWideContainer">
                            <div class="row d-flex justify-content-center align-items-center">
                                <div class="col-12 libraryMediaHeader">
                                    <div class="row">
                                        <div class="col-12">
                                            <h1>[Placeholder Title]</h1>
                                            <p>[Placeholder User]</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row d-flex justify-content-start align-items-center flex-row libraryMediaInteractions">
                                <div class="col-11 d-flex justify-content-start align-items-center mediaInteractionsLeft">
                                    <img class="libraryActions" src="../assets/img/download.png">
                                    <img class="libraryActions" src="../assets/img/alert.png">
                                    <img class="libraryActions" src="../assets/img/broken-link.png">
                                </div>
                                <div class="col-1 d-flex justify-content-end align-items-center mediaInteractionsRight">
                                    <img class="libraryActions" src="../assets/img/bookmark-white.png">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis ut quidem voluptatum quo nobis, aperiam ipsa ipsum fugiat quos, commodi mollitia officia porro unde et sint quae. Tenetur, vel ratione.</p>
                                </div>
                            </div>
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
                    <div class="modal-header text-center">
                        <div class="container d-flex justify-content-center align-items-center flex-column">
                            <h5 class="modal-title w-100">Report Content</h5>
                            <div id="reportContentHeader"></div>
                        </div>
                        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
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