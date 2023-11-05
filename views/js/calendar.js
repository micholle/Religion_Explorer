$(function() {
    $.ajax({
        url: "../../ajax/showSidebar.ajax.php",
        method: "POST",
        success:function(data){
            $("#calendarSidebar").html(data);
            var currentPage = window.location.pathname.split("/").pop();

            $("#calendarSidebar li a").each(function() {
                var tabPage = $(this).attr("href");
                if (tabPage === currentPage) {
                    $(this).css({
                        "background-color": "#EAF7F0",
                        "border": "solid #75C884 2px",
                        "font-weight": "600",
                    });
                }
            });
        }
    });

    $.ajax({
        url: '../../ajax/createCalendar.ajax.php',
        method: "POST",
        data: {"calendarDate" : ($("#calendarDatePlaceHolder").text())},
        success: function(data){
            $("#calendarContainer").html(data);

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
        url: '../../ajax/getCalendarData.ajax.php',
        method: "POST",
        success: function(data){
            var eventsList = data;

            var calendarDays = document.getElementsByClassName("day_num");
            var acctype = $('#acctype').text();
            for (let day of calendarDays) {
                for (let event in eventsList) {
                    var eventDetails = eventsList[event];
                    if (acctype === 'regular'){
                        if (eventDetails["date"] == day.getAttribute("id")){
                            var dayWithEvent = "#" + eventDetails["date"];
                            $(dayWithEvent).append('<div class="calendarEvent ' + eventDetails["religion"] + '" data-religion="' + eventDetails["religion"] + '" onclick="viewEvent(' + "'" + event + "', '" + eventDetails["religion"] + "', '"+ eventDetails["date"] + "'" + ')">' + event +'</div>');
                        }
                    } else {
                        if (eventDetails["date"] == day.getAttribute("id")){
                            var dayWithEvent = "#" + eventDetails["date"];
                            $(dayWithEvent).append('<div class="calendarEvent ' + eventDetails["religion"] + '" data-religion="' + eventDetails["religion"] + '" onclick="viewEvent(' + "'" + event + "', '" + eventDetails["religion"] + "', '"+ eventDetails["date"] + "'" + ')" style="pointer-events: none;">' + event +'</div>');
                        }
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

function viewEvent(event, religion, date) {
    $("#calendarEvent").text(event);
    var personalEvent = false;

    $.ajax({
        url: '../../ajax/getPersonalCalendarData.ajax.php',
        method: "POST",
        data: {"accountid" : $("#accountidPlaceholder").text()},
        success: function(personaldata){
            var personalEvents = personaldata;
             
            if (personalEvents.length != 0) {
                for (let personalevent in personalEvents) {
                    var eventDetails = personalEvents[personalevent];

                    if (personalevent == event) {
                        personalEvent = true;
                    } else {
                        personalEvent = false;
                    }
                }
            } else {
                personalEvent = false;
            }

            if (personalEvent) {
                $("#calendarEventContent").html('<button onclick="removeFromPersonalCalendar(' + "'" + eventDetails["personaleventid"] + "'" + ')" type="button">Remove from Personal Calendar</button> <button onclick="learnMore(' + "'" + event + "'" + ')" type="button">Learn More</button>');
            } else {
                $("#calendarEventContent").html('<button onclick="addToPersonalCalendar(' + "'" + event + "', '" + religion + "', '" + date + "'" + ')" type="button">Add to Personal Calendar</button> <button onclick="learnMore(' + "'" + event + "'" + ')" type="button">Learn More</button>');
            }

        }
    });

    $("#calendarEventModal").modal();
    $("#calendarEventModal").show();
}

function addToPersonalCalendar(event, religion, date) {
    var accountid = $("#accountidPlaceholder").text();
    var event = event;
    var religion = religion;
    var date = date;

    var personalEvent = new FormData();
    personalEvent.append("accountid", accountid);
    personalEvent.append("event", event);
    personalEvent.append("religion", religion);
    personalEvent.append("date", date);

    $.ajax({
        url: '../../ajax/addToPersonalCalendar.ajax.php',
        method: "POST",
        data: personalEvent,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "text",
        success: function(data){
            $("#calendarEventModal").removeClass("fade").modal("hide");
            $("#calendarEventModal").modal("dispose");

            $("#toast").html('"' + data +  '" was added to your personal calendar.')

            $('#toast').addClass('show');
        
            setTimeout(function() {
                $('#toast').removeClass('show');
            }, 2000);

            //add explorer points: calendar add event                
            var accountid = $("#accountidPlaceholder").text();

            var explorerPoint = new FormData();
            explorerPoint.append("accountid", accountid);
            explorerPoint.append("pointsource", accountid + "_calendar_add_" + data);
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
        }
    });
}

function removeFromPersonalCalendar(personaleventid) {
    $.ajax({
        url: '../../ajax/removeFromPersonalCalendar.ajax.php',
        method: "POST",
        data: {"personaleventid" : personaleventid},
        success: function(data){
            $("#calendarEventModal").removeClass("fade").modal("hide");
            $("#calendarEventModal").modal("dispose");
            $("#calendarContainer").fadeOut(200, function() {
                $("#calendarContainer").load("#calendarContainer", function() {
                    $("#calendarContainer").fadeIn(200);
                });
            });

            $("#toast").html('"' + data +  '" was removed from your personal calendar.')

            $('#toast').addClass('show');
        
            setTimeout(function() {
                $('#toast').removeClass('show');
            }, 2000);
        }
    });
}

function learnMore(event) {
    window.location.href = "../modules/library.php?search=" + encodeURIComponent(event);
}

function prevMonth(prevMonth, day) {
    var date = "2023-" + prevMonth + "-" + day;

    if (prevMonth == 0) {
        $("#prevMonthButton").css("color", "#A6A6A6");
        $("#prevMonthButton").css("cursor", "auto");
    } else {
        $("#calendarContainer").fadeOut(200, function() {
            $("#calendarDatePlaceHolder").html(date);
            $("#calendarContainer").load("#calendarContainer", function() {
                $("#calendarContainer").fadeIn(200);
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
        $("#calendarContainer").fadeOut(200, function() {
            $("#calendarDatePlaceHolder").html(date);
            $("#calendarContainer").load("#calendarContainer", function() {
                $("#calendarContainer").fadeIn(200);
            });
        });
    }
}