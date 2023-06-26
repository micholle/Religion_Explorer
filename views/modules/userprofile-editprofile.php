<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Religion Explorer</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <?php
        require 'sidebar.php';
        require 'userbasicinfo.php';
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

                            <div class="row d-flex justify-content-center align-items-center nicknameContainer">
                                <div class="col-4 mh-100 d-flex justify-content-start">
                                    <p class="nicknameText">aka Johnny</p>
                                </div>
                                <div class="col-8 mh-100 d-flex justify-content-start">
                                    <button class="editNicknameButton">Edit Nickname</button>
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
                    <a href="userprofile-editprofile"><button class="roundedButton">Save Changes</button></a>
                </div>

            </div>

            <div class="row no-gutters justify-content-center editProfileContainer">
                <div class="col-6">
                    <div class="row no-gutters justify-content-start">
                        <h3>Personal Information</h3>
                    </div>
                    <div class="row">
                        <div class="col-12 personalInfoContainer">
                            <div class="row">
                                <div class="col-3 d-flex justify-content-center align-items-center">
                                    <p>Username</p>
                                </div>
                                <div class="col-9 d-flex justify-content-start align-items-center personalInfoInput">
                                    <input type="text" id="" name="" placeholder="Placeholder">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3 d-flex justify-content-center align-items-center">
                                    <p>Email</p>
                                </div>
                                <div class="col-9 d-flex justify-content-start align-items-center personalInfoInput">
                                    <input type="text" id="" name="" placeholder="Placeholder">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3 d-flex justify-content-center align-items-center">
                                    <p>Password</p>
                                </div>
                                <div class="col-9 personalInfoInput">
                                    <div class="row">
                                        <div class="col-12 d-flex justify-content-start align-items-start">
                                            <input type="password" id="" name="" placeholder="Placeholder">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 d-flex justify-content-start align-items-start">
                                            <button class="editPasswordButton">Edit Password</button>
                                            <button class="editPasswordButton">Forgot Password</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3 d-flex justify-content-center align-items-center">
                                    <p>Religious Affiliation</p>
                                </div>
                                <div class="col-9 d-flex justify-content-start align-items-center personalInfoInput">
                                    <select id="" name="">
                                        <option value="" disabled selected hidden>Choose your religion</option>
                                        <option value="">Buddhism</option>
                                        <option value="">Christianity</option>
                                        <option value="">Hinduism</option>
                                        <option value="">Islam</option>
                                        <option value="">Judaism</option>
                                        <option value="">Non-religious</option>
                                        <option value="">Other</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="row achBlock">
                        <div class="col-12">
                            <div class="row no-gutters justify-content-start">
                                <h3>Achievements</h3>
                            </div>
                            <div class="row no-gutters justify-content-center achContainer">
                                Placeholder
                            </div>
                        </div>
                    </div>

                    <div class="row settingsBlock">
                        <div class="col-12">
                            <div class="row no-gutters justify-content-start">
                                <h3>Account Settings</h3>
                            </div>
                            <div class="row no-gutters justify-content-center settingsContainer">
                                Placeholder
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="userContent">
                    <div class="userContentContainer">
                        <h1>Holy Week in the Philippines</h1><h2>by ReligionExplorer_User123 • May 12, 2023 • 8:43 P.M.</h2>
                        <p>Good day, everyone! Are there any Filipinos here who can share about why that week in particular is so significant in the country? I’m a non-practising Christian who is interested in learning more about religion again. Thanks in advance to those who will reply!<p>
                    </div>
                </div> -->
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