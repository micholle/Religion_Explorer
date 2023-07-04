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
    <title>Religion Explorer</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
  <section id="loginSignup">
    <div class="container mw-100 mh-100">
      <div class="row d-flex justify-content-center align-items-center loginSignupContainer">
        <div class="col-4 mh-100 d-flex align-items-start loginSignupContainer">
          <a href="splash.php"><img src="../assets/images/close.png" class="margin" height="20px" width="20px"></a>
        </div>
      
        <div class="col-4 mh-100 d-flex justify-content-center align-items-center loginSignupForm">
          <div class="container">

            <div class="row d-flex justify-content-center align-items-center">
              <div class="col-12 mh-100 d-flex justify-content-center align-items-center">
                <img src="../assets/images/applogo.png" height="110px" width="110px">
              </div>
            </div>
            
            <div class="row loginSignupHeader">
              <h3>Log in</h3>
            </div>
            <?php if (isset($errorMessage)) : ?>
            <div class="row d-flex justify-content-center align-items-center">
              <p class="error-message"><?php echo $errorMessage; ?></p>
            </div>
            <?php endif; ?>
            <form method="POST">
            <div class="row d-flex justify-content-center align-items-center">
              <input type="text" id="username" name="username" placeholder="Email or username">
              <input type="password" id="password" name="password" placeholder="Password">
              <p class="forgotLink">Forgot your password?</p>
              <button type="submit" id="btn-login" name="btn-login">Login</button>
            </div>
            </form>
            
          </div>
        </div>

        <div class="col-4 mh-100 d-flex justify-content-end loginSignupContainer">
          <a href="signup.php"><button class="signupButton">Sign Up</button></a>
        </div>
      </div>
    </div>
  </section>
</body>
</html>
