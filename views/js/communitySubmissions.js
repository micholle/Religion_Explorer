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
                                '<img onclick="downloadContent(' + "'" + photoDetails.filedata + '\', \'' + photoDetails.filename + '\')" class="libraryActions" src="../assets/img/download.png">' +
                                '<img onclick="reportContent(' + "'" + photoData + '\', \'' + photoDetails.creationid + '\')" class="libraryActions" src="../assets/img/alert.png">' +
                                '<img onclick="copyContentLink(' + "'" + photoDetails.creationid + "'" + ')" class="libraryActions" src="../assets/img/broken-link.png">' +
                                '<img id="deleteCreationBtn" class="libraryActions" src="../assets/img/x-mark.png">' +
                            '</div>' +
                            '<div class="col-1 d-flex justify-content-end align-items-center mediaInteractionsRight">' +
                                '<img onclick="bookmarkContent(this, \'' + photoDetails.creationid + '\', \'' + photoData + '\')" class="libraryActions" src="../assets/img/bookmark-white.png">' +
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
                                '<video class="communitySubVideo" controls> <source src=' + videoDetails.filedata + '> </video>' +
                            '</div>' +
                        '</div>' +

                        '<div class="row d-flex justify-content-start align-items-center flex-row libraryMediaInteractions">' +
                            '<div class="col-11 d-flex justify-content-start align-items-center mediaInteractionsLeft">' +
                                '<img onclick="downloadContent(' + "'" + videoDetails.filedata + '\', \'' + videoDetails.filename + '\')" class="libraryActions" src="../assets/img/download.png">' +
                                '<img onclick="reportContent(' + "'" + videoData + '\', \'' + videoDetails.creationid + '\')" class="libraryActions" class="libraryActions" src="../assets/img/alert.png" id="reportVideoSubmission">' +
                                '<img onclick="copyContentLink(' + "'" + videoDetails.creationid + "'" + ')" class="libraryActions" src="../assets/img/broken-link.png">' +
                                '<img id="deleteCreationBtn" class="libraryActions" src="../assets/img/x-mark.png">' +
                            '</div>' +
                            '<div class="col-1 d-flex justify-content-end align-items-center mediaInteractionsRight">' +
                                '<img onclick="bookmarkContent(this, \'' + videoDetails.creationid + '\', \'' + videoData + '\')" class="libraryActions" src="../assets/img/bookmark-white.png">' +
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
                                // '<img class="libraryActions" src="../assets/img/download.png">' +
                                '<img onclick="reportContent(' + "'" + readingMaterialData + '\', \'' + readingMaterialDetails.creationid + '\')" class="libraryActions" src="../assets/img/alert.png" id="reportReadMatSubmission">' +
                                '<img onclick="copyContentLink(' + "'" + readingMaterialDetails.creationid + "'" + ')" class="libraryActions" src="../assets/img/broken-link.png">' +
                                '<img id="deleteCreationBtn" class="libraryActions" src="../assets/img/x-mark.png">' +
                            '</div>' +
                            '<div class="col-1 d-flex justify-content-end align-items-center mediaInteractionsRight">' +
                                '<img onclick="bookmarkContent(this, \'' + readingMaterialDetails.creationid + '\', \'' + readingMaterialData + '\')" class="libraryActions" src="../assets/img/bookmark-white.png">' +
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

    $("#deleteCreationBtn").click(function(){
        $('#confirmDeleteCreationModal').modal();
        $('#confirmDeleteCreationModal').show();
    });
    
    $("#submitReportContent").click(function() {    
        var atLeastOneCheckboxChecked = false;
        $("input[type=checkbox]", "#reportUserModal").each(function() {
            if (this.checked) {
                atLeastOneCheckboxChecked = true;
                return false;
            }
        });
    
        if (!atLeastOneCheckboxChecked && $("#othersSpecify").val() == "") {
            $("#toast").html("Please fill out all required fields.")
            $("#toast").css("background-color", "#E04F5F");
            $("#toast").addClass('show');
        
            setTimeout(function() {
                $("#toast").removeClass('show');
            }, 2000);
        } else {
            var contentViolationsArray = []; 
            var reportedContentid = $("#reportContentid").text();
            var additionalContext = $("#reportContentAdditional").val();
            var reportedBy = $("#accountUsernamePlaceholder").text();
            
            var currentDate = new Date();
            var year = currentDate.getFullYear();
            var month = String(currentDate.getMonth() + 1).padStart(2, '0');
            var day = String(currentDate.getDate()).padStart(2, '0');
            var reportedOn = `${year}-${month}-${day}`;

            var checkboxes = document.querySelectorAll('input[type="checkbox"]');

            checkboxes.forEach(checkbox => {
              if (checkbox.checked) {
                contentViolationsArray.push(checkbox.value);
              }
            });

            if($("#othersSpecify").val() != "") {
                contentViolationsArray.push($("#othersSpecify").val());
            }

            var contentViolations = contentViolationsArray.join(', ');

            reportData = new FormData();
            reportData.append("contentid" , reportedContentid);
            reportData.append("contentViolations" , contentViolations);
            reportData.append("additionalContext", additionalContext);
            reportData.append("reportedOn", reportedOn);
            reportData.append("reportedBy", reportedBy);
    
            $.ajax({
                url: "../../ajax/submitReportContent.ajax.php",
                method: "POST",
                data: reportData,
                dataType: "text",
                processData: false,
                contentType: false,
                success: function() {
                    $("#reportContentIcon").attr("src", "../assets/img/verification-check.png");
                    $("#reportContentStatus").text("Report Received");
                    $("#reportContentMessage").text("The team will review your complaint. Please expect a notification in 3-5 business days.");
                },
                error: function() {
                    $("#reportContentIcon").attr("src", "../assets/img/verification-error.png");
                    $("#reportContentStatus").text("Error");
                    $("#reportContentMessage").text("There was an error processing your request. Please try again later.");
                    $("#reportContentNoticeButton").css("background-color", "#E04F5F");
                },
                complete: function() {
                    $("#reportContentModal").removeClass("fade").modal("hide");
                    $("#reportContentModal").modal("dispose");
            
                    $("#reportContentNotice").modal();
                    $("#reportContentNotice").show();

                    $("#reportContentForm")[0].reset();
                    $("#reportContentAdditional").val("");
                }
            });
        }
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

function downloadContent(file, filename) {
    fetch(file)
    .then(response => response.blob())
    .then(blob => {
      const url = URL.createObjectURL(blob);
      const link = document.createElement('a');
      link.href = url;
      link.download = filename;
      link.style.display = "none";
      document.body.appendChild(link);
      link.click();
      document.body.removeChild(link);
      URL.revokeObjectURL(url);
    });
}

function reportContent(title, contentid) {
    $("#reportContentHeader").html("");
    $("#communityDisplayModal").removeClass("fade").modal("hide");
    $("#communityDisplayModal").modal("dispose");

    $("#reportContentHeader").html("<br>" + title);
    $("#reportContentid").html("<br>" + contentid);
    $("#reportContentModal").modal();
}

function copyContentLink(file) {
    var imageLink = ((window.location.href).substring(0, (window.location.href).indexOf("communitySubmissions.php") + "communitySubmissions.php".length)) + "/" + file.substring(file.indexOf("assets/"));
    navigator.clipboard.writeText(imageLink);

    $("#toast").html("Link copied to clipboard.")

    $('#toast').addClass('show');

    setTimeout(function() {
        $('#toast').removeClass('show');
    }, 2000);
}

function bookmarkContent(thisIcon, creationid, title) {
    $.ajax({
        url: "../../ajax/getBookmarksData.ajax.php",
        method: "POST",
        data: {"accountid" : $("#accountidPlaceholder").text()},
        success:function(data){
            var bookmarksList = data;
            var bookmarks = [];

            for (let bookmark in bookmarksList) {
                var bookmarkDetails = bookmarksList[bookmark];
                bookmarks.push(bookmarkDetails["resourceid"]);

                if(bookmarkDetails["resourceid"] == creationid) { 
                    var bookmarkid = bookmarkDetails["bookmarkid"];

                    $.ajax({
                        url: "../../ajax/removeFromBookmarks.ajax.php",
                        method: "POST",
                        data: {"bookmarkid" : bookmarkid},
                        success:function(){
                            $(thisIcon).attr("src", "../assets/img/bookmark-white.png");
                            $("#toast").html('"' + title +  '" was removed from the bookmarks.')
                            $('#toast').addClass('show');
                        
                            setTimeout(function() {
                                $('#toast').removeClass('show');
                            }, 2000);
                        },
                        error: function() {
                            $(thisIcon).attr("src", "../assets/img/bookmark-black.png");
                            $("#toast").html('Error removing "' + title +  '" from the bookmarks.')
                            $("#toast").css("background-color", "#E04F5F");
                            $('#toast').addClass('show');
                    
                            setTimeout(function() {
                                $('#toast').removeClass('show');
                            }, 2000);
                        }
                    });
                }
            }

            if (!bookmarks.includes(creationid)) {
                $.ajax({
                    url: "../../ajax/addToBookmarks.ajax.php",
                    method: "POST",
                    data: {"accountid" : $("#accountidPlaceholder").text(), "resourceid" : creationid, "resourceTitle" : title},
                    success:function(){
                        $(thisIcon).attr("src", "../assets/img/bookmark-black.png");
                        $("#toast").html('"' + title +  '" was added to the bookmarks.');
                        $('#toast').addClass('show');
                
                        setTimeout(function() {
                            $('#toast').removeClass('show');
                        }, 2000);
                    },
                    error: function() {
                        $(thisIcon).attr("src", "../assets/img/bookmark-white.png");
                        $("#toast").html('Error adding "' + title +  '" to the bookmarks.');
                        $("#toast").css("background-color", "#E04F5F");
                        $('#toast').addClass('show');
                
                        setTimeout(function() {
                            $('#toast').removeClass('show');
                        }, 2000);
                    }
                });
            }
        }
    });
}