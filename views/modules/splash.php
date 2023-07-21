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
    <header>
        <li>
            <img src="../assets/img/logo-and-text.png">
        </li>
        <ul clas="d-flex justify-content-center align-items-center">
            <li><a href="#splash-page">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#features">Features</a></li>
            <li><a href="#developers">Developers</a></li>
            <li><a href="login.php"><button class="splashButton navBarButton">Log in</button></a></li>
        </ul>
    </header>
    
    <section id="splash-page">
        <div class="container mw-100 mh-100">
            <div class="row" style="height: 100vh; background-image: url('../assets/img/try3.png'); background-repeat: no-repeat; background-attachment: fixed; background-position: center; background-size: cover;">
            
            <div class="col-5 mh-100 d-flex justify-content-center align-items-center">
              <div id="splash-gif">
                  <img src="../assets/img/splash/frame1.png" alt="Frame 1">
                  <img src="../assets/img/splash/frame2.png" alt="Frame 2">
                  <img src="../assets/img/splash/frame3.png" alt="Frame 3">
                  <img src="../assets/img/splash/frame4.png" alt="Frame 4">
                  <img src="../assets/img/splash/frame5.png" alt="Frame 5">
              </div>
            </div>

            <div class="col-7 mh-100 d-flex justify-content-center align-items-center">
                <div class="container">
                    <div class="row d-flex justify-content-center align-items-center flex-column homeHeader">
                        <h2>Navigate the world, befriend explorers, and discover religion!</h2>
                        <a href="signup.php"><button class="splashButton splashMainButton">Sign Up</button></a>
                        <a href="../../models/guest.model.php">View Religion Explorer as Guest</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

      <div class="container mw-100 div-divider">
      </div>

      <section id="about">
        <div class="mw-100 d-flex justify-content-center align-items-center">
          <div class="container">

            <div class="row contentHeader">
              <h2>About Religion Explorer </h2>
            </div>

            <hr>

            <div class="row content">
              <p>Religion Explorer is a website application that aims to become a reliable religious resource for people who practice the world's five major religions. It aspires to be a convenient source where users can see statistics, events, have fruitful discussions, or browse for information.</p>
            </div>

          </div>
        </div>
        <hr>
      </section>

      <section id="features">
        <div class="mw-100 d-flex justify-content-center align-items-center"></div>
          <div class="container">

            <div class="row contentHeader">
              <h2>Available Features</h2>
            </div>

            <div class="row content">
              <div class="col-4 mh-100">
                <div class="row d-flex justify-content-center align-items-center featuresRow">
                  <div class="col-2 mh-100 d-flex justify-content-center featuresCol">
                    <img src="../assets/img/feat-worldwide.png" height="50px" width="50px">
                  </div>
                  <div class="col-10 mh-100 featuresText">
                    <h5>Interactive Map</h5>
                    <p>Provides users with a visual representation of the distribution and diversity of different religious and spiritual traditions around the world.</p>
                  </div>
                </div>

                <div class="row d-flex justify-content-center align-items-center featuresRow">
                  <div class="col-2 mh-100 d-flex justify-content-center featuresCol">
                    <img src="../assets/img/feat-book-stack.png" height="50px" width="50px">
                  </div>
                  <div class="col-10 mh-100 featuresText">
                    <h5>Library of Resources</h5>
                    <p>Includes a wide range of materials such as: articles, videos, images, books, research papers, and user-generated content.</p>
                  </div>
                </div>
              </div>
    
              <div class="col-4 mh-100 d-flex justify-content-center align-items-center">
                <img src="../assets/img/feat-compass.png" height="275px" width="275px">
              </div>

              <div class="col-4 mh-100">
                <div class="row d-flex justify-content-center align-items-center featuresRow">
                  <div class="col-2 mh-100 d-flex justify-content-center featuresCol">
                    <img src="../assets/img/feat-chat.png" height="50px" width="50px">
                  </div>
                  <div class="col-10 mh-100 featuresText">
                    <h5>Discussion Forum</h5>
                    <p>Provides users with a platform to share their thoughts and questions about different religions in order to foster widespread understanding.</p>
                  </div>
                </div>

                <div class="row d-flex justify-content-center align-items-center featuresRow">
                  <div class="col-2 mh-100 d-flex justify-content-center featuresCol">
                    <img src="../assets/img/feat-calendar.png" height="50px" width="50px">
                  </div>
                  <div class="col-10 mh-100 featuresText">
                    <h5>Calendar</h5>
                    <p>Provides users with a comprehensive list of upcoming religious holidays and events so that they can properly prepare.</p>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <hr>
      </section>

      <section id="developers">
        <div class="container mw-100">

          <div class="row contentHeader">
            <h2>Developers</h2>
          </div>

          <div class="row content">
            <div class="col-4 mh-100">
              <div class="row d-flex justify-content-center align-items-center">
                <img src="../assets/img/dev1.png"> 
              </div>

              <div class="row d-flex justify-content-center align-items-center developersRow">
                <h5>Jose Carl Angeles</h5>
                <p>Back-end Developer</p>
              </div>  
            </div>

            <div class="col-4 mh-100">
              <div class="row d-flex justify-content-center align-items-center">
                <img src="../assets/img/dev2.png"> 
              </div>

              <div class="row d-flex justify-content-center align-items-center developersRow">
                <h5>Andrea Ymanuelle Cervales</h5>
                <p>Front-end Developer</p>
              </div>  
            </div>

            <div class="col-4 mh-100">
              <div class="row d-flex justify-content-center align-items-center">
                <img src="../assets/img/dev3.png"> 
              </div>

              <div class="row d-flex justify-content-center align-items-center developersRow">
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