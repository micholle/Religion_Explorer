$(function() {
    $.ajax({
        url: "../../ajax/showSidebar.ajax.php",
        method: "POST",
        success:function(data){
            $("#userProfileSidebar").html(data);
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
});

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
    $("#calendarEventContent").html('<button onclick="removeFromPersonalCalendar(' + "'" + personaleventid + "'" + ')" type="button">Remove from Personal Calendar</button> <button type="button">Learn More</button>');
    $("#calendarEventModal").modal();
    $("#calendarEventModal").show();
}

function removeFromPersonalCalendar(personaleventid) {
    $.ajax({
        url: '../../ajax/removeFromPersonalCalendar.ajax.php',
        method: "POST",
        data: {"personaleventid" : personaleventid},
        success: function(){
            $("#calendarEventModal").removeClass("fade").modal("hide");
            $("#calendarEventModal").modal("dispose");
            $("#userProfileCalendar").load("userProfile.php" + "#userProfileCalendar");
        }
    });
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