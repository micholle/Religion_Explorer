$(function() {
    //sidebar
    let minimize = document.querySelector('#minimize');
    let sidebar = document.querySelector('.sidebar');
    let textImage = document.querySelector('#text');
    let minmaxImage = document.querySelector('#minmax');

    minimize.onclick = function () {
        sidebar.classList.toggle('active');
        if (sidebar.classList.contains('active')) {
            textImage.style.display = 'none';
            minmaxImage.src = '../assets/img/maximize.png';
        } else {
            textImage.style.display = 'inline-block';
            minmaxImage.src = '../assets/img/minimize.png';
        }
    };

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

    $.ajax({
        url: "../../ajax/showReportUser.ajax.php",
        method: "POST",
        success:function(data){
            $("#reportUserDiv").html(data);
        }
    });

    $("#reportUser").click(function () { 
        $("#reportUserModal").modal();
    });

    $("#submitReportUser").click(function () { 
        $("#reportUserModal").removeClass("fade").modal("hide");
        $("#reportUserModal").modal("dispose");

        $("#resultHeader").html("Report Received");
        $("#resultContent").html("The team will review your complaint. Please expect a notification in 3-5 business days. <br>");
        $("#resultContent").append("<button data-dismiss='modal'>Thanks!</button>");
        $("#resultModal").modal();
        $("#resultModal").show();
    });
});