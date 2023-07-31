<?php
require_once "../../controllers/login.controller.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $controller = new ControllerLogin();
    $errorMessage = $controller->loginUser($username, $password);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Religion Explorer: Log In</title>
    <link rel="icon" type="image/x-icon" href="../assets/img/applogo.png">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
    <section id="loginSignup">
        <div class="container mw-100">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-12">
                    <div class="row">
                        <div class="col-6 d-flex justify-content-start align-items-start" >
                            <a href="splash.php"><img src="../assets/img/close.png" class="margin" height="20px" width="20px"></a>
                        </div>
                        <div class="col-6 d-flex justify-content-end align-items-end">
                            <a href="signup.php"><button class="registrationNavButton">Sign Up</button></a>
                        </div>
                    </div>
                </div>
            
                <div class="loginSignupFormVariant d-flex align-items-center">
                    <div class="container d-flex align-items-center justify-content-center">
                        <div class="row">
                            <div class="col-12 d-flex justify-content-center align-items-center flex-column">
                                <img src="../assets/img/applogo.png" height="110px" width="110px">
                                <h3>Log in</h3>
                                    <?php if (isset($errorMessage)) : ?>
                                    <div class="row d-flex justify-content-center align-items-center">
                                        <p class="error-message" style="color: #E04F5F; text-align: center;"><?php echo $errorMessage; ?></p>
                                    </div>
                                    <?php endif; ?>
                                <form method="POST">
                                    <input type="text" id="username" name="username" placeholder="Email or username">
                                    <input type="password" id="password" name="password" placeholder="Password">
                                    <p class="forgotLink"><a href="forgotPassword.php">Forgot your password?</a></p>
                                    <button type="submit" id="btn-login" name="btn-login" class="registrationSubmitButton">Login</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
