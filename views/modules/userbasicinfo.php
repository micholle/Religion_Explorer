<?php
function create_userBasicinfo() {
    $userBasicInfo_html = '
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
                <a href="userProfileEditProfile.php"><button class="roundedButton">Edit Profile</button></a>
            </div>

        </div>
        ';

        return $userBasicInfo_html;
    }
    ?>