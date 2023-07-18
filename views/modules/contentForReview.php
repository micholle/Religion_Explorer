<!doctype html>
<html lang="en">
<head>
    <title>Religion Explorer: Content for Review</title>
    <link rel="icon" type="image/x-icon" href="../assets/img/applogo.png">
    <script type="text/javascript" src="../assets/js/jquery-3.6.4.min.js"></script>
    <script type="text/javascript" src="../assets/plugins/bootstrap-4.0.0/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="../assets/plugins/select2-4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script type="text/javascript" src="../js/contentForReview.js"></script>
    <script type="text/javascript" src="../js/script.js"></script>

    <link type="text/css" rel="stylesheet" href="../assets/plugins/bootstrap-4.0.0/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="../assets/plugins/select2-4.1.0-rc.0/dist/css/select2.css">
    <link type="text/css" rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <div id="contentForReviewSidebar"></div>

    <div class="pageContainer">
        <div class="container mw-100 mh-100">
            <div class="row pageHeader adminHeader">
                <div class="col-12 d-flex justify-content-start align-items-center">
                    <h1>Content for Review</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-12 d-flex justify-content-center align-items-center">
                    <div class="adminReviewContainer">
                        <div class="row">
                            <div class="col-12 adminFilter">
                                <input type="search" id="contentSearch" name="" class="adminSearch" placeholder="Search">
                                <select id="contentFilter" class="js-example-basic-multiple" multiple="multiple" data-placeholder="  Filter">
                                    <optgroup id="timeOptgroup" label="Time">
                                        <option value="today">Today</option>
                                        <option value="week">This Week</option>
                                        <option value="month">This Month</option>
                                        <option value="year">This Year</option>
                                    </optgroup>
                                    <optgroup label="Category">
                                        <option value="Privacy Violation">Privacy Violation</option>
                                        <option value="Misinformation">Misinformation</option>
                                        <option value="Graphic Content">Graphic Content</option>
                                        <option value="Offensive Language">Offensive Language</option>
                                        <option value="Spam or Unwanted Content">Spam or Unwanted Content</option>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                        <div class="row no-gutters">
                            <div id="contentidColumn" class="col-2">
                                <div class="adminReviewContainerHeader d-flex justify-content-center align-items-center">
                                    <p>Content ID</p>
                                </div>
                            </div>
                            <div id="contentLinkColumn" class="col-2">
                                <div class="adminReviewContainerHeader d-flex justify-content-center align-items-center">
                                    <p>Content Link</p>
                                </div>
                            </div>
                            <div id="violationColumn" class="col-2">
                                <div class="adminReviewContainerHeader d-flex justify-content-center align-items-center">
                                    <p>Content Violation</p>
                                </div>
                            </div>
                            <div id="additionalContextColumn" class="col-2">
                                <div class="adminReviewContainerHeader d-flex justify-content-center align-items-center">
                                    <p>Additional Context</p>
                                </div>
                            </div>
                            <div id="reportedOnColumn" class="col-1">
                                <div class="adminReviewContainerHeader d-flex justify-content-center align-items-center">
                                    <p>Reported On</p>
                                </div>
                            </div>
                            <div id="reportedByColumn" class="col-2">
                                <div class="adminReviewContainerHeader d-flex justify-content-center align-items-center">
                                    <p>Reported By</p>
                                </div>
                            </div>
                            <div id="actionColumn" class="col-1">
                                <div class="adminReviewContainerHeader d-flex justify-content-center align-items-center">
                                    <p>Action</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="toast" class="toast"></div>

        <!--Modals-->
        <div class="modal fade adminActionModal" id="resolveReportContentModal">
            <div class="modal-dialog modal-xs modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 d-flex justify-content-center align-items-center flex-column">
                                    <h5 class="modal-title w-100">Resolve the Report?</h5>
                                    <div class="d-flex flex-row">
                                        <div id="resolveReportContentid" hidden></div>
                                        <button type="button" class="roundedButtonVariant" data-dismiss="modal">Cancel</button>
                                        <button type="button" id="confirmResolveReportContent" class="roundedButton">Confirm</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade adminActionModal" id="deleteContentModal">
            <div class="modal-dialog modal-xs modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 d-flex justify-content-center align-items-center flex-column">
                                    <h5 class="modal-title w-100">Delete the Content?</h5>
                                    <div class="d-flex flex-row">
                                        <div id="deleteReportContentid" hidden></div>
                                        <button type="button" class="roundedButtonVariant" data-dismiss="modal">Cancel</button>
                                        <button type="button" id="confirmDeleteReportContent" class="roundedButton">Confirm</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade adminActionModal" id="reportUserModal">
            <div class="modal-dialog modal-xs modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 d-flex justify-content-center align-items-center flex-column">
                                    <h5 class="modal-title w-100">Report the User?</h5>
                                    <div class="d-flex flex-row">
                                        <div id="reportUserContentid" hidden></div>
                                        <div id="reportUserContentCreator" hidden></div>
                                        <div id="reportUserViolations" hidden></div>
                                        <div id="reportUserAdditionalContext" hidden></div>
                                        <button type="button" class="roundedButtonVariant" data-dismiss="modal">Cancel</button>
                                        <button type="button" id="confirmReportUser" class="roundedButton">Confirm</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>