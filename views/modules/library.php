<?php session_start(); 
if (!isset($_SESSION['accountid']) || empty($_SESSION['accountid'])) {
    // Redirect the user to splash.php
    header("Location: splash.php");
    exit(); // Terminate the script to prevent further execution
}
?>
<!doctype html>
<html lang="en">
    <head>
        <title>Religion Explorer: Library of Resources</title>
        <link rel="icon" type="image/x-icon" href="../assets/img/applogo.png">
        <script type="text/javascript" src="../assets/js/jquery-3.6.4.min.js"></script>
        <script type="text/javascript" src="../assets/plugins/bootstrap-4.0.0/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript" src="../assets/plugins/js-summarize-master/lib/lodash/lodash.js"></script>
        <script type="text/javascript" src="../assets/plugins/js-summarize-master/lib/tokenizer/tokenizer.js"></script>
        <script type="text/javascript" src="../assets/plugins/js-summarize-master/js-summarize.js"></script>

        <script type="text/javascript" src="../js/library.js"></script>
        <script type="text/javascript" src="../js/script.js"></script>

        <link type="text/css" rel="stylesheet" href="../assets/plugins/bootstrap-4.0.0/css/bootstrap.min.css">
        <link type="text/css" rel="stylesheet" href="../assets/css/styles.css">
    </head>
    <body>
        <div id="librarySidebar"></div>
        <div id="acctype" hidden><?php echo $_SESSION['acctype']; ?></div>
        <div id="accountidPlaceholder" hidden><?php echo $_SESSION['accountid']; ?></div>
        <div id="accountUsernamePlaceholder" hidden><?php echo $_SESSION['username']; ?></div>

        <div class="pageContainer">
            <div class="container mw-100 mh-100">
                <div class="row d-flex justify-content-center align-items-center pageHeader">
                    <div class="col-4 d-flex justify-content-start align-items-center">
                        <a href="library.php" class="pageHeaderLink"><h1>Library of Resources</h1></a>
                    </div>
                    <div class="col-8 d-flex justify-content-start align-items-center">
                        <input type="search" id="librarySearch" name="" placeholder="Search the Library">
                    </div>
                </div>

                <div class="row pageContent">
                    <div class="col-7">
                        <div class="row">
                            <div class="col-12 libraryBasicInfoContainer">
                                <div class="row d-flex justify-content-center align-items-center">
                                    <div class="col-12 d-flex justify-content-start align-items-start">
                                        <h1>Basic Information</h1>
                                    </div>
                                </div>
                                <div class="row d-flex justify-content-center align-items-center flex-row">
                                    <div class="col-2 d-flex justify-content-center align-items-center flex-column">
                                        <div class="libraryBasicInfoBox" id="Buddhism">
                                            <img src="../assets/img/lib-buddhism.png">
                                        </div>
                                        <p>Buddhism</p>
                                    </div>
                                    
                                    <div class="col-2 d-flex justify-content-center align-items-center flex-column">
                                        <div class="libraryBasicInfoBox" id="Christianity">
                                            <img src="../assets/img/lib-christianity.png">
                                        </div>
                                        <p>Christianity</p>
                                    </div>

                                    <div class="col-2 d-flex justify-content-center align-items-center flex-column">
                                        <div class="libraryBasicInfoBox" id="Hinduism">
                                            <img src="../assets/img/lib-hinduism.png">
                                        </div>
                                        <p>Hinduism</p>
                                    </div>

                                    <div class="col-2 d-flex justify-content-center align-items-center flex-column">
                                        <div class="libraryBasicInfoBox" id="Islam">
                                            <img src="../assets/img/lib-islam.png">
                                        </div>
                                        <p>Islam</p>
                                    </div>

                                    <div class="col-2 d-flex justify-content-center align-items-center flex-column">
                                        <div class="libraryBasicInfoBox" id="Judaism">
                                            <img src="../assets/img/lib-judaism.png">
                                        </div>
                                        <p>Judaism</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--Reading Materials-->
                        <div class="row libraryMainContainer" id="libraryReadingMaterialsWide">
                            <div class="col-12">
                                <div class="row d-flex justify-content-center align-items-center">
                                    <div class="col-12 d-flex justify-content-start align-items-start">
                                        <h1 id="">Reading Materials</h1>
                                    </div>
                                </div>
                                <div id="" class="row d-flex justify-content-center align-items-center flex-row">
                                    <div class="col-12 flex-column">
                                        <div id="libraryReadMatsContainer"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!--Photos Wide-->
                        <div class="row libraryMainContainer" id="libraryPhotosWide" hidden>
                            <div class="col-12">
                                <div class="row d-flex justify-content-center align-items-center">
                                    <div class="col-12 d-flex justify-content-start align-items-start">
                                        <h1 id="">Photos</h1>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-center align-items-center flex-column">
                                <div id="libraryPhotosContainer"></div>
                            </div>
                        </div>

                        <!--Videos Wide-->
                        <div class="row libraryMainContainer" id="libraryVideosWide" hidden>
                            <div class="col-12">
                                <div class="row d-flex justify-content-center align-items-center">
                                    <div class="col-12 d-flex justify-content-start align-items-start">
                                        <h1 id="">Videos</h1>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-center align-items-center flex-column">
                                <div id="libraryVideosContainer"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-5">
                        <div class="row libraryRightContainer">
                            <div class="col-12 libraryRightContBox">
                                <p>Religion:</p>
                                <select id="libraryReligionFilter">
                                    <option selected value="All Religions">All Religions</option>
                                    <option value="Buddhism">Buddhism</option>
                                    <option value="Christianity">Christianity</option>
                                    <option value="Hinduism">Hinduism</option>
                                    <option value="Islam">Islam</option>
                                    <option value="Judaism">Judaism</option>
                                </select>
                                <input type="checkbox" class="libraryCategoryFilter" id="Religious Traditions" value="Religious Traditions">
                                <label for="Religious Traditions">Religious Traditions</label><br>
                                <input type="checkbox" class="libraryCategoryFilter" id="Historical Context" value="Historical Context">
                                <label for="Historical Context">Historical Context</label><br>
                                <input type="checkbox" class="libraryCategoryFilter" id="Theology" value="Theology">
                                <label for="Theology">Theology</label><br>
                                <input type="checkbox" class="libraryCategoryFilter" id="Religious Practices" value="Religious Practices">
                                <label for="Religious Practices">Religious Practices</label><br>
                                <input type="checkbox" class="libraryCategoryFilter" id="Ethics" value="Ethics">
                                <label for="Ethics">Ethics</label><br>
                                <input type="checkbox" class="libraryCategoryFilter" id="Social Issues" value="Social Issues">
                                <label for="Social Issues">Social Issues</label>
                            </div>
                        </div>
                        <!--Photos Small-->
                        <div class="row libraryRightContainer" id="libraryPhotosSmall">
                            <h1>Photos</h1>
                            <div class="col-12 d-flex justify-content-center align-items-center flex-column libraryRightContBox">
                                <div class="row d-flex flex-row">
                                    <div id="libraryPhotosPreview" class="col-12 d-flex justify-content-center align-items-center"></div>
                                </div>
                                <div class="row d-flex flex-row">
                                    <div class="col-12 d-flex justify-content-center align-items-center">
                                        <button class="roundedButton librarySeeMore" id="libraryPhotosSeeMore">See More</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--Videos Small-->
                        <div class="row libraryRightContainer" id="libraryVideosSmall">
                            <h1>Videos</h1>
                            <div class="col-12 d-flex justify-content-center align-items-center flex-column libraryRightContBox">
                                <div class="row d-flex flex-row">
                                    <div id="libraryVideosPreview" class="col-12 d-flex justify-content-center align-items-center"></div>
                                </div>
                                <div class="row d-flex flex-row">
                                    <div class="col-12 d-flex justify-content-center align-items-center">
                                        <button class="roundedButton librarySeeMore" id="libraryVideosSeeMore">See More</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--Reading Materials Small-->
                        <div class="row libraryRightContainer" id="libraryReadingMaterialsSmall" hidden>
                            <h1>Reading Materials</h1>
                            <div class="col-12 d-flex justify-content-center align-items-center flex-column libraryRightContBox">
                                <div class="row d-flex justify-content-center align-items-center flex-row">
                                    <div id="libraryReadingMatsPreview" class="libraryReadMatsBox"></div>
                                </div>
                                <div class="row d-flex flex-row">
                                    <div class="col-12 d-flex justify-content-center align-items-center">
                                        <button class="roundedButton librarySeeMore" id="libraryReadingMaterialsSeeMore">See More</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="toast" class="toast"></div>

        <!-- Modal -->
        <div class="modal fade" id="libraryBasicInfoModal">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-0 text-center">
                        <div class="container">
                            <div class="row d-flex justify-content-center align-items-center">
                                <div class="col-2">
                                    <img id="borderLeftImg" src="">
                                </div>
                                <div class="col-3">
                                    <h5 class="modal-title w-100" id="basicInfoModalTitle"></h5>
                                </div>
                                <div class="col-2">
                                    <img id="borderRightImg" src="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                <p id="basicInfoDescription"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="basicItemsBox d-flex justify-content-center align-items-center flex-column">
                                        <p class="basicItemsBoxTitle">Sacred Scripture</p>
                                        <p id="sacredScripture"></p>
                                        <img id="sacredScriptureImg" src="">
                                        <p id="sacredScriptureDesc"></p>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="basicItemsBox d-flex justify-content-center align-items-center flex-column">
                                        <p class="basicItemsBoxTitle">Place of Worship</p>
                                        <p id="placeOfWorship"></p>
                                        <img id="placeOfWorshipImg" src="">
                                        <p id="placeOfWorshipDesc"></p>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="basicItemsBox d-flex justify-content-center align-items-center flex-column">
                                        <p class="basicItemsBoxTitle">Sacred Symbol</p>
                                        <p id="sacredSymbol"></p>
                                        <img id="sacredSymbolImg" src="">
                                        <p id="sacredSymbolDesc"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="readingMaterialOverview">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-4 readingMaterialImg">
                                <img id="readingMaterialBg" class="readingMaterialBg" src="">
                            </div>

                            <div class="col-8">
                                <div class="row readingMaterialHeader d-flex justify-content-center align-items-center">
                                    <div class="col-1">
                                    </div>
                                    <div class="col-10 d-flex justify-content-center align-items-center flex-row readingMaterialTitle">
                                        <h1 id="readingMaterialTitle"></h1>
                                    </div>
                                    <?php
                                    if ($_SESSION['acctype'] === 'regular'){
                                    echo '<div id="readingMaterialBookmark" class="col-1 d-flex justify-content-end align-items-center flex-row readingMaterialTitle"></div>';
                                    }
                                    ?>

                                    <div class="row">
                                        <div class="col-12 d-flex justify-content-center align-items-center flex-row">
                                            <p id="readingMaterialAuthor"></p>
                                            <p>•</p>
                                            <p id="readingMaterialDate"></p>
                                            <p>•</p>
                                            <div class="readingMaterialEvent" id="readingMaterialSource"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row readingMaterialOveContent">
                                    <div class="col-12 d-flex flex-row">
                                        <p id="readingMaterial1"></p>
                                    </div>
                                </div>

                                <div class="row readingMaterialOveContent">
                                    <div class="col-12 d-flex flex-row">
                                        <p id="readingMaterial2"></p>
                                    </div>
                                </div>

                                <div class="row readingMaterialOveContent">
                                    <div class="col-12 d-flex flex-row">
                                        <p id="readingMaterial3"></p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </body>

</html>