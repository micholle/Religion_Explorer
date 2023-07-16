$(function() {
    $.ajax({
        url: "../../ajax/showAdminSidebar.ajax.php",
        method: "POST",
        success:function(data){
            $("#reportedUsersSidebar").html(data);
        }
    });

    $(".js-example-basic-multiple").select2({
        width: "100%"
    });

    $('#reportedUsersFilter').on('select2:select', function() {
        var selectedValues = $('.js-example-basic-multiple').val();
        var timeValues = ["today", "week", "month", "year"];

        for (value in selectedValues) {
            if (!(timeValues.includes(selectedValues[value]))){
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
        success:function(data){
            var reportedUsers = data;

            var userid = "";
            var userLink = "";
            var violations = "";
            var reportedOn = "";
            var reportedBy = "";

            for (user in reportedUsers) {
                userDetails = reportedUsers[user];

                userid = user;
                userLink = userDetails.userLink;

                violations = "";
                for (violation in userDetails.violation) {
                    violations += userDetails.violation[violation] + "<br><br>";
                }

                reportedOn = userDetails.reportedOn;
                reportedBy = userDetails.reportedBy;

                
                $("#useridColumn").append('<div class="' + userid + ' adminReviewContainerContent justify-content-center align-items-center"> <p>' + userid + '</p> </div>');
                $("#userLinkColumn").append('<div class="' + userid + ' adminReviewContainerContent justify-content-center align-items-center"> <a href="' + userLink + '">' + userLink + '</a> </div>');
                $("#userViolationColumn").append('<div class="' + userid + ' adminReviewContainerContent justify-content-center align-items-center"> <p>' + violations + '</p> </div>');
                $("#userReportedOnColumn").append('<div class="' + userid + ' adminReviewContainerContent justify-content-center align-items-center"> <p>' + reportedOn + '</p> </div>');
                $("#userReportedByColumn").append('<div class="' + userid + ' adminReviewContainerContent justify-content-center align-items-center"> <p>' + reportedBy + '</p> </div>');
                $("#userActionColumn").append('<div class="' + userid + ' adminReviewContainerContent justify-content-center align-items-center flex-column">' +
                    '<img class="reportButton" id="resolveReportUserBtn" src="../assets/img/admin/action-check.png" onclick="resolveReport(' + userid + ')">' +
                    '<img class="reportButton" id="suspendUserBtn" src="../assets/img/admin/action-slash.png" onclick="suspendUser(' + userid + ')">' +
                    '<img class="reportButton" id="banUserBtn" src="../assets/img/admin/action-dash.png" onclick="banUser(' + userid + ')"">' +
                '</div>');
            }
        }
    });
        
    $("#resolveReportUserBtn").click(function(){
        $('#resolveReportUserModal').modal();
        $('#resolveReportUserModal').show();
    });

    $("#suspendUserBtn").click(function(){
        $('#suspendUserModal').modal();
        $('#suspendUserModal').show();
    });

    $("#banUserBtn").click(function(){
        $('#banUserModal').modal();
        $('#banUserModal').show();
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
});

function resolveReport(userid) {
    alert("Resolve report with user id: " + userid);
}

function suspendUser(userid) {
    alert("Suspend user with user id: " + userid);
}

function banUser(userid) {
    alert("Ban user with user id: " + userid);
}
