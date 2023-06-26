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
                    <a href="userProfilePosts.php"><div class="tabs">Posts</div></a>
                    <a href="userProfileComments.php"><div class="tabs">Comments</div></a>
                    <a href="userProfileBookmarks.php"><div class="tabs">Bookmarks</div></a>
                    <div class="tabs activeTab">Personal Calendar</div>
                    <a href="userProfileStatistics.php"><div class="tabs">Statistics</div></a>
                    <div class="tabs">Achievements</div>
                </div>

                <div class="userContent">
                    <div class="userContentContainer">
                        <h1>Holy Week in the Philippines</h1><h2>by ReligionExplorer_User123 • May 12, 2023 • 8:43 P.M.</h2>
                        <p>Good day, everyone! Are there any Filipinos here who can share about why that week in particular is so significant in the country? I’m a non-practising Christian who is interested in learning more about religion again. Thanks in advance to those who will reply!<p>
                    </div>
                </div>
            </div>
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