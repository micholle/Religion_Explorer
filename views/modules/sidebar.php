<?php
function create_sidebar() {
    $sidebar_html = '
        <div class="sidebar">
            <div class="top">
                <div class="logo d-flex justify-content-center align-items-center">
                    <img src="../assets/img/applogo.png" id="logo">
                    <img src="../assets/img/text.png" id="text">
                </div>
            </div>
            <ul>
                <li>
                    <a href="userProfile.php">
                        <img src="../assets/img/lamb.png">
                        <span class="navItem">Profile</span>
                    </a>
                </li>

                <li>
                    <a href="map.php">
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
                            <a href="library.php">
                                <img src="../assets/img/feat-book-stack.png">
                                <span class="navItem">Main Library</span>
                            </a>
                        </li>
                        <li>
                            <a href="community.php">
                                <img src="../assets/img/diversity.png">
                                <span class="navItem">Community Creations</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="">
                        <img src="../assets/img/feat-chat.png">
                        <span class="navItem">Discussion Forum</span>
                    </a>
                </li>
                
                <li>
                    <a href="calendar.php">
                        <img src="../assets/img/feat-calendar.png">
                        <span class="navItem">Calendar</span>
                    </a>
                </li>

                <li>
                    <a href="#">
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
                            <a href="#" id="minimize">
                                <img src="../assets/img/minimize.png" id="minmax">
                                <span class="navItem">Minimize Sidebar</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img src="../assets/img/report.png">
                                <span class="navItem">Report a User</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
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
