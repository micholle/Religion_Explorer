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
}