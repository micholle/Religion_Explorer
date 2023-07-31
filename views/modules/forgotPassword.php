<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Religion Explorer: Forgot Password</title>
        <link rel="icon" type="image/x-icon" href="../assets/img/applogo.png">
        <script type="text/javascript" src="../assets/js/jquery-3.6.4.min.js"></script>
        <script type="text/javascript" src="../assets/plugins/bootstrap-4.0.0/js/bootstrap.bundle.min.js"></script>

        <script type="text/javascript" src="../js/forgotPassword.js"></script>
        <script type="text/javascript" src="../js/script.js"></script>

        <link type="text/css" rel="stylesheet" href="../assets/plugins/bootstrap-4.0.0/css/bootstrap.min.css">
        <link type="text/css" rel="stylesheet" href="../assets/css/styles.css">
    </head>
    <body>
        <header class="registrationHeader">
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
                <div class="container d-flex align-items-center justify-content-center" id="forgotPasswordCont">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center align-items-center flex-column">
                            <h3>Forgot Password</h3>
                            <p>Enter your email for the verification process.</p>
                            <form method="POST">
                                <input type="text" id="email" name="email" placeholder="Email">
                                <button type="submit" id="forgotPasswordSubmit" name="" class="registrationSubmitButton">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div id="toast" class="toast"></div>
    </body>
</html>
