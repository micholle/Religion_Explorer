$(function() {
    $.ajax({
        url: "../../ajax/showSidebar.ajax.php",
        method: "POST",
        success:function(data){
            $("#communitySidebar").html(data);
        }
    });

    $.ajax({
        url: "../../ajax/getCommunityData.ajax.php",
        method: "POST",
        success:function(data){
            var communityData = data;

            for (let photo in communityData["photos"]) {
                var photoDetails = communityData["photos"][photo];
                $("#communityPhotos").append("<img onclick='viewContent(\"" + photoDetails.contentid + "\")' src=" + photoDetails.file +"> &nbsp;");
            }

            for (let video in communityData["videos"]) {
                var videoDetails = communityData["videos"][video];
                $("#communityVideos").append("<video onclick='viewContent(\"" + videoDetails.contentid + "\")' width='200' autoplay muted controls> <source src=" + videoDetails.file +"> </video> &nbsp;");
            }
            
            for (let blog in communityData["blogs"]) {
                var blogDetails = communityData["blogs"][blog];

                var blogCategory = "";
                for (let category in blogDetails.category) {
                    blogCategory += blogDetails.category[category] + " ";
                }

                var showBlog = "<div onclick='viewContent(\"" + blogDetails.contentid + "\")'>" + blog + " | " + blogCategory + "<br>" + blogDetails.author + " | " + blogDetails.date + "<br>" + blogDetails.description + "</div> <br>"
                $("#communityBlogs").append(showBlog);
            }
        }
    });

    $("#communityCreate").click(function(){
        $('#communityModal').modal();
        $('#communityModal').show();
    });

    $("#communityPublish").click(function(){
        $("#communityModal").removeClass("fade").modal("hide");
        $("#communityModal").modal("dispose");

        $("#communityNoticeHeader").html("Upload Complete");
        $("#communityNoticeContent").html("Your file was uploaded successfully.");
        $("#communityNoticeModal").modal();
        $("#communityNoticeModal").show();

        setTimeout(function(){
            $("#communityNoticeHeader").html("");
            $("#communityNoticeContent").html("");

            $("#communityNoticeModal").removeClass("fade").modal("hide");
            $("#communityNoticeModal").modal("dispose");
        }, 1500);
    });

    $("#submitReportContent").click(function(){
        $("#reportContentModal").removeClass("fade").modal("hide");
        $("#reportContentModal").modal("dispose");

        $("#communityNoticeHeader").html("Report Received");
        $("#communityNoticeContent").html("The team will review your complaint. Please expect a notification in 3-5 business days. <br>");
        $("#communityNoticeContent").append("<button data-dismiss='modal'>Thanks!</button>");
        $("#communityNoticeModal").modal();
        $("#communityNoticeModal").show();
    });
});

function viewContent(contentid) {  
    $("#communityDisplayContent").html("");
    
    $.ajax({
        url: "../../ajax/getCommunityData.ajax.php",
        method: "POST",
        success:function(data){
            var communityData = data;

            for (let fileType in communityData) {
                for (let content in communityData[fileType]) {
                    for (let contentDetails in communityData[fileType][content]){
                        if (contentDetails == "contentid" && communityData[fileType][content][contentDetails] == contentid) {
                            if (fileType == "photos") {
                                var modalContent = "<div> <img src='../assets/img/community-download.png' onclick='downloadContent(\"" + communityData[fileType][content]["file"] + "\")'>" +
                                "<img src='../assets/img/community-report.png' onclick='reportContent(\"" + content + "\")'>" + 
                                "<img src='../assets/img/community-copy.png' id='copyContent' onclick='copyContent(\"" + communityData[fileType][content]["file"] + "\")'>" +
                                "<img src='../assets/img/community-bookmark.png' id='bookmarkContent' onclick='bookmarkContent(\"" + contentid + "\")'>" + 
                                "<img src=" + communityData[fileType][content]["file"] +">" + 
                                "<br>" + content + "<br>" + communityData[fileType][content]["author"] + " | " + communityData[fileType][content]["date"] +
                                "<br>" + communityData[fileType][content]["description"] + "</div>";
                            } else if (fileType == "videos") {
                                var modalContent = "<div> <img src='../assets/img/community-download.png' onclick='downloadContent(\"" + communityData[fileType][content]["file"] + "\")'>" +
                                "<img src='../assets/img/community-report.png' onclick='reportContent(\"" + content + "\")'>" + 
                                "<img src='../assets/img/community-copy.png' id='copyContent' onclick='copyContent(\"" + communityData[fileType][content]["file"] + "\")'>" +
                                "<img src='../assets/img/community-bookmark.png' id='bookmarkContent' onclick='bookmarkContent(\"" + contentid + "\")'>" + 
                                "<video width='200' autoplay muted controls> <source src=" + communityData[fileType][content]["file"] +"> </video>" + 
                                "<br>" + content + "<br>" + communityData[fileType][content]["author"] + " | " + communityData[fileType][content]["date"] +
                                "<br>" + communityData[fileType][content]["description"] + "</div>";
                            } else {
                                var modalContent = "<div> <img src='../assets/img/community-report.png' onclick='reportContent(\"" + content + "\")'>" + 
                                "<img src='../assets/img/community-copy.png' id='copyContent' onclick='copyContent(\"" + communityData[fileType][content]["file"] + "\")'>" +
                                "<img src='../assets/img/community-bookmark.png' id='bookmarkContent' onclick='bookmarkContent(\"" + contentid + "\")'>" + 
                                "<br>" + content + "<br>" + communityData[fileType][content]["author"] + " | " + communityData[fileType][content]["date"] +
                                "<br>" + communityData[fileType][content]["description"] + "</div>";
                            }
                            $("#communityDisplayContent").append(modalContent);
                        }
                    }
                }
            }
        }
    });

    $("#communityDisplayModal").modal();
}

function downloadContent(file) {
    fetch(file)
    .then(response => response.blob())
    .then(blob => {
      const url = URL.createObjectURL(blob);
      const link = document.createElement('a');
      link.href = url;
      link.download = "image.jpg";
      link.style.display = "none";
      document.body.appendChild(link);
      link.click();
      document.body.removeChild(link);
      URL.revokeObjectURL(url);
    });
}

function reportContent(title) {
    $("#reportContentHeader").html("");
    $("#communityDisplayModal").removeClass("fade").modal("hide");
    $("#communityDisplayModal").modal("dispose");

    $("#reportContentHeader").html("<br>" + title);
    $("#reportContentModal").modal();
}

function copyContent(file) {
    navigator.clipboard.writeText(file);
    $("#copyContent").attr("src", "../assets/img/check.png");
    $("#copyContent").attr("disabled", true);

    setTimeout(function(){
        $("#copyContent").attr("src", "../assets/img/community-copy.png");
        $("#copyContent").attr("disabled", false);

    }, 3000);
}

function bookmarkContent(contentid) {
    if ($("#bookmarkContent").attr("src") == "../assets/img/community-bookmark.png") {
        // add content to user profile bookmarks
        $("#bookmarkContent").attr("src", "../assets/img/community-bookmarked.png");
    } else {
        // remove content from user profile bookmarks
        $("#bookmarkContent").attr("src", "../assets/img/community-bookmark.png");
    }
}