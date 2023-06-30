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
    </head>
    <body>
        <div id="librarySidebar"></div>
        <div class="mainContent">
            <div>
                Library of Resources
                <input type="search" id="communitySearch" name="communitySearch" placeholder="Search">
            </div>
            <div>
                Basic Information
                <div class="libraryBasicInformation">
                    <button id="libraryBuddhismInformation">Buddhism</button>
                    <button id="libraryChristianityInformation">Christianity</button>
                    <button id="libraryHinduismInformation">Hinduism</button>
                    <button id="libraryIslamInformation">Islam</button>
                    <button id="libraryJudaismInformation">Judaism</button>
                </div>
            </div>
            <div id="libraryFilter">
                <form>
                    <label for="libraryReligion">Religion:</label><br>
                    <select id="libraryReligion" name="libraryReligion">
                        <option selected hidden disabled>Choose Religion</option>
                        <option value="">Buddhism</option>
                        <option value="">Christianity</option>
                        <option value="">Hinduism</option>
                        <option value="">Islam</option>
                        <option value="">Judaism</option>
                    </select><br>
                    <input type="checkbox" id="religious traditions" name="religious traditions" value="religious traditions">
                    <label for="religious traditions">Religious Traditions</label><br>
                    <input type="checkbox" id="historical context" name="historical context" value="historical context">
                    <label for="historical context">Historical Context</label><br>
                    <input type="checkbox" id="theology" name="theology" value="theology">
                    <label for="theology">Theology</label><br>
                    <input type="checkbox" id="religious practices" name="religious practices" value="religious practices">
                    <label for="religious practices">Religious Practices</label><br>
                    <input type="checkbox" id="ethics" name="ethics" value="ethics">
                    <label for="ethics">Ethics</label><br>
                    <input type="checkbox" id="social issues" name="social issues" value="social issues">
                    <label for="social issues">Social Issues</label><br>
                </form>
            </div>
            <div id="libraryPhotos" >
                Photos
            </div>
            <div id="libraryVideos">
                Videos
            </div>
            <div id="libraryReadingMaterials">
                Reading Materials
            </div>
            <div id="libraryPhotosPreview">
                Photos
            </div>
            <div id="libraryVideosPreview">
                Videos
            </div>
            <div id="libraryReadingMaterialsPreview">
                Reading Materials
            </div>
        </div>

        <!-- Modal -->
        <div id="reportUserDiv"></div>
        <div class="modal fade" id="libraryBasicInformationModal">
            <div class="modal-dialog modal-xs modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header" id="libraryBasicInformationHeader"></div>
                    <div class="modal-body" id="libraryBasicInformationContent"></div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="resultModal">
            <div class="modal-dialog modal-xs modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header" id="resultHeader"></div>
                    <div class="modal-body" id="resultContent"></div>
                </div>
            </div>
        </div>
    </body>
</html>