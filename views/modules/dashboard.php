<?php
session_start();
if (!isset($_SESSION['accountid']) || empty($_SESSION['accountid'])) {
    // Redirect the user to splash.php
    header("Location: splash.php");
    exit(); // Terminate the script to prevent further execution
}
?>
<!doctype html>
<html lang="en">
<head>
    <title>Religion Explorer: Discussion Forum</title>
    <link rel="icon" type="image/x-icon" href="../assets/img/applogo.png">
    <script type="text/javascript" src="../assets/js/jquery-3.6.4.min.js"></script>
    <script type="text/javascript" src="../assets/plugins/bootstrap-4.0.0/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="../assets/js/chart.umd.js"></script>

    <script type="text/javascript" src="../js/dashboard.js"></script>
    <script type="text/javascript" src="../js/script.js"></script>

    <link type="text/css" rel="stylesheet" href="../assets/plugins/bootstrap-4.0.0/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <div id="dashboardSidebar"></div>

    <div class="pageContainer">
        <div class="container mw-100 mh-100">
            <div class="row pageHeader adminHeader">
                <div class="col-8 d-flex justify-content-start align-items-center">
                    <h1>Admin Dashboard</h1>
                </div>
                <div class="col-4 d-flex justify-content-end align-items-center">
                    <select id="adminDashboardMonth" class="adminDashboardDate">
                        <option selected value="allMonths">January to December</option>
                        <option value="January">January</option>
                        <option value="February">February</option>
                        <option value="March">March</option>
                        <option value="April">April</option>
                        <option value="May">May</option>
                        <option value="June">June</option>
                        <option value="July">July</option>
                        <option value="August">August</option>
                        <option value="September">September</option>
                        <option value="October">October</option>
                        <option value="November">November</option>
                        <option value="December">December</option>
                    </select>
                    <select id="adminDashboardWeek" class="adminDashboardDate" disabled>
                        <option value="allWeeks">Week 1 - 4</option>
                        <option value="Week 1">Week 1</option>
                        <option value="Week 2">Week 2</option>
                        <option value="Week 3">Week 3</option>
                        <option value="Week 4">Week 4</option>
                    </select>
                    <select id="adminDashboardYear" class="adminDashboardDate">
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                        <option selected value="2023">2023</option>
                    </select>
                </div>
            </div>

            <div class="row adminBasicStatsContainer">
                <div class="col-3 d-flex justify-content-center align-items-center">
                    <div class="adminBasicStatsBox adminBasicStatsBoxUser">
                        <div class="adminBasicStatsBoxContent d-flex flex-column">
                            <img src="../assets/img/admin/user.png">
                            <h3>New Users</h3>
                            <h1 id="newUsers"></h1>
                        </div>
                        <div class="adminBasicStatsBoxFooter">
                        </div>
                    </div>
                </div>
                <div class="col-3 d-flex justify-content-center align-items-center">
                    <div class="adminBasicStatsBox adminBasicStatsBoxOnline">
                        <div class="adminBasicStatsBoxContent d-flex flex-column">
                            <img src="../assets/img/admin/online.png">
                            <h3>Active Users</h3>
                            <h1 id="online"></h1>
                        </div>
                        <div class="adminBasicStatsBoxFooter">
                        </div>
                    </div>
                </div>
                <div class="col-3 d-flex justify-content-center align-items-center">
                    <div class="adminBasicStatsBox adminBasicStatsBoxVisitor">
                        <div class="adminBasicStatsBoxContent d-flex flex-column">
                            <img src="../assets/img/admin/eyes.png">
                            <h3>Visitors</h3>
                            <h1 id="visitors"></h1>
                        </div>
                        <div class="adminBasicStatsBoxFooter">
                        </div>
                    </div>
                </div>
                <div class="col-3 d-flex justify-content-center align-items-center">
                    <div class="adminBasicStatsBox adminBasicStatsBoxRegister">
                        <div class="adminBasicStatsBoxContent d-flex flex-column">
                            <img src="../assets/img/admin/register.png">
                            <h3>Registered Users</h3>
                            <h1 id="registeredUsers"></h1>
                        </div>
                        <div class="adminBasicStatsBoxFooter">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row adminMainStatsContainer">
                <div class="col-12 d-flex justify-content-center align-items-center">
                    <div class="adminMainStatsBox">
                        <div id="monthlyNewUsersContainer">
                            <canvas id="monthlyNewUsers"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row adminMainStatsContainer">
                <div class="col-6 d-flex justify-content-center align-items-center">
                    <div class="adminMainStatsBox">
                        <div id="registeredUsersReligionContainer">
                            <canvas id="registeredUsersReligion"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-6 d-flex justify-content-center align-items-center">
                    <div class="adminMainStatsBox">
                        <div id="usersActivityContainer"></div>
                        <div style="border-bottom: solid #D0D0D0 2px; margin-top:10px"></div>
                        <div id="usersActivityReligionContainer"></div>
                    </div>
                </div>
            </div>

            <div class="row adminBasicStatsContainer" style="border-top:solid #D0D0D0 2px; border-bottom:none; padding-top:30px; margin-top:30px; margin-bottom:-20px">
                <div class="col-3 d-flex justify-content-center align-items-center">
                    <div class="adminBasicStatsBox adminBasicStatsBoxUser">
                        <div class="adminBasicStatsBoxContent d-flex flex-column">
                            <img src="../assets/img/admin/bookmark.png">
                            <h3>Bookmarks</h3>
                            <h1 id="bookmarks"></h1>
                        </div>
                        <div class="adminBasicStatsBoxFooter">
                        </div>
                    </div>
                </div>
                <div class="col-3 d-flex justify-content-center align-items-center">
                    <div class="adminBasicStatsBox adminBasicStatsBoxOnline">
                        <div class="adminBasicStatsBoxContent d-flex flex-column">
                            <img src="../assets/img/admin/upload.png">
                            <h3>Community Uploads</h3>
                            <h1 id="communityUploads"></h1>
                        </div>
                        <div class="adminBasicStatsBoxFooter">
                        </div>
                    </div>
                </div>
                <div class="col-3 d-flex justify-content-center align-items-center">
                    <div class="adminBasicStatsBox adminBasicStatsBoxVisitor">
                        <div class="adminBasicStatsBoxContent d-flex flex-column">
                            <img src="../assets/img/admin/post.png">
                            <h3>Forum Posts</h3>
                            <h1 id="forumPosts"></h1>
                        </div>
                        <div class="adminBasicStatsBoxFooter">
                        </div>
                    </div>
                </div>
                <div class="col-3 d-flex justify-content-center align-items-center">
                    <div class="adminBasicStatsBox adminBasicStatsBoxRegister">
                        <div class="adminBasicStatsBoxContent d-flex flex-column">
                            <img src="../assets/img/admin/event.png">
                            <h3>Celebrated Events</h3>
                            <h1 id="celebratedEvents"></h1>
                        </div>
                        <div class="adminBasicStatsBoxFooter">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row adminMainStatsContainer">
                <div class="col-12 d-flex justify-content-center align-items-center">
                    <div class="adminMainStatsBox">
                        <div id="reportedContentContainer"></div>
                    </div>
                </div>
            </div>

            <div class="row adminMainStatsContainer">
                <div class="col-12 d-flex justify-content-center align-items-center">
                    <div class="adminMainStatsBox">
                        <div id="reportedUsersContainer"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>