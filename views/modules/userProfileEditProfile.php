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

    <script type="text/javascript" src="../js/userProfileEditProfile.js"></script>
    <script type="text/javascript" src="../js/script.js"></script>

    <link type="text/css" rel="stylesheet" href="../assets/plugins/bootstrap-4.0.0/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="../assets/css/styles.css">
</head>

<body>
    <div id="userProfileEditProfileSidebar"></div>
    <div class="pageContainer">
        <div class="container mw-100 mh-100">
            <div class="row d-flex justify-content-center align-items-center basicInfoContainer">
                <div class="col-3 d-flex justify-content-end align-items-end">
                    <img src="../assets/img/editProfile/lamb.png" width="175px">
                    <img src="../assets/img/editProfile/edit.png" id="editAvatar" class="editAvatarButton">
                </div>

                <div class="col-4 userBasicStatsContainer">
                    <div class="row">
                        <div class="col-12 mh-100 userBasicInfo">

                            <div class="row d-flex justify-content-center align-items-center">
                                <div class="col-12 mh-100 d-flex justify-content-start">
                                    <h1>[Placeholder]</h1>
                                </div>
                            </div>

                            <div class="row d-flex justify-content-center align-items-center nicknameContainer">
                                <div class="col-12 mh-100 d-flex justify-content-start">
                                    <p class="nicknameText">aka [Placeholder]</p>
                                    <button class="editNicknameButton">Edit Nickname</button>
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
                    <a href="userProfile.php"><button class="roundedButton">Save Changes</button></a>
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
                                <div class="col-9 d-flex justify-content-start align-items-center">
                                    <input type="text" id="" name="" placeholder="Placeholder">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3 d-flex justify-content-center align-items-center">
                                    <p>Email</p>
                                </div>
                                <div class="col-9">
                                    <input type="text" id="" name="" placeholder="Placeholder">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3 d-flex justify-content-center align-items-center">
                                    <p>Password</p>
                                </div>
                                <div class="col-9">
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
                                <div class="col-9 d-flex justify-content-start align-items-center">
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
            </div>
        </div>
    </div>

    <!--Modal-->
    <div class="modal fade" id="editAvatarModal">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-0 text-center">
                        <h5 class="modal-title w-100">Choose an Avatar</h5>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 d-flex justify-content-center align-items-center flex-row">
                                    <img src="../assets/img/editProfile/lion.png" class="defaultAvatar">
                                    <img src="../assets/img/editProfile/lamb.png" class="defaultAvatar">
                                    <img src="../assets/img/editProfile/cow.png" class="defaultAvatar">
                                    <img src="../assets/img/editProfile/cat.png" class="defaultAvatar">
                                    <img src="../assets/img/editProfile/deer.png" class="defaultAvatar">
                                    <img src="../assets/img/editProfile/robot.png" class="defaultAvatar">
                                </div>
                                <div class="col-12 d-flex justify-content-center align-items-center flex-row">
                                    <img src="../assets/img/editProfile/woman1.png" class="defaultAvatar">
                                    <img src="../assets/img/editProfile/man1.png" class="defaultAvatar">
                                    <img src="../assets/img/editProfile/woman2.png" class="defaultAvatar">
                                    <img src="../assets/img/editProfile/man2.png" class="defaultAvatar">
                                    <img src="../assets/img/editProfile/woman3.png" class="defaultAvatar">
                                    <img src="../assets/img/editProfile/man3.png" class="defaultAvatar">
                                </div>
                            </div>
                            <p>OR</p>
                            <div class="row">
                                <div class="col-12 d-flex justify-content-center align-items-center flex-column">
                                    <button class="roundedButtonVariant">Upload File</button>
                                    <button class="roundedButton">Update Avatar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>
</html>