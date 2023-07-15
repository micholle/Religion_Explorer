<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Religion Explorer: Library of Resources</title>
    <link rel="icon" type="image/x-icon" href="../assets/img/applogo.png">
    <script type="text/javascript" src="../assets/js/jquery-3.6.4.min.js"></script>
    <script type="text/javascript" src="../assets/plugins/bootstrap-4.0.0/js/bootstrap.bundle.min.js"></script>

    <script type="text/javascript" src="../js/userProfile.js"></script>
    <script type="text/javascript" src="../js/script.js"></script>

    <link type="text/css" rel="stylesheet" href="../assets/plugins/bootstrap-4.0.0/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="../assets/css/styles.css">
</head>

<body>
    <div id="userProfileSidebar"></div>
    <div id="accountidPlaceholder" hidden><?php echo $_SESSION['accountid']; ?></div>
    <div id="accountUsernamePlaceholder" hidden><?php echo $_SESSION['username']; ?></div>

    <div class="pageContainer">
        <div class="container mw-100 mh-100">
            <div class="row d-flex justify-content-center align-items-center basicInfoContainer">
                <div class="col-3 d-flex justify-content-end align-items-end">
                    <img src="../assets/img/editProfile/lamb.png" width="175px">
                </div>

                <div class="col-4 userBasicStatsContainer">
                    <div class="row">
                        <div class="col-12 mh-100 userBasicInfo">

                            <div class="row d-flex justify-content-center align-items-center">
                                <div class="col-12 mh-100 d-flex justify-content-start flex-column">
                                    <h1><?php if(isset($_SESSION['username'])){echo $_SESSION['username'];} else {echo "not logged in";}?></h1>
                                    <p class="nicknameText">aka [Placeholder]</p>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 mh-100">
                            <div class="row d-flex justify-content-start align-items-center userBasicStats">
                                <div class="col-12 d-flex justify-content-start align-items-center flex-row">
                                    <img src="../assets/img/userBasicStats-clock.png" width="20px">
                                    <p>Joined [Placeholder Date]</p>
                                </div>
                            </div>

                            <div class="row d-flex justify-content-start align-items-center userBasicStats">
                                <div class="col-12 d-flex justify-content-start align-items-center flex-row">
                                    <img src="../assets/img/userBasicStats-star.png" width="20px">
                                    <p>[Placeholder] Explorer Points</p>
                                </div>
                            </div>

                            <div class="row d-flex justify-content-start align-items-center userBasicStats">
                                <div class="col-12 d-flex justify-content-start align-items-center flex-row">
                                    <img src="../assets/img/userBasicStats-feather.png" width="20px">
                                    <p>[Placeholder Religion]</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-3 d-flex flex-column justify-content-start align-items-start buttonProfile">
                    <a href="userProfileEditProfile.php"><button class="roundedButton">Edit Profile</button></a>
                </div>
            </div>

            <div class="userProfileTab">
                <button class="userProfileTabBtn active">Overview</button>
                <button class="userProfileTabBtn">Posts</button>
                <button class="userProfileTabBtn">Comments</button>
                <button class="userProfileTabBtn">Bookmarks</button>
                <button class="userProfileTabBtn">Personal Calendar</button>
                <button class="userProfileTabBtn">Statistics</button>
                <button class="userProfileTabBtn">Achievements</button>
            </div>
            <div class="userProfileContentBox">
                <div class="userProfileContent active">
                    <div class="userPostContainer">
                        <h1>[Placeholder Display]</h1>
                    </div>
                </div>

                <div class="userProfileContent">
                    <div class="forumPostContainer">
                        <div class="d-flex justify-content-start align-items-center flex-column forumInteractions">
                            <img src="../assets/img/discussionForum/upvote.png">
                            <p class="upvotes">0</p>
                            <img src="../assets/img/discussionForum/downvote.png">
                            <img src="../assets/img/discussionForum/comments.png" class="commentIcon">
                            <p>0</p>
                        </div>
                        <div class="forumContent">
                            <h1>[Placeholder Title]</h1>
                            <div class="row">
                                <div class="col-12 d-flex flex-row">
                                    <h2>[Placeholder User]</h2><h2>•</h2><h2>[Placeholder Date]</h2>
                                </div>
                            </div>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime, culpa sed cumque facilis doloremque aliquam sint labore natus amet earum totam aperiam quae! Nisi, officiis nihil veritatis cumque aspernatur error. Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime, culpa sed cumque facilis doloremque aliquam sint labore natus amet earum totam aperiam quae! Nisi, officiis nihil veritatis cumque aspernatur error. Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime, culpa sed cumque facilis doloremque aliquam sint labore natus amet earum totam aperiam quae!</p>
                        </div>
                    </div>
                </div>

                <div class="userProfileContent">
                    <div class="forumPostContainer">
                        <div class="d-flex justify-content-start align-items-center flex-column forumInteractions">
                            <img src="../assets/img/discussionForum/upvote.png">
                            <p class="upvotes">0</p>
                            <img src="../assets/img/discussionForum/downvote.png">
                            <img src="../assets/img/discussionForum/comments.png" class="commentIcon">
                            <p>0</p>
                        </div>
                        <div class="forumContentContainer">
                            <div class="forumContent">
                                <h1>[Placeholder Title]</h1>
                                <div class="row">
                                    <div class="col-12 d-flex flex-row">
                                        <h2>[Placeholder User]</h2><h2>•</h2><h2>[Placeholder Date]</h2>
                                    </div>
                                </div>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime, culpa sed cumque facilis doloremque aliquam sint labore natus amet earum totam aperiam quae! Nisi, officiis nihil veritatis cumque aspernatur error. Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime, culpa sed cumque facilis doloremque aliquam sint labore natus amet earum totam aperiam quae! Nisi, officiis nihil veritatis cumque aspernatur error. Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime, culpa sed cumque facilis doloremque aliquam sint labore natus amet earum totam aperiam quae!</p>
                            </div>
                            <div class="forumPostContainer">
                                <div class="d-flex justify-content-start align-items-center flex-column forumInteractions">
                                    <img src="../assets/img/discussionForum/upvote.png">
                                    <p class="upvotes">0</p>
                                    <img src="../assets/img/discussionForum/downvote.png">
                                </div>
                                <div class="forumContent">
                                    <h1>[Placeholder Title]</h1>
                                    <div class="row">
                                        <div class="col-12 d-flex flex-row">
                                            <h2>[Placeholder User]</h2><h2>•</h2><h2>[Placeholder Date]</h2>
                                        </div>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime, culpa sed cumque facilis doloremque aliquam sint labore natus amet earum totam aperiam quae! Nisi, officiis nihil veritatis cumque aspernatur error. Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime, culpa sed cumque facilis doloremque aliquam sint labore natus amet earum totam aperiam quae! Nisi, officiis nihil veritatis cumque aspernatur error. Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime, culpa sed cumque facilis doloremque aliquam sint labore natus amet earum totam aperiam quae!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="userProfileContent">
                    <div id="userProfileBookmarksList"></div>
                </div>

                <div id="calendarDatePlaceHolder" hidden></div>
                <div class="userProfileContent" id="userProfileCalendar"></div>

                <div class="userProfileContent">
                    <div class="container mw-100 mh-100">
                        <div class="row userProfileStatsContainer no-gutters">
                            <div class="col-8">
                                <div class="userProfileStatsMain">
                                    <div class="userProfileStatsHeader">
                                        <div class="row justify-content-center align-items-start">
                                            <div class="col-6 d-flex justify-content-start">
                                                <h1>[Date Range]</h1>
                                            </div>
                                            <div class="col-6 d-flex justify-content-end no-gutters">
                                                <select id="" class="">
                                                    <option value="week">Last 7 Days</option>
                                                    <option value="month">Last Month</option>
                                                    <option value="year">Last Year</option>
                                                    <option value="year">All Time</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="userProfileStatsMain">
                                <div class="userProfileStatsHeader">
                                        <h1>Overview</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="userProfileContent">
                    <div class="achievementsContainer d-flex justify-content-center align-items-center flex-row">
                        <div class="achievementsBox d-flex justify-content-center align-items-center flex-column">
                            <img src="../assets/img/placeholder-medal.png">
                            <h1>[Achievement Title]</h2>
                            <p>[Achievement Description]</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="toast" class="toast"></div>

    <!-- Modal -->
    <div class="modal fade" id="calendarEventModal">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title w-100" id="calendarEvent"></h5>
                </div>
                <div class="modal-body" id="calendarEventContent"></div>
            </div>
        </div>
    </div>
</body>

</html>