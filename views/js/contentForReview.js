$(function() {
    $.ajax({
        url: "../../ajax/showAdminSidebar.ajax.php",
        method: "POST",
        success:function(data){
            $("#contentForReviewSidebar").html(data);
            var currentPage = window.location.pathname.split("/").pop();

            $("#contentForReviewSidebar li a").each(function() {
                var tabPage = $(this).attr("href");
                if (tabPage === currentPage) {
                   $(this).addClass("active");
                }
            });
        }
    });


    $("#contentFilter").on("click", function() {
        var contentFilter = $(this).val();
        
        $.ajax({
            url: "../../ajax/getReportedContent.ajax.php",
            method: "POST",
            success:function(data){
                var contentForReview = data;
    
                for (content in contentForReview) {
                    var contentDetails = contentForReview[content];
                    var contentClass = "." + content;

                    var violations = contentDetails.violation;

                    if(contentFilter == null){
                        $(contentClass).show();
                    } else {
                        if (violations.includes(contentFilter)) {
                            $(contentClass).show();
                        } else {
                            $(contentClass).hide();
                        }
                    }
                }
            }
        });   
    });
    
    $.ajax({    
        url: "../../ajax/getReportedContent.ajax.php",
        method: "POST",
        success:function(data){
            var contentForReview = data;

            var contentid = "";
            var violations = "";
            var additionalContext = "";
            var reportedOn = "";
            var reportedBy = "";
            var contentCreator = "";
            var contentLink = "";

            for (content in contentForReview) {
                var contentDetails = contentForReview[content];

                var [year, month, day] = contentDetails.reportedOn.split('-');
                var formattedDate = `${month}-${day}-${year}`;

                contentid = contentDetails.contentid;
                violations = contentDetails.violation;
                additionalContext = contentDetails.additionalContext;
                reportedOn = formattedDate;
                reportedBy = contentDetails.reportedBy;
                contentCreator = contentDetails.contentCreator;
                contentLink = contentDetails.contentLink;
                
                $("#contentidColumn").append('<div class="' + content + ' adminReviewContainerContent justify-content-center align-items-center text-center"> <a href="' + contentLink + contentid + '">' + contentid + '</a> </div>');
                $("#violationColumn").append('<div class="' + content + ' adminReviewContainerContent justify-content-center align-items-center"> <p>' + violations + '</p> </div>');
                $("#additionalContextColumn").append('<div class="' + content + ' adminReviewContainerContent justify-content-center align-items-center"> <p>' + additionalContext + '</p> </div>');
                $("#reportedOnColumn").append('<div class="' + content + ' adminReviewContainerContent justify-content-center align-items-center"> <p>' + reportedOn + '</p> </div>');
                $("#reportedByColumn").append('<div class="' + content + ' adminReviewContainerContent justify-content-center align-items-center"> <p>' + reportedBy + '</p> </div>');
                $("#actionColumn").append('<div class="' + content + ' adminReviewContainerContent justify-content-center align-items-center flex-row">' +
                    '<img class="reportButton" src="../assets/img/admin/action-check.png" onclick="resolveReport(' + "'" + contentid + "'" + ')">' +
                    '<img class="reportButton" src="../assets/img/admin/action-x.png" onclick="deleteContent(' + "'" + contentid + "'" +')">' +
                    '<img class="reportButton" src="../assets/img/admin/action-exclamation.png" onclick="reportUser(' + "'" + contentid + '\', \'' + violations + '\', \'' + additionalContext + '\', \'' + contentCreator + '\')"">' +
                '</div>');

            }
        }
    });

    $("#contentSearch").keyup(function () { 
        var contentSearchVal = $("#contentSearch").val().toLowerCase();

        $.ajax({
            url: "../../ajax/getReportedContent.ajax.php",
            method: "POST",
            success:function(data){
                var contentForReview = data;
    
                for (content in contentForReview) {
                    var contentDetails = contentForReview[content];
                    var contentid = contentDetails.contentid;
                    var contentLink = contentDetails.contentLink;
                    var additionalContext = contentDetails.additionalContext;
                    var reportedOn = contentDetails.reportedOn;
                    var reportedBy = contentDetails.reportedBy;
                    var contentClass = "." + content;

                    if(((contentid.toLowerCase()).includes(contentSearchVal)) || ((contentLink.toLowerCase()).includes(contentSearchVal)) || ((additionalContext.toLowerCase()).includes(contentSearchVal)) || ((reportedOn.toLowerCase()).includes(contentSearchVal)) || ((reportedBy.toLowerCase()).includes(contentSearchVal))) {
                        $(contentClass).show();
                    } else {
                        $(contentClass).hide();
                    }
                }
            }
        });
    });

    $("#confirmResolveReportContent").click(function () { 
        var contentid = $("#resolveReportContentid").text();
        
        $.ajax({
            url: "../../ajax/resolveReportedContent.ajax.php",
            method: "POST",
            data: {"contentid" : contentid},
            success:function(data){
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

                    var contentClass = "." + contentid;
                    $(contentClass).hide();
                }, 2000);
            }
        });
    });

    $("#confirmDeleteReportContent").click(function () { 
        var contentid = $("#deleteReportContentid").text();
        
        $.ajax({
            url: "../../ajax/deleteReportedContent.ajax.php",
            method: "POST",
            data: {"contentid" : contentid},
            success:function(data){
                console.log(data);
                $("#toast").html("Content deleted.");
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
                    
                    var contentClass = "." + contentid;
                    $(contentClass).hide();
                }, 2000);
            }
        });
    });

    $("#confirmReportUser").click(function () { 
        var contentid = $("#reportUserContentid").text();
        var reportUserUsername =  $("#reportUserContentCreator").text();
        var userViolations = $("#reportUserViolations").text();
        var additionalContext = $("#reportUserAdditionalContext").text();
        
        var currentDate = new Date();
        var year = currentDate.getFullYear();
        var month = String(currentDate.getMonth() + 1).padStart(2, '0');
        var day = String(currentDate.getDate()).padStart(2, '0');
        var reportedOn = `${year}-${month}-${day}`;

        reportData = new FormData();
        reportData.append("username" , reportUserUsername);
        reportData.append("userViolations" , "Content Violations: " + userViolations);
        reportData.append("additionalContext", additionalContext);
        reportData.append("reportedOn", reportedOn);
        reportData.append("reportedBy", "Admin");

        $.ajax({
            url: "../../ajax/submitReportUser.ajax.php",
            method: "POST",
            data: reportData,
            dataType: "text",
            processData: false,
            contentType: false,
            success: function() {
                $("#toast").html("User reported.");
            },
            error: function() {
                $("#toast").html("There was an error processing your request. Please try again later.")
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

function resolveReport(contentid) {
    $("#resolveReportContentid").html(contentid);
    $("#resolveReportContentModal").modal();
    $("#resolveReportContentModal").show();
}

function deleteContent(contentid) {
    $("#deleteReportContentid").html(contentid);
    $("#deleteContentModal").modal();
    $("#deleteContentModal").show();
}

function reportUser(contentid, violations, additionalContext, contentCreator) {
    $("#reportUserContentid").html(contentid);
    $("#reportUserViolations").html(violations);
    $("#reportUserAdditionalContext").html(additionalContext);
    $("#reportUserContentCreator").html(contentCreator);

    $("#reportUserModal").modal();
    $("#reportUserModal").show();
}
