<?php 
require_once "../../models/explorerPoints.model.php";
?>

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

    <script type="text/javascript" src="../js/viewUserProfile.js"></script>
    <script type="text/javascript" src="../js/script.js"></script>

    <link type="text/css" rel="stylesheet" href="../assets/plugins/bootstrap-4.0.0/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="../assets/css/styles.css">
</head>

<body>
    <div id="viewUserProfileSidebar"></div>
    <div id="accountidPlaceholder" hidden><?php echo $_SESSION['accountid']; ?></div>
    <div id="accountUsernamePlaceholder" hidden><?php echo $_SESSION['username']; ?></div>

    <div class="pageContainer">
        <div class="container mw-100 mh-100">
            <div class="row d-flex justify-content-center align-items-center basicInfoContainer">
                <div class="col-3 d-flex justify-content-end align-items-end">
                    <img src="data:image/png;base64,<?php echo base64_encode($_SESSION['avatar']); ?>" class="userProfileAvatar">
                </div>

                <div class="col-4 userBasicStatsContainer">
                    <div class="row">
                        <div class="col-12 mh-100 userBasicInfo">

                            <div class="row d-flex justify-content-center align-items-center">
                                <div class="col-12 mh-100 d-flex justify-content-start flex-column">
                                    <h1><?php if(isset($_SESSION['username'])){echo $_SESSION['username'];} else {echo "not logged in";}?></h1>
                                    <p class="nicknameText">aka <?php echo $_SESSION['username']; ?></p>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="userBasicStatsOverview userBasicStats row d-flex justify-content-start align-items-center flex-column">
                        <div class="col-12 d-flex justify-content-start align-items-center flex-row">
                            <img src="../assets/img/editProfile/userBasicStats-clock.png">
                            <p>Joined <?php echo date('F d, Y', strtotime($_SESSION['accountDate'])); ?></p>
                        </div>

                        <div class="userBasicStatsOverview col-12 d-flex justify-content-start align-items-center flex-row">
                            <img src="../assets/img/editProfile/userBasicStats-star.png">
                            <p><?php echo $explorerPoints;?> Explorer Points</p>
                        </div>

                        <div class="userBasicStatsOverview col-12 d-flex justify-content-start align-items-center flex-row">
                            <img src="../assets/img/editProfile/userBasicStats-feather.png">
                            <p><?php echo $_SESSION['religion']; ?></p>
                        </div>
                    </div>
                </div>

                <div class="col-3 d-flex flex-column justify-content-start align-items-center buttonProfile">
                    <button button id="viewUserReport" class="roundedButtonVariantTwo userBasicStatsSave">Report User</button></a>
                </div>
            </div>

            <div class="userProfileTab">
                <button class="userProfileTabBtn active">Overview</button>
                <button class="userProfileTabBtn">Posts</button>
                <button class="userProfileTabBtn">Comments</button>
                <button class="userProfileTabBtn">Creations</button>
                <button class="userProfileTabBtn">Bookmarks</button>
                <button class="userProfileTabBtn">Personal Calendar</button>
                <button class="userProfileTabBtn">Statistics</button>
                <button class="userProfileTabBtn">Achievements</button>
            </div>
            <div class="userProfileContentBox">
                <div class="userProfileContent active" id="profileOverview">
                </div>

                <div class="userProfileContent" id="profileTopics">
                </div>

                <div class="userProfileContent" id="profilePosts">
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
                    <div class="bookmarkContainer">
                        <div class="bookmarkImgContainer d-flex justify-content-center align-items-center">
                            <img src="../assets/img/userProfile/photo.png" class="userProfBookmark">
                        </div>
                        <div class="bookmarkContent d-flex justify-content-start align-items-center">
                            <p>[Placeholder Title]<p>
                        </div>
                    </div>
                    <div class="bookmarkContainer">
                        <div class="bookmarkImgContainer d-flex justify-content-center align-items-center">
                            <img src="../assets/img/userProfile/video.png" class="userProfBookmark">
                        </div>
                        <div class="bookmarkContent d-flex justify-content-start align-items-center">
                            <p>[Placeholder Title]<p>
                        </div>
                    </div>
                    <div class="bookmarkContainer">
                        <div class="bookmarkImgContainer d-flex justify-content-center align-items-center">
                            <img src="../assets/img/userProfile/readmat.png" class="userProfBookmark">
                        </div>
                        <div class="bookmarkContent d-flex justify-content-start align-items-center">
                            <p>[Placeholder Title]<p>
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
                                    <div class="userProfileStatsContentBox">
                                        <div class="row no-gutters">
                                            <div class="col-3">
                                                <div class="userProfileStatsContent d-flex">
                                                    <div class="userProfileStatsContentImg" >
                                                        <img src="../assets/img/discussionForum/upvote-active.png">
                                                    </div>
                                                    <div class="userProfileStatsContentNum">
                                                        <h1>0%</h1>
                                                        <p>upvote rate</p>
                                                    </div>
                                                </div>
                                                <div class="userProfileStatsContent d-flex">
                                                    <div class="userProfileStatsContentImg">
                                                        <img src="../assets/img/discussionForum/downvote.png">
                                                    </div>
                                                    <div class="userProfileStatsContentNum">
                                                        <h1>0%</h1>
                                                        <p>downvote rate</p>
                                                    </div>
                                                </div>
                                                <div class="userProfileStatsContent d-flex">
                                                    <div class="userProfileStatsContentImg">
                                                        <img src="../assets/img/discussionForum/comments.png">
                                                    </div>
                                                    <div class="userProfileStatsContentNum">
                                                        <h1>0%</h1>
                                                        <p>comment rate</p>
                                                    </div>
                                                </div>
                                                <div class="userProfileStatsContent">
                                                    <div class="userProfileStatsContentNumVar d-flex justify-content-center align-items-center flex-column">
                                                        <h1>0%</h1>
                                                        <p>total engagement rate</p>
                                                    </div>
                                                </div>
                                                <div class="userProfileStatsBox">
                                                    <div class="userProfileStatsContentNumVar d-flex justify-content-center align-items-center flex-column">
                                                        <h1>0%</h1>
                                                        <p>Your total engagement rate [increased/decreased] by this compared to the previous [placeholder time].</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-9">
                                                <div class="userProfileStatsInnerDiv">
                                                    <img src="../assets/img/placeholder.png">
                                                </div>
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
                                    <div class="userProfileStatsOverviewBody justify-content-start">
                                        <div class="userProfileStatsContent d-flex flex-row">
                                            <div class="userProfileStatsContentImg">
                                                <img src="../assets/img/editProfile/lion.png">
                                            </div>
                                            <div class="userProfileStatsContentNum">
                                                <p>Profile Views</p>
                                                <h1>[Number]<span class="userProfileStatsPercent">[Percentage]</span></h1>
                                            </div>
                                        </div>

                                        <div class="userProfileStatsInnerDiv d-flex justify-content-center">
                                            <img src="../assets/img/placeholder.png">
                                        </div>
                                    </div>
                                    <div class="userProfileStatsOverviewBody justify-content-start">
                                        <div class="userProfileStatsContent d-flex flex-row">
                                            <div class="userProfileStatsContentImg">
                                                <img src="../assets/img/editProfile/lion.png">
                                            </div>
                                            <div class="userProfileStatsContentNum">
                                                <p>Video Views</p>
                                                <h1>[Number]<span class="userProfileStatsPercent">[Percentage]</span></h1>
                                            </div>
                                        </div>

                                        <div class="userProfileStatsInnerDiv d-flex justify-content-center">
                                            <img src="../assets/img/placeholder.png">
                                        </div>
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
    <div class="modal fade" id="reportViewUserModal">
        <div class="modal-dialog modal-xs modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <div class="container d-flex justify-content-center align-items-center flex-column">
                        <h5 class="modal-title w-100">Report a User</h5>
                        <p><?php if(isset($_SESSION['username'])){echo $_SESSION['username'];} else {echo "not logged in";}?></p>
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