<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Religion Explorer</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="../js/script.js"></script>
    <?php
        require 'sidebar.php';
    ?>
</head>

<body>
    <?php  
    $sidebar_html = create_sidebar();
    echo $sidebar_html;
    ?>

    <div class="mainContent">
        <div class="container mw-100 mh-100">
            <div class="row d-flex justify-content-center align-items-center basicInfoContainer">
                <div class="col-3 d-flex justify-content-end align-items-end">
                    <img src="../assets/img/lamb.png" width="175px">
                </div>

                <div class="col-4 userBasicStatsContainer">
                    <div class="row">
                        <div class="col-12 mh-100 userBasicInfo">

                            <div class="row d-flex justify-content-center align-items-center">
                                <div class="col-12 mh-100 d-flex justify-content-start">
                                    <h1>ReligionExplorer_123</h1>
                                </div>
                            </div>

                            <div class="row d-flex justify-content-center align-items-center">
                                <div class="col-12 mh-100 d-flex justify-content-start">
                                    <p class="nicknameText">aka Johnny</p>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 mh-100">

                            <div class="row d-flex justify-content-start align-items-center userBasicStats">
                                <div class="col-1 d-flex justify-content-start align-items-center">
                                    <img src="../assets/img/userBasicStats-clock.png" width="20px">
                                </div>
                                
                                <div class="col-8 d-flex justify-content-start align-items-center">
                                    <p>Joined April 2023</p>
                                </div>
                            </div>

                            <div class="row d-flex justify-content-start align-items-center userBasicStats">
                                <div class="col-1 d-flex justify-content-start align-items-center">
                                    <img src="../assets/img/userBasicStats-star.png" width="20px">
                                </div>
                                
                                <div class="col-8 d-flex justify-content-start align-items-center">
                                    <p>407 Explorer Points</p>
                                </div>
                            </div>

                            <div class="row d-flex justify-content-start align-items-center userBasicStats">
                                <div class="col-1 d-flex justify-content-start align-items-center">
                                    <img src="../assets/img/userBasicStats-feather.png" width="20px">
                                </div>
                                
                                <div class="col-8 d-flex justify-content-start align-items-center">
                                    <p>Non-religious</p>
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
                <!-- <div class="userProfileLine"></div> -->
            </div>
            <div class="userProfileContentBox">
                <div class="userProfileContent active">
                    <div class="userContentContainer">
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

                <div class="userProfileContent">
                    <h2>Personal Calendar</h2>
                    <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum eleifend ligula nisl, ac aliquam felis faucibus id. Aenean vel lacinia massa.    
                    </p>
                </div>

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
</body>

<script>
    let minimize = document.querySelector('#minimize');
    let sidebar = document.querySelector('.sidebar');
    let textImage = document.querySelector('#text');
    let minmaxImage = document.querySelector('#minmax');

    minimize.onclick = function () {
        sidebar.classList.toggle('active');
        if (sidebar.classList.contains('active')) {
            textImage.style.display = 'none';
            minmaxImage.src = '../assets/img/maximize.png';
        } else {
            textImage.style.display = 'inline-block';
            minmaxImage.src = '../assets/img/minimize.png';
        }
    };
</script>

</html>