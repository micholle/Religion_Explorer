<!doctype html>
<html lang="en">
    <head>
        <title>Religion Explorer: Library of Resources</title>
        <link rel="icon" type="image/x-icon" href="../assets/img/applogo.png">
        <script type="text/javascript" src="../assets/js/jquery-3.6.4.min.js"></script>
        <script type="text/javascript" src="../assets/plugins/bootstrap-4.0.0/js/bootstrap.bundle.min.js"></script>

        <script type="text/javascript" src="../js/library.js"></script>
        <script type="text/javascript" src="../js/script.js"></script>

        <link type="text/css" rel="stylesheet" href="../assets/plugins/bootstrap-4.0.0/css/bootstrap.min.css">
        <link type="text/css" rel="stylesheet" href="../assets/css/styles.css">
        <?php
        require 'sidebar.php';
        ?>
    </head>
    <body>
        <!-- <div id="librarySidebar"></div> -->
        <!--pasaylo sa js pls-->
        <?php  
        $sidebar_html = create_sidebar();
        echo $sidebar_html;
        ?>

        <div class="pageContainer">
            <div class="container mw-100 mh-100">
                <div class="row d-flex justify-content-center align-items-center pageHeader">
                    <div class="col-4 d-flex justify-content-start align-items-center">
                        <h1>Library of Resources</h1>
                    </div>
                    <div class="col-8 d-flex justify-content-start align-items-center">
                        <input type="search" id="" name="" placeholder="Search the Library">
                    </div>
                </div>

                <div class="row pageContent">
                    <div class="col-7">
                        <div class="row">
                            <div class="col-12 libraryBasicInfoCont">
                                <div class="row d-flex justify-content-center align-items-center">
                                    <div class="col-12 d-flex justify-content-start align-items-start">
                                        <h1>Basic Information</h1>
                                    </div>
                                </div>
                                <div class="row d-flex justify-content-center align-items-center flex-row">
                                    <div class="col-2 d-flex justify-content-center align-items-center flex-column">
                                        <div class="libraryBasicInfoBox">
                                            <img src="../assets/img/lib-buddhism.png">
                                        </div>
                                        <p>Buddhism</p>
                                    </div>
                                    
                                    <div class="col-2 d-flex justify-content-center align-items-center flex-column">
                                        <div class="libraryBasicInfoBox">
                                            <img src="../assets/img/lib-christianity.png">
                                        </div>
                                        <p>Christianity</p>
                                    </div>

                                    <div class="col-2 d-flex justify-content-center align-items-center flex-column">
                                        <div class="libraryBasicInfoBox">
                                            <img src="../assets/img/lib-hinduism.png">
                                        </div>
                                        <p>Hinduism</p>
                                    </div>

                                    <div class="col-2 d-flex justify-content-center align-items-center flex-column">
                                        <div class="libraryBasicInfoBox">
                                            <img src="../assets/img/lib-islam.png">
                                        </div>
                                        <p>Islam</p>
                                    </div>

                                    <div class="col-2 d-flex justify-content-center align-items-center flex-column">
                                        <div class="libraryBasicInfoBox">
                                            <img src="../assets/img/lib-judaism.png">
                                        </div>
                                        <p>Judaism</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 libraryReadMatCont">
                                <div class="row d-flex justify-content-center align-items-center">
                                    <div class="col-12 d-flex justify-content-start align-items-start">
                                        <h1>Reading Materials</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="row">
                            <div class="col-12 libraryFilterCont">
                                <div class="libraryFilterBox">
                                    <div class="row">
                                        <div class="col-12">
                                            <p>Religion:</p>
                                            <select id="" name="">
                                                <option selected hidden disabled>Select a Religion</option>
                                                <option value="">Buddhism</option>
                                                <option value="">Christianity</option>
                                                <option value="">Hinduism</option>
                                                <option value="">Islam</option>
                                                <option value="">Judaism</option>
                                            </select>
                                            <input type="checkbox" id="" name="" value="">
                                            <label for="">Religious Traditions</label><br>
                                            <input type="checkbox" id="" name="" value="">
                                            <label for="">Historical Context</label><br>
                                            <input type="checkbox" id="" name="" value="">
                                            <label for="">Theology</label><br>
                                            <input type="checkbox" id="" name="" value="">
                                            <label for="">Religious Practices</label><br>
                                            <input type="checkbox" id="" name="" value="">
                                            <label for="">Ethics</label><br>
                                            <input type="checkbox" id="" name="" value="">
                                            <label for="">Social Issues</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

    <!--pasaylo sa js pls-->
    <script>
    let minimize = document.querySelector('#minimize');
    let sidebar = document.querySelector('.sidebar');
    let textImage = document.querySelector('#text');
    let minmaxImage = document.querySelector('#minmax');

    minimize.onclick = function () {
        sidebar.classList.toggle('active');
        if (sidebar.classList.contains('active')) {
            textImage.style.display = 'none';
            minmaxImage.src = '../assets/img/maximize.png';
        } else {
            textImage.style.display = 'inline-block';
            minmaxImage.src = '../assets/img/minimize.png';
        }
    };
    </script>

</html>