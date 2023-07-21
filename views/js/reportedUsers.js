$(function() {
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

    $.ajax({
        url: "../../ajax/getReportedUsers.ajax.php",
        method: "POST",
        success: function (data) {
            var reportedUsers = data;
    
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
                    '<img class="reportButton" src="../assets/img/admin/action-check.png" onclick="resolveReport(' + userid + ')">' +
                    '<img class="reportButton" src="../assets/img/admin/action-slash.png" onclick="suspendUser(' + userid + ')">' +
                    '<img class="reportButton" src="../assets/img/admin/action-dash.png" onclick="banUser(' + userid + ')"">' +
                '</div>');
            }
        }
    });

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
        var userid = $("#resolveReportUserid").text();
        
        $.ajax({
            url: "../../ajax/sample.ajax.php", //insert ajax
            method: "POST",
            data: {},
            success:function(){
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

    $("#confirmSuspendUser").click(function () { 
        var userid = $("#suspendUserUserid").text();
        var suspendUserVal = $("#suspendUserVal").val();
        var suspendUserTime = $("#suspendUserTime").val();

        alert("User suspended for " + suspendUserVal + " " + suspendUserTime);

        $.ajax({
            url: "../../ajax/sample.ajax.php", //insert ajax
            method: "POST",
            data: {},
            success:function(){
                $("#toast").html("User suspended for " + suspendUserVal + " " + suspendUserTime)
            }, error: function() {
                $("#toast").html("There was an error processing your request. Please try again later.")
                $("#toast").css("background-color", "#E04F5F");
            },
            complete: function() {
                $("#deleteContentModal").removeClass("fade").modal("hide");
                $("#deleteContentModal").modal("dispose");

                $('#toast').addClass('show');
    
                setTimeout(function() {
                    $('#toast').removeClass('show');
                    location.reload();
                }, 2000);
            }
        });
    });

    $("#confirmBanUser").click(function () { 
        var userid = $("#banUserUserid").text();
        
        $.ajax({
            url: "../../ajax/sample.ajax.php", //insert ajax
            method: "POST",
            data: {},
            success:function(){
                $("#toast").html("User banned.");
            }, error: function() {
                $("#toast").html("There was an error processing your request. Please try again later.");
                $("#toast").css("background-color", "#E04F5F");
            },
            complete: function() {
                $("#reportUserModal").removeClass("fade").modal("hide");
                $("#reportUserModal").modal("dispose");

                $('#toast').addClass('show');
    
                setTimeout(function() {
                    $('#toast').removeClass('show');
                }, 2000);
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


