<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Religion Explorer</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    
    <!-- scripts -->
    <script type="text/javascript" src="../assets/js/jquery-3.6.4.min.js"></script>
    <script type="text/javascript" src="../assets/plugins/bootstrap-4.0.0/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="../assets/js/chart.umd.js"></script>
    <script type="text/javascript" src="../js/accounts.js"></script>
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
              <h3>Sign Up</h3>
            </div>
            <form method="POST">
            <div class="row d-flex justify-content-center align-items-center">
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
              <button type="submit" id="btn-signup" name="btn-signup">Sign Up</button>
              <p class="terms">By signing up, you agree to Religion Explorer’s <span class="signupLink">Terms of Service</span> and have acknowledged our <span class="signupLink">Privacy Policy</span>.</p>
            </div>
            <form>
            <input type="text" id="verificationCode" name="verificationCode" placeholder="Verification Code">
            <button type="button" id="verify" name="verify">Verify Code</button>

            
          </div>
        </div>

        <div class="col-4 mh-100 d-flex justify-content-end loginSignupContainer">
          <a href="login.php"><button class="signupButton">Log in</button></a>
        </div>
      </div>
    </div>
  </section>
</body>
  
