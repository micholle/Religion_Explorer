$(function() {
    var acctype = $('#acctype').text();
    var username = $('#accountUsernamePlaceholder').text();
    $.ajax({
        url: "../../ajax/showSidebar.ajax.php",
        method: "POST",
        success:function(data){
            $("#communitySubmissionsSidebar").html(data);
            var currentPage = window.location.pathname.split("/").pop();

            $("#communitySubmissionsSidebar ul.dropdownMenu li a").each(function() {
                var tabPage = $(this).attr("href");
                if (currentPage.includes("community") || tabPage === currentPage) {
                    $("#communitySubmissionsSidebar li.dropdown a span.navItem:contains('Library of Resources')").parent().css({
                        "background-color": "#EAF7F0",
                        "border": "solid #75C884 2px",
                        "font-weight": "600",
                    });
                }
            });
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
                    '<div id="' + photoDetails.creationid + '" class="flex-column libraryMediaContainer libraryWideContainer">' +
                        '<div class="row d-flex justify-content-center align-items-center pl-0 pr-0">' +
                            '<div class="col-12">' +
                                '<div class="row">' +
                                    '<div class="col-12">' +
                                        '<div class="row">' +
                                            '<div class="col-12">' +
                                                '<h1>' + photoDetails.title + '</h1>' +
                                            '</div>' +
                                        '</div>' +
                                        '<div class="row">' +
                                            '<div class="col-12 flex-row d-flex justify-content-center justify-content-lg-start align-items-start" style="margin-top: -10px;">' +
                                                '<p>' + photoDetails.author + '</p><p>&nbsp•&nbsp</p><p>' + formattedDate + '</p>' +
                                            '</div>' +
                                        '</div>' +
                                    '</div>' +
                                '</div>' +
                            '</div>' +
                        '</div>' +

                        '<div class="row">' +
                            '<div class="col-12 d-flex justify-content-center align-items-center">' +
                                '<img src="' + "../" + photoDetails.filedata + '">' +
                            '</div>' +
                        '</div>' +

                        '<div class="row d-flex justify-content-start align-items-center flex-row libraryMediaInteractions">' +
                            '<div class="col-6 col-lg-11 d-flex justify-content-start align-items-center mediaInteractionsLeft">' +
                                '<img onclick="downloadContent(' + "'" + photoDetails.filedata + '\', \'' + photoDetails.filename + '\')" class="libraryActions" src="../assets/img/download.png">' +
                                (acctype === 'regular' && username !== photoDetails.author ? '<img onclick="reportContent(' + "'" + photoDetails.title + '\', \'' + photoDetails.creationid + '\')" class="libraryActions" src="../assets/img/alert.png">': '') +
                                '<img onclick="copyContentLink(' + "'" + photoDetails.creationid + "'" + ')" class="libraryActions" src="../assets/img/broken-link.png">' +
                            '</div>' +
                            '<div class="col-6 col-lg-1 d-flex justify-content-end align-items-center mediaInteractionsRight">' +
                                (acctype === 'regular' ? '<img id="' + photoDetails.creationid + "Bookmark" + '" onclick="bookmarkContent(this, \'' + photoDetails.creationid + '\', \'' + photoDetails.title + '\')" class="libraryActions" src="../assets/img/bookmark-white.png">' : '') +
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
                    '<div id="' + videoDetails.creationid + '" class="flex-column libraryMediaContainer libraryWideContainer">' +
                        '<div class="row d-flex justify-content-center align-items-center pl-0 pr-0">' +
                            '<div class="col-12">' +
                                '<div class="row">' +
                                    '<div class="col-12">' +
                                        '<div class="row">' +
                                            '<div class="col-12">' +
                                                '<h1>' + videoDetails.title + '</h1>' +
                                            '</div>' +
                                        '</div>' +
                                        '<div class="row">' +
                                            '<div class="col-12 flex-row d-flex justify-content-center justify-content-lg-start align-items-start" style="margin-top: -10px;">' +
                                                '<p>' + videoDetails.author + '</p><p>&nbsp•&nbsp</p><p>' + formattedDate + '</p>' +
                                            '</div>' +
                                        '</div>' +
                                    '</div>' +
                                '</div>' +
                            '</div>' +
                        '</div>' +

                        '<div class="row">' +
                            '<div class="col-12 d-flex justify-content-center align-items-center" style="max-width: 100vw;">' +
                                '<video class="communitySubVideo" controls> <source src=' + "../" + videoDetails.filedata + '> </video>' +
                            '</div>' +
                        '</div>' +

                        '<div class="row d-flex justify-content-start align-items-center flex-row libraryMediaInteractions">' +
                            '<div class="col-6 col-lg-11 d-flex justify-content-start align-items-center mediaInteractionsLeft">' +
                                '<img onclick="downloadContent(' + "'" + videoDetails.filedata + '\', \'' + videoDetails.filename + '\')" class="libraryActions" src="../assets/img/download.png">' +
                                (acctype === 'regular' && username !== photoDetails.author ? '<img onclick="reportContent(' + "'" + videoDetails.title + '\', \'' + videoDetails.creationid + '\')" class="libraryActions" class="libraryActions" src="../assets/img/alert.png" id="reportVideoSubmission">': '') +
                                '<img onclick="copyContentLink(' + "'" + videoDetails.creationid + "'" + ')" class="libraryActions" src="../assets/img/broken-link.png">' +
                            '</div>' +
                            '<div class="col-6 col-lg-1 d-flex justify-content-end align-items-center mediaInteractionsRight">' +
                                (acctype === 'regular' ? '<img id="' + videoDetails.creationid + "Bookmark" + '" onclick="bookmarkContent(this, \'' + videoDetails.creationid + '\', \'' + videoDetails.title + '\')" class="libraryActions" src="../assets/img/bookmark-white.png">' : '') +
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
                    '<div id="' + readingMaterialDetails.creationid + '" class="flex-column libraryMediaContainer libraryWideContainer">' +
                        '<div class="row d-flex justify-content-center align-items-center">' +
                            '<div class="col-12 libraryMediaHeader">' +
                                '<div class="row">' +
                                    '<div class="col-12">' +
                                        '<div class="row">' +
                                            '<div class="col-12 d-flex justify-content-center justify-content-lg-start align-items-start">' +
                                                '<h1>' + readingMaterialDetails.title + '</h1>' +
                                            '</div>' +
                                        '</div>' +
                                        '<div class="row">' +
                                            '<div class="col-12 flex-row d-flex justify-content-center justify-content-lg-start align-items-start">' +
                                                '<p>' + readingMaterialDetails.author + '</p><p>&nbsp•&nbsp</p><p>' + formattedDate + '</p>' +
                                            '</div>' +
                                        '</div>' +
                                        '<div class="row">' +
                                            '<div class="col-12 d-flex flex-row justify-content-center justify-content-lg-start align-items-start">' +
                                                '<div class="libraryReadMatsTag">' + readingMaterialDetails.religion + '</div>' +
                                            '</div>' +
                                        '</div>' +
                                    '</div>' +
                                '</div>' +
                            '</div>' +
                        '</div>' +

                        '<div class="row d-flex justify-content-start align-items-center flex-row libraryMediaInteractions">' +
                            '<div class="col-6 col-lg-11 d-flex justify-content-start align-items-center mediaInteractionsLeft">' +
                                // '<img class="libraryActions" src="../assets/img/download.png">' +
                                (acctype === 'regular' && username !== photoDetails.author ? '<img onclick="reportContent(' + "'" + readingMaterialDetails.title + '\', \'' + readingMaterialDetails.creationid + '\')" class="libraryActions" src="../assets/img/alert.png" id="reportReadMatSubmission">' : '')+
                                '<img onclick="copyContentLink(' + "'" + readingMaterialDetails.creationid + "'" + ')" class="libraryActions" src="../assets/img/broken-link.png">' +
                            '</div>' +
                            '<div class="col-6 col-lg-1 d-flex justify-content-end align-items-center mediaInteractionsRight">' +
                                (acctype === 'regular' ? '<img id="' + readingMaterialDetails.creationid + "Bookmark" + '" onclick="bookmarkContent(this, \'' + readingMaterialDetails.creationid + '\', \'' + readingMaterialDetails.title + '\')" class="libraryActions" src="../assets/img/bookmark-white.png">' :'') +
                            '</div>' +
                        '</div>' +

                        '<div class="row">' +
                            '<div class="col-12">' +
                                '<p>' + readingMaterialDetails.description + '</p>' +
                            '</div>' +
                        '</div>' +
                    '</div>';


                    $("#communitySubBlogs").append(readingMaterialsDisplay);

                }
            }            
        }
    });

    setBookmark();

    $("#submitReportContent").click(function(event) {    
        event.preventDefault();
        
        var contentViolationsArray = []; 
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    
        checkboxes.forEach(checkbox => {
            if (checkbox.checked) {
                contentViolationsArray.push(checkbox.value);
            }
        });
    
        if ($("#contentOthers").val() != "") {
            contentViolationsArray.push($("#contentOthers").val());
        }
    
        if (contentViolationsArray.length != 0) {
            var reportedContentid = $("#reportContentid").text();
            var additionalContext = $("#reportContentAdditional").val();
            var reportedBy = $("#accountidPlaceholder").text();
            
            var currentDate = new Date();
            var year = currentDate.getFullYear();
            var month = String(currentDate.getMonth() + 1).padStart(2, '0');
            var day = String(currentDate.getDate()).padStart(2, '0');
            var reportedOn = `${year}-${month}-${day}`;
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
        } else {
            $("#toast").html("Please fill out all required fields.")
            $("#toast").css("background-color", "#E04F5F");
            $("#toast").addClass('show');
        
            setTimeout(function() {
                $("#toast").removeClass('show');
            }, 2000);
        }
    });

    var view = getUrlParameter("view");
    if (view) {
        $("#viewContent").html(decodeURIComponent(view));
        communitySearch();
    }

    function getUrlParameter(name) {
        name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
        var regex = new RegExp("[\\?&]" + name + "=([^&#]*)");
        var results = regex.exec(location.search);
        return results === null ? "" : results[1].replace(/\+/g, " ");
    }

    $("#communitySearch").keyup(function () { 
        communitySearch();
    });

    function communitySearch() {
        if (view) {
            var communitySearchVal = view;

            $.ajax({
                url: "../../ajax/getCommunityData.ajax.php",
                method: "POST",
                success:function(data){
                    var communityData = data;

                    if ((window.location.href).includes("communitySubPhotos")) {
                        for (let photo in communityData["photos"]) {
                            var photoList = communityData["photos"][photo];
                            for (photoData in photoList) {
                                var photoDetails = photoList[photoData];
        
                                if (photoDetails.creationid == communitySearchVal) {
                                    var creationid = "#" + photoDetails.creationid;
                                    $(creationid).css("display", "block");
                                } else {
                                    var creationid = "#" + photoDetails.creationid;
                                    $(creationid).css("display", "none");
                                }
                            }
                        }
                    }

                    if ((window.location.href).includes("communitySubVideos")) {
                        for (let video in communityData["videos"]) {
                            var videoList = communityData["videos"][video];
                            for (videoData in videoList) {
                                var videoDetails = videoList[videoData];
        
                                if (videoDetails.creationid == communitySearchVal) {
                                    var creationid = "#" + videoDetails.creationid;
                                    $(creationid).css("display", "block");
                                } else {
                                    var creationid = "#" + videoDetails.creationid;
                                    $(creationid).css("display", "none");
                                }
                            }
                        }
                    }
                    
                    if ((window.location.href).includes("communitySubBlogs")) {
                        for (let readingMaterial in communityData["readingMaterials"]) {
                            var readingMaterialList = communityData["readingMaterials"][readingMaterial];
                            for (readingMaterialData in readingMaterialList) {
                                var readingMaterialDetails = readingMaterialList[readingMaterialData];
        
                                if (readingMaterialDetails.creationid == communitySearchVal) {
                                    var creationid = "#" + readingMaterialDetails.creationid;
                                    $(creationid).css("display", "block");
                                } else {
                                    var creationid = "#" + readingMaterialDetails.creationid;
                                    $(creationid).css("display", "none");
                                }
                            }
                        }
                    }  
                }
            });
        } else {
            var communitySearchVal = $("#communitySearch").val().toLowerCase();
            $.ajax({
                url: "../../ajax/getCommunityData.ajax.php",
                method: "POST",
                success:function(data){
                    var communityData = data;

                    if ((window.location.href).includes("communitySubPhotos")) {
                        for (let photo in communityData["photos"]) {
                            var photoList = communityData["photos"][photo];
                            for (photoData in photoList) {
                                var photoDetails = photoList[photoData];
        
                                if ((photoDetails.title).includes(communitySearchVal) || ((photoDetails.religion).toLowerCase()).includes(communitySearchVal) || ((photoDetails.description).toLowerCase()).includes(communitySearchVal) || ((photoDetails.author).toLowerCase()).includes(communitySearchVal)) {
                                    var creationid = "#" + photoDetails.creationid;
                                    $(creationid).css("display", "block");
                                } else {
                                    var creationid = "#" + photoDetails.creationid;
                                    $(creationid).css("display", "none");
                                }
                            }
                        }
                    }

                    if ((window.location.href).includes("communitySubVideos")) {
                        for (let video in communityData["videos"]) {
                            var videoList = communityData["videos"][video];
                            for (videoData in videoList) {
                                var videoDetails = videoList[videoData];
        
                                if ((videoDetails.title).includes(communitySearchVal) || ((videoDetails.religion).toLowerCase()).includes(communitySearchVal) || ((videoDetails.description).toLowerCase()).includes(communitySearchVal) || ((videoDetails.author).toLowerCase()).includes(communitySearchVal)) {
                                    var creationid = "#" + videoDetails.creationid;
                                    $(creationid).css("display", "block");
                                } else {
                                    var creationid = "#" + videoDetails.creationid;
                                    $(creationid).css("display", "none");
                                }
                            }
                        }
                    }
                    
                    if ((window.location.href).includes("communitySubBlogs")) {
                        for (let readingMaterial in communityData["readingMaterials"]) {
                            var readingMaterialList = communityData["readingMaterials"][readingMaterial];
                            for (readingMaterialData in readingMaterialList) {
                                var readingMaterialDetails = readingMaterialList[readingMaterialData];
        
                                if ((readingMaterialDetails.title).includes(communitySearchVal) || ((readingMaterialDetails.religion).toLowerCase()).includes(communitySearchVal) || ((readingMaterialDetails.description).toLowerCase()).includes(communitySearchVal) || ((readingMaterialDetails.author).toLowerCase()).includes(communitySearchVal)) {
                                    var creationid = "#" + readingMaterialDetails.creationid;
                                    $(creationid).css("display", "block");
                                } else {
                                    var creationid = "#" + readingMaterialDetails.creationid;
                                    $(creationid).css("display", "none");
                                }
                            }
                        }
                    }  
                }
            });
        }
    }

    const tabs = document.querySelectorAll('.communitySubmissionsTabBtn')
    const all_content = document.querySelectorAll('.communitySubmissionsContent')

    tabs.forEach((tab, index) => {
        tab.addEventListener('click', (e) => {
            tabs.forEach(tab => {
                tab.classList.remove('active');
            });
            tab.classList.add('active');
    
            all_content.forEach(content => {
                content.classList.remove('active');
            });
            all_content[index].classList.add('active');
    
            const dataTab = tab.getAttribute('data-tab');
            var currentURL = new URL(window.location.href);
    
            if (currentURL.searchParams.has('view')) {
                currentURL.searchParams.delete('view');
            }
    
            currentURL.searchParams.set('openTab', dataTab);
            window.history.pushState({}, '', currentURL.toString());
    
            handleFilterChange();
        });
    });
    

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
    
    function handleFilterChange() { 
        var communityReligion = $("#communityReligionFilter").val();
        var communityFilters = $(".communityCategoryFilter:checked").map(function() {
          return $(this).val();
        }).get();


        $.ajax({
            url: "../../ajax/getCommunityData.ajax.php",
            method: "POST",
            success:function(data){
                var communityData = data;
                const currentURL = window.location.href;

                if (currentURL.includes("communitySubPhotos")) {
                    for (let photo in communityData["photos"]) {
                        var allPhotos = communityData["photos"][photo];

                        for (let img in allPhotos) {
                            var resourceid = "#" + img;
                            var photoDetails = allPhotos[img];
                            var filtersArray = (photoDetails.filters).split(", ");

                            if ($(".communityCategoryFilter:checked").length == 0) {
                                if (communityReligion == "All Religions") {
                                    $(resourceid).css("display", "block");
                                } else {
                                    if (communityReligion == photoDetails.religion) {
                                        $(resourceid).css("display", "block");
                                    } else {
                                        $(resourceid).css("display", "none");
                                    }
                                }
                            } else {
                                if (communityReligion == "All Religions") {
                                    $.each(filtersArray, function(index, filters) {
                                        if (communityFilters.includes(filters)) {
                                            $(resourceid).css("display", "block");
                                        } else {
                                            $(resourceid).css("display", "none");
                                        }
                                    });
                                } else {
                                    if (communityReligion == photoDetails.religion) {
                                        $.each(filtersArray, function(index, filters) {
                                            if (communityFilters.includes(filters)) {
                                                $(resourceid).css("display", "block");
                                            } else {
                                                $(resourceid).css("display", "none");
                                            }
                                        });
                                    } else {
                                        $(resourceid).css("display", "none");
                                    }
                                }
                            }
                        }
                    }
                }
    
                if (currentURL.includes("communitySubVideos")) {
                    for (let video in communityData["videos"]) {
                        var allVideos = communityData["videos"][video];

                        for (let vid in allVideos) {
                            var resourceid = "#" + vid;
                            var videoDetails = allVideos[vid];
                            var filtersArray = (videoDetails.filters).split(", ");

                            if ($(".communityCategoryFilter:checked").length == 0) {
                                if (communityReligion == "All Religions") {
                                    $(resourceid).css("display", "block");
                                } else {
                                    if (communityReligion == videoDetails.religion) {
                                        $(resourceid).css("display", "block");
                                    } else {
                                        $(resourceid).css("display", "none");
                                    }
                                }
                            } else {
                                if (communityReligion == "All Religions") {
                                    $.each(filtersArray, function(index, filters) {
                                        if (communityFilters.includes(filters)) {
                                            $(resourceid).css("display", "block");
                                        } else {
                                            $(resourceid).css("display", "none");
                                        }
                                    });
                                } else {
                                    if (communityReligion == videoDetails.religion) {
                                        $.each(filtersArray, function(index, filters) {
                                            if (communityFilters.includes(filters)) {
                                                $(resourceid).css("display", "block");
                                            } else {
                                                $(resourceid).css("display", "none");
                                            }
                                        });
                                    } else {
                                        $(resourceid).css("display", "none");
                                    }
                                }
                            }
                        }
                    }
                }
                
                if (currentURL.includes("communitySubBlogs")) {
                    for (let readingMat in communityData["readingMaterials"]) {
                        var allReadingMat = communityData["readingMaterials"][readingMat];

                        for (let blog in allReadingMat) {
                            var resourceid = "#" + blog;
                            var readingMatDetails = allReadingMat[blog];
                            var filtersArray = (readingMatDetails.filters).split(", ");
                        
                            if ($(".communityCategoryFilter:checked").length == 0) {
                                if (communityReligion == "All Religions") {
                                    $(resourceid).css("display", "block");
                                } else {
                                    if (communityReligion == readingMatDetails.religion) {
                                        $(resourceid).css("display", "block");
                                    } else {
                                        $(resourceid).css("display", "none");
                                    }
                                }
                            } else {
                                if (communityReligion == "All Religions") {
                                    $.each(filtersArray, function(index, filters) {
                                        if (communityFilters.includes(filters)) {
                                            $(resourceid).css("display", "block");
                                        } else {
                                            $(resourceid).css("display", "none");
                                        }
                                    });
                                } else {
                                    if (communityReligion == readingMatDetails.religion) {
                                        $.each(filtersArray, function(index, filters) {
                                            if (communityFilters.includes(filters)) {
                                                $(resourceid).css("display", "block");
                                            } else {
                                                $(resourceid).css("display", "none");
                                            }
                                        });
                                    } else {
                                        $(resourceid).css("display", "none");
                                    }
                                }
                            }
                        }
                    }  
                }

            }
        });
    }

    $("#communityReligionFilter, .communityCategoryFilter").on("change", handleFilterChange);

    $.ajax({
        url: "../../ajax/getBookmarksData.ajax.php",
        method: "POST",
        data: {"accountid" : $("#accountidPlaceholder").text()},
        success: function(data){
            data.sort(function(a, b) {
                return new Date(b.datetime) - new Date(a.datetime);
            });

            var bookmarkTitle = "";
            var bookmarkPreview = "";
            var bookmarkDescription = "";
            var bookmarksCounter = 0;
    
            for (let bookmark of data) {
    
                if (bookmarksCounter >= 3) {
                    break;
                }

                if ((bookmark.resourceid).startsWith("CC")) {
                    $.ajax({
                        url: "../../ajax/getCommunityData.ajax.php",
                        method: "POST",
                        success:function(data){
                            var communityData = data;

                            for (let photo in communityData["photos"]) {
                                var photoList = communityData["photos"][photo];
                                for (photoData in photoList) {
                                    var photoDetails = photoList[photoData];

                                    if(photoDetails.creationid == bookmark.resourceid) {
                                        bookmarkTitle = photoDetails.title;
                                        bookmarkPreview = '<img src="' + "../" + photoDetails.filedata + '">';
                                        bookmarkDescription = photoDetails.description;

                                        $("#recentlyBookmarked").append(
                                            '<div class="commCreationsBoxContent" id="' + bookmark.resourceid + '" onclick="redirectBookmark(this, \'' + "ccPhoto" + '\')">' +
                                                '<h3>' + bookmarkTitle + '</h3>' +
                                                bookmarkPreview +
                                                '<p>' + bookmarkDescription + '</p>' +
                                            '</div>'
                                        );
                                    }
                                }
                            }
                
                            for (let video in communityData["videos"]) {
                                var videoList = communityData["videos"][video];
                                for (videoData in videoList) {
                                    var videoDetails = videoList[videoData];
                
                                    if(videoDetails.creationid == bookmark.resourceid) {
                                        bookmarkTitle = videoDetails.title;
                                        bookmarkPreview = '<video controls class="commCreationsVideo"> <source src=' + "../" + videoDetails.filedata + '> </video>';
                                        bookmarkDescription = videoDetails.description;

                                        $("#recentlyBookmarked").append(
                                            '<div class="commCreationsBoxContent" id="' + bookmark.resourceid + '" onclick="redirectBookmark(this, \'' + "ccVideo" + '\')">' +
                                                '<h3>' + bookmarkTitle + '</h3>' +
                                                bookmarkPreview +
                                                '<p>' + bookmarkDescription + '</p>' +
                                            '</div>'
                                        );
                                    }

                                }
                            }
                            
                            for (let readingMaterial in communityData["readingMaterials"]) {
                                var readingMaterialsList = communityData["readingMaterials"][readingMaterial];
                            
                                for (let readingMaterialData in readingMaterialsList) {
                                    var readingMaterialDetails = readingMaterialsList[readingMaterialData];

                                    if(readingMaterialDetails.creationid == bookmark.resourceid) {
                                        bookmarkTitle = readingMaterialDetails.title;
                                        bookmarkDescription = readingMaterialDetails.description;

                                        $("#recentlyBookmarked").append(
                                            '<div class="commCreationsBoxContent" id="' + bookmark.resourceid + '" onclick="redirectBookmark(this, \'' + "ccReadingMaterial" + '\')">' +
                                                '<h3>' + bookmarkTitle + '</h3>' +
                                                '<p>' + bookmarkDescription + '</p>' +
                                            '</div>'
                                        );
                                    }
                
                                }
                            }            
                        }
                    });
                } else {
                    $.ajax({
                        url: "../../ajax/getLibraryResources.ajax.php",
                        method: "POST",
                        success:function(data){
                            var libraryData = data;
                
                            for (let photo in libraryData["photos"]) {
                                if (photo == bookmark.resourceid) {
                                    var photoDetails = libraryData["photos"][photo];
                                    bookmarkTitle = photoDetails.title;
                                    bookmarkPreview = '<img src="' + photoDetails.file + '">';
                                    bookmarkDescription = photoDetails.description;

                                    $("#recentlyBookmarked").append(
                                        '<div class="commCreationsBoxContent" id="' + bookmark.resourceid + '" onclick="redirectBookmark(this, \'' + "libPhoto" + '\')">' +
                                            '<h3>' + bookmarkTitle + '</h3>' +
                                            bookmarkPreview +
                                            '<p>' + bookmarkDescription + '</p>' +
                                        '</div>'
                                    );
                                }
                            }
                            
                            for (let video in libraryData["videos"]) {
                                if (video == bookmark.resourceid) {
                                    var videoDetails = libraryData["videos"][video];
                                    bookmarkTitle = videoDetails.title;
                                    bookmarkPreview = '<video controls class="commCreationsVideo"> <source src=' + videoDetails.file + '> </video>';
                                    bookmarkDescription = videoDetails.description;
                                
                                    $("#recentlyBookmarked").append(
                                        '<div class="commCreationsBoxContent" id="' + bookmark.resourceid + '" onclick="redirectBookmark(this, \'' + "libVideo" + '\')">' +
                                            '<h3>' + bookmarkTitle + '</h3>' +
                                            bookmarkPreview +
                                            '<p>' + bookmarkDescription + '</p>' +
                                        '</div>'
                                    );
                                }
                            }                                
                        
                            for (let readingMat in libraryData["readingMats"]) {
                                if (readingMat == bookmark.resourceid) {
                                    var readingMatDetails = libraryData["readingMats"][readingMat];
                            
                                    bookmarkTitle = readingMatDetails.title;
                                    bookmarkPreview = '<img src="' + readingMatDetails.resourceImg + '">';
                                    bookmarkDescription = readingMatDetails.source;

                                    $("#recentlyBookmarked").append(
                                        '<div class="commCreationsBoxContent" id="' + bookmark.resourceid + '" onclick="redirectBookmark(this, \'' + "libReadingMaterial" + '\')">' +
                                            '<h3>' + bookmarkTitle + '</h3>' +
                                            bookmarkPreview +
                                            '<p>' + bookmarkDescription + '</p>' +
                                        '</div>'
                                    );
                                }
                            }
                            
                        }
                    });

                }

                bookmarksCounter++;

            }
        }
    });
    
});

