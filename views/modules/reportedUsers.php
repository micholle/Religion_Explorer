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
    <title>Religion Explorer: Reported Users</title>
    <link rel="icon" type="image/x-icon" href="../assets/img/applogo.png">
    <script type="text/javascript" src="../assets/js/jquery-3.6.4.min.js"></script>
    <script type="text/javascript" src="../assets/plugins/bootstrap-4.0.0/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="../assets/plugins/select2-4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script type="text/javascript" src="../js/reportedUsers.js"></script>
    <script type="text/javascript" src="../js/script.js"></script>

    <link type="text/css" rel="stylesheet" href="../assets/plugins/bootstrap-4.0.0/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="../assets/plugins/select2-4.1.0-rc.0/dist/css/select2.css">
    <link type="text/css" rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <div id="reportedUsersSidebar"></div>

    <div class="pageContainer">
        <div class="container mw-100 mh-100">
            <div class="row pageHeader adminHeader">
                <div class="col-12 d-flex justify-content-start align-items-center">
                    <h1>Reported Users</h1>
                </div>
            </div>

            <div class="row adminContainer">
                <div class="col-12 d-flex justify-content-center align-items-center">
                    <div class="adminReviewContainer">
                        <div class="row">
                            <div class="col-12 adminFilter">
                                <input type="search" id="userSearch" name="" class="adminSearch" placeholder="Search">
                                <select id="reportedUsersFilter">
                                    <option value="" selected>All Violations</option>
                                    <option value="Harrassment or Bullying">Harrassment or Bullying</option>
                                    <option value="Offensive Language">Offensive Language</option>
                                    <option value="Spam">Spam</option>
                                    <option value="Community Guidelines Violation">Community Guidelines Violation</option>
                                    <option value="Suspicious or Fake Account">Suspicious or Fake Account</option>
                                    <option value="Content Violations">Content Violations</option>
                                </select>
                            </div>
                        </div>
                        <div class="row no-gutters">
                            <div id="useridColumn" class="col-2">
                                <div class="adminReviewContainerHeader d-flex justify-content-center align-items-center">
                                    <p>User ID</p>
                                </div>  
                            </div>
                            <div id="userViolationColumn" class="col-2">
                                <div class="adminReviewContainerHeader d-flex justify-content-center align-items-center">
                                    <p>Violation</p>
                                </div>
                            </div>
                            <div id="userAdditionalContextColumn" class="col-2">
                                <div class="adminReviewContainerHeader d-flex justify-content-center align-items-center">
                                    <p>Additional Context</p>
                                </div>
                            </div>
                            <div id="userReportedOnColumn" class="col-2">
                                <div class="adminReviewContainerHeader d-flex justify-content-center align-items-center">
                                    <p>Reported On</p>
                                </div>
                            </div>
                            <div id="userReportedByColumn" class="col-2">
                                <div class="adminReviewContainerHeader d-flex justify-content-center align-items-center">
                                    <p>Reported By</p>
                                </div>
                            </div>
                            <div id="userActionColumn" class="col-2">
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
        <div class="modal fade adminActionModal" id="resolveReportUserModal">
            <div id="resolveReportUserid" hidden></div>
            <div class="modal-dialog modal-xs modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 d-flex justify-content-center align-items-center flex-column">
                                    <h5 class="modal-title w-100">Resolve the Report?</h5>
                                    <div class="d-flex flex-row">
                                        <button type="button" class="roundedButtonVariant" data-dismiss="modal">Cancel</button>
                                        <button type="button" id="confirmResolveUserReport" class="roundedButton">Confirm</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade adminActionModal" id="suspendUserModal">
            <div id="suspendUserUserid" hidden></div>
            <div class="modal-dialog modal-xs modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 d-flex justify-content-center align-items-center flex-column">
                                    <h5 class="modal-title w-100">Suspend User for:</h5>
                                    <div class="d-flex justify-content-center align-items-center flex-column">
                                        <input type="number" min="1" id="suspendUserVal" placeholder="Number of">
                                        <select id="suspendUserTime">
                                            <option value="Hours" selected>Hours</option>
                                            <option value="Days">Days</option>
                                            <option value="Weeks">Weeks</option>
                                            <option value="Months">Months</option>
                                            <option value="Years">Years</option>
                                        </select>
                                    </div>
                                    <div class="d-flex flex-row">
                                        <button type="button" id="" name="" class="roundedButtonVariant" data-dismiss="modal">Cancel</button>
                                        <button type="button" id="confirmSuspendUser" class="roundedButton">Confirm</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade adminActionModal" id="banUserModal">
            <div id="banUserUserid" hidden></div>
            <div class="modal-dialog modal-xs modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 d-flex justify-content-center align-items-center flex-column">
                                    <h5 class="modal-title w-100">Ban the User?</h5>
                                    <div class="d-flex flex-row">
                                        <button type="button" id="" name="" class="roundedButtonVariant" data-dismiss="modal">Cancel</button>
                                        <button type="button" id="confirmBanUser" class="roundedButton">Confirm</button>
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