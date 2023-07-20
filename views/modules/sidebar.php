<?php
session_start();
function create_sidebar() {
    $sidebar_html = '
        <script type="text/javascript" src="../assets/js/jquery-3.6.4.min.js"></script>
        <script type="text/javascript" src="../js/script.js"></script>
        <script type="text/javascript" src="../assets/plugins/bootstrap-4.0.0/js/bootstrap.bundle.min.js"></script>
        <link type="text/css" rel="stylesheet" href="../assets/plugins/bootstrap-4.0.0/css/bootstrap.min.css">

        <div class="sidebarContainer" style="display: flex">
            <div class="sidebar">
                <div class="top">
                    <div class="logo d-flex justify-content-center align-items-center">
                        <img src="../assets/img/applogo.png" id="logo">
                        <img src="../assets/img/text.png" id="text">
                    </div>
                </div>
                <ul>
                    <li>
                        <a id="sidebarProfile" href="userProfile.php">
                            <img src="data:image/png;base64,'. base64_encode($_SESSION['avatar']) .'" class="userSidebarAvatar">
                            <span class="navItem">Profile</span>
                        </a>
                    </li>

                    <li>
                        <a id="sidebarMap" href="map.php">
                            <img src="../assets/img/feat-worldwide.png">
                            <span class="navItem">World Map</span>
                        </a>
                    </li>

                    <li class="dropdown">
                        <a href="#">
                            <img src="../assets/img/feat-book-stack.png">
                            <span class="navItem">Library of Resources</span>
                        </a>
                        <ul class="dropdownMenu">
                            <li>
                                <a id="sidebarLibrary" href="library.php">
                                    <img src="../assets/img/feat-book-stack.png">
                                    <span class="navItem">Main Library</span>
                                </a>
                            </li>
                            <li>
                                <a id="sidebarCommunity" href="community.php">
                                    <img src="../assets/img/diversity.png">
                                    <span class="navItem">Community Creations</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a id="sidebarForum" href="discussionForum.php">
                            <img src="../assets/img/feat-chat.png">
                            <span class="navItem">Discussion Forum</span>
                        </a>
                    </li>
                    
                    <li>
                        <a id="sidebarCalendar" href="calendar.php">
                            <img src="../assets/img/feat-calendar.png">
                            <span class="navItem">Calendar</span>
                        </a>
                    </li>

                    <li>
                        <a id="sidebarNotifications" href="#">
                            <img src="../assets/img/bell.png">
                            <span class="navItem">Notifications</span>
                        </a>
                    </li>

                    <li class="dropdown">
                        <a href="#">
                            <img src="../assets/img/more.png">
                            <span class="navItem">More</span>
                        </a>
                        <ul class="dropdownMenu">
                            <li>
                                <a id="minimize" href="#">
                                    <img src="../assets/img/minimize.png" id="minmax">
                                    <span class="navItem">Minimize Sidebar</span>
                                </a>
                            </li>
                            <li>
                                <a id="sidebarReport" href="#">
                                    <img src="../assets/img/report.png">
                                    <span class="navItem">Report a User</span>
                                </a>
                            </li>
                            <li>
                                <a href="../../models/logout.model.php">
                                    <img src="../assets/img/logout.png">
                                    <span class="navItem">Logout</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>

            <div class="notificationsPanel">
                <div class="container mw-100 mh-100">
                    <div class="row notificationsPanelHeader">
                        <h1>Notifications</h1>
                    </div>
                    <div id="notification"></div>
                </div>
            </div>
        </div>
        
        <div id="toast" class="toast"></div>

        <div class="modal fade" id="reportUserModal">
            <div class="modal-dialog modal-xs modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <div class="container d-flex justify-content-center align-items-center flex-column">
                            <h5 class="modal-title w-100">Report a User</h5>
                            <input class="inputVariant" id="reportUserUsername" placeholder="Enter username"><br>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <form id="reportUserForm" method="post">
                                <div class="row">
                                    <div class="col-12">
                                        <p class="reportDescription">As accurately as you can, please tell us what happened.</p>
                                        <input type="checkbox" id="harrassmentOrBullying" name="harrassmentOrBullying" value="Harrassment or Bullying">
                                        <label for="harrassmentOrBullying">Harrassment or Bullying</label><br>
                                        <input type="checkbox" id="offensiveLanguage" name="offensiveLanguage" value="Offensive Language">
                                        <label for="offensiveLanguage">Offensive Language</label><br>
                                        <input type="checkbox" id="spam" name="spam" value="Spam">
                                        <label for="spam">Spam</label><br>
                                        <input type="checkbox" id="communityGuidelinesViolation" name="communityGuidelinesViolation" value="Community Guidelines Violation">
                                        <label for="communityGuidelinesViolation">Community Guidelines Violation</label><br>
                                        <input type="checkbox" id="suspiciousOrFakeAccount" name="suspiciousOrFakeAccount" value="Suspicious or Fake Account">
                                        <label for="suspiciousOrFakeAccount">Suspicious or Fake Account</label><br>
                                        <label for="others">Others, specify:</label><br>
                                        <input id="othersSpecify" class="inputVariant" name="othersSpecify"><br>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-center align-items-center flex-column">
                                        <textarea id="reportUserAdditional" placeholder="Give additional context."></textarea><br>
                                        <button type="button" id="submitReportContent" class="roundedButton">Send</button>
                                    </div>
                                </div>
                            </form>    
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="reportUserNotice" class="modal fade">
            <div class="modal-dialog modal-xs modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 d-flex justify-content-center align-items-center flex-column">
                                    <img id="reportUserIcon" src="../assets/img/verification-check.png" height="80px" width="80px">
                                    <h5 id="reportUserStatus" class="modal-title w-100">Report Received</h5>
                                    <p id="reportUserMessage" class="text-center">The team will review your complaint. Please expect a notification in 3-5 business days.</p>
                                    <button type="button" id="reportUserNoticeButton" class="roundedButton" data-dismiss="modal">Thanks!</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        ';

        return $sidebar_html;
    }
    ?>
