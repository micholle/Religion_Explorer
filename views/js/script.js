$(function() {
    //sidebar
    $("#sidebarUsername").text($("#accountUsernamePlaceholder").text());
    
    if (localStorage.getItem("sidebarStatus")) {
        const sidebarStatus = localStorage.getItem("sidebarStatus");
        var currentPage = window.location.pathname.split("/").pop();
    
        if (sidebarStatus == "minimized") {
            $(".sidebar").addClass("active");
            $("#text").css("display", "none");
            $("#minmax").attr("src", "../assets/img/maximize.png");
            $(".pageContainer").css("padding-left", "85px");
            $("#sidebarStatus").text("minimized");
        } else {
            if (currentPage === "map.php") {
                return;
            }

            $(".sidebar").removeClass("active");
            $("#text").css("display", "inline-block");
            $("#minmax").attr("src", "../assets/img/minimize.png");
            $(".pageContainer").css("padding-left", "275px");
            $("#sidebarStatus").text("maximized");
        }
    }

    $("#minimize").click(function() {
        var currentPage = window.location.pathname.split("/").pop();
        if (currentPage === "map.php") {
            return;
        }

        $(".sidebar").toggleClass("active");
        if ($(".sidebar").hasClass("active")) {
            $("#text").css("display", "none");
            $("#minmax").attr("src", "../assets/img/maximize.png");
            $(".pageContainer").css("padding-left", "85px");
            $("#sidebarStatus").text("minimized");
        } else {
            $("#text").css("display", "inline-block");
            $("#minmax").attr("src", "../assets/img/minimize.png");
            $(".pageContainer").css("padding-left", "275px");
            $(".notificationsPanel").removeClass("show");
            $("#sidebarNotifications").removeClass("active");
            $("#sidebarStatus").text("maximized");
        }

        localStorage.setItem("sidebarStatus", $(".sidebar").hasClass("active") ? "minimized" : "maximized");
    });

    $("sidebarCloseBtn").click(function() {
        $(".sidebar").css("display", "none");
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
                    $("#reportUserNotice").modal();
                    $("#reportUserNotice").show();

                    $("#reportUserModal").removeClass("fade").modal("hide");
                    $("#reportUserModal").modal("dispose");

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
        url: "../../ajax/getNotifications.ajax.php",
        method: "POST",
            data : {"accountid" : $("#accountidPlaceholder").text()},
        success: function (data) {
            var notificationData = data;  

            var uniqueid = "";
            var notification = "";
            var notificationIcon = "";
            var notificationDate = "";
            var personInvolved = "";
            var notificationSource = "";
            var upvotesCount = 0;
            var contentViolations = "";
            var notificationStatus = "";
            $("#notification").html("");

            for (notif in notificationData) {
                notificationDetails = notificationData[notif];

                uniqueid = notificationDetails.uniqueid;
                notification = notificationDetails.notification;
                notificationIcon = notificationDetails.notificationIcon;
                notificationDate = notificationDetails.notificationDate;
                personInvolved = notificationDetails.personInvolved;
                notificationSource = notificationDetails.notificationSource;
                upvotesCount = notificationDetails.upvotesCount;
                contentViolations = notificationDetails.contentViolations;
                notificationStatus = notificationDetails.notificationStatus;
                var displayNotifications = notificationDetails.displayNotifications;
                var avatar = notificationDetails.avatar;

                if (notificationStatus == "Unread") {
                    $("#notificationsIcon").attr("src", "../assets/img/bell-alert.png");
                }
                
                if (notificationSource == "Calendar") {
                    $("#notification").append(
                        '<div class="row notificationsPanelBody d-flex justify-content-start align-items-top" onclick="notificationRedirect(\'' + uniqueid + '\', \'' + notificationSource + '\')">' +
                            '<div class="col-2 d-flex justify-content-start align-items-start">' +
                                '<img src="' + notificationIcon + '">' +
                            '</div>' +
                            '<div class="col-10 d-flex flex-column">' +
                                '<p class="notificationsPanelMainText"><span class="notificationsPanelBoldText">' + notification + '</span> starts today.</p>' +
                                '<p class="notificationsPanelSubtext">' + notificationDate + '</p>' +
                            '</div>' +
                        '</div>'
                    );
                } else if (notificationSource == "Community Creations") {
                    $("#notification").append(
                        '<div class="row notificationsPanelBody d-flex justify-content-start align-items-top" onclick="notificationRedirect(\'' + uniqueid + '\', \'' + notificationSource + '\')">' +
                            '<div class="col-2 d-flex justify-content-start align-items-start">' +
                                '<img src="' + notificationIcon + '">' +
                            '</div>' +
                            '<div class="col-10 d-flex flex-column">' +
                                '<p class="notificationsPanelMainText"><span class="notificationsPanelBoldText">' + personInvolved + '</span>  has added <span class="notificationsPanelBoldText">"' + notification + '"</span> to their bookmarks.</p>' +
                                '<p class="notificationsPanelSubtext">' + notificationDate + '</p>' +
                            '</div>' +
                        '</div>'
                    );
                } else if (notificationSource == "Discussion Forum Posts") {
                    if (displayNotifications == 1){
                    $("#notification").append(
                        '<div class="row notificationsPanelBody d-flex justify-content-start align-items-top" onclick="notificationRedirect(\'' + uniqueid + '\', \'' + notificationSource + '\')">' +
                            '<div class="col-2 d-flex justify-content-start align-items-start" style="display: inline-block; position: relative;">' +
                                '<img src="data:image/png;base64, '+ avatar +'" style="width: 40px; height: 40px; border-radius: 50%; vertical-align: middle;">' +
                                '<img src="' + notificationIcon + '"  style="width: 20px; height: 20px; position: absolute; bottom: 15px; left: 23px;">' +
                            '</div>' +
                            '<div class="col-10 d-flex flex-column">' +
                                '<p class="notificationsPanelMainText"><span class="notificationsPanelBoldText">' + personInvolved + '</span>  commented on your post: <span class="notificationsPanelBoldText">"' + notification + '"</span></p>' +
                                '<p class="notificationsPanelSubtext">' + notificationDate + '</p>' +
                            '</div>' +
                        '</div>'
                    );
                    }
                } else if (notificationSource == "Discussion Forum Replies") {
                    if (displayNotifications == 1){
                    $("#notification").append(
                        '<div class="row notificationsPanelBody d-flex justify-content-start align-items-top" onclick="notificationRedirect(\'' + uniqueid + '\', \'' + notificationSource + '\')">' +
                            '<div class="col-2 d-flex justify-content-start align-items-start" style="display: inline-block; position: relative;">' +
                                '<img src="data:image/png;base64, '+ avatar +'" style="width: 40px; height: 40px; border-radius: 50%; vertical-align: middle;">' +
                                '<img src="' + notificationIcon + '"  style="width: 20px; height: 20px; position: absolute; bottom: 15px; left: 23px;">' +
                            '</div>' +
                            '<div class="col-10 d-flex flex-column">' +
                                '<p class="notificationsPanelMainText"><span class="notificationsPanelBoldText">' + personInvolved + '</span>  replied to your comment on the post: <span class="notificationsPanelBoldText">"' + notification + '"</span></p>' +
                                '<p class="notificationsPanelSubtext">' + notificationDate + '</p>' +
                            '</div>' +
                        '</div>'
                    );
                    }
                } else if (notificationSource == "Discussion Forum Topics Upvote") {
                    $("#notification").append(
                        '<div class="row notificationsPanelBody d-flex justify-content-start align-items-top" onclick="notificationRedirect(\'' + uniqueid + '\', \'' + notificationSource + '\')">' +
                            '<div class="col-2 d-flex justify-content-start align-items-start" style="display: inline-block; position: relative;">' +
                                '<img src="data:image/png;base64, '+ avatar +'" style="width: 40px; height: 40px; border-radius: 50%; vertical-align: middle;">' +
                                '<img src="' + notificationIcon + '"  style="width: 20px; height: 20px; position: absolute; bottom: 15px; left: 23px;">' +
                            '</div>' +
                            '<div class="col-10 d-flex flex-column">' +
                                '<p class="notificationsPanelMainText"><span class="notificationsPanelBoldText">' + personInvolved + '</span> and ' + upvotesCount + ' others upvoted your post: <span class="notificationsPanelBoldText">"' + notification + '"</span></p>' +
                                '<p class="notificationsPanelSubtext">' + notificationDate + '</p>' +
                            '</div>' +
                        '</div>'
                    );
                } else if (notificationSource == "Discussion Forum Posts Upvote") {
                    $("#notification").append(
                        '<div class="row notificationsPanelBody d-flex justify-content-start align-items-top" onclick="notificationRedirect(\'' + uniqueid + '\', \'' + notificationSource + '\')">' +
                            '<div class="col-2 d-flex justify-content-start align-items-start" style="display: inline-block; position: relative;">' +
                                '<img src="data:image/png;base64, '+ avatar +'" style="width: 40px; height: 40px; border-radius: 50%; vertical-align: middle;">' +
                                '<img src="' + notificationIcon + '"  style="width: 20px; height: 20px; position: absolute; bottom: 15px; left: 23px;">' +
                            '</div>' +
                            '<div class="col-10 d-flex flex-column">' +
                                '<p class="notificationsPanelMainText"><span class="notificationsPanelBoldText">' + personInvolved + '</span> and ' + upvotesCount + ' others upvoted your comment: <span class="notificationsPanelBoldText">"' + notification + '"</span></p>' +
                                '<p class="notificationsPanelSubtext">' + notificationDate + '</p>' +
                            '</div>' +
                        '</div>'
                    );
                } else if (notificationSource == "Discussion Forum Replies Upvote") {
                    $("#notification").append(
                        '<div class="row notificationsPanelBody d-flex justify-content-start align-items-top" onclick="notificationRedirect(\'' + uniqueid + '\', \'' + notificationSource + '\')">' +
                            '<div class="col-2 d-flex justify-content-start align-items-start" style="display: inline-block; position: relative;">' +
                                '<img src="data:image/png;base64, '+ avatar +'" style="width: 40px; height: 40px; border-radius: 50%; vertical-align: middle;">' +
                                '<img src="' + notificationIcon + '"  style="width: 20px; height: 20px; position: absolute; bottom: 15px; left: 23px;">' +
                            '</div>' +
                            '<div class="col-10 d-flex flex-column">' +
                                '<p class="notificationsPanelMainText"><span class="notificationsPanelBoldText">' + personInvolved + '</span> and ' + upvotesCount + ' others upvoted your reply: <span class="notificationsPanelBoldText">"' + notification + '"</span></p>' +
                                '<p class="notificationsPanelSubtext">' + notificationDate + '</p>' +
                            '</div>' +
                        '</div>'
                    );
                } else if (notificationSource == "Reported Content") {
                    $("#notification").append(
                        '<div class="row notificationsPanelBody d-flex justify-content-start align-items-top" onclick="reportedContentDetails(\'' + notification + '\', \'' + contentViolations + '\')">' +
                            '<div class="col-2 d-flex justify-content-start align-items-start">' +
                                '<img src="' + notificationIcon + '">' +
                            '</div>' +
                            '<div class="col-10 d-flex flex-column">' +
                                '<p class="notificationsPanelMainText">Your post was taken down because it goes against our community guidelines.</p>' +
                                '<p class="notificationsPanelSubtext">' + notificationDate + '</p>' +
                            '</div>' +
                        '</div>'
                    );
                }
            } 
        }
    });

    $("#sidebarNotifications").click(function(event) {
        event.preventDefault();
    
        //Set the notification status to read
        $.ajax({
            url: "../../ajax/updateNotificationStatus.ajax.php",
            method: "POST",
            data: {"accountid" : $("#accountidPlaceholder").text()},
            success:function(){
                $("#notificationsIcon").attr("src", "../assets/img/bell.png");
            }
        });

        // Remove the "active" class from all tab links
        $("#sidebarUsername li a").removeClass("active");
        localStorage.setItem("sidebarStatus", "minimized");
    
        // Check if the sidebar is already minimized
        var isSidebarMinimized = $(".sidebar").hasClass("active");
        var isNotificationsPanelVisible = $(".notificationsPanel").hasClass("show");
    
        if (isSidebarMinimized) {
            if (isNotificationsPanelVisible) {
                // Hide the notifications panel
                $(".notificationsPanel").removeClass("show");
                $("#sidebarNotifications").removeClass("active");
            } else {
                // Show the notifications panel
                $(".notificationsPanel").addClass("show");
                $("#sidebarNotifications").addClass("active");
            }
        } else {
            // Toggle the sidebar and notifications panel
            $(".sidebar").toggleClass("active");
            $(".notificationsPanel").toggleClass("show");
            $("#sidebarNotifications").toggleClass("active");
    
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

    //sidebar tooltip    
    $("#sidebarProfile").hover(function(){
        $("#sidebarProfile").attr("data-toggle", "popover");
        $("#sidebarProfile").popover({
            content: "The Profile contains user information and activity.",
            placement: "right",
            template: '<div class="popover custom-popover-content" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>'
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
            placement: "right",
            template: '<div class="popover custom-popover-content" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>'
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
            placement: "right",
            template: '<div class="popover custom-popover-content" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>'
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
            placement: "right",
            template: '<div class="popover custom-popover-content" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>'
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
            placement: "right",
            template: '<div class="popover custom-popover-content" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>'
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
            placement: "right",
            template: '<div class="popover custom-popover-content" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>'
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
            placement: "right",
            template: '<div class="popover custom-popover-content" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>'
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
            placement: "right",
            template: '<div class="popover custom-popover-content" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>'
        });
        $('[data-toggle = "popover"]').popover("show");
    }, function(){
        $("#sidebarReport").removeAttr("data-toggle");
        $('.popover').popover('dispose');
    });
});

function notificationRedirect(uniqueid, notificationSource) {
    if (notificationSource == "Calendar") {
        window.location.replace("calendar.php");
    } else if (notificationSource == "Community Creations") {
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
                            if (details.creationid == uniqueid) {
                                if ((details.filetype).includes("image")) {
                                    link = "../modules/communitySubmissions.php?openTab=communitySubPhotos&view=";
                                } else if ((details.filetype).includes("video")) {
                                    link = "../modules/communitySubmissions.php?openTab=communitySubVideos&view=";
                                } else if (details.filetype == ""){
                                    link = "../modules/communitySubmissions.php?openTab=communitySubBlogs&view=";
                                }
                                window.location.href = link + encodeURIComponent(uniqueid);
                            }
                        }
                    }
                }
            }
        });
    } else if (notificationSource.includes("Discussion Forum")) {
        window.location.replace("discussionForumPost.php?topicId=" + uniqueid);
    }
}

function reportedContentDetails(title, violations) {
    $("#reportedContentTitle").text(title);
    $("#reportedContentViolations").text(violations);
    $("#reportDetails").modal();
    $("#reportDetails").show();
}