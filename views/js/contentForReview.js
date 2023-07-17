$(function() {
    $.ajax({
        url: "../../ajax/showAdminSidebar.ajax.php",
        method: "POST",
        success:function(data){
            $("#contentForReviewSidebar").html(data);
        }
    });

    $(".js-example-basic-multiple").select2({
        width: "100%"
    });

    $('#contentFilter').on('select2:select', function() {
        var selectedValues = $('.js-example-basic-multiple').val();
        var timeValues = ["today", "week", "month", "year"];

        for (value in selectedValues) {
            if (!(timeValues.includes(selectedValues[value]))){
                var violationFilter = selectedValues[value];
            
                $.ajax({
                    url: "../../ajax/getReportedContent.ajax.php",
                    method: "POST",
                    success:function(data){
                        var contentForReview = data;
            
                        for (content in contentForReview) {
                            var contentDetails = contentForReview[content];
                            var contentid = content;
                            var contentClass = "." + contentid;
    
                            var violations = contentDetails.violation;
    
                            if(violations.length == 0){
                                $(contentClass).show();
                            } else {
                                if (violations.includes(violationFilter)) {
                                    $(contentClass).show();
                                } else {
                                    $(contentClass).hide();
                                }
                            }
                        }
                    }
                });   
            }
        }
    });

    
    $.ajax({    
        url: "../../ajax/getReportedContent.ajax.php",
        method: "POST",
        success:function(data){
            var contentForReview = data;

            var contentid = "";
            var contentLink = "";
            var violations = "";
            var reportedOn = "";
            var reportedBy = "";

            for (content in contentForReview) {
                var contentDetails = contentForReview[content];

                var [year, month, day] = contentDetails.reportedOn.split('-');
                var formattedDate = `${month}-${day}-${year}`;

                contentid = content;
                contentLink = contentDetails.contentLink;
                violations = contentDetails.violation;
                reportedOn = formattedDate;
                reportedBy = contentDetails.reportedBy;
                
                $("#contentidColumn").append('<div class="' + contentid + ' adminReviewContainerContent justify-content-center align-items-center"> <p>' + contentid + '</p> </div>');
                $("#contentLinkColumn").append('<div class="' + contentid + ' adminReviewContainerContent justify-content-center align-items-center text-center"> <a href="' + "http://localhost/religion_explorer/views/modules/communitySubmissions.php/" + contentid + '">' + contentLink + '</a> </div>');
                $("#violationColumn").append('<div class="' + contentid + ' adminReviewContainerContent justify-content-center align-items-center"> <p>' + violations + '</p> </div>');
                $("#reportedOnColumn").append('<div class="' + contentid + ' adminReviewContainerContent justify-content-center align-items-center"> <p>' + reportedOn + '</p> </div>');
                $("#reportedByColumn").append('<div class="' + contentid + ' adminReviewContainerContent justify-content-center align-items-center"> <p>' + reportedBy + '</p> </div>');
                $("#actionColumn").append('<div class="' + contentid + ' adminReviewContainerContent justify-content-center align-items-center flex-column">' +
                    '<img class="reportButton" src="../assets/img/admin/action-check.png" onclick="resolveReport(' + "'" + contentid + "'" + ')">' +
                    '<img class="reportButton" src="../assets/img/admin/action-x.png" onclick="deleteContent(' + "'" + contentid + "'" +')">' +
                    '<img class="reportButton" src="../assets/img/admin/action-exclamation.png" onclick="reportUser(' + "'" + contentid + "'" +')"">' +
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
                    var contentid = content;
                    var contentLink = contentDetails.contentLink;
                    var reportedBy = contentDetails.reportedBy;
                    var contentClass = "." + contentid;

                    if(((contentid.toLowerCase()).includes(contentSearchVal)) || ((contentLink.toLowerCase()).includes(contentSearchVal)) || ((reportedBy.toLowerCase()).includes(contentSearchVal))) {
                        $(contentClass).show();
                    } else {
                        $(contentClass).hide();
                    }
                }
            }
        });
    });
});

function resolveReport(contentid) {
    $("#resolveReportContentModal").modal();
    $("#resolveReportContentModal").show();
}

function deleteContent(contentid) {
    $("#deleteContentModal").modal();
    $("#deleteContentModal").show();
}

function reportUser(contentid) {
    $("#reportUserModal").modal();
    $("#reportUserModal").show();
}
