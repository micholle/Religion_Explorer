<?php

function createReportUserModal() {
    $reportUser = '
    <script type="text/javascript" src="../assets/js/jquery-3.6.4.min.js"></script>
    <script type="text/javascript" src="../assets/plugins/bootstrap-4.0.0/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="../js/script.js"></script>
    <link type="text/css" rel="stylesheet" href="../assets/plugins/bootstrap-4.0.0/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="../assets/css/styles.css">

    <div class="modal fade" id="reportUserModal">
        <div class="modal-dialog modal-xs modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    Report a User
                    <input id="reportUserUsername" name="reportUserUsername" placeholder="Enter Username">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                <div class="modal-body">
                    <form id="reportUserForm" method="post">
                        As accurately as you can, please tell us what happened. <br>
                        <input type="checkbox" id="harrasment or bullying" name="harrasment or bullying" value="harrasment or bullying">
                        <label for="harrasment or bullying">Harrasment or Bullying</label><br>
                        <input type="checkbox" id="offensive language" name="offensive language" value="offensive language">
                        <label for="offensive language">Offensive Language</label><br>
                        <input type="checkbox" id="spam" name="spam" value="spam">
                        <label for="spam">Spam</label><br>
                        <input type="checkbox" id="community guidelines violation" name="community guidelines violation" value="community guidelines violation">
                        <label for="community guidelines violation">Community Guidelines Violation</label><br>
                        <input type="checkbox" id="suspicious or fake account" name="suspicious or fake account" value="suspicious or fake account">
                        <label for="suspicious or fake account">Suspicious or Fake Account</label><br>
                        <input type="checkbox" id="others" name="others" value="others">
                        <label for="others">Others, Specify:</label><br>
                        <input id="othersSpecify" name="othersSpecify"><br>
                        <textarea id="reportUserAdditional" name="reportUserAdditional" placeholder="Give additional context."></textarea><br>
                        <button type="button" id="submitReportUser">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>';

    return $reportUser;
}

?>