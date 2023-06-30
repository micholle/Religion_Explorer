$(function() {
    $.ajax({
        url: "../../ajax/showSidebar.ajax.php",
        method: "POST",
        success:function(data){
            $("#calendarSidebar").html(data);
        }
    });

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

    $.ajax({
        url: '../../ajax/getCalendarData.ajax.php',
        method: "POST",
        success: function(data){
            var eventsList = data;

            var calendarDays = document.getElementsByClassName("day_num");

            for (let day of calendarDays) {
                for (let event in eventsList) {
                    var eventDetails = eventsList[event];
                    if (eventDetails["date"] == day.getAttribute("id")){
                        var dayWithEvent = "#" + eventDetails["date"];
                        $(dayWithEvent).append('<div class="calendarEvent ' + eventDetails["religion"] + '" data-religion="' + eventDetails["religion"] + '" onclick="viewEvent(' + "'" + event + "'" + ')">' + event +'</div>');
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

function viewEvent(event) {
    $('#calendarEvent').text(event);
    $('#calendarEventModal').modal();
}