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
                <div class="userProfileContent">
                    <div class="userPostContainer">
                        <h1>Holy Week in the Philippines</h1><h2>by ReligionExplorer_User123 • May 12, 2023 • 8:43 P.M.</h2>
                        <p>Good day, everyone! Are there any Filipinos here who can share about why that week in particular is so significant in the country? I’m a non-practising Christian who is interested in learning more about religion again. Thanks in advance to those who will reply!<p>
                    </div>
                </div>

                <div class="userProfileContent">
                    <h2>Posts</h2>
                    <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum eleifend ligula nisl, ac aliquam felis faucibus id. Aenean vel lacinia massa.    
                    </p>
                </div>

                <div class="userProfileContent">
                    <h2>Comments</h2>
                    <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum eleifend ligula nisl, ac aliquam felis faucibus id. Aenean vel lacinia massa.    
                    </p>
                </div>

                <div class="userProfileContent">
                    <div class="userContentContainer">
                        <img src="../assets/img/bookmark.png" class="userProfBookmark">
                        <p>ReligionExplorer_User123 has added ‘Mere Christianity’ to their bookmarks.<p>
                    </div>
                </div>

                <div id="calendarDatePlaceHolder" hidden></div>
                <div class="userProfileContent" id="userProfileCalendar"></div>

                <div class="userProfileContent">
                    <h2>Statistics</h2>
                    <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum eleifend ligula nisl, ac aliquam felis faucibus id. Aenean vel lacinia massa.    
                    </p>
                </div>

                <div class="userProfileContent">
                    <h2>Achievements</h2>
                    <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum eleifend ligula nisl, ac aliquam felis faucibus id. Aenean vel lacinia massa.    
                    </p>
                </div>
            </div>
            <script>
            const tabs = document.querySelectorAll('.userProfileTabBtn')
            const all_content = document.querySelectorAll('.userProfileContent')

            tabs.forEach((tab, index)=>{
                tab.addEventListener('click', (e)=>{
                tabs.forEach(tab=>{tab.classList.remove('active')})
                tab.classList.add('active');

                // var line=document.querySelector('.userProfileLine');
                // line.style.width = e.target.offsetWidth + "px";
                // line.style.left = e.target.offsetLeft + "px";
                
                all_content.forEach(content=>{content.classList.remove('active')});
                all_content[index].classList.add('active');
                })
            })
            </script>
        </div>
    </div>

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