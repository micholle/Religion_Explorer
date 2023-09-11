<?php 
require_once "../../models/explorerPoints.model.php";
if (!isset($_SESSION['accountid']) || empty($_SESSION['accountid'])) {
    // Redirect the user to splash.php
    header("Location: splash.php");
    exit(); // Terminate the script to prevent further execution
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Religion Explorer: Edit Profile</title>
    <link rel="icon" type="image/x-icon" href="../assets/img/applogo.png">
    <script type="text/javascript" src="../assets/js/jquery-3.6.4.min.js"></script>
    <script type="text/javascript" src="../assets/plugins/bootstrap-4.0.0/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="../assets/plugins/googleapis/apis.google.com_js_api.js"></script>

    <script type="text/javascript" src="../js/userProfileEditProfile.js"></script>
    <script type="text/javascript" src="../js/script.js"></script>

    <link type="text/css" rel="stylesheet" href="../assets/plugins/bootstrap-4.0.0/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="../assets/css/styles.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>

</head>

<body>
    <div id="userProfileEditProfileSidebar"></div>
    <div id="accountidPlaceholder" hidden><?php echo $_SESSION['accountid']; ?></div>
    <div id="accountUsernamePlaceholder" hidden><?php echo $_SESSION['username']; ?></div>

    <div class="pageContainer">
        <div class="container mw-100 mh-100">
            <div class="row d-flex justify-content-center align-items-center basicInfoContainer">
                <div class="col-3 d-flex justify-content-end align-items-end">
                    <img src="data:image/png;base64,<?php echo base64_encode($_SESSION['avatar']); ?>" class="userProfileAvatar">
                    <img src="../assets/img/editProfile/edit.png" id="editAvatar" class="editAvatarButton">
                </div>

                <div class="col-4 userBasicStatsContainer">
                    <div class="row">
                        <div class="col-12 mh-100 userBasicInfo">

                            <div class="row d-flex justify-content-center align-items-center">
                                <div class="col-12 mh-100 d-flex justify-content-start flex-column">
                                    <h1><?php echo $_SESSION['username']; ?></h1>
                                    <div class="row">
                                        <div class="col-12 d-flex flex-row">
                                            <p class="nicknameText" id="avatarSizeTest">aka <?php echo $_SESSION['username']; ?></p>
                                        </div>
                                    </div>
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
                            <p><?php echo $explorerPoints; ?> Explorer Points</p>
                        </div>

                        <div class="userBasicStatsOverview col-12 d-flex justify-content-start align-items-center flex-row">
                            <img src="../assets/img/editProfile/userBasicStats-feather.png">
                            <p><?php echo $_SESSION['religion']; ?></p>
                        </div>
                    </div>
                </div>

                <div class="col-3 d-flex flex-column justify-content-start align-items-center buttonProfile flex-column">
                    <a href="userProfile.php"><button class="roundedButton userBasicStatsSave" id="saveEdit">Save Changes</button></a>
                    <a href="userProfile.php"><button class="roundedButtonVariant userBasicStatsCancel">Cancel</button></a>
                </div>

            </div>

            <div class="row no-gutters justify-content-center editProfileContainer">
                <div class="col-7">
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
                                    <input type="text" id="username" name="" placeholder="Placeholder">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3 d-flex justify-content-center align-items-center">
                                    <p>Email</p>
                                </div>
                                <div class="col-9">
                                    <input type="text" id="email" name="" placeholder="<?php echo $_SESSION['email']; ?>" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3 d-flex justify-content-center align-items-center">
                                    <p>Password</p>
                                </div>
                                <div class="col-9">
                                    <div class="row">
                                        <div class="col-12 d-flex justify-content-start align-items-start flex-column">
                                            <button class="editPasswordButton" id="editPasswordButton">Edit Password</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3 d-flex justify-content-center align-items-center">
                                    <p>Religious Affiliation</p>
                                </div>
                                <div class="col-9 d-flex justify-content-start align-items-center">
                                    <select id="religion" name="religion">
                                        <option value="<?php echo $_SESSION['religion']; ?>" disabled selected hidden>Choose your religion</option>
                                        <option value="Buddhism">Buddhism</option>
                                        <option value="Christianity">Christianity</option>
                                        <option value="Hinduism">Hinduism</option>
                                        <option value="Islam">Islam</option>
                                        <option value="Judaism">Judaism</option>
                                        <option value="Non-religious">Non-religious</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-5">
                    <div class="row settingsBlock">
                        <div class="col-12">
                            <div class="row no-gutters justify-content-start">
                                <h3>Account Settings</h3>
                            </div>
                            <div class="row no-gutters settingsContainer">
                                <!-- Checkboxes -->
                                <div class="col-12 d-flex justify-content-start align-items-center flex-row">
                                    <input type="checkbox" id="displayNotification" <?php echo $displayNotifications == 1 ? "checked" : ""; ?>>
                                    <label for="">Notifications for new comments or replies</label>
                                </div>
                                <div class="col-12 d-flex justify-content-start align-items-center flex-row">
                                    <input type="checkbox" id="displayCalendar" <?php echo $displayCalendar == 1 ? "checked" : ""; ?>>
                                    <label for="">Display Personal Calendar</label>
                                </div>
                                <div class="col-12 d-flex justify-content-start align-items-center flex-row">
                                    <input type="checkbox" id="displayNickname" <?php echo $displayNickname == 1 ? "checked" : ""; ?>>
                                    <label for="">Display nickname/s</label>
                                </div>
                                <div class="col-12 d-flex justify-content-start align-items-center flex-row">
                                    <input type="checkbox" id="displayBookmark" <?php echo $displayBookmark == 1 ? "checked" : ""; ?>>
                                    <label for="">Display bookmarks</label>
                                </div>
                                <div class="col-12 d-flex justify-content-start align-items-center flex-row">
                                    <input type="checkbox" id="displayReligion" <?php echo $displayReligion == 1 ? "checked" : ""; ?>>
                                    <label for="">Display religious affiliation</label>
                                </div>

                                <!-- Dropdown -->
                                <div class="col-12 d-flex justify-content-start align-items-start flex-column">
                                    <p>Page display after login:</p>
                                    <select id="libraryReligionFilter">
                                        <option value="1" <?php echo $pageDisplayAfterLogin == 1 ? "selected" : ""; ?>>User Profile</option>
                                        <option value="0" <?php echo $pageDisplayAfterLogin == 0 ? "selected" : ""; ?>>World Map</option>
                                        <option value="2" <?php echo $pageDisplayAfterLogin == 2 ? "selected" : ""; ?>>Library of Resources</option>
                                        <option value="3" <?php echo $pageDisplayAfterLogin == 3 ? "selected" : ""; ?>>Discussion Forum</option>
                                        <option value="4" <?php echo $pageDisplayAfterLogin == 4 ? "selected" : ""; ?>>Calendar</option>
                                    </select>
                                </div>

                                <div class="col-12 d-flex justify-content-center align-items-center flex-column">
                                    <button class="roundedButtonVariantTwo" id="deleteAccountButton">Delete Account</button>
                                </div>
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
                    <h5 class="modal-title w-100" id="avatarModalTitle">Choose an Avatar</h5>
                </div>
                <div class="modal-body">
                    <div class="container" id="originalContainer">
                        <div class="row">
                            <div class="col-12 d-flex justify-content-center align-items-center flex-row">
                                <img src="../assets/img/editProfile/lion.png" class="defaultAvatar" value="../views/assets/img/editProfile/lion.png">
                                <img src="../assets/img/editProfile/lamb.png" class="defaultAvatar" value="../views/assets/img/editProfile/lamb.png">
                                <img src="../assets/img/editProfile/cow.png" class="defaultAvatar" value="../views/assets/img/editProfile/cow.png">
                                <img src="../assets/img/editProfile/cat.png" class="defaultAvatar" value="../views/assets/img/editProfile/cat.png">
                                <img src="../assets/img/editProfile/deer.png" class="defaultAvatar" value="../views/assets/img/editProfile/deer.png">
                                <img src="../assets/img/editProfile/robot.png" class="defaultAvatar" value="../views/assets/img/editProfile/robot.png">
                            </div>
                            <div class="col-12 d-flex justify-content-center align-items-center flex-row">
                                <img src="../assets/img/editProfile/woman1.png" class="defaultAvatar" value="../views/assets/img/editProfile/woman1.png">
                                <img src="../assets/img/editProfile/man1.png" class="defaultAvatar" value="../views/assets/img/editProfile/man1.png">
                                <img src="../assets/img/editProfile/woman2.png" class="defaultAvatar" value="../views/assets/img/editProfile/woman2.png">
                                <img src="../assets/img/editProfile/man2.png" class="defaultAvatar" value="../views/assets/img/editProfile/man2.png">
                                <img src="../assets/img/editProfile/woman3.png" class="defaultAvatar" value="../views/assets/img/editProfile/woman3.png">
                                <img src="../assets/img/editProfile/man3.png" class="defaultAvatar" value="../views/assets/img/editProfile/man3.png">
                            </div>
                            </div>
                            <p>OR</p>
                            <div class="row">
                            <div class="col-12 d-flex justify-content-center align-items-center flex-column">
                                <button class="roundedButtonVariant" id="uploadButton">Upload File</button>
                                <button class="roundedButton" id="updateAvatarBtn">Update Avatar</button>
                            </div>
                        </div>
                    </div>
                    <div class="container" id="cropperContainer" style="display: none;">
                        <!-- <div class="row">
                            <div class="col-12">
                                <button class="btn btn-secondary" id="backToSelection">Back</button>
                            </div>
                        </div> -->
                        <div class="row">
                            <div class="col-12">
                                <div id="cropper" style="height: 300px;"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 d-flex justify-content-center align-items-center flex-row">
                                <button class="roundedButton" id="cropAvatarBtn">Crop and Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editPasswordModal">
        <div class="modal-dialog modal-xs modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <div class="container d-flex justify-content-center align-items-center flex-column">
                        <h5 class="modal-title w-100">Edit Password</h5>
                    </div>
                </div>
                <form id="" method="post">
                    <div class="editPasswordModalBox d-flex justify-content-center align-items-center flex-column">
                        <input type="password" id="oldPassword" name="oldPassword" placeholder="Old Password">
                        <input type="password" id="newPassword" name="newPassword" placeholder="New Password">
                        <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm New Password">
                    </div>
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center align-items-center flex-row">
                            <button type="button" id="" class="roundedButtonVariant" data-dismiss="modal">Cancel</button>
                            <button type="button" id="confirmEditPasswordBtn" class="roundedButton">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteAccountModal">
        <div class="modal-dialog modal-xs modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <div class="container d-flex justify-content-center align-items-center flex-column">
                        <h5 class="modal-title w-100">Delete Account</h5>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form id="" method="post">
                            <div class="deleteAccountContent d-flex justify-content-center align-items-center flex-column">
                                <p class="deleteAccountDescription">We're sorry to see you go. Once your Religion Explorer account is deleted, your profile and username will be removed. All of your site activity will be disassociated instead unless you delete them beforehand.</p>
                                <br>
                                <p class="deleteAccountDescriptionVar">Please verify your identity.</p>
                                <input type="text" id="deleteEmail" name="deleteEmail" placeholder="Email" autocomplete="off">
                                <input type="password" id="deletePassword" name="" placeholder="Password">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 d-flex justify-content-center align-items-center flex-row">
                                    <button type="button" id="" class="roundedButtonVariant" data-dismiss="modal">Cancel</button>
                                    <button type="button" id="confirmDeleteAccountBtn" class="roundedButtonVariantTwo">Delete</button>
                                </div>
                            </div>
                        </form>    
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="inputCheckModal">
        <div class="modal-dialog modal-xs modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 d-flex justify-content-center align-items-center flex-column">
                                <img id="inputCheckIcon" src="../assets/img/verification-error.png" height="80px" width="80px">
                                <h5 id="inputCheckHeader" class="modal-title w-100"></h5>
                                <p id="inputCheckContent" class="text-center"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>