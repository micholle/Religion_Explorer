<?php
session_start();
if (!isset($_SESSION['accountid']) || empty($_SESSION['accountid'])) {
    // Redirect the user to splash.php
    header("Location: splash.php");
    exit(); // Terminate the script to prevent further execution
}
function create_sidebar() {
    $sidebar_html = '
        <script type="text/javascript" src="../assets/js/jquery-3.6.4.min.js"></script>
        <script type="text/javascript" src="../js/script.js"></script>
        <script type="text/javascript" src="../assets/plugins/bootstrap-4.0.0/js/bootstrap.bundle.min.js"></script>
        <link type="text/css" rel="stylesheet" href="../assets/plugins/bootstrap-4.0.0/css/bootstrap.min.css">

        <div class="sidebar">
            <div class="top">
                <div class="logo d-flex justify-content-center align-items-center" id="minimize">
                    <img src="../assets/img/applogo.png" id="logo">
                    <img src="../assets/img/text.png" id="text">
                </div>
            </div>
            <ul>
                <li>
                    <a id="" href="dashboard.php">
                        <img src="../assets/img/editProfile/lamb.png">
                        <span class="navItem">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a id="" href="contentForReview.php">
                        <img src="../assets/img/admin/content-for-review.png">
                        <span class="navItem">Content for Review</span>
                    </a>
                </li>

                <li>
                    <a id="" href="reportedUsers.php">
                        <img src="../assets/img/admin/reported-users.png">
                        <span class="navItem">Reported Users</span>
                    </a>
                </li>

                <li>
                    <a href="../../models/logout.model.php">
                        <img src="../assets/img/logout.png">
                        <span class="navItem">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
        ';

        return $sidebar_html;
    }
    ?>
