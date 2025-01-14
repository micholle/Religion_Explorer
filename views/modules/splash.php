<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Religion Explorer</title>
    <link rel="icon" type="image/x-icon" href="../assets/img/applogo.png">
    <script type="text/javascript" src="../assets/js/jquery-3.6.4.min.js"></script>
    <script type="text/javascript" src="../assets/plugins/bootstrap-4.0.0/js/bootstrap.bundle.min.js"></script>

    <script type="text/javascript" src="../js/splash.js"></script>
    <script type="text/javascript" src="../js/script.js"></script>

    <link type="text/css" rel="stylesheet" href="../assets/plugins/bootstrap-4.0.0/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <header id="splashPageHeader">
        <li>
            <img src="../assets/img/logo-and-text.png">
        </li>
        <ul>
            <li><a href="#splash-page" style="margin-left: 0px;">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#features">Features</a></li>
            <li><a href="#developers">Developers</a></li>
            <li><a href="login.php"><button class="splashButton navBarButton">Log in</button></a></li>
        </ul>
    </header>
    
    <section id="splash-page">
        <div class="container mw-100 mh-100">
            <div class="row" style="height: 100vh; background-image: url('../assets/img/try3.png'); background-repeat: no-repeat; background-attachment: fixed; background-position: center; background-size: cover;">
            
            <div class="col-12 col-lg-5 mh-100 d-flex justify-content-center align-items-center">
              <div id="splash-gif">
                  <img src="../assets/img/splash/frame1.png" alt="Frame 1" class="active">
                  <img src="../assets/img/splash/frame2.png" alt="Frame 2">
                  <img src="../assets/img/splash/frame3.png" alt="Frame 3">
                  <img src="../assets/img/splash/frame4.png" alt="Frame 4">
                  <img src="../assets/img/splash/frame5.png" alt="Frame 5">
              </div>
            </div>

            <div class="col-12 col-lg-7 mh-100 d-flex justify-content-center align-items-center">
                <div class="container">
                    <div class="row d-flex justify-content-center align-items-center flex-column homeHeader">
                        <h2>Navigate the world and discover religion!</h2>
                        <a href="signup.php"><button class="splashButton splashMainButton">Sign Up</button></a>
                        <a href="../../models/guest.model.php"><p>View Religion Explorer as Guest</p></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

      <div class="container mw-100 div-divider">
      </div>

      <section id="about">
        <div class="mw-100">
          <div class="container">

            <div class="row contentHeader d-flex justify-content-center align-items-center">
              <h2>About Religion Explorer </h2>
            </div>

            <hr>

            <div class="row content">
              <p>Religion Explorer is a web application that functions as a religious resource and as a platform that promotes camaraderie and global understanding for people who practice the world's five major religions. Users can also see statistics, events, have fruitful discussions, or browse for information.</p>
            </div>

          </div>
        </div>
      </section>

      <section id="features">
        <div class="mw-100 d-flex justify-content-center align-items-center no-gutters"></div>
          <div class="container">

            <div class="row contentHeader d-flex justify-content-center align-items-center">
              <h2>Available Features</h2>
            </div>

            <div class="row content">
              <div class="col-12 col-lg-4 mh-100 no-gutters">
                <div class="row d-flex justify-content-center align-items-start">
                  <div class="col-2 d-flex justify-content-center">
                    <img src="../assets/img/feat-worldwide.png" height="50px" width="50px">
                  </div>
                  <div class="col-10 justify-content-center">
                    <h5>Interactive Map</h5>
                    <p>Provides users with a visual representation of the distribution and diversity of different religious and spiritual traditions around the world.</p>
                  </div>
                </div>

                <div class="row d-flex justify-content-center align-items-start featuresTopSpacing">
                  <div class="col-2 d-flex justify-content-center">
                    <img src="../assets/img/feat-book-stack.png" height="50px" width="50px">
                  </div>
                  <div class="col-10 justify-content-center">
                    <h5>Library of Resources and Community Creations</h5>
                    <p>Offers users with an extensive array of materials for reading, learning, and content submission.</p>
                  </div>
                </div>
              </div>
    
              <div class="col-12 col-lg-4 mh-100 d-flex justify-content-center align-items-start featuresCenterImg">
                <img src="../assets/img/feat-compass.png">
              </div>

              <div class="col-12 col-lg-4 mh-100">
                <div class="row d-flex justify-content-center align-items-start">
                  <div class="col-2 d-flex justify-content-center">
                    <img src="../assets/img/feat-chat.png" height="50px" width="50px">
                  </div>
                  <div class="col-10 featuresText">
                    <h5>Discussion Forum</h5>
                    <p>Provides users with a platform to share their thoughts and questions about different religions in order to foster widespread understanding.</p>
                  </div>
                </div>

                <div class="row d-flex justify-content-center align-items-start featuresTopSpacing">
                  <div class="col-2 d-flex justify-content-center">
                    <img src="../assets/img/feat-calendar.png" height="50px" width="50px">
                  </div>
                  <div class="col-10 featuresText">
                    <h5>Calendar</h5>
                    <p>Provides users with a comprehensive list of upcoming religious holidays and events so that they can properly prepare.</p>
                  </div>
                </div>
              </div>
            </div>
        </div>
      </section>

      <section id="developers">
        <div class="container">

          <div class="row contentHeader d-flex justify-content-center align-items-center">
            <h2>Developers</h2>
          </div>

          <div class="row content">
            <div class="col-12 col-lg-4 mh-100">
              <div class="row d-flex justify-content-end align-items-center flex-column">
                <img src="../assets/img/dev1.png"> 
                <h5>Jose Carl Angeles</h5>
                <p>Back-end Developer</p>
              </div> 
            </div>

            <div class="col-12 col-lg-4 mh-100">
              <div class="row d-flex justify-content-center align-items-center flex-column">
                <img src="../assets/img/dev2.png"> 
                <h5>Andrea Ymanuelle Cervales</h5>
                <p>Front-end Developer</p>
              </div>  
            </div>

            <div class="col-12 col-lg-4 mh-100">
              <div class="row d-flex justify-content-center align-items-center flex-column">
                <img src="../assets/img/dev3.png"> 
                <h5>Micholle Cortezano</h5>
                <p>Project Manager</p>
              </div>  
            </div>
          </div>
        </div>
      </section>
    </div>
</body>
</html>