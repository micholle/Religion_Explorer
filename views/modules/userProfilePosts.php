<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Religion Explorer</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/script.js"></script>
    <?php
        require 'sidebar.php';
        require 'userBasicInfo.php';
    ?>
</head>

<body>
    <?php  
    $sidebar_html = create_sidebar();
    echo $sidebar_html;
    ?>

    <div class="mainContent">
        <div class="container mw-100 mh-100">
            <?php  
                $userBasicInfo_html = create_userBasicInfo();
                echo $userBasicInfo_html;
            ?>

            <div class="row no-gutters justify-content-center no-gutters userTabsContainer">
                <div class="col-12 d-flex justify-content-center align-items-start userTabs">
                    <a href="userProfileOverview.php"><div class="tabs">Overview</div></a>
                    <div class="tabs activeTab">Posts</div>
                    <a href="userProfileComments.php"><div class="tabs">Comments</div></a>
                    <a href="userProfileBookmarks.php"><div class="tabs">Bookmarks</div></a>
                    <a href="userProfilePersonalCalendar.php"><div class="tabs">Personal Calendar</div></a>
                    <a href="userProfileStatistics.php"><div class="tabs">Statistics</div></a>
                    <div class="tabs">Achievements</div>
                </div>
            </div>

            <!-- <div class="row userContentContainer" style="background-color: pink">
                <div class="col-1 d-flex justify-content-center align-items-top">
                    <img src="../assets/img/bookmark.png" class="postVotes">
                </div>
                <div class="col-11">
                    <div class="row no-gutters justify-content-center">
                        <h1>Holy Week in the Philippines</h1>
                        <h2>by ReligionExplorer_User123 • May 12, 2023 • 8:43 P.M.</h2>
                        <p>Good day, everyone! Are there any Filipinos here who can share about why that week in particular is so significant in the country? I’m a non-practising Christian who is interested in learning more about religion again. Thanks in advance to those who will reply!</p>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</body>
</html>