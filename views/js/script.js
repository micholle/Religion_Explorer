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
            $(".notificationsPanel").removeClass("show");
        }
    });

    $('#submitReportContent').click(function() {
        // Get a reference to the modal body element
        var modalBody = $('#reportUserModal');
      
        // Change the content of the modal body
        modalBody.html(`
        <div class="modal-dialog modal-xs modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 d-flex justify-content-center align-items-center flex-column">
                                <img src="../assets/img/verification-check.png" height="80px" width="80px">
                                <h5 class="modal-title w-100">Report Received</h5>
                                <p>The team will review your complaint. Please expect a notification in 3-5 business days.</p>
                                <button type="button" id="" class="roundedButton" data-dismiss="modal">Thanks!</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        `);
    });

    $("#sidebarNotifications").click(function(event) {
        event.preventDefault();
    
        // Check if the sidebar is already minimized
        var isSidebarMinimized = $(".sidebar").hasClass("active");
        var isNotificationsPanelVisible = $(".notificationsPanel").hasClass("show");
    
        if (isSidebarMinimized) {
            if (isNotificationsPanelVisible) {
                // Hide the notifications panel
                $(".notificationsPanel").removeClass("show");
            } else {
                // Show the notifications panel
                $(".notificationsPanel").addClass("show");
            }
        } else {
            // Toggle the sidebar and notifications panel
            $(".sidebar").toggleClass("active");
            $(".notificationsPanel").toggleClass("show");
            
            // Update the sidebar appearance based on its current state
            if ($(".sidebar").hasClass("active")) {
                $("#text").css("display", "none");
                $("#minmax").attr("src", "../assets/img/maximize.png");
                $(".pageContainer").css("padding-left", "85px");
            } else {
                $("#text").css("display", "inline-block");
                $("#minmax").attr("src", "../assets/img/minimize.png");
                $(".pageContainer").css("padding-left", "275px");
            }
        }
    });
    
    

    $("#sidebarReport").click(function(){
        $('#reportUserModal').modal();
        $('#reportUserModal').show();
    });

    $("#termsOfService").click(function() {
        window.location.href = "../modules/termsOfService.php";
    });

    $("#privacyPolicy").click(function() {
        window.location.href = "../modules/privacyPolicy.php";
    });  

    //js functions below this line are temporary---------------------------------------------------------------

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

    $("#sidebarCommunity").hover(function(){
        $("#sidebarCommunity").attr("data-toggle", "popover");
        $("#sidebarCommunity").popover({
            content: "The Community Creations allows users to submit their religion-related creations to the platform for other users to see.",
            placement: "right"
        });
        $('[data-toggle = "popover"]').popover("show");
    }, function(){
        $("#sidebarCommunity").removeAttr("data-toggle");
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

    $("#sidebarReport").hover(function(){
        $("#sidebarReport").attr("data-toggle", "popover");
        $("#sidebarReport").popover({
            content: "This allows users to report other users who have violated the website's community guidelines.",
            placement: "right"
        });
        $('[data-toggle = "popover"]').popover("show");
    }, function(){
        $("#sidebarReport").removeAttr("data-toggle");
        $('.popover').popover('dispose');
    });

    //notifications

});