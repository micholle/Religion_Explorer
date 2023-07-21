$(function() {
    $.ajax({
        url: "../../ajax/showSidebar.ajax.php",
        method: "POST",
        success:function(data){
            $("#userProfileSidebar").html(data);
        }
    });

    const tabs = document.querySelectorAll('.userProfileTabBtn')
    const all_content = document.querySelectorAll('.userProfileContent')

    tabs.forEach((tab, index)=>{
        tab.addEventListener('click', (e)=>{
        tabs.forEach(tab=>{tab.classList.remove('active')})
        tab.classList.add('active');

        all_content.forEach(content=>{content.classList.remove('active')});
        all_content[index].classList.add('active');
        })
    })

    getOverview();
    getPosts();
    getTopics();
    createCalendar();
    getPersonalCalendar();
    getBookmarks();
    getCreations();

    $("#confirmDelete").click(function () { 
        $.ajax({
            url: "../../ajax/deleteReportedContent.ajax.php",
            method: "POST",
            data: {"contentid" : $("#deleteContentid").text()},
            success:function(data){
                $("#toast").html("Content deleted.");
            }, error: function() {
                $("#toast").html("There was an error processing your request. Please try again later.")
                $("#toast").css("background-color", "#E04F5F");
            },
            complete: function() {
                $("#confirmDeleteCreationModal").removeClass("fade").modal("hide");
                $("#confirmDeleteCreationModal").modal("dispose");

                $('#toast').addClass('show');
    
                setTimeout(function() {
                    $('#toast').removeClass('show');
                }, 2000);

                var deletedid = "#" + $("#deleteContentid").text();
                $(deletedid).css("display", "none");
                updateCreationsFill();

                $("#userProfileBookmarksList").html("");
                getBookmarks()

                $("#profileOverview").html("");
                getOverview();
            }
        });
    });
});

function getCreations() {
    $.ajax({
        url: "../../ajax/getCommunityData.ajax.php",
        method: "POST",
        success:function(data){
            var communityData = data;
            var creationsMade = "";
            var dataUsed = 0.00;

            for (let photo in communityData["photos"]) {
                var photoList = communityData["photos"][photo];
                for (photoData in photoList) {
                    var photoDetails = photoList[photoData];
                    var imageSize = 0.00;

                    if (photoDetails.author == $("#accountUsernamePlaceholder").text()) {
                        imageSize = photoDetails.filesize  / (1024 * 1024);
                        dataUsed += imageSize;

                        creationsMade =
                        '<div id="' + photoDetails.creationid + '" class="bookmarkContainer">' +
                            '<div class="d-flex" onclick="viewCreationImage(' + "'" + photoDetails.creationid + "'" + ')" style="width:100% !important">' +
                                '<div class="bookmarkImgContainer d-flex justify-content-center align-items-center">' +
                                    '<img src="../assets/img/userProfile/photo.png" class="userProfBookmark">' +
                                '</div>' +
                                '<div class="bookmarkContent d-flex justify-content-start align-items-center">' +
                                    '<p>' + photoDetails.title + '<p>' +
                                '</div>' +
                                '<p>' + imageSize.toFixed(2) + 'MB <p>' +
                            '</div>' +
                            '<img class="userProfileCreationsActions" src="../assets/img/x-mark.png" onclick="deleteCreation(' + "'" + photoDetails.creationid + "'" + ')">' +
                        '</div>';

                        $("#userProfileCreationsList").append(creationsMade);
                    }
                }
            }

            for (let video in communityData["videos"]) {
                var videoList = communityData["videos"][video];
                for (videoData in videoList) {
                    var videoDetails = videoList[videoData];
                    var videoSize = 0.00;

                    if (videoDetails.author == $("#accountUsernamePlaceholder").text()) {
                        videoSize = videoDetails.filesize / (1024 * 1024);
                        dataUsed += videoSize;

                        creationsMade =
                        '<div id="' + videoDetails.creationid + '" class="bookmarkContainer">' +
                            '<div class="d-flex" onclick="viewCreationVideo(' + "'" + videoDetails.creationid + "'" + ')" style="width:100% !important">' +
                                '<div class="bookmarkImgContainer d-flex justify-content-center align-items-center">' +
                                    '<img src="../assets/img/userProfile/video.png" class="userProfBookmark">' +
                                '</div>' +
                                '<div class="bookmarkContent d-flex justify-content-start align-items-center">' +
                                    '<p>' + videoDetails.title + '<p>' +
                                '</div>' +
                                '<p>' + videoSize.toFixed(2) + 'MB <p>' +
                            '</div>' +
                            '<img class="userProfileCreationsActions" src="../assets/img/x-mark.png" onclick="deleteCreation(' + "'" + videoDetails.creationid + "'" + ')">' +
                        '</div>';

                        $("#userProfileCreationsList").append(creationsMade);
                    }
                }
            }
            
            for (let readingMaterial in communityData["readingMaterials"]) {
                var readingMaterialList = communityData["readingMaterials"][readingMaterial];
                for (readingMaterialData in readingMaterialList) {
                    var readingMaterialDetails = readingMaterialList[readingMaterialData];
                    var readingMaterialSize = 0.00;

                    if (readingMaterialDetails.author == $("#accountUsernamePlaceholder").text()) {
                        readingMaterialSize = readingMaterialDetails.filesize / 1024;
                        dataUsed += readingMaterialDetails.filesize / (1024 * 1024);

                        creationsMade =
                        '<div id="' + readingMaterialDetails.creationid + '" class="bookmarkContainer">' +
                            '<div class="d-flex" onclick="viewCreationReadingMaterial(' + "'" + readingMaterialDetails.creationid + "'" + ')" style="width:100% !important">' +
                                '<div class="bookmarkImgContainer d-flex justify-content-center align-items-center">' +
                                    '<img src="../assets/img/userProfile/readmat.png" class="userProfBookmark">' +
                                '</div>' +
                                '<div class="bookmarkContent d-flex justify-content-start align-items-center">' +
                                    '<p>' + readingMaterialDetails.title + '<p>' +
                                '</div>' +
                                '<p>' + readingMaterialSize.toFixed(2) + 'KB <p>' +
                            '</div>' +
                            '<img class="userProfileCreationsActions" src="../assets/img/x-mark.png" onclick="deleteCreation(' + "'" + readingMaterialDetails.creationid + "'" + ')">' +
                        '</div>';
    
                        $("#userProfileCreationsList").append(creationsMade);
                    }
                }
            }

            updateFill(dataUsed);
            $("#creationsDescription").text(dataUsed.toFixed(2) + " MB of 100 MB used");
        }
    });
}