function redirectBookmark(bookmark, bookmarkType){
    console.log(bookmarkType);
    if (bookmarkType == "ccPhoto") {
        window.location.href = "communitySubmissions.php?openTab=communitySubPhotos&view=" +  encodeURIComponent(bookmark.id);
    } else if (bookmarkType == "ccVideo") {
        window.location.href = "communitySubmissions.php?openTab=communitySubVideos&view=" +  encodeURIComponent(bookmark.id);
    } else if (bookmarkType == "ccReadingMaterial") {
        window.location.href = "communitySubmissions.php?openTab=communitySubBlogs&view=" +  encodeURIComponent(bookmark.id);
    } else if (bookmarkType == "libPhoto") {
        window.location.href = "library.php?open=photos&view=" +  encodeURIComponent(bookmark.id);
    } else if (bookmarkType == "libVideo") {
        window.location.href = "library.php?open=videos&view=" +  encodeURIComponent(bookmark.id);
    } else {
        window.location.href = "library.php?open=reading-materials&view=" +  encodeURIComponent(bookmark.id);
    } 

}

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
    var imageLink = ((window.location.href).substring(0, (window.location.href).indexOf("communitySubmissions.php") + "communitySubmissions.php?openTab=communitySubPhotos".length)) + "&view=" +  encodeURIComponent(file.substring(file.indexOf("assets/")));
    navigator.clipboard.writeText(imageLink);

    $("#toast").html("Link copied to clipboard.")

    $('#toast').addClass('show');

    setTimeout(function() {
        $('#toast').removeClass('show');
    }, 2000);
}

function setBookmark() {
    $.ajax({
        url: "../../ajax/getBookmarksData.ajax.php",
        method: "POST",
        data: {"accountid" : $("#accountidPlaceholder").text()},
        success:function(data){
            var bookmarksList = data;

            for (let bookmark in bookmarksList) {
                var bookmarkDetails = bookmarksList[bookmark];
                
                var creationid = "#" + bookmarkDetails["resourceid"] + "Bookmark";
                $(creationid).attr("src", "../assets/img/bookmark-black.png");
            }
        }
    });
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

                        //add explorer points: community creations bookmark                
                        var accountid = $("#accountidPlaceholder").text();

                        var explorerPoint = new FormData();
                        explorerPoint.append("accountid", accountid);
                        explorerPoint.append("pointsource", accountid + "_cc_bookmarked_" + creationid);
                        explorerPoint.append("points", 2);

                        $.ajax({
                            url: '../../ajax/addExplorerPoints.ajax.php',
                            method: "POST",
                            data: explorerPoint,
                            cache: false,
                            contentType: false,
                            processData: false,
                            dataType: "text"
                        });
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