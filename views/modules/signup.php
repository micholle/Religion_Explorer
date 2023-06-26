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
            <a href="splash.php"><img src="../assets/img/close.png" class="margin" height="20px" width="20px"></a>
        </div>
      
        <div class="col-4 mh-100 d-flex justify-content-center align-items-center loginSignupForm">
          <div class="container">

            <div class="row d-flex justify-content-center align-items-center">
              <div class="col-12 mh-100 d-flex justify-content-center align-items-center">
                <img src="../assets/img/applogo.png" height="110px" width="110px">
              </div>
            </div>
            
            <div class="row loginSignupHeader">
              <h3>Sign Up</h3>
            </div>
            
            <div class="row d-flex justify-content-center align-items-center">
                <input type="text" id="" name="" placeholder="Email">
                <input type="text" id="" name="" placeholder="Username">
                <input type="password" id="" name="" placeholder="Password">
                <input type="password" id="" name="" placeholder="Confirm Password">
                <select id="" name="">
                    <option value="" disabled selected hidden>Choose your religion</option>
                    <option value="">Buddhism</option>
                    <option value="">Christianity</option>
                    <option value="">Hinduism</option>
                    <option value="">Islam</option>
                    <option value="">Judaism</option>
                    <option value="">Non-religious</option>
                    <option value="">Other</option>
                </select>
              <input type="submit" value="Sign up">
              <p class="terms">By signing up, you agree to Religion Explorer’s <span class="signupLink">Terms of Service</span> and have acknowledged our <span class="signupLink">Privacy Policy</span>.</p>
            </div>
            
          </div>
        </div>

        <div class="col-4 mh-100 d-flex justify-content-end loginSignupContainer">
          <a href="login.php"><button class="signupButton">Log in</button></a>
        </div>
      </div>
    </div>
  </section>
</body>
  