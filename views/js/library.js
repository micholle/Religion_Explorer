$(function() {
    var acctype = $('#acctype').text();
    $.ajax({
        url: "../../ajax/showSidebar.ajax.php",
        method: "POST",
        success:function(data){
            $("#librarySidebar").html(data);
        }
    });
    
    const urlParams = new URLSearchParams(window.location.search);
    const openParam = urlParams.get("open");
    if (openParam) {
        openWideView(openParam);
    } else {
        changeLink();
    }

    $.ajax({
        url: "../../ajax/getLibraryResources.ajax.php",
        method: "POST",
        success:function(data){
            var libraryData = data;
            var photoPreviewCounter = 0;
            var videoPreviewCounter = 0;
            var readingMarsPreviewCounter = 0;

            for (let photo in libraryData["photos"]) {
                var photoDetails = libraryData["photos"][photo];

                // Wide
                $libraryPhotosMats =
                '<div id="' + photo +'" class="flex-column libraryMediaContainer libraryWideContainer">' +
                    '<div class="row d-flex justify-content-center align-items-center">' +
                        '<div class="col-12 libraryMediaHeader">' +
                            '<div class="row">' +
                                '<div class="col-12">' +
                                    '<h1>' + photoDetails.title + '</h1>' +
                                    '<p>' + photoDetails.author + '</p>' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                    '</div>' +

                    '<div class="row">' +
                        '<div class="col-12 d-flex justify-content-center align-items-center">' +
                            '<img src="' + photoDetails.file +'">' +
                        '</div>' +
                    '</div>' +

                    '<div class="row d-flex justify-content-start align-items-center flex-row libraryMediaInteractions">' +
                        '<div class="col-11 d-flex justify-content-start align-items-center mediaInteractionsLeft">' +
                            '<img class="libraryActions" src="../assets/img/download.png" onclick="downloadPhoto(\'' + photoDetails.file + '\')">' +
                            '<img class="libraryActions" src="../assets/img/broken-link.png" onclick="copyResourceLink(\'' + photo + '\')">' +
                        '</div>' +
                        '<div class="col-1 d-flex justify-content-end align-items-center mediaInteractionsRight">' +
                        (acctype === 'regular' ? '<img id="' + photo + "Bookmark" +'" class="libraryActions" src="../assets/img/bookmark-white.png" onclick="bookmarkResource(this, \'' + photo + '\', \'' + photoDetails.title + '\')">' : '') +
                        '</div>' +
                    '</div>' +

                    '<div class="row">' +
                        '<div class="col-12">' +
                            '<p>' + photoDetails.description +'</p>' +
                        '</div>' +
                    '</div>' +
                '</div>';

                $("#libraryPhotosContainer").append($libraryPhotosMats);

                // Small
                if (photoPreviewCounter <= 1) {
                    $("#libraryPhotosPreview").append("<img id='" + photo + "' src=" + photoDetails.file +" class='libraryPreview' data-identifier='libraryPreview'> &nbsp;");
                    photoPreviewCounter++;
                }
            }

            for (let video in libraryData["videos"]) {
                var videoDetails = libraryData["videos"][video];

                // Wide
                $libraryVideosMats = 
                '<div id="' + video +'" class="flex-column libraryMediaContainer libraryWideContainer">' +
                    '<div class="row d-flex justify-content-center align-items-center">' +
                        '<div class="col-12 libraryMediaHeader">' +
                           ' <div class="row">' +
                                '<div class="col-12">' +
                                    '<h1>' + videoDetails.title + '</h1>' +
                                    '<p>' + videoDetails.author + '</p>' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                    '</div>' +

                    '<div class="row">' +
                        '<div class="col-12 d-flex justify-content-center align-items-center">' +
                            '<video controls class="libraryVideo"> <source src="' + videoDetails.file +'"> </video>' +
                        '</div>' +
                    '</div>' +

                    '<div class="row d-flex justify-content-start align-items-center flex-row libraryMediaInteractions">' +
                        '<div class="col-11 d-flex justify-content-start align-items-center mediaInteractionsLeft">' +
                            '<img class="libraryActions" src="../assets/img/download.png" onclick="downloadVideo(\'' + videoDetails.file + '\')">' +
                            '<img class="libraryActions" src="../assets/img/broken-link.png" onclick="copyResourceLink(\'' + video + '\')">' +
                        '</div>' +
                        '<div class="col-1 d-flex justify-content-end align-items-center mediaInteractionsRight">' +
                        (acctype === 'regular' ? '<img id="' + video + "Bookmark" +'"  class="libraryActions" src="../assets/img/bookmark-white.png" onclick="bookmarkResource(this, \'' + video + '\', \'' + videoDetails.title + '\')">' : '') +
                        '</div>' +
                    '</div>' +

                    '<div class="row">' +
                        '<div class="col-12">'
                            '<p>' + videoDetails.description + '</p>' +
                        '</div>' +
                    '</div>' +
                '</div>';

                $("#libraryVideosContainer").append($libraryVideosMats);

                // Small
                
                if (videoPreviewCounter <= 1) {
                    $("#libraryVideosPreview").append("<video id='" + video + "' class='libraryPreview' data-identifier='libraryPreview' controls> <source src=" + videoDetails.file +"> </video> &nbsp;");
                    videoPreviewCounter++;
                }

            }
            
            for (let readingMat in libraryData["readingMats"]) {
                var readingMatDetails = libraryData["readingMats"][readingMat];

                // Wide
                var tags = "";

                $.each(readingMatDetails.category, function(index, category) {
                    tags += '<div class="libraryReadMatsTag"><p style="color: #FFFFFF">' + category + '</p></div>&nbsp;';
                });

                $libraryReadingMats =
                        '<div id="' + readingMat +'" class="libraryReadMatsBox" onclick="showReadingMaterialModal(' + "'" + readingMat + "', '" + readingMatDetails.resourceImg + "', '" + readingMatDetails.title + "', '" + readingMatDetails.author + "', '" + readingMatDetails.date + "', '" + readingMatDetails.source + "', '" + readingMatDetails.mainPoint1 + "', '" + readingMatDetails.mainPoint2 + "', '" + readingMatDetails.mainPoint3 + "' " + ')"> <div class="row"> <div class="col-12 d-flex justify-content-start align-items-center flex-row libraryReadMatsHeader">' +
                            '<div class="libraryReadMatsType">[' + readingMatDetails.type + ']</div>' +
                            '<div class="libraryReadMatsTitle">' + readingMatDetails.title + '</div>' +
                            tags + '</div> </div> ' +
                            '<div class="row"> <div class="col-12 d-flex justify-content-start align-items-center flex-row libraryReadMatsSubheader">' +
                            '<p>' + readingMatDetails.author + ' - ' + readingMatDetails.date + '</p> </div> </div>' +
                            '<div class="row libraryReadMatsSummary"> <div class="col-12">' +
                            '<p>' + readingMatDetails.description + '</p>' +
                        '</div> </div> </div>';

                $("#libraryReadMatsContainer").append($libraryReadingMats);

                // Small
                $libraryReadingMatsPreview =
                '<div id="' + readingMat + '" data-identifier="libraryPreview" style="cursor: pointer;">' +
                    '<div class="row">' +
                        '<div class="col-12 d-flex justify-content-start align-items-center flex-row libraryReadMatsHeader">' +
                            '<div class="libraryReadMatsType">[' + readingMatDetails.type + ']</div>' +
                            '<div class="libraryReadMatsTitle">' + readingMatDetails.title + '</div>' +
                        '</div>' +
                    '</div>' + 
                    '<div class="row">' +
                        '<div class="col-12 d-flex justify-content-start align-items-center flex-row libraryReadMatsSubheader">' +
                            '<p>' + readingMatDetails.author + '</p>' +
                        '</div>' +
                ' </div>' +
                    '<div class="row libraryReadMatsSummary">' +
                        '<div class="col-12">' +
                            '<p>' + readingMatDetails.description + '</p>' +
                        '</div>' +
                    '</div>' +
                '</div><br>';

                if (readingMarsPreviewCounter <= 1) {
                    $("#libraryReadingMatsPreview").append($libraryReadingMatsPreview);
                    readingMarsPreviewCounter++;
                }
            }
        }
    });

    setBookmark();

    $(".libraryBasicInfoBox").click(function(){
        $.ajax({
            url: "../../ajax/getLibraryBasicInfo.ajax.php",
            method: "POST",
            data: {"religion" : $(this).attr("id")},
            success:function(data){
                var basicInfo = data;
                
                for (let religion in basicInfo) {
                    var basicInfoDetails = basicInfo[religion];
                    $("#borderLeftImg").attr("src", basicInfoDetails["borderLeftImg"]);
                    $("#borderRightImg").attr("src", basicInfoDetails["borderRightImg"]);
                    $("#basicInfoModalTitle").html(religion);
                    $("#basicInfoDescription").html(basicInfoDetails["religionDesc"])
                    $("#sacredScripture").html(basicInfoDetails["sacredScripture"]);
                    $("#sacredScriptureImg").attr("src", basicInfoDetails["sacredScriptureImg"]);
                    $("#sacredScriptureDesc").html(basicInfoDetails["sacredScriptureDesc"]);
                    $("#placeOfWorship").html(basicInfoDetails["placeOfWorship"]);
                    $("#placeOfWorshipImg").attr("src", basicInfoDetails["placeOfWorshipImg"]);
                    $("#placeOfWorshipDesc").html(basicInfoDetails["placeOfWorshipDesc"]);
                    $("#sacredSymbol").html(basicInfoDetails["sacredSymbol"]);
                    $("#sacredSymbolImg").attr("src", basicInfoDetails["sacredSymbolImg"]);
                    $("#sacredSymbolDesc").html(basicInfoDetails["sacredSymbolDesc"]);
                }
                }
        });
        $('#libraryBasicInfoModal').modal();
    });

    var search = getUrlParameter("search");
    if (search) {
        $("#librarySearch").val(decodeURIComponent(search));
        librarySearch();
    }

    var view = getUrlParameter("view");
    if (view) {
        $("#viewContent").html(decodeURIComponent(view));
        librarySearch();
    }

    function getUrlParameter(name) {
        name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
        var regex = new RegExp("[\\?&]" + name + "=([^&#]*)");
        var results = regex.exec(location.search);
        return results === null ? "" : results[1].replace(/\+/g, " ");
    }

    $("#librarySearch").keyup(function () { 
        librarySearch();
    });

    $(document).on("click", '[data-identifier="libraryPreview"]', function() {
        var resourceId = $(this).attr("id");
        if(resourceId.startsWith("LP")) {
            window.location.href = "http://localhost/religion_explorer/views/modules/library.php?open=photos&view=" + resourceId;
        } else if(resourceId.startsWith("LV")) {
            window.location.href = "http://localhost/religion_explorer/views/modules/library.php?open=videos&view=" + resourceId;
        } else if(resourceId.startsWith("LR")) {
            window.location.href = "http://localhost/religion_explorer/views/modules/library.php?open=reading-materials&view=" + resourceId;
        }
        $("#viewContent").html(decodeURIComponent(resourceId));
        librarySearch();
    });

    function librarySearch() {
        if (view) {
            var librarySearchVal = view;

            $.ajax({
                url: "../../ajax/getLibraryResources.ajax.php",
                method: "POST",
                success:function(data){
                    var libraryData = data;
                    const currentURL = window.location.href;
        
                    if (currentURL.includes("photos")) {
                        for (let photo in libraryData["photos"]) {        
                            if (photo == librarySearchVal) {
                                var resourceid = "#" + photo;
                                $(resourceid).css("display", "block");
                            } else {
                                var resourceid = "#" + photo;
                                $(resourceid).css("display", "none");
                            }
                        }
                    }
        
                    if (currentURL.includes("videos")) {
                        for (let video in libraryData["videos"]) {
                            if (video == librarySearchVal) {
                                var resourceid = "#" + video;
                                $(resourceid).css("display", "block");
                            } else {
                                var resourceid = "#" + video;
                                $(resourceid).css("display", "none");
                            }
                        }
                    }
                    
                    if (currentURL.includes("reading-materials")) {
                        for (let readingMat in libraryData["readingMats"]) {        
                            if (readingMat == librarySearchVal) {
                                var resourceid = "#" + readingMat;
                                $(resourceid).css("display", "block");
                                $(resourceid).click();
                            } else {
                                var resourceid = "#" + readingMat;
                                $(resourceid).css("display", "none");
                            }
                        }
                    }
                }
            });            
        } else {
            var librarySearchVal = $("#librarySearch").val().toLowerCase();

            $.ajax({
                url: "../../ajax/getLibraryResources.ajax.php",
                method: "POST",
                success:function(data){
                    var libraryData = data;
                    const currentURL = window.location.href;
                    
                    if (currentURL.includes("photos")) {
                        for (let photo in libraryData["photos"]) {
                            var photoDetails = libraryData["photos"][photo];
        
                            if (((photoDetails.title).toLowerCase()).includes(librarySearchVal) || ((photoDetails.author).toLowerCase()).includes(librarySearchVal) || ((photoDetails.description).toLowerCase()).includes(librarySearchVal)) {
                                var resourceid = "#" + photo;
                                $(resourceid).css("display", "block");
                            } else {
                                var resourceid = "#" + photo;
                                $(resourceid).css("display", "none");
                            }
                        }
                    } else if (currentURL.includes("videos")) {
                        for (let video in libraryData["videos"]) {
                            var videoDetails = libraryData["videos"][video];
        
                            if (((videoDetails.title).toLowerCase()).includes(librarySearchVal) || ((videoDetails.author).toLowerCase()).includes(librarySearchVal) || ((videoDetails.description).toLowerCase()).includes(librarySearchVal)) {
                                var resourceid = "#" + video;
                                $(resourceid).css("display", "block");
                            } else {
                                var resourceid = "#" + video;
                                $(resourceid).css("display", "none");
                            }
                        }
                    } else if (currentURL.includes("reading-materials")) {
                        for (let readingMat in libraryData["readingMats"]) {
                            var readingMatDetails = libraryData["readingMats"][readingMat];
        
                            if (((readingMatDetails.title).toLowerCase()).includes(librarySearchVal) || ((readingMatDetails.type).toLowerCase()).includes(librarySearchVal) || ((readingMatDetails.author).toLowerCase()).includes(librarySearchVal) || ((readingMatDetails.description).toLowerCase()).includes(librarySearchVal)) {
                                var resourceid = "#" + readingMat;
                                $(resourceid).css("display", "block");
                            } else {
                                var resourceid = "#" + readingMat;
                                $(resourceid).css("display", "none");
                            }
                        }
                    }
                }
            });
        }
    }

    function handleFilterChange() { 
        var libraryReligion = $("#libraryReligionFilter").val();
        var libraryFilters = $(".libraryCategoryFilter:checked").map(function() {
          return $(this).val();
        }).get();

        $.ajax({
            url: "../../ajax/getLibraryResources.ajax.php",
            method: "POST",
            success:function(data){
                var libraryData = data;
                const currentURL = window.location.href;

                if (currentURL.includes("photos")) {
                    for (let photo in libraryData["photos"]) {
                        var photoDetails = libraryData["photos"][photo];
                        var resourceid = "#" + photo;

                        if ($(".libraryCategoryFilter:checked").length == 0) {
                            if (libraryReligion == "All Religions") {
                                $(resourceid).css("display", "block");
                            } else {
                                if (libraryReligion == photoDetails.religion) {
                                    $(resourceid).css("display", "block");
                                } else {
                                    $(resourceid).css("display", "none");
                                }
                            }
                        } else {
                            if (libraryReligion == "All Religions") {
                                $.each(photoDetails.category, function(index, category) {
                                    if (libraryFilters.includes(category)) {
                                        $(resourceid).css("display", "block");
                                    } else {
                                        $(resourceid).css("display", "none");
                                    }
                                });
                            } else {
                                if (libraryReligion == photoDetails.religion) {
                                    $.each(photoDetails.category, function(index, category) {
                                        if (libraryFilters.includes(category)) {
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
    
                if (currentURL.includes("videos")) {
                    for (let video in libraryData["videos"]) {
                        var videoDetails = libraryData["videos"][video];
                        var resourceid = "#" + video;

                        if ($(".libraryCategoryFilter:checked").length == 0) {
                            if (libraryReligion == "All Religions") {
                                $(resourceid).css("display", "block");
                            } else {
                                if (libraryReligion == videoDetails.religion) {
                                    $(resourceid).css("display", "block");
                                } else {
                                    $(resourceid).css("display", "none");
                                }
                            }
                        } else {
                            if (libraryReligion == "All Religions") {
                                $.each(videoDetails.category, function(index, category) {
                                    if (libraryFilters.includes(category)) {
                                        $(resourceid).css("display", "block");
                                    } else {
                                        $(resourceid).css("display", "none");
                                    }
                                });
                            } else {
                                if (libraryReligion == videoDetails.religion) {
                                    $.each(videoDetails.category, function(index, category) {
                                        if (libraryFilters.includes(category)) {
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
                
                if (currentURL.includes("reading-materials")) {
                    for (let readingMat in libraryData["readingMats"]) {
                        var readingMatDetails = libraryData["readingMats"][readingMat];
                        var resourceid = "#" + readingMat;
                        
                        if ($(".libraryCategoryFilter:checked").length == 0) {
                            if (libraryReligion == "All Religions") {
                                $(resourceid).css("display", "block");
                            } else {
                                if (libraryReligion == readingMatDetails.religion) {
                                    $(resourceid).css("display", "block");
                                } else {
                                    $(resourceid).css("display", "none");
                                }
                            }
                        } else {
                            if (libraryReligion == "All Religions") {
                                $.each(readingMatDetails.category, function(index, category) {
                                    if (libraryFilters.includes(category)) {
                                        $(resourceid).css("display", "block");
                                    } else {
                                        $(resourceid).css("display", "none");
                                    }
                                });
                            } else {
                                if (libraryReligion == readingMatDetails.religion) {
                                    $.each(readingMatDetails.category, function(index, category) {
                                        if (libraryFilters.includes(category)) {
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
        });
    }

    $("#libraryReligionFilter, .libraryCategoryFilter").on("change", handleFilterChange);

    $("#libraryPhotosSeeMore").click(function () { 
        viewPhotos();
    });

    $("#libraryVideosSeeMore").click(function () { 
        viewVideos();
    });

    $("#libraryReadingMaterialsSeeMore").click(function () { 
        viewReadingMaterials();
    });

});

function viewPhotos() {
    $("#libraryReadingMaterialsWide").attr("hidden", true);
    $("#libraryPhotosWide").removeAttr("hidden");
    $("#libraryVideosWide").attr("hidden", true);

    $("#libraryPhotosSmall").attr("hidden", true);
    $("#libraryVideosSmall").removeAttr("hidden");
    $("#libraryReadingMaterialsSmall").removeAttr("hidden");

    changeLink();
}

function viewVideos() {
    $("#libraryReadingMaterialsWide").attr("hidden", true);
    $("#libraryPhotosWide").attr("hidden", true);
    $("#libraryVideosWide").removeAttr("hidden");

    $("#libraryPhotosSmall").removeAttr("hidden");
    $("#libraryVideosSmall").attr("hidden", true);
    $("#libraryReadingMaterialsSmall").removeAttr("hidden");

    changeLink();
}

function viewReadingMaterials() {
    $("#libraryReadingMaterialsWide").removeAttr("hidden");
    $("#libraryPhotosWide").attr("hidden", true);
    $("#libraryVideosWide").attr("hidden", true);

    $("#libraryPhotosSmall").removeAttr("hidden");
    $("#libraryVideosSmall").removeAttr("hidden");
    $("#libraryReadingMaterialsSmall").attr("hidden", true);

    changeLink();
}

function changeLink() {
    var open = "";
    if (!$("#libraryReadingMaterialsWide").is(":hidden")) {
        open = "reading-materials";
    } else if (!$("#libraryPhotosWide").is(":hidden")) {
        open = "photos";
    } else if (!$("#libraryVideosWide").is(":hidden")) {
        open = "videos";
    } 

    const currentURL = new URL(window.location.href);
    currentURL.searchParams.set("open", open);
    window.history.pushState({}, '', currentURL.toString());
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

function openWideView(openParam) {
    if (openParam == "reading-materials") {
        viewReadingMaterials();
    } else if (openParam == "photos") {
        viewPhotos();
    } else if (openParam == "videos") {
        viewVideos();
    }
}

function showReadingMaterialModal(resourceid, resourceImg, title, author, date, source, mainPoint1, mainPoint2, mainPoint3) {
    $("#readingMaterialTitle").text(title);
    $("#readingMaterialBg").attr("src", resourceImg);
    $("#readingMaterialAuthor").text(author);
    $("#readingMaterialDate").text(date);
    $("#readingMaterialSource").html("<p><a href=" + source +">[External Link]</a></p>");
    $("#readingMaterial1").text(mainPoint1);
    $("#readingMaterial2").text(mainPoint2);
    $("#readingMaterial3").text(mainPoint3);

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
            }

            if (bookmarks.includes(resourceid)) {
                $("#readingMaterialBookmark").html('<img class="libraryActions" src="../assets/img/bookmark-black.png" onclick="bookmarkResource(this, \'' + resourceid + '\', \'' + title + '\')">');
            } else {
                $("#readingMaterialBookmark").html('<img class="libraryActions" src="../assets/img/bookmark-white.png" onclick="bookmarkResource(this, \'' + resourceid + '\', \'' + title + '\')">');

            }
        }
    });

    $('#readingMaterialOverview').modal();
    $('#readingMaterialOverview').show();
}

function downloadPhoto(file) {
    fetch(file)
    .then(response => response.blob())
    .then(blob => {
      const url = URL.createObjectURL(blob);
      const link = document.createElement('a');
      link.href = url;
      link.download = "image.jpg";
      link.style.display = "none";
      document.body.appendChild(link);
      link.click();
      document.body.removeChild(link);
      URL.revokeObjectURL(url);
    });
}

function downloadVideo(file) {
    fetch(file)
    .then(response => response.blob())
    .then(blob => {
    const url = URL.createObjectURL(blob);
    const link = document.createElement('a');
    link.href = url;
    link.download = "video.mp4";
    link.style.display = "none";
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    URL.revokeObjectURL(url);
    });
}

function copyResourceLink(resourceid) {
    var link = "";
    if(resourceid.startsWith("LP")) {
        link = "http://localhost/religion_explorer/views/modules/library.php?open=photos&view=" + resourceid;
    } else if(resourceid.startsWith("LV")) {
        link = "http://localhost/religion_explorer/views/modules/library.php?open=videos&view=" + resourceid;
    }

    navigator.clipboard.writeText(link);

    $("#toast").html("Link copied to clipboard.")

    $('#toast').addClass('show');

    setTimeout(function() {
        $('#toast').removeClass('show');
    }, 2000);
}

function bookmarkResource(thisIcon, resourceid, resourceTitle) {
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

                if(bookmarkDetails["resourceid"] == resourceid) {
                    var bookmarkid = bookmarkDetails["bookmarkid"];

                    $.ajax({
                        url: "../../ajax/removeFromBookmarks.ajax.php",
                        method: "POST",
                        data: {"bookmarkid" : bookmarkid},
                        success:function(){
                            $(thisIcon).attr("src", "../assets/img/bookmark-white.png");
                            $("#toast").html('"' + resourceTitle +  '" was removed from the bookmarks.')
                            $('#toast').addClass('show');
                        
                            setTimeout(function() {
                                $('#toast').removeClass('show');
                            }, 2000);
                        },
                        error: function() {
                            $(thisIcon).attr("src", "../assets/img/bookmark-black.png");
                            $("#toast").html('Error removing "' + resourceTitle +  '" from the bookmarks.')
                            $('#toast').addClass('show');
                    
                            setTimeout(function() {
                                $('#toast').removeClass('show');
                            }, 2000);
                        }
                    });
                }
            }

            if (!bookmarks.includes(resourceid)) {
                $.ajax({
                    url: "../../ajax/addToBookmarks.ajax.php",
                    method: "POST",
                    data: {"accountid" : $("#accountidPlaceholder").text(), "resourceid" : resourceid, "resourceTitle" : resourceTitle},
                    success:function(){
                        $(thisIcon).attr("src", "../assets/img/bookmark-black.png");
                        $("#toast").html('"' + resourceTitle +  '" was added to the bookmarks.')
                        $('#toast').addClass('show');
                
                        setTimeout(function() {
                            $('#toast').removeClass('show');
                        }, 2000);
                    },
                    error: function() {
                        $(thisIcon).attr("src", "../assets/img/bookmark-white.png");
                        $("#toast").html('Error adding "' + resourceTitle +  '" to the bookmarks.')
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