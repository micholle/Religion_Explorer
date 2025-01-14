<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Religion Explorer: Sign Up</title>
    <link rel="icon" type="image/x-icon" href="../assets/img/applogo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link type="text/css" rel="stylesheet" href="../assets/css/styles.css">
    
    <!-- scripts -->
    <script type="text/javascript" src="../assets/js/jquery-3.6.4.min.js"></script>
    <script type="text/javascript" src="../assets/plugins/bootstrap-4.0.0/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="../assets/plugins/googleapis/apis.google.com_js_api.js"></script>
    <script type="text/javascript" src="../js/signup.js"></script>
</head>

<body>
    <section id="loginSignup">
        <div class="container mw-100 mh-100">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-12">
                    <div class="row">
                        <div class="col-6 d-flex justify-content-start align-items-start" >
                            <a href="splash.php"><img src="../assets/img/close.png" class="margin" height="20px" width="20px"></a>
                        </div>
                        <div class="col-6 d-flex justify-content-end align-items-end">
                            <a href="login.php"><button class="registrationNavButton">Log in</button></a>
                        </div>
                    </div>
                </div>
            
                <div class="loginSignupFormVariant d-flex align-items-center">
                    <div class="container d-flex align-items-center justify-content-center">
                        <div class="row">
                            <div class="col-12 d-flex justify-content-center align-items-center flex-column">
                                <img src="../assets/img/applogo.png" height="110px" width="110px">
                                <h3>Sign Up</h3>
                                <form method="POST">
                                    <div class="d-flex justify-content-center align-items-center flex-column inputIconVariant">
                                        <div class="input-container">
                                            <span class="input-icon">
                                                <i class="fa fa-inbox fa-fw"></i>
                                            </span>
                                            <input type="text" id="email" name="email" class="input-field" placeholder="Email" autocomplete="off">
                                        </div>
                                        <div class="input-container">
                                            <span class="input-icon">
                                                <i class="fa fa-user fa-fw"></i>
                                            </span>
                                            <input type="text" id="username" name="username" class="input-field" placeholder="Username" autocomplete="off">
                                        </div>
                                        <div class="input-container">
                                            <span class="input-icon">
                                                <i class="fa fa-lock fa-fw"></i>
                                            </span>
                                            <input type="password" id="password" name="password" class="input-field" placeholder="Password">
                                        </div>
                                        <div class="input-container">
                                            <span class="input-icon">
                                                <i class="fa fa-lock fa-fw"></i>
                                            </span>
                                            <input type="password" id="confirmPassword" name="confirmPassword" class="input-field" placeholder="Confirm Password">
                                        </div>
                                        <div class="input-container">
                                            <span class="input-icon">
                                                <i class="fa fa-heart fa-fw"></i>
                                            </span>
                                            <select id="religion" name="religion" class="input-field">
                                                <option value="" disabled selected hidden>Choose your religion</option>
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
                                    <div class="d-flex justify-content-center">
                                        <button type="submit" id="btn-signup" name="btn-signup" class="registrationSubmitButton">Sign Up</button>
                                    </div>
                                    <div class="userAgreementStyle d-flex justify-content-center align-items-end">
                                        <p class="terms" style="text-align: center">By signing up, you agree to Religion Explorer’s <span class="signupLink" id="termsOfService">Terms of Service</span> and have acknowledged our <span class="signupLink" id="privacyPolicy">Privacy Policy</span>.</p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div id="toast" class="toast"></div>

    <!--Modal-->
    <div class="modal fade" id="verificationCodeModal">
        <div class="modal-dialog modal-xs modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 d-flex justify-content-center align-items-center flex-column">
                                <h5 class="modal-title w-100">Verification Code</h5>
                                <input type="text" id="verificationCode" name="verificationCode" placeholder="Verification Code">
                                <button type="button" id="verify" name="verify" class="registrationSubmitButton">Verify Code</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="inputCheckModal" class="modal fade">
        <div class="modal-dialog modal-xs modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 d-flex justify-content-center align-items-center flex-column">
                                <img id="inputCheckIcon" src="../assets/img/verification-check.png" height="80px" width="80px">
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
  
