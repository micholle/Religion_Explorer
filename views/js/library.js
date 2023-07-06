$(function() {
    $.ajax({
        url: "../../ajax/showSidebar.ajax.php",
        method: "POST",
        success:function(data){
            $("#librarySidebar").html(data);
        }
    });

    $.ajax({
        url: "../../ajax/getLibraryResources.ajax.php",
        method: "POST",
        success:function(data){
            var libraryData = data;
            var photoPreviewCounter = 0;
            var videoPreviewCounter = 0;

            for (let photo in libraryData["photos"]) {
                var photoDetails = libraryData["photos"][photo];
                $("#libraryPhotosPreview").append("<img onclick='viewContent(\"" + photoDetails.contentid + "\")' src=" + photoDetails.file +" class='libraryPreview'> &nbsp;");
                photoPreviewCounter++;

                if (photoPreviewCounter == 2) {
                    break;
                }
            }

            for (let video in libraryData["videos"]) {
                var videoDetails = libraryData["videos"][video];
                $("#libraryVideosPreview").append("<video onclick='viewContent(\"" + videoDetails.contentid + "\")' class='libraryPreview' controls> <source src=" + videoDetails.file +"> </video> &nbsp;");
                videoPreviewCounter++;

                if (videoPreviewCounter == 2) {
                    break;
                }
            }
            
            for (let readingMat in libraryData["readingMats"]) {
                var readingMatDetails = libraryData["readingMats"][readingMat];
                var tags = "";

                $.each(readingMatDetails.category, function(index, category) {
                    tags += '<div class="libraryReadMatsTag"><p style="color: #FFFFFF">' + category + '</p></div>&nbsp;';
                });

                $libraryreadingMats =
                        '<div id="' + readingMatDetails.resourceid +'" class="libraryReadMatsBox"> <div class="row"> <div class="col-12 d-flex justify-content-start align-items-center flex-row libraryReadMatsHeader">' +
                            '<div class="libraryReadMatsType">[' + readingMatDetails.type + ']</div>' +
                            '<div class="libraryReadMatsTitle">' + readingMat + '</div>' +
                            tags + '</div> </div> ' +
                            '<div class="row"> <div class="col-12 d-flex justify-content-start align-items-center flex-row libraryReadMatsSubheader">' +
                            '<p>' + readingMatDetails.author + '</p> </div> </div>' +
                            '<div class="row libraryReadMatsSummary"> <div class="col-12">' +
                            '<p>' + readingMatDetails.description + '</p>' +
                        '</div> </div> </div>';

                $("#libraryReadMatsContainer").append($libraryreadingMats);
            }
        }
    });

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

    function getUrlParameter(name) {
        name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
        var regex = new RegExp("[\\?&]" + name + "=([^&#]*)");
        var results = regex.exec(location.search);
        return results === null ? "" : results[1].replace(/\+/g, " ");
    }

    $("#librarySearch").keyup(function () { 
        librarySearch();
    });

    function librarySearch() {
        var librarySearchVal = $("#librarySearch").val().toLowerCase();

        $.ajax({
            url: "../../ajax/getLibraryResources.ajax.php",
            method: "POST",
            success:function(data){
                var libraryData = data;
    
                // for (let photo in libraryData["photos"]) {
                //     var photoDetails = libraryData["photos"][photo];
                // }
    
                // for (let video in libraryData["videos"]) {
                //     var videoDetails = libraryData["videos"][video];
                // }
                
                for (let readingMat in libraryData["readingMats"]) {
                    var readingMatDetails = libraryData["readingMats"][readingMat];

                    if ((readingMat.toLowerCase()).includes(librarySearchVal) || ((readingMatDetails.type).toLowerCase()).includes(librarySearchVal) || ((readingMatDetails.author).toLowerCase()).includes(librarySearchVal) || ((readingMatDetails.description).toLowerCase()).includes(librarySearchVal)) {
                        var resourceid = "#" + readingMatDetails.resourceid;
                        $(resourceid).css("display", "block");
                    } else {
                        var resourceid = "#" + readingMatDetails.resourceid;
                        $(resourceid).css("display", "none");
                    }
                }
            }
        });
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
    
                // for (let photo in libraryData["photos"]) {
                //     var photoDetails = libraryData["photos"][photo];
                // }
    
                // for (let video in libraryData["videos"]) {
                //     var videoDetails = libraryData["videos"][video];
                // }
                
                for (let readingMat in libraryData["readingMats"]) {
                    var readingMatDetails = libraryData["readingMats"][readingMat];
                    var resourceid = "#" + readingMatDetails.resourceid;
                    
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
        });
    }

    $("#libraryReligionFilter, .libraryCategoryFilter").on("change", handleFilterChange);

});