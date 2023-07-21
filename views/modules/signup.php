<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Religion Explorer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="../assets/css/styles.css">
    
    <!-- scripts -->
    <script type="text/javascript" src="../assets/js/jquery-3.6.4.min.js"></script>
    <script type="text/javascript" src="../assets/plugins/bootstrap-4.0.0/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="../assets/js/chart.umd.js"></script>
    <script type="text/javascript" src="../js/signup.js"></script>
</head>

<body>
    <section id="loginSignup">
        <div class="container mw-100 mh-100">
            <div class="row d-flex justify-content-center align-items-center loginSignupContainer">
                <div class="col-4 mh-100 d-flex align-items-start loginSignupContainer">
                    <a href="splash.php"><img src="../assets/img/close.png" class="margin" height="20px" width="20px"></a>
                </div>
            
                <div class="col-4 mh-100 loginSignupForm">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 d-flex justify-content-center align-items-center flex-column">
                                <img src="../assets/img/applogo.png" height="110px" width="110px">
                                <h3>Sign Up</h3>
                                <form method="POST">
                                    <div class="d-flex justify-content-center align-items-center flex-column">
                                        <input type="text" id="email" name="email" placeholder="Email">
                                        <input type="text" id="username" name="username" placeholder="Username">
                                        <input type="password" id="password" name="password" placeholder="Password">
                                        <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password">
                                        <select id="religion" name="religion">
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
                                    <div class="d-flex justify-content-center">
                                        <button type="submit" id="btn-signup" name="btn-signup" class="registrationSubmitButton">Sign Up</button>
                                    </div>
                                    <p class="terms">By signing up, you agree to Religion Explorer’s <span class="signupLink" id="termsOfService">Terms of Service</span> and have acknowledged our <span class="signupLink" id="privacyPolicy">Privacy Policy</span>.</p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-4 mh-100 d-flex justify-content-end loginSignupContainer">
                    <a href="login.php"><button class="registrationNavButton">Log in</button></a>
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
</body>
  
