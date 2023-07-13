<?php
function create_sidebar() {
    $sidebar_html = '
        <script type="text/javascript" src="../assets/js/jquery-3.6.4.min.js"></script>
        <script type="text/javascript" src="../js/script.js"></script>
        <script type="text/javascript" src="../assets/plugins/bootstrap-4.0.0/js/bootstrap.bundle.min.js"></script>
        <link type="text/css" rel="stylesheet" href="../assets/plugins/bootstrap-4.0.0/css/bootstrap.min.css">

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
                        <img src="../assets/img/editProfile/lamb.png">
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
        ';

        return $sidebar_html;
    }
    ?>
