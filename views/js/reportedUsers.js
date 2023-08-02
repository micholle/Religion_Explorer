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

    $("#reportedUsersFilter").on("click", function() {
        var reportedUsersFilter = $(this).val();
            
        $.ajax({
            url: "../../ajax/getReportedUsers.ajax.php",
            method: "POST",
            success:function(data){
                var reportedUsers = data;
    
                for (user in reportedUsers) {
                    var userDetails = reportedUsers[user];
                    var userClass = "." + user;
                    var violations = userDetails.violation;

                    if(reportedUsersFilter == null){
                        $(userClass).show();
                    } else {
                        if (violations.includes(reportedUsersFilter)) {
                            $(userClass).show();
                        } else {
                            $(userClass).hide();
                        }
                    }
                }
            }
        });   
    });

    function getReportedUsers(){
        $.ajax({
            url: "../../ajax/getReportedUsers.ajax.php",
            method: "POST",
            success: function (data) {
                var reportedUsers = data;
                console.log(reportedUsers);
                
                $(".adminReviewContainerContent").remove();

                var userid = "";
                var violations = "";
                var additionalContext = "";
                var reportedOn = "";
                var reportedBy = "";
        
                for (user in reportedUsers) {
                    userDetails = reportedUsers[user];

                    var [year, month, day] = userDetails.reportedOn.split('-');
                    var formattedDate = `${month}-${day}-${year}`;
        
                    userid = userDetails.userid;
                    violations = userDetails.violation;
                    additionalContext = userDetails.additionalContext;
                    reportedOn = formattedDate;
                    reportedBy = userDetails.reportedBy;
                    
                    $("#useridColumn").append('<div class="' + user + ' adminReviewContainerContent justify-content-center align-items-center"> <p> <a href="' + ("viewUserProfile.php?accountid=" + userid)  + '">' + userid + '</a></p> </div>');
                    $("#userViolationColumn").append('<div class="' + user + ' adminReviewContainerContent justify-content-center align-items-center"> <p>' + violations + '</p> </div>');
                    $("#userAdditionalContextColumn").append('<div class="' + user + ' adminReviewContainerContent justify-content-center align-items-center"> <p>' + additionalContext + '</p> </div>');
                    $("#userReportedOnColumn").append('<div class="' + user + ' adminReviewContainerContent justify-content-center align-items-center"> <p>' + reportedOn + '</p> </div>');
                    $("#userReportedByColumn").append('<div class="' + user + ' adminReviewContainerContent justify-content-center align-items-center"> <p>' + reportedBy + '</p> </div>');
                    $("#userActionColumn").append('<div class="' + user + ' adminReviewContainerContent justify-content-center align-items-center flex-column">' +
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
                    var userid = userDetails.userid;
                    var userAdditionalContext = userDetails.additionalContext;
                    var userReportedOn = userDetails.reportedOn;
                    var userReportedBy = userDetails.reportedBy;
                    var userClass = "." + user;

                    if(((userid.toLowerCase()).includes(userSearchVal)) || ((userAdditionalContext.toLowerCase()).includes(userSearchVal)) || ((userReportedOn.toLowerCase()).includes(userSearchVal)) || ((userReportedBy.toLowerCase()).includes(userSearchVal))) {
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
                $("#resolveReportUserModal").removeClass("fade").modal("hide");
                $("#resolveReportUserModal").modal("dispose");

                $("#toast").addClass("show");
    
                setTimeout(function() {
                    $("#toast").removeClass("show");
                    var userClass = "." + userID;
                    $(userClass).hide();
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
                        var userClass = "." + userID;
                        $(userClass).hide();
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
                    $("#toast").addClass("show");

                    setTimeout(function() {
                        $("#toast").removeClass("show");
                        var userClass = "." + userID;
                        $(userClass).hide();
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