function updateCreationsFill() {
    $.ajax({
        url: "../../ajax/getCommunityData.ajax.php",
        method: "POST",
        success:function(data){
            var communityData = data;
            var dataUsed = 0.00;

            for (let photo in communityData["photos"]) {
                var photoList = communityData["photos"][photo];
                for (photoData in photoList) {
                    var photoDetails = photoList[photoData];
                    var imageSize = 0.00;

                    if (photoDetails.author == $("#accountUsernamePlaceholder").text()) {
                        imageSize = photoDetails.filesize  / (1024 * 1024);
                        dataUsed += imageSize;
                    }
                }
            }

            for (let video in communityData["videos"]) {
                var videoList = communityData["videos"][video];
                for (videoData in videoList) {
                    var videoDetails = videoList[videoData];
                    var videoSize = 0.00;

                    if (videoDetails.author == $("#accountUsernamePlaceholder").text()) {
                        videoSize = videoDetails.filesize / (1024 * 1024);
                        dataUsed += videoSize;
                    }
                }
            }
            
            for (let readingMaterial in communityData["readingMaterials"]) {
                var readingMaterialList = communityData["readingMaterials"][readingMaterial];
                for (readingMaterialData in readingMaterialList) {
                    var readingMaterialDetails = readingMaterialList[readingMaterialData];
                    var readingMaterialSize = 0.00;

                    if (readingMaterialDetails.author == $("#accountUsernamePlaceholder").text()) {
                        readingMaterialSize = readingMaterialDetails.filesize / 1024;
                        dataUsed += readingMaterialDetails.filesize / (1024 * 1024);
                    }
                }
            }

            updateFill(dataUsed);
            $("#creationsDescription").text(dataUsed.toFixed(2) + " MB of 100 MB used");
        }
    });
}

function updateFill(percentage) {
    const fillElement = document.querySelector('.creationsFill');
    fillElement.style.width = percentage + '%';
    fillElement.style.backgroundColor = '#2CA464';
}

function viewCreationImage(creationid) {
    var imageLink = "http://localhost/religion_explorer/views/modules/communitySubmissions.php?openTab=communitySubPhotos" + "&view=" +  encodeURIComponent(creationid);
    window.location.href = imageLink;
}

function viewCreationVideo(creationid) {
    var videoLink = "http://localhost/religion_explorer/views/modules/communitySubmissions.php?openTab=communitySubVideos" + "&view=" +  encodeURIComponent(creationid);
    window.location.href = videoLink;
}

function viewCreationReadingMaterial(creationid) {
    var readingMaterialLink = "http://localhost/religion_explorer/views/modules/communitySubmissions.php?openTab=communitySubBlogs" + "&view=" +  encodeURIComponent(creationid);
    window.location.href = readingMaterialLink;
}

function deleteCreation(creationid) {
    $("#deleteContentid").html(creationid);

    $('#confirmDeleteCreationModal').modal();
    $('#confirmDeleteCreationModal').show();
}

