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
                    <li><a href="login.php"><button class="registrationButtonVariant">Login</button></a></li>
                    <li><a href="signup.php"><button class="registrationButtonVariant">Sign up</button></a></li>
                </ul>
        </header>
        <section id="loginSignup">
            <div class="container mw-100 mh-100" id="resetPasswordCont">
                <div class="row d-flex justify-content-center align-items-center loginSignupContainer">
                    <div class="col-3 d-flex justify-content-center align-items-center flex-column">
                        <h3>Reset Password</h3>
                        <p>Enter your new password.</p>
                        <form method="POST">
                            <input type="password" id="" name="" placeholder="New Password">
                            <input type="password" id="" name="" placeholder="Confirm New Password">
                            <button type="submit" id="resetPasswordSubmit" name="" class="registrationSubmitButton">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>
