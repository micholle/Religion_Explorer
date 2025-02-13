<?php 
require_once "../../models/viewUserProfile.model.php";
session_start();
if (!isset($_SESSION['accountid']) || empty($_SESSION['accountid'])) {
    // Redirect the user to splash.php
    header("Location: splash.php");
    exit(); // Terminate the script to prevent further execution
}
$accountid = $_GET['accountid'];
$userData = getUserProfileInfo($accountid);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Religion Explorer: View User Profile</title>
    <link rel="icon" type="image/x-icon" href="../assets/img/applogo.png">
    <script type="text/javascript" src="../assets/js/jquery-3.6.4.min.js"></script>
    <script type="text/javascript" src="../assets/plugins/bootstrap-4.0.0/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="../assets/js/chart.umd.js"></script>

    <script type="text/javascript" src="../js/viewUserProfile.js"></script>
    <script type="text/javascript" src="../js/script.js"></script>

    <link type="text/css" rel="stylesheet" href="../assets/plugins/bootstrap-4.0.0/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="../assets/css/styles.css">
</head>

<body>
    <div id="viewUserProfileSidebar"></div>
    <div id="accountidView" hidden><?php echo $accountid; ?></div>
    <div id="accountidPlaceholder" hidden><?php echo $_SESSION['accountid']; ?></div>
    <div id="accountUsernamePlaceholder" hidden><?php echo $_SESSION['username']; ?></div>
    <div id="accountUsernamePlaceholderView" hidden><?php echo $userData['username']; ?></div>

    <div class="pageContainer">
        <div class="container mw-100 mh-100">
            <div class="row d-flex justify-content-center align-items-center basicInfoContainer">
                <div class="col-12 col-lg-3 d-flex justify-content-center align-items-center justify-content-lg-end align-items-lg-end">
                    <img src="data:image/png;base64,<?php echo base64_encode($userData['avatar']); ?>" class="userProfileAvatar">
                </div>

                <div class="col-12 col-lg-4 userBasicStatsContainer">
                    <div class="row">
                        <div class="col-12 mh-100 userBasicInfo">

                            <div class="row d-flex justify-content-center align-items-center">
                                <div class="col-12 mh-100 d-flex justify-content-center align-items-center justify-content-lg-start align-items-lg-start flex-column">
                                    <h1><?php echo $userData['username']; ?></h1>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="userBasicStatsOverview userBasicStats row d-flex justify-content-start align-items-center justify-content-lg-start flex-column">
                        <div class="col-12 d-flex justify-content-center align-items-center justify-content-lg-start flex-row">
                            <img src="../assets/img/editProfile/userBasicStats-clock.png">
                            <p>Joined <?php echo date('F d, Y', strtotime($userData['accountDate'])); ?></p>
                        </div>

                        <div class="userBasicStatsOverview col-12 d-flex justify-content-center align-items-center justify-content-lg-start flex-row">
                            <img src="../assets/img/editProfile/userBasicStats-star.png">
                            <p><?php echo $userData['explorerPoints'];?> Explorer Points</p>
                        </div>

                        <div class="userBasicStatsOverview col-12 d-flex justify-content-center align-items-center justify-content-lg-start flex-row">
                            <?php if ($userData['displayReligion'] === '1') { ?>
                            <img src="../assets/img/editProfile/userBasicStats-feather.png">
                            <p><?php echo $userData['religion']; ?></p>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-3 d-flex flex-column justify-content-start align-items-center justify-content-lg-start buttonProfile">
                    <?php if ($userData['username'] !== $_SESSION['username']){ echo '<button button id="viewUserReport" class="roundedButtonVariantTwo userBasicStatsSave">Report User</button></a>';} ?>
                </div>
            </div>

            <div class="userProfileTab">
                <button class="userProfileTabBtn active">Overview</button>
                <button class="userProfileTabBtn">Posts</button>
                <button class="userProfileTabBtn">Comments</button>
                <button class="userProfileTabBtn">Creations</button>
                <?php if ($userData['displayBookmark'] === '1') { ?>
                    <button class="userProfileTabBtn">Bookmarks</button>
                <?php } ?>
                <?php if ($userData['displayCalendar'] === '1') { ?>
                    <button class="userProfileTabBtn">Personal Calendar</button>
                <?php } ?>
                <!-- <button class="userProfileTabBtn">Statistics</button> -->
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
                    <p id="creationsDescription"></p>
                    <div id="userProfileCreationsList"></div>
                </div>

                <?php if ($userData['displayBookmark'] === '1') { ?>
                <div class="userProfileContent">
                    <div id="userProfileBookmarksList"></div>
                </div>
                <?php } ?>

                <?php if ($userData['displayCalendar'] === '1') { ?>
                <div id="calendarDatePlaceHolder" hidden></div>
                <div class="userProfileContent" id="userProfileCalendar"></div>
                <?php } ?>

                <!-- <div class="userProfileContent">
                    <div class="container mw-100 mh-100">
                        <div class="row userProfileStatsContainer">
                            <div class="col-12 col-lg-8">
                                <div class="userProfileStatsMain">
                                    <div class="userProfileStatsHeader">
                                        <div class="row justify-content-center align-items-start">
                                            <div class="col-12 col-lg-6 d-flex justify-content-center justify-content-lg-start">
                                                <h1 id="dateRangeLabel"></h1>
                                            </div>
                                            <div class="col-12 col-lg-6 d-flex justify-content-center justify-content-lg-end no-gutters">
                                                <select id="engagementDate" class="">
                                                    <option value="week">Last 7 Days</option>
                                                    <option value="month">Last Month</option>
                                                    <option value="year">Last Year</option>
                                                    <option value="all">All Time</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="userProfileStatsContentBox">
                                        <div class="row no-gutters">
                                            <div class="col-12 col-lg-3">
                                                <div class="userProfileStatsContent d-flex">
                                                    <div class="userProfileStatsContentImg" >
                                                        <img src="../assets/img/discussionForum/upvote-active.png">
                                                    </div>
                                                    <div class="userProfileStatsContentNum">
                                                        <h1 id="countUpvotes"></h1>
                                                        <p>upvotes</p>
                                                    </div>
                                                </div>
                                                <div class="userProfileStatsContent d-flex">
                                                    <div class="userProfileStatsContentImg">
                                                        <img src="../assets/img/discussionForum/downvote.png">
                                                    </div>
                                                    <div class="userProfileStatsContentNum">
                                                        <h1 id="countDownvotes"></h1>
                                                        <p>downvotes</p>
                                                    </div>
                                                </div>
                                                <div class="userProfileStatsContent d-flex">
                                                    <div class="userProfileStatsContentImg">
                                                        <img src="../assets/img/discussionForum/comments.png">
                                                    </div>
                                                    <div class="userProfileStatsContentNum">
                                                        <h1 id="countComments"></h1>
                                                        <p>comments</p>
                                                    </div>
                                                </div>
                                                <div class="userProfileStatsContent">
                                                    <div class="userProfileStatsContentNumVar d-flex justify-content-center align-items-center flex-column">
                                                        <h1 id="totalEngagements"></h1>
                                                        <p>total engagements</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-9">
                                                <div class="userProfileStatsInnerDiv">
                                                    <div id="engagementInsightsContainer"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="userProfileStatsMain">
                                    <div class="userProfileStatsHeader d-flex justify-content-center align-items-center">
                                        <h1>Community Creations</h1>
                                    </div>
                                    <div class="userProfileStatsOverviewBody justify-content-start">
                                        <div class="userProfileStatsContent d-flex flex-row">
                                            <div class="userProfileStatsContentNum">
                                                <p>Total Uploads</p>
                                                <h1 id='totalUploads'></h1>
                                            </div>
                                        </div>

                                        <div class="userProfileStatsInnerDiv">
                                            <div id="totalCommunityUploadsContainer"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                <div class="userProfileContent">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-lg-1"></div>

                            <div class="col-12 col-lg-2">
                                <div class="achievementsBox d-flex justify-content-center align-items-center flex-column" <?Php echo $userData['postBadge10']; ?>>
                                    <img src="../assets/img/userProfile/achievements/forum-10.png">
                                    <h1>10 posts badge</h2>
                                    <p></p>
                                </div>
                            </div>

                            <div class="col-12 col-lg-2">
                                <div class="achievementsBox d-flex justify-content-center align-items-center flex-column" <?Php echo $userData['postBadge50']; ?>>
                                    <img src="../assets/img/userProfile/achievements/forum-50.png">
                                    <h1>50 posts badge</h2>
                                    <p></p>
                                </div>
                            </div>

                            <div class="col-12 col-lg-2">
                                <div class="achievementsBox d-flex justify-content-center align-items-center flex-column" <?Php echo $userData['postBadge100']; ?>>
                                    <img src="../assets/img/userProfile/achievements/forum-100.png">
                                    <h1>100 posts badge</h2>
                                    <p></p>
                                </div>
                            </div>

                            <div class="col-12 col-lg-2">
                                <div class="achievementsBox d-flex justify-content-center align-items-center flex-column" <?Php echo $userData['postBadge250']; ?>>
                                    <img src="../assets/img/userProfile/achievements/forum-250.png">
                                    <h1>250 posts badge</h2>
                                    <p></p>
                                </div>
                            </div>

                            <div class="col-12 col-lg-2">
                                <div class="achievementsBox d-flex justify-content-center align-items-center flex-column" <?Php echo $userData['postBadge500']; ?>>
                                    <img src="../assets/img/userProfile/achievements/forum-500.png">
                                    <h1>500 posts badge</h2>
                                    <p></p>
                                </div>
                            </div>
                            
                            <div class="col-12 col-lg-1"></div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-lg-1"></div>

                            <div class="col-12 col-lg-2">
                                <div class="achievementsBox d-flex justify-content-center align-items-center flex-column" <?Php echo $userData['explorerBadge250']; ?>>
                                    <img src="../assets/img/userProfile/achievements/explorer-tier1.png">
                                    <h1>Tier 1 Explorer Badge</h2>
                                    <p>250 explorer points</p>
                                </div>
                            </div>

                            <div class="col-12 col-lg-2">
                                <div class="achievementsBox d-flex justify-content-center align-items-center flex-column" <?Php echo $userData['explorerBadge500']; ?>>
                                    <img src="../assets/img/userProfile/achievements/explorer-tier2.png">
                                    <h1>Tier 2 Explorer Badge</h2>
                                    <p>500 explorer points</p>
                                </div>
                            </div>

                            <div class="col-12 col-lg-2">
                                <div class="achievementsBox d-flex justify-content-center align-items-center flex-column" <?Php echo $userData['explorerBadge1000']; ?>>
                                    <img src="../assets/img/userProfile/achievements/explorer-tier3.png">
                                    <h1>Tier 3 Explorer Badge</h2>
                                    <p>1000 explorer points</p>
                                </div>
                            </div>

                            <div class="col-12 col-lg-2">
                                <div class="achievementsBox d-flex justify-content-center align-items-center flex-column" <?Php echo $userData['explorerBadge2500']; ?>>
                                    <img src="../assets/img/userProfile/achievements/explorer-tier4.png">
                                    <h1>Tier 4 Explorer Badge</h2>
                                    <p>2500 explorer points</p>
                                </div>
                            </div>

                            <div class="col-12 col-lg-2">
                                <div class="achievementsBox d-flex justify-content-center align-items-center flex-column" <?Php echo $userData['explorerBadge5000']; ?>>
                                    <img src="../assets/img/userProfile/achievements/explorer-tier5.png">
                                    <h1>Tier 5 Explorer Badge</h2>
                                    <p>5000 explorer points</p>
                                </div>
                            </div>

                            <div class="col-12 col-lg-1"></div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-lg-1"></div>

                            <div class="col-12 col-lg-2">
                                <div class="achievementsBox d-flex justify-content-center align-items-center flex-column" <?Php echo $userData['bookmarkBadge10']; ?>>
                                    <img src="../assets/img/userProfile/achievements/scholar-tier1.png">
                                    <h1>Tier 1 Scholar Badge</h2>
                                    <p>Marked 10 materials</p>
                                </div>
                            </div>

                            <div class="col-12 col-lg-2">
                                <div class="achievementsBox d-flex justify-content-center align-items-center flex-column" <?Php echo $userData['bookmarkBadge50']; ?>>
                                    <img src="../assets/img/userProfile/achievements/scholar-tier2.png">
                                    <h1>Tier 2 Scholar Badge</h2>
                                    <p>Marked 50 materials</p>
                                </div>
                            </div>

                            <div class="col-12 col-lg-2">
                                <div class="achievementsBox d-flex justify-content-center align-items-center flex-column" <?Php echo $userData['bookmarkBadge100']; ?>>
                                    <img src="../assets/img/userProfile/achievements/scholar-tier3.png">
                                    <h1>Tier 3 Scholar Badge</h2>
                                    <p>Marked 100 materials</p>
                                </div>
                            </div>

                            <div class="col-12 col-lg-2">
                                <div class="achievementsBox d-flex justify-content-center align-items-center flex-column" <?Php echo $userData['bookmarkBadge250']; ?>>
                                    <img src="../assets/img/userProfile/achievements/scholar-tier4.png">
                                    <h1>Tier 4 Scholar Badge</h2>
                                    <p>Marked 250 materials</p>
                                </div>
                            </div>

                            <div class="col-12 col-lg-2">
                                <div class="achievementsBox d-flex justify-content-center align-items-center flex-column" <?Php echo $userData['bookmarkBadge500']; ?>>
                                    <img src="../assets/img/userProfile/achievements/scholar-tier5.png">
                                    <h1>Tier 5 Scholar Badge</h2>
                                    <p>Marked 500 materials</p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-lg-1"></div>

                            <div class="col-12 col-lg-2">
                                <div class="achievementsBox d-flex justify-content-center align-items-center flex-column" <?Php echo $userData['creationBadge5']; ?>>
                                    <img src="../assets/img/userProfile/achievements/creator-tier1.png">
                                    <h1>Tier 1 Creator Badge</h2>
                                    <p>contributed 5 creations</p>
                                </div>
                            </div>

                            <div class="col-12 col-lg-2">
                                <div class="achievementsBox d-flex justify-content-center align-items-center flex-column" <?Php echo $userData['creationBadge25']; ?>>
                                    <img src="../assets/img/userProfile/achievements/creator-tier2.png">
                                    <h1>Tier 2 Creator Badge</h2>
                                    <p>contributed 25 creations</p>
                                </div>
                            </div>

                            <div class="col-12 col-lg-2">
                                <div class="achievementsBox d-flex justify-content-center align-items-center flex-column" <?Php echo $userData['creationBadge50']; ?>>
                                    <img src="../assets/img/userProfile/achievements/creator-tier3.png">
                                    <h1>Tier 3 Creator Badge</h2>
                                    <p>contributed 50 creations</p>
                                </div>
                            </div>

                            <div class="col-12 col-lg-2">
                                <div class="achievementsBox d-flex justify-content-center align-items-center flex-column" <?Php echo $userData['creationBadge75']; ?>>
                                    <img src="../assets/img/userProfile/achievements/creator-tier4.png">
                                    <h1>Tier 4 Creator Badge</h2>
                                    <p>contributed 75 creations</p>
                                </div>
                            </div>

                            <div class="col-12 col-lg-2">
                                <div class="achievementsBox d-flex justify-content-center align-items-center flex-column" <?Php echo $userData['creationBadge100']; ?>>
                                    <img src="../assets/img/userProfile/achievements/creator-tier5.png">
                                    <h1>Tier 5 Creator Badge</h2>
                                    <p>contributed 100 creations</p>
                                </div>
                            </div>
                            
                            <div class="col-12 col-lg-1"></div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-lg-1"></div>

                            <div class="col-12 col-lg-10">
                                <div class="achievementsBox d-flex justify-content-center align-items-center flex-column" <?Php echo $userData['accountDateBadge']; ?>>
                                <img src="../assets/img/userProfile/achievements/1-year-anniv.png">
                                <h1 style="text-align: center;">1-year anniversary badge</h2>
                                <p></p>
                            </div>

                            <div class="col-12 col-lg-1"></div>
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
                        <div id="reportUserUsername" hidden><?php echo $userData['username']; ?></div>
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
                                    <label for="userOthers">Others, specify:</label><br>
                                    <input id="userOthers" class="inputVariant" name="userOthers"><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 d-flex justify-content-center align-items-center flex-column">
                                    <textarea id="reportUserAdditional" placeholder="Give additional context."></textarea><br>
                                    <button type="button" id="submitReportUser" class="roundedButton">Send</button>
                                </div>
                            </div>
                        </form>    
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="reportContentNotice">
        <div id class="modal-dialog modal-xs modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 d-flex justify-content-center align-items-center flex-column">
                                <img id="reportUserIcon" src="" height="80px" width="80px">
                                <h5 id="reportUserStatus" class="modal-title w-100"></h5>
                                <p  id="reportUserMessage" class="text-center"></p>
                                <button type="button" id="reportUserNoticeButton" class="roundedButton" data-dismiss="modal">Thanks!</button></a>
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