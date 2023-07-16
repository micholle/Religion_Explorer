$(function() {
    $.ajax({
        url: "../../ajax/showSidebar.ajax.php",
        method: "POST",
        success:function(data){
            $("#communitySubmissionsSidebar").html(data);
        }
    });

    $.ajax({
        url: "../../ajax/getCommunityData.ajax.php",
        method: "POST",
        success:function(data){
            var communityData = data;

            for (let photo in communityData["photos"]) {
                var photoList = communityData["photos"][photo];
                for (photoData in photoList) {
                    var photoDetails = photoList[photoData];

                    var [year, month, day] = photoDetails.date.split('-');
                    var formattedDate = `${month}-${day}-${year}`;
                    
                    var photoDisplay =
                    '<div id="" class="d-flex flex-column libraryMediaContainer libraryWideContainer">' +
                        '<div class="row d-flex justify-content-center align-items-center">' +
                            '<div class="col-12 libraryMediaHeader">' +
                                '<div class="row">' +
                                    '<div class="col-12">' +
                                        '<div class="row">' +
                                            '<div class="col-12">' +
                                                '<h1>' + photoData + '</h1>' +
                                            '</div>' +
                                        '</div>' +
                                        '<div class="row">' +
                                            '<div class="col-12 d-flex flex-row">' +
                                                '<p>' + photoDetails.author + '</p><p>•<p>' + formattedDate + '</p>' +
                                            '</div>' +
                                        '</div>' +
                                    '</div>' +
                                '</div>' +
                            '</div>' +
                        '</div>' +

                        '<div class="row">' +
                            '<div class="col-12 d-flex justify-content-center align-items-center">' +
                                '<img src="' + photoDetails.filedata + '">' +
                            '</div>' +
                        '</div>' +

                        '<div class="row d-flex justify-content-start align-items-center flex-row libraryMediaInteractions">' +
                            '<div class="col-11 d-flex justify-content-start align-items-center mediaInteractionsLeft">' +
                                '<img class="libraryActions" src="../assets/img/download.png">' +
                                '<img class="libraryActions" src="../assets/img/alert.png" id="reportPhotoSubmission">' +
                                '<img class="libraryActions" src="../assets/img/broken-link.png">' +
                            '</div>' +
                            '<div class="col-1 d-flex justify-content-end align-items-center mediaInteractionsRight">' +
                                '<img class="libraryActions" src="../assets/img/bookmark-white.png">' +
                            '</div>' +
                        '</div>' +

                        '<div class="row">' +
                            '<div class="col-12">' +
                                '<p>' + photoDetails.description + '</p>' +
                            '</div>' +
                        '</div>' +
                    '</div>';

                    $("#communitySubPhotos").append(photoDisplay);
                }
            }

            for (let video in communityData["videos"]) {
                var videoList = communityData["videos"][video];
                for (videoData in videoList) {
                    var videoDetails = videoList[videoData];

                    var [year, month, day] = videoDetails.date.split('-');
                    var formattedDate = `${month}-${day}-${year}`;

                    var videoDisplay = 
                    '<div id="" class="d-flex flex-column libraryMediaContainer libraryWideContainer">' +
                        '<div class="row d-flex justify-content-center align-items-center">' +
                            '<div class="col-12 libraryMediaHeader">' +
                                '<div class="row">' +
                                    '<div class="col-12">' +
                                        '<div class="row">' +
                                            '<div class="col-12">' +
                                                '<h1>' + videoData + '</h1>' +
                                            '</div>' +
                                        '</div>' +
                                        '<div class="row">' +
                                            '<div class="col-12 d-flex flex-row">' +
                                                '<p>' + videoDetails.author + '</p><p>•<p>' + formattedDate + '</p>' +
                                            '</div>' +
                                        '</div>' +
                                    '</div>' +
                                '</div>' +
                            '</div>' +
                        '</div>' +

                        '<div class="row">' +
                            '<div class="col-12 d-flex justify-content-center align-items-center" style="max-width: 100vw;">' +
                                '<video class="communitySubVideo" muted controls> <source src=' + videoDetails.filedata + '> </video>' +
                            '</div>' +
                        '</div>' +

                        '<div class="row d-flex justify-content-start align-items-center flex-row libraryMediaInteractions">' +
                            '<div class="col-11 d-flex justify-content-start align-items-center mediaInteractionsLeft">' +
                                '<img class="libraryActions" src="../assets/img/download.png">' +
                                '<img class="libraryActions" src="../assets/img/alert.png" id="reportVideoSubmission">' +
                                '<img class="libraryActions" src="../assets/img/broken-link.png">' +
                            '</div>' +
                            '<div class="col-1 d-flex justify-content-end align-items-center mediaInteractionsRight">' +
                                '<img class="libraryActions" src="../assets/img/bookmark-white.png">' +
                            '</div>' +
                        '</div>' +

                        '<div class="row">' +
                            '<div class="col-12">' +
                                '<p>' + videoDetails.description + '</p>' +
                            '</div>' +
                        '</div>' +
                    '</div>';

                    $("#communitySubVideos").append(videoDisplay);
                }
            }
            
            for (let readingMaterial in communityData["readingMaterials"]) {
                var readingMaterialsList = communityData["readingMaterials"][readingMaterial];
            
                for (let readingMaterialData in readingMaterialsList) {
                    var readingMaterialDetails = readingMaterialsList[readingMaterialData];

                    var [year, month, day] = readingMaterialDetails.date.split('-');
                    var formattedDate = `${month}-${day}-${year}`;   

                    var readingMaterialsDisplay =
                    '<div id="" class="d-flex flex-column libraryMediaContainer libraryWideContainer">' +
                        '<div class="row d-flex justify-content-center align-items-center">' +
                            '<div class="col-12 libraryMediaHeader">' +
                                '<div class="row">' +
                                    '<div class="col-12">' +
                                        '<div class="row">' +
                                            '<div class="col-12 d-flex">' +
                                                '<h1>' + readingMaterialData + '</h1>' +
                                                '<div class="libraryReadMatsTag" style="margin-left: 5px">' + readingMaterialDetails.religion + '</div>' +
                                            '</div>' +
                                        '</div>' +
                                        '<div class="row">' +
                                            '<div class="col-12 d-flex flex-row">' +
                                                '<p>' + readingMaterialDetails.author + '</p><p>•<p>' + formattedDate + '</p>' +
                                            '</div>' +
                                        '</div>' +
                                    '</div>' +
                                '</div>' +
                            '</div>' +
                        '</div>' +

                        '<div class="row d-flex justify-content-start align-items-center flex-row libraryMediaInteractions">' +
                            '<div class="col-11 d-flex justify-content-start align-items-center mediaInteractionsLeft">' +
                                '<img class="libraryActions" src="../assets/img/download.png">' +
                                '<img class="libraryActions" src="../assets/img/alert.png" id="reportReadMatSubmission">' +
                                '<img class="libraryActions" src="../assets/img/broken-link.png">' +
                            '</div>' +
                            '<div class="col-1 d-flex justify-content-end align-items-center mediaInteractionsRight">' +
                                '<img class="libraryActions" src="../assets/img/bookmark-white.png">' +
                            '</div>' +
                        '</div>' +

                        '<div class="row">' +
                            '<div class="col-12">' +
                                '<p>' + readingMaterialDetails.description + '</p>' +
                            '</div>' +
                        '</div>' +
                    '</div>';


                    $("#communitySubBlogs").append(readingMaterialsDisplay);

                    // var jsonTopics = JSON.parse(readingMaterialDetails.topics)

                    // var formattedTopics = "";
                    // jsonTopics.forEach(topic => {
                    //     formattedTopics += '<div class="libraryReadMatsTag" style="margin: 3px">' + topic + '</div>';
                    // });

                    // var showReadingMaterial = "<div class='communityReadingMaterials' onclick='viewContent(\"" + readingMaterialDetails.contentid + "\")'>" + readingMaterialData + " | " + "<div class='libraryReadMatsTag' style='margin: 3px'>" + readingMaterialDetails.religion + "</div>" + formattedTopics + "</div><div>" + readingMaterialDetails.author + " | " + formattedDate+ "<br>" + readingMaterialDetails.description + "</div> <br>"
                    // $("#communityReadingMaterials").append(showReadingMaterial);

                }
            }            
        }
    });

    $("#reportPhotoSubmission").click(function(){
        $('#reportContentModal').modal();
        $('#reportContentModal').show();
    });

    $("#reportVideoSubmission").click(function(){
        $('#reportContentModal').modal();
        $('#reportContentModal').show();
    });

    $("#reportReadMatSubmission").click(function(){
        $('#reportContentModal').modal();
        $('#reportContentModal').show();
    });

    const tabs = document.querySelectorAll('.communitySubmissionsTabBtn')
    const all_content = document.querySelectorAll('.communitySubmissionsContent')

    tabs.forEach((tab, index)=>{
        tab.addEventListener('click', (e)=>{
        tabs.forEach(tab=>{tab.classList.remove('active')})
        tab.classList.add('active');

        all_content.forEach(content=>{content.classList.remove('active')});
        all_content[index].classList.add('active');
        })
    })

    function activateTab(tabId) {
        const tabs = document.querySelectorAll(".communitySubmissionsTabBtn");
        const contents = document.querySelectorAll(".communitySubmissionsContent");
      
        // Remove the "active" class from all tabs and contents
        tabs.forEach((tab) => tab.classList.remove("active"));
        contents.forEach((content) => content.classList.remove("active"));
      
        // Activate the specified tab and content
        const activeTab = document.querySelector(`[data-tab="${tabId}"]`);
        const activeContent = document.getElementById(tabId);
        if (activeTab && activeContent) {
          activeTab.classList.add("active");
          activeContent.classList.add("active");
        }
    }
      
      // Check the URL for the "openTab" parameter and activate the corresponding tab
    const urlParams = new URLSearchParams(window.location.search);
    const openTabParam = urlParams.get("openTab");
        if (openTabParam) {
        activateTab(openTabParam);
    }      
});