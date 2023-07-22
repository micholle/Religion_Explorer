$(function() {
    getReportedUsers();
    $(document).on("click", ".reportButton", function() {
        var userID = $(this).data("userid");
        var action = $(this).data("action");

        if (action === "resolve") {
            resolveReport(userID);
        } else if (action === "suspend") {
            suspendUser(userID);
        } else if (action === "ban") {
            banUser(userID);
        }
    });

    $.ajax({
        url: "../../ajax/showAdminSidebar.ajax.php",
        method: "POST",
        success:function(data){
            $("#reportedUsersSidebar").html(data);

            $("#reportedUsersSidebar li a").each(function() {
                var tabPage = $(this).attr("href");
                if (tabPage === currentPage) {
                   $(this).addClass("active");
                }
            });
        }
    });

    $(".js-example-basic-multiple").select2({
        width: "100%"
    });

    $('#reportedUsersFilter').on('select2:select', function() {
        var selectedValues = $('.js-example-basic-multiple').val();

        for (value in selectedValues) {
            var violationFilter = selectedValues[value];
            
            $.ajax({
                url: "../../ajax/getReportedUsers.ajax.php",
                method: "POST",
                success:function(data){
                    var reportedUsers = data;
        
                    for (user in reportedUsers) {
                        var userDetails = reportedUsers[user];
                        var userid = user;
                        var userClass = "." + userid;

                        var violations = userDetails.violation;

                        if(violations.length == 0){
                            $(userClass).show();
                        } else {
                            if (violations.includes(violationFilter)) {
                                $(userClass).show();
                            } else {
                                $(userClass).hide();
                            }
                        }
                    }
                }
            });   
        }
    });

    $('#reportedUsersFilter').on('select2:unselect', function() {
        var selectedValues = $('.js-example-basic-multiple').val();

        if (selectedValues == "") {
            $(".adminReviewContainerContent").show();
        } else {
            for (value in selectedValues) {
                var violationFilter = selectedValues[value];
                
                $.ajax({
                    url: "../../ajax/getReportedUsers.ajax.php",
                    method: "POST",
                    success:function(data){
                        var reportedUsers = data;
            
                        for (user in reportedUsers) {
                            var userDetails = reportedUsers[user];
                            var userid = user;
                            var userClass = "." + userid;
    
                            var violations = userDetails.violation;
    
                            if(violations.length == 0){
                                $(userClass).show();
                            } else {
                                if (violations.includes(violationFilter)) {
                                    $(userClass).show();
                                } else {
                                    $(userClass).hide();
                                }
                            }
                        }
                    }
                });   
            }   
        }
    });

    function getReportedUsers(){
    $.ajax({
        url: "../../ajax/getReportedUsers.ajax.php",
        method: "POST",
        success: function (data) {
            var reportedUsers = data;
            
            $(".adminReviewContainerContent").remove();

            var userid = "";
            var userLink = "";
            var violations = "";
            var additionalContext = "";
            var reportedOn = "";
            var reportedBy = "";
    
            for (user in reportedUsers) {
                userDetails = reportedUsers[user];
    
                userid = user;
                userLink = userDetails.userLink;
                violations = userDetails.violation;
                additionalContext = userDetails.additionalContext;
                reportedOn = userDetails.reportedOn;
                reportedBy = userDetails.reportedBy;

                
                $("#useridColumn").append('<div class="' + userid + ' adminReviewContainerContent justify-content-center align-items-center"> <p>' + userid + '</p> </div>');
                $("#userLinkColumn").append('<div class="' + userid + ' adminReviewContainerContent justify-content-center align-items-center"> <a href="' + ("http://localhost/religion_explorer/views/modules/userProfile.php/" + userid)  + '">' + userLink + '</a> </div>');
                $("#userViolationColumn").append('<div class="' + userid + ' adminReviewContainerContent justify-content-center align-items-center"> <p>' + violations + '</p> </div>');
                $("#userAdditionalContextColumn").append('<div class="' + userid + ' adminReviewContainerContent justify-content-center align-items-center"> <p>' + additionalContext + '</p> </div>');
                $("#userReportedOnColumn").append('<div class="' + userid + ' adminReviewContainerContent justify-content-center align-items-center"> <p>' + reportedOn + '</p> </div>');
                $("#userReportedByColumn").append('<div class="' + userid + ' adminReviewContainerContent justify-content-center align-items-center"> <p>' + reportedBy + '</p> </div>');
                $("#userActionColumn").append('<div class="' + userid + ' adminReviewContainerContent justify-content-center align-items-center flex-column">' +
                    '<img class="reportButton" src="../assets/img/admin/action-check.png" data-userid="' + userid + '" data-action="resolve">' +
                    '<img class="reportButton" src="../assets/img/admin/action-slash.png" data-userid="' + userid + '" data-action="suspend">' +
                    '<img class="reportButton" src="../assets/img/admin/action-dash.png" data-userid="' + userid + '" data-action="ban">' +
                '</div>');
            }
        }
    });
    }

    $("#userSearch").keyup(function () { 
        var userSearchVal = $("#userSearch").val().toLowerCase();

        $.ajax({
            url: "../../ajax/getReportedUsers.ajax.php",
            method: "POST",
            success:function(data){
                var reportedUsers = data;
    
                for (user in reportedUsers) {
                    var userDetails = reportedUsers[user];
                    var userid = user;
                    var userLink = userDetails.userLink;
                    var userReportedBy = userDetails.reportedBy;
                    var userClass = "." + userid;

                    if(((userid.toLowerCase()).includes(userSearchVal)) || ((userLink.toLowerCase()).includes(userSearchVal)) || ((userReportedBy.toLowerCase()).includes(userSearchVal))) {
                        $(userClass).show();
                    } else {
                        $(userClass).hide();
                    }
                }
            }
        });
    });

    $("#confirmResolveUserReport").click(function () { 
        var userID = $("#resolveReportUserid").text();
        
        $.ajax({
            type: "POST",
            url: "../../ajax/reportAction.ajax.php",
            data: {
                action: "resolve",
                userid: userID
            },
            success:function(){
                getReportedUsers();
                $("#resolveUserModal").removeClass("fade").modal("hide");
                $("#resolveUserModal").modal("dispose");
                $("#toast").html("Report resolved.");
            }, error: function() {
                $("#toast").html("There was an error processing your request. Please try again later.")
                $("#toast").css("background-color", "#E04F5F");
            },
            complete: function() {
                $("#resolveReportContentModal").removeClass("fade").modal("hide");
                $("#resolveReportContentModal").modal("dispose");

                $('#toast').addClass('show');
    
                setTimeout(function() {
                    $('#toast').removeClass('show');
                    location.reload();
                }, 2000);
            }
        });
    });

    $("#confirmSuspendUser").click(function() {
        var userID = $("#suspendUserUserid").text();
        var suspendUserVal = $("#suspendUserVal").val();
        var suspendUserTime = $("#suspendUserTime").val();
    
        $.ajax({
            type: "POST",
            url: "../../ajax/reportAction.ajax.php",
            data: {
                action: "suspend",
                userid: userID,
                duration: suspendUserVal,
                unit: suspendUserTime
            },
            success: function(response) {
                    getReportedUsers();
                    $("#toast").html("User suspended for " + suspendUserVal + " " + suspendUserTime);
                    $("#suspendUserModal").removeClass("fade").modal("hide");
                    $("#suspendUserModal").modal("dispose");
                    $('#toast').addClass('show');
                    setTimeout(function() {
                        $('#toast').removeClass('show');
                        location.reload();
                    }, 2000);
            },
            error: function() {
                $("#toast").html("There was an error processing your request. Please try again later.");
                $("#toast").css("background-color", "#E04F5F");
            }
        });
    });
    
    // Event listener for "Confirm Ban User" button
    $("#confirmBanUser").click(function() {
        var userID = $("#banUserUserid").text();
    
        $.ajax({
            type: "POST",
            url: "../../ajax/reportAction.ajax.php",
            data: {
                action: "ban",
                userid: userID
            },
            success: function(response) {
                    getReportedUsers();
                    $("#toast").html("User banned.");
                    $("#banUserModal").removeClass("fade").modal("hide");
                    $("#banUserModal").modal("dispose");
                    $('#toast').addClass('show');
                    setTimeout(function() {
                        $('#toast').removeClass('show');
                    }, 2000);
            },
            error: function() {
                $("#toast").html("There was an error processing your request. Please try again later.");
                $("#toast").css("background-color", "#E04F5F");
            }
        });
    });    
    
});

function resolveReport(userid) {
    $("#resolveReportUserid").html(userid);
    $('#resolveReportUserModal').modal();
    $('#resolveReportUserModal').show();
}

function suspendUser(userid) {
    $("#suspendUserUserid").html(userid);
    $('#suspendUserModal').modal();
    $('#suspendUserModal').show();
}

function banUser(userid) {
    $("#banUserUserid").html(userid);
    $('#banUserModal').modal();
    $('#banUserModal').show();
}