function getBookmarks() {
    $.ajax({
        url: '../../ajax/getBookmarksData.ajax.php',
        method: "POST",
        data: {"accountid" : $("#accountidPlaceholder").text()},
        success: function(data){
            var bookmarksList = data;
            for (let bookmark in bookmarksList) {
                var bookmarkDetails = bookmarksList[bookmark];

                var $bookmarkDiv = 
                '<div class="bookmarkContainer" onclick="viewBookmark(' + "'" + bookmarkDetails.resourceid + "'" + ')">' +
                    '<div class="bookmarkImgContainer d-flex justify-content-center align-items-center">' +
                        '<img src="../assets/img/bookmark.png" class="userProfBookmark">' +
                    '</div>' +
                    '<div class="bookmarkContent d-flex justify-content-start align-items-center">' +
                        '<p>' + bookmarkDetails.resourceTitle + '<p>' +
                    '</div>' +
                '</div>';

                $("#userProfileBookmarksList").append($bookmarkDiv);
            }
        }
    }); 
}
  
function viewBookmark(resourceid) {
    var link = "";

    if (resourceid.startsWith("CC")) {
        $.ajax({
            url: "../../ajax/getCommunityData.ajax.php",
            method: "POST",
            success:function(data){
                var communityData = data;
    
                for (let materialType in communityData) {
                    for (let type in communityData[materialType]) {
                        var list = communityData[materialType][type];
                        for (item in list) {
                            var details = list[item];
                            if (details.creationid == resourceid) {
                                if ((details.filetype).includes("image")) {
                                    link = "../modules/communitySubmissions.php?openTab=communitySubPhotos&view=";
                                } else if ((details.filetype).includes("video")) {
                                    link = "../modules/communitySubmissions.php?openTab=communitySubVideos&view=";
                                } else if (details.filetype == ""){
                                    link = "../modules/communitySubmissions.php?openTab=communitySubBlogs&view=";
                                }
                                window.location.href = link + encodeURIComponent(resourceid);
                            }
                        }
                    }
                }
            }
        });
    } else {
        link = "../modules/library.php?view=";
        window.location.href = link + encodeURIComponent(resourceid);
    }
}

function createCalendar() {
    $.ajax({
        url: '../../ajax/createCalendar.ajax.php',
        method: "POST",
        data: {"calendarDate" : ($("#calendarDatePlaceHolder").text())},
        success: function(data){
            $("#userProfileCalendar").html(data);

            $('#buddhismEvents').click(function(){
                enableFilter("Buddhism");
            });
        
            $('#christianityEvents').click(function(){
                enableFilter("Christianity");
            });
        
            $('#hinduismEvents').click(function(){
                enableFilter("Hinduism");
            });
        
            $('#islamEvents').click(function(){
                enableFilter("Islam");
            });
        
            $('#judaismEvents').click(function(){
                enableFilter("Judaism");
            });
        }
    });
}

function getPersonalCalendar() {
    $.ajax({
        url: '../../ajax/getPersonalCalendarData.ajax.php',
        method: "POST",
        data: {"accountid" : $("#accountidPlaceholder").text()},
        success: function(data){
            var personalEvents = data;
            var calendarDays = document.getElementsByClassName("day_num");

            for (let day of calendarDays) {
                for (let event in personalEvents) {
                    var eventDetails = personalEvents[event];
                    if (eventDetails["date"] == day.getAttribute("id")){
                        var dayWithEvent = "#" + eventDetails["date"];
                        $(dayWithEvent).append('<div class="calendarEvent ' + eventDetails["religion"] + '" data-religion="' + eventDetails["religion"] + '" onclick="viewEvent(' + "'" + event + "', '" + eventDetails["personaleventid"] + "'" + ')">' + event +'</div>');
                    }
                }
            }
        }
    });
}

var activeFilter = "";

function enableFilter(religion) {
    $('#buddhismEvents').css("background", "#808080");
    $('#christianityEvents').css("background", "#808080");
    $('#hinduismEvents').css("background", "#808080");
    $('#islamEvents').css("background", "#808080");
    $('#judaismEvents').css("background", "#808080");

    if (activeFilter != religion) {
        var allEvents = document.getElementsByClassName("calendarEvent");

        for (let event of allEvents) {
            $(event).show();

            var eventReligion = event.getAttribute("data-religion");

            if (eventReligion != religion) {
                $(event).hide();
            }

        }

        var pillFilter = "#" + religion.toLowerCase() + "Events";
        
        switch (religion) {
            case "Buddhism":
                $(pillFilter).css("background", "#BAA400");
                break;
            case "Christianity":
                $(pillFilter).css("background", "#56097A");
                break;
            case "Hinduism":
                $(pillFilter).css("background", "#A81315");
                break;
            case "Islam":
                $(pillFilter).css("background", "#018744");
                break;
            case "Judaism":
                $(pillFilter).css("background", "#1334A8");
                break;
        }

        activeFilter = religion;
    } else {
        $('#buddhismEvents').css("background", "#BAA400");
        $('#christianityEvents').css("background", "#56097A");
        $('#hinduismEvents').css("background", "#A81315");
        $('#islamEvents').css("background", "#018744");
        $('#judaismEvents').css("background", "#1334A8");

        var allEvents = document.getElementsByClassName("calendarEvent");

        for (let event of allEvents) {
            $(event).show();
        }

        activeFilter = "";
    }
}

function viewEvent(event, personaleventid) {
    $("#calendarEvent").text(event);
    $("#calendarEventContent").html('<button onclick="removeFromPersonalCalendar(' + "'" + personaleventid + "'" + ')" type="button">Remove from Personal Calendar</button> <button onclick="learnMore(' + "'" + event + "'" + ')" type="button">Learn More</button>');
    $("#calendarEventModal").modal();
    $("#calendarEventModal").show();
}

function removeFromPersonalCalendar(personaleventid) {
    $.ajax({
        url: '../../ajax/removeFromPersonalCalendar.ajax.php',
        method: "POST",
        data: {"personaleventid" : personaleventid},
        success: function(data){
            $("#calendarEventModal").removeClass("fade").modal("hide");
            $("#calendarEventModal").modal("dispose");
            $("#userProfileCalendar").html("");
            createCalendar();
            getPersonalCalendar();

            $("#toast").html('"' + data +  '" was removed from your personal calendar.')

            $('#toast').addClass('show');
        
            setTimeout(function() {
                $('#toast').removeClass('show');
            }, 2000);

        }
    });
}

function learnMore(event) {
    console.log(event);
    window.location.href = "../modules/library.php?search=" + encodeURIComponent(event);
}

function prevMonth(prevMonth, day) {
    var date = "2023-" + prevMonth + "-" + day;

    if (prevMonth == 0) {
        $("#prevMonthButton").css("color", "#A6A6A6");
        $("#prevMonthButton").css("cursor", "auto");
    } else {
        $("#calendarDatePlaceHolder").html(date);
        $("#userProfileCalendar").html("");
        createCalendar();
        getPersonalCalendar();
    }
}

function nextMonth(nextMonth, day) {
    var date = "2023-" + nextMonth + "-" + day;

    if (nextMonth == 13) {
        $("#nextMonthButton").css("color", "#A6A6A6");
        $("#nextMonthButton").css("cursor", "auto");
    } else {
        $("#calendarDatePlaceHolder").html(date);
        $("#userProfileCalendar").html("");
        createCalendar();
        getPersonalCalendar();
    }
}

function getTopics() {
    $.ajax({
        url: "../../ajax/profileTopics.ajax.php",
        method: "GET", 
        success: function(data) {
            console.log(data);
            $("#profileTopics").html(data);
            shortenUpvotes();
        },
        error: function(xhr, status, error) {
            console.log(xhr.responseText);
            console.log(status);
            console.log(error);
        }
    });
}


function getPosts() {
    $.ajax({
        url: "../../ajax/profilePosts.ajax.php",
        method: "GET", 
        success: function(data) {
            console.log(data);
            $("#profilePosts").html(data);
            shortenUpvotes();
        },
        error: function(xhr, status, error) {
            console.log(xhr.responseText);
            console.log(status);
            console.log(error);
        }
    });
}

function getOverview() {
    $.ajax({
        url: "../../ajax/profileOverview.ajax.php",
        method: "GET", 
        success: function(data) {
            $.ajax({
                url: '../../ajax/getBookmarksData.ajax.php',
                method: "POST",
                data: {"accountid" : $("#accountidPlaceholder").text()},
                success: function(data){
                    var bookmarksList = data;
                    for (let bookmark in bookmarksList) {
                        var bookmarkDetails = bookmarksList[bookmark];
        
                        var $bookmarkDiv = 
                        '<div class="bookmarkContainer" onclick="viewBookmark(' + "'" + bookmarkDetails.resourceid + "'" + ')">' +
                            '<div class="bookmarkImgContainer d-flex justify-content-center align-items-center">' +
                                '<img src="../assets/img/bookmark.png" class="userProfBookmark">' +
                            '</div>' +
                            '<div class="bookmarkContent d-flex justify-content-start align-items-center">' +
                                '<p>' + bookmarkDetails.resourceTitle + '<p>' +
                            '</div>' +
                        '</div>';
        
                        $("#profileOverview").append($bookmarkDiv);
                    }
                }
            }); 
            console.log(data);
            $("#profileOverview").html(data);
            shortenUpvotes();
            
        },
        error: function(xhr, status, error) {
            console.log(xhr.responseText);
            console.log(status);
            console.log(error);
        }
    });
}