$(function() {
    $.ajax({
        url: "../../ajax/showSidebar.ajax.php",
        method: "POST",
        success:function(data){
            $("#viewUserProfileSidebar").html(data);
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

    $("#viewUserReport").click(function(){
        $('#reportViewUserModal').modal();
        $('#reportViewUserModal').show();
    });

    $('#submitReportUser').click(function(event) {    
        event.preventDefault();

        var userViolationsArray = []; 
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');

        checkboxes.forEach(checkbox => {
            if (checkbox.checked) {
                userViolationsArray.push(checkbox.value);
            }
        });

        if($("#userOthers").val() != "") {
            userViolationsArray.push($("#userOthers").val());
        }
    
        if (userViolationsArray.length != 0) {
            var reportUserUsername = $("#reportUserUsername").val();
            var additionalContext = $("#reportUserAdditional").val();
            var accountUsername = $("#accountUsernamePlaceholder").text();
            
            var currentDate = new Date();
            var year = currentDate.getFullYear();
            var month = String(currentDate.getMonth() + 1).padStart(2, '0');
            var day = String(currentDate.getDate()).padStart(2, '0');
            var reportedOn = `${year}-${month}-${day}`;
            var userViolations = userViolationsArray.join(', ');

            reportData = new FormData();
            reportData.append("username" , reportUserUsername);
            reportData.append("userViolations" , userViolations);
            reportData.append("additionalContext", additionalContext);
            reportData.append("reportedOn", reportedOn);
            reportData.append("reportedBy", accountUsername);
    
            $.ajax({
                url: "../../ajax/submitReportUser.ajax.php",
                method: "POST",
                data: reportData,
                dataType: "text",
                processData: false,
                contentType: false,
                success: function() {
                    $("#reportUserIcon").attr("src", "../assets/img/verification-check.png");
                    $("#reportUserStatus").text("Report Received");
                    $("#reportUserMessage").text("The team will review your complaint. Please expect a notification in 3-5 business days.");
                },
                error: function() {
                    $("#reportUserIcon").attr("src", "../assets/img/verification-error.png");
                    $("#reportUserStatus").text("Error");
                    $("#reportUserMessage").text("There was an error processing your request. Please try again later.");
                    $("#reportUserNoticeButton").css("background-color", "#E04F5F");
                },
                complete: function() {
                    $("#reportContentNotice").modal();
                    $("#reportContentNotice").show();

                    $("#reportViewUserModal").removeClass("fade").modal("hide");
                    $("#reportViewUserModal").modal("dispose");

                    $("#reportUserUsername").val("");
                    $("#reportUserForm")[0].reset();
                    $("#reportUserAdditional").val("");
                }
            });
        } else {
            $("#toast").html("Please fill out all required fields.")
            $("#toast").css("background-color", "#E04F5F");
            $('#toast').addClass('show');
        
            setTimeout(function() {
                $('#toast').removeClass('show');
            }, 2000);
        }
    });

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

    $.ajax({
        url: '../../ajax/getPersonalCalendarData.ajax.php',
        method: "POST",
        data: {"accountid" : $("#accountidView").text()},
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

    $.ajax({
        url: '../../ajax/getBookmarksData.ajax.php',
        method: "POST",
        data: {"accountid" : $("#accountidView").text()},
        success: function(data){
            var bookmarksList = data;
            for (let bookmark in bookmarksList) {
                var bookmarkDetails = bookmarksList[bookmark];

                var $bookmarkDiv = 
                '<div class="bookmarkContainer" onclick="viewBookmark(' + "'" + bookmarkDetails.resourceTitle + "'" + ')">' +
                    '<div class="bookmarkImgContainer d-flex justify-content-center align-items-center">' +
                        '<img src="../assets/img/bookmark.png" class="userProfBookmark">' +
                    '</div>' +
                    '<div class="bookmarkContent d-flex justify-content-start align-items-center">' +
                        '<p>' + $("#accountUsernamePlaceholder").text() + ' has added "' + bookmarkDetails.resourceTitle + '" to their bookmarks.<p>' +
                    '</div>' +
                '</div>';

                $("#userProfileBookmarksList").append($bookmarkDiv);
            }
        }
    });    
    
});

function viewBookmark(resourceTitle) {
    window.location.href = "../modules/library.php?search=" + encodeURIComponent(resourceTitle);
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
        $("#userProfileCalendar").fadeOut(200, function() {
            $("#calendarDatePlaceHolder").html(date);
            $("#userProfileCalendar").load("#userProfileCalendar", function() {
                $("#userProfileCalendar").fadeIn(200);
            });
        });
    }
}

function nextMonth(nextMonth, day) {
    var date = "2023-" + nextMonth + "-" + day;

    if (nextMonth == 13) {
        $("#nextMonthButton").css("color", "#A6A6A6");
        $("#nextMonthButton").css("cursor", "auto");
    } else {
        $("#userProfileCalendar").fadeOut(200, function() {
            $("#calendarDatePlaceHolder").html(date);
            $("#userProfileCalendar").load("#userProfileCalendar", function() {
                $("#userProfileCalendar").fadeIn(200);
            });
        });
    }
}

$(document).ready(function() {
    getTopics();
});
function getTopics() {
    const accountId = $("#accountidView").text().trim();
    $.ajax({
        url: "../../ajax/profileTopics.ajax.php",
        method: "GET", 
        data: { accountid: accountId },
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

$(document).ready(function() {
    getPosts();
});
function getPosts() {
    const accountId = $("#accountidView").text().trim();

    $.ajax({
        url: "../../ajax/profilePosts.ajax.php",
        method: "GET", 
        data: { accountid: accountId },
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

$(document).ready(function() {
    getOverview();
});
function getOverview() {
    $.ajax({
        url: "../../ajax/profileOverview.ajax.php",
        method: "GET", 
        data: {"accountid" : $("#accountidView").text()},
        success: function(data) {
            $.ajax({
                url: '../../ajax/getBookmarksData.ajax.php',
                method: "POST",
                data: {"accountid" : $("#accountidView").text()},
                success: function(data){
                    var bookmarksList = data;
                    for (let bookmark in bookmarksList) {
                        var bookmarkDetails = bookmarksList[bookmark];
        
                        var $bookmarkDiv = 
                        '<div class="bookmarkContainer" onclick="viewBookmark(' + "'" + bookmarkDetails.resourceTitle + "'" + ')">' +
                            '<div class="bookmarkImgContainer d-flex justify-content-center align-items-center">' +
                                '<img src="../assets/img/bookmark.png" class="userProfBookmark">' +
                            '</div>' +
                            '<div class="bookmarkContent d-flex justify-content-start align-items-center">' +
                                '<p>' + $("#accountUsernamePlaceholder").text() + ' has added "' + bookmarkDetails.resourceTitle + '" to their bookmarks.<p>' +
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

    getCreations();
    
    function getCreations() {
        $.ajax({
            url: "../../ajax/getCommunityData.ajax.php",
            method: "POST",
            success:function(data){
                var communityData = data;
                var creationsMade = "";
                var dataUsed = 0.00;
                var photoCount = 0;
                var videoCount = 0;
                var readingMaterialCount = 0;
    
                for (let photo in communityData["photos"]) {
                    var photoList = communityData["photos"][photo];
                    for (photoData in photoList) {
                        var photoDetails = photoList[photoData];
                        var imageSize = 0.00;
    
                        if (photoDetails.author == $("#accountUsernamePlaceholderView").text()) {
                            imageSize = photoDetails.filesize  / (1024 * 1024);
                            dataUsed += imageSize;
                            photoCount++;
    
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
    
                        if (videoDetails.author == $("#accountUsernamePlaceholderView").text()) {
                            videoSize = videoDetails.filesize / (1024 * 1024);
                            dataUsed += videoSize;
                            videoCount++;
    
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
    
                        if (readingMaterialDetails.author == $("#accountUsernamePlaceholderView").text()) {
                            readingMaterialSize = readingMaterialDetails.filesize / 1024;
                            dataUsed += readingMaterialDetails.filesize / (1024 * 1024);
                            readingMaterialCount++;
    
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
                            '</div>';
        
                            $("#userProfileCreationsList").append(creationsMade);
                        }
                    }
                }
    
                updateFill(dataUsed);
                $("#creationsDescription").text(dataUsed.toFixed(2) + " MB of 500 MB used");

                //total uploads
                const totalUploadsData = {
                    labels: [
                    'Images',
                    'Videos',
                    'Reading Materials'
                    ],
                    datasets: [{
                    data: [photoCount, videoCount, readingMaterialCount],
                    backgroundColor: [
                        'rgba(186, 164, 0, 0.2)',
                        'rgba(86, 9, 122, 0.2)',
                        'rgba(168, 19, 21, 0.2)',
                    ],
                    borderColor: [
                        'rgb(186, 164, 0)',
                        'rgb(86, 9, 122)',
                        'rgb(168, 19, 21)',
                    ],
                    borderWidth: 1,
                    }]
                };

                const totalUploadsConfig = {
                    type: 'pie',
                    data: totalUploadsData,
                };

                const totalUploadsCanvas = document.createElement('canvas');
                totalUploadsCanvas.id = 'totalCommunityUploads';
                document.getElementById('totalCommunityUploadsContainer').appendChild(totalUploadsCanvas);

                const totalUploadsCtx = document.getElementById('totalCommunityUploads').getContext('2d');
                new Chart(totalUploadsCtx, totalUploadsConfig);

                var totalUploads = photoCount + videoCount + readingMaterialCount;

                $("#totalUploads").text(totalUploads);
            }
        });
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
    

    getEngagementData();


    function updateDateRangeLabel(selectedDateRange) {
        let endDate = new Date(); // Current date
        let startDate;
    
        if (selectedDateRange === 'week') {
            startDate = new Date();
            startDate.setDate(startDate.getDate() - 7);
        } else if (selectedDateRange === 'month') {
            startDate = new Date();
            startDate.setMonth(startDate.getMonth() - 1);
        } else if (selectedDateRange === 'year') {
            startDate = new Date();
            startDate.setFullYear(startDate.getFullYear() - 1);
        } else if (selectedDateRange === 'all') {
            startDate = null;
            endDate = null;
        }
    
        const startDateString = startDate ? startDate.toLocaleString('default', { month: 'long', day: 'numeric', year: 'numeric' }) : '';
        const endDateString = endDate ? endDate.toLocaleString('default', { month: 'long', day: 'numeric', year: 'numeric' }) : '';
        document.getElementById('dateRangeLabel').innerText = `${startDateString} - ${endDateString}`;
    }
    
    $(document).ready(function() {
        getEngagementData();
        $("#engagementDate").change(function() {
            getEngagementData();
        });
    });
    

    function getEngagementData() {
        var selectedDateRange = $("#engagementDate").val();
        updateDateRangeLabel(selectedDateRange);
        $.ajax({
            url: "../../models/profileStats.model.php",
            method: "POST",
            data: {
                username: $("#accountUsernamePlaceholderView").text(),
                engagementDate: selectedDateRange
            },
            success: function(data) {
                if (data.success) {
                    // Update the chart with the retrieved data
                    var engagementData = data.engagementData;
                    const labels = ['Buddhism', 'Christianity', 'Hinduism', 'Islam', 'Judaism', 'Other Religions', 'Non-Religious'];
    
                    const registeredUsersData = {
                        labels: labels,
                        datasets: [{
                            axis: 'y',
                            label: 'Engagement Insights',
                            data: engagementData,
                            fill: false,
                            backgroundColor: [
                                'rgba(186, 164, 0, 0.2)',
                                'rgba(86, 9, 122, 0.2)',
                                'rgba(168, 19, 21, 0.2)',
                                'rgba(1, 135, 68, 0.2)',
                                'rgba(19, 52, 168, 0.2)',
                                'rgba(179, 113, 0, 0.2)',
                                'rgba(36, 36, 36, 0.2)'
                            ],
                            borderColor: [
                                'rgb(186, 164, 0)',
                                'rgb(86, 9, 122)',
                                'rgb(168, 19, 21)',
                                'rgb(1, 135, 68)',
                                'rgb(19, 52, 168)',
                                'rgb(179, 113, 0)',
                                'rgb(36, 36, 36)'
                            ],
                            borderWidth: 1
                        }]
                    };
    
                    const config = {
                        type: 'bar',
                        data: registeredUsersData,
                        options: {
                            indexAxis: 'y'
                        }
                    };
    
                    // Remove the previous canvas element if it exists
                    const existingCanvas = document.getElementById('engagementInsights');
                    if (existingCanvas) {
                        existingCanvas.parentNode.removeChild(existingCanvas);
                    }
    
                    // Create the new canvas element for the chart
                    const canvasElement = document.createElement('canvas');
                    canvasElement.id = 'engagementInsights';
                    document.getElementById('engagementInsightsContainer').appendChild(canvasElement);
    
                    const ctx = document.getElementById('engagementInsights').getContext('2d');
                    new Chart(ctx, config);


                    // Update the other statistics on the page
                    const countUpvotes = data.totalUpvotes;
                    const countDownvotes = data.totalDownvotes;
                    const countComments = data.totalTopicPosts + data.totalPostReplies;

                    // Total of all downvotes, upvotes, and comments
                    const totalEngagements = countUpvotes + countDownvotes + countComments;

                    // Update the HTML elements with the statistics
                    $("#countUpvotes").text(countUpvotes);
                    $("#countDownvotes").text(countDownvotes);
                    $("#countComments").text(countComments);
                    $("#totalEngagements").text(totalEngagements);
                } else {
                    console.error(data.message);
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error:", error);
            }
        });
    }
}