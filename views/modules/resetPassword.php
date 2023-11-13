<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Religion Explorer: Forgot Password</title>
        <link rel="icon" type="image/x-icon" href="../assets/img/applogo.png">
        <script type="text/javascript" src="../assets/js/jquery-3.6.4.min.js"></script>
        <script type="text/javascript" src="../assets/plugins/bootstrap-4.0.0/js/bootstrap.bundle.min.js"></script>

        <script type="text/javascript" src="../js/resetPassword.js"></script>
        <script type="text/javascript" src="../js/script.js"></script>

        <link type="text/css" rel="stylesheet" href="../assets/plugins/bootstrap-4.0.0/css/bootstrap.min.css">
        <link type="text/css" rel="stylesheet" href="../assets/css/styles.css">
    </head>
    <body>
        <header style="background-color: #2CA464">
            <li>
                <a href="splash.php"><img src="../assets/img/logo-and-text-variant.png"></a>
            </li>
                <ul>
                    <li><a href="login.php"><button class="registrationNavButton">Login</button></a></li>
                    <li><a href="signup.php"><button class="registrationNavButton">Sign up</button></a></li>
                </ul>
        </header>
        <section id="loginSignup">
            <div class="loginSignupForm d-flex align-items-center">
                <div class="container d-flex align-items-center justify-content-center" id="resetPasswordCont">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center align-items-center flex-column">
                            <h3>Reset Password</h3>
                            <p>Enter your new password.</p>
                            <form method="POST">    
                                <input type="password" id="password" name="password" placeholder="New Password">
                                <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm New Password">
                                <button type="submit" id="resetPasswordSubmit" name="" class="registrationSubmitButton">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div id="toast" class="toast"></div>
    </body>
</html>
