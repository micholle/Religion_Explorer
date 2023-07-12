$(function() {
    //sidebar
    $("#minimize").click(function() {
        var currentPage = window.location.pathname.split("/").pop();
        if (currentPage === "map.php") {
            return; // Exit the function without executing the code
        }

        $(".sidebar").toggleClass("active");
        if ($(".sidebar").hasClass("active")) {
            $("#text").css("display", "none");
            $("#minmax").attr("src", "../assets/img/maximize.png");
            $(".pageContainer").css("padding-left", "85px");
        } else {
            $("#text").css("display", "inline-block");
            $("#minmax").attr("src", "../assets/img/minimize.png");
            $(".pageContainer").css("padding-left", "275px");
        }
    });

    $("#termsOfService").click(function() {
        window.location.href = "../modules/termsOfService.php";
    });

    $("#privacyPolicy").click(function() {
        window.location.href = "../modules/privacyPolicy.php";
    });  

    //js functions below this line are temporary---------------------------------------------------------------

    //timeline overlays
    $("#timelineOverlay").click(function(){
        $("#timelineOverlay").css("display", "none");
    });

    var timelineYear = "2020";
    $("#sliderOptions").click(function(){
        var timelineYears = document.getElementsByName("timelineValue");

        for (i = 0; i < timelineYears.length; i++) {
            if (timelineYears[i].checked){
                if(timelineYears[i].value != timelineYear){
                    timelineYear = timelineYears[i].value;
                    $("#timelineOverlayYear").text(timelineYear);
                    $("#timelineOverlay").css("display", "block");
                }
            }
        }
    });

    //help overlay
    $("#mapHelpButton").click(function(){
        $("#helpOverlay").css("display", "block");

        //display tooltip
        $("#Brazil").attr("data-toggle", "popover");
        $("#mapFilter").attr("data-toggle", "popover");
        $("#1970").attr("data-toggle", "popover");

        $("#Brazil").popover({
            content: "Hover on a country to view its prevailing religion, and click on it for more information.",
            placement: "top"
        });

        $("#mapFilter").popover({
            content: "Filter the religion, geographic region, and pins on the map.",
            placement: "left"
        });

        $("#1970").popover({
            content: "Click on a year to change the year displayed on the map.",
            placement: "top"
        });

        $('[data-toggle = "popover"]').popover("show");
    })

    $("#helpOverlay").click(function(){
        //hide tooltip
        $("#Brazil").removeAttr("data-toggle");
        $("#mapFilter").removeAttr("data-toggle");
        $("#1970").removeAttr("data-toggle");

        $('.popover').popover('dispose');

        $("#helpOverlay").css("display", "none");
    });

    //sidebar tooltip    
    $("#sidebarProfile").hover(function(){
        $("#sidebarProfile").attr("data-toggle", "popover");
        $("#sidebarProfile").popover({
            content: "The Profile contains user information and activity.",
            placement: "right"
        });
        $('[data-toggle = "popover"]').popover("show");
    }, function(){
        $("#sidebarProfile").removeAttr("data-toggle");
        $('.popover').popover('dispose');
    });

    $("#sidebarMap").hover(function(){
        $("#sidebarMap").attr("data-toggle", "popover");
        $("#sidebarMap").popover({
            content: "The World Map shows the religions of the different countries, their history, and more related information.",
            placement: "right"
        });
        $('[data-toggle = "popover"]').popover("show");
    }, function(){
        $("#sidebarMap").removeAttr("data-toggle");
        $('.popover').popover('dispose');
    });

    $("#sidebarLibrary").hover(function(){
        $("#sidebarLibrary").attr("data-toggle", "popover");
        $("#sidebarLibrary").popover({
            content: "The Library of Resources displays educational materials about the five major religions.",
            placement: "right"
        });
        $('[data-toggle = "popover"]').popover("show");
    }, function(){
        $("#sidebarLibrary").removeAttr("data-toggle");
        $('.popover').popover('dispose');
    });

    $("#sidebarForum").hover(function(){
        $("#sidebarForum").attr("data-toggle", "popover");
        $("#sidebarForum").popover({
            content: "The Discussion Forum provides users a platform to exchange their thoughts on topics related to different religions.",
            placement: "right"
        });
        $('[data-toggle = "popover"]').popover("show");
    }, function(){
        $("#sidebarForum").removeAttr("data-toggle");
        $('.popover').popover('dispose');
    });

    $("#sidebarCalendar").hover(function(){
        $("#sidebarCalendar").attr("data-toggle", "popover");
        $("#sidebarCalendar").popover({
            content: "The Calendar displays events related to the different religions and more information about them.",
            placement: "right"
        });
        $('[data-toggle = "popover"]').popover("show");
    }, function(){
        $("#sidebarCalendar").removeAttr("data-toggle");
        $('.popover').popover('dispose');
    });

    $("#sidebarNotifications").hover(function(){
        $("#sidebarNotifications").attr("data-toggle", "popover");
        $("#sidebarNotifications").popover({
            content: "The Notifications tab displays recent engagements to your submitted content and forum comments and posts.",
            placement: "right"
        });
        $('[data-toggle = "popover"]').popover("show");
    }, function(){
        $("#sidebarNotifications").removeAttr("data-toggle");
        $('.popover').popover('dispose');
    });

    //notifications

});