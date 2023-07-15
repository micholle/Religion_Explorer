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
            var photosCounter = 0;
            var videosCounter = 0;
            var readingMaterialsCounter = 0;

            for (let photo in communityData["photos"]) {
                var photoList = communityData["photos"][photo];
                for (photoData in photoList) {
                    var photoDetails = photoList[photoData];

                    fetch(photoDetails.file)
                    .then(response => response.blob())
                    .then(blob => {
                        const url = URL.createObjectURL(blob);

                        $("#communityPhotos").append("<img onclick='viewContent(\"" + photoDetails.creationid + "\")' src=" + url +"> &nbsp;");
                        
                        // URL.revokeObjectURL(url);
                    });

                    photosCounter++;

                    if (photosCounter == 3) {
                        break;
                    }
                }
            }

            for (let video in communityData["videos"]) {
                var videoList = communityData["videos"][video];
                for (videoData in videoList) {
                    var videoDetails = videoList[videoData];

                    fetch(videoDetails.file)
                    .then(response => response.blob())
                    .then(blob => {
                        const url = URL.createObjectURL(blob);

                        $("#communityVideos").append("<video onclick='viewContent(\"" + videoDetails.creationid + "\")' width='200' autoplay muted controls> <source src=" + url +"> </video> &nbsp;");
                        
                        // URL.revokeObjectURL(url);
                    });

                    videosCounter++

                    if (videosCounter == 3) {
                        break;
                    }
                }
            }
            
            for (let readingMaterial in communityData["readingMaterials"]) {
                var readingMaterialsList = communityData["readingMaterials"][readingMaterial];
            
                for (let readingMaterialData in readingMaterialsList) {
                    var readingMaterialDetails = readingMaterialsList[readingMaterialData];
            
                    // var readingMaterialTopics = "";
                    // for (let topic in readingMaterialDetails.topics) {
                    //     readingMaterialTopics += readingMaterialDetails.topics[topic] + " ";
                    // }
            
                    var showReadingMaterial = "<div onclick='viewContent(\"" + readingMaterialDetails.contentid + "\")'>" + readingMaterialData + " | " + readingMaterialDetails.topics + "<br>" + readingMaterialDetails.author + " | " + readingMaterialDetails.date + "<br>" + readingMaterialDetails.description + "</div> <br>"
                    $("#communityReadingMaterials").append(showReadingMaterial);

                    readingMaterialsCounter++;

                    if (readingMaterialsCounter == 3) {
                        break;
                    }
                }
            }            
        }
    });

    $("#communityCreate").click(function(){
        $('#communityModal').modal();
        $('#communityModal').show();
    });

    $("#communityPublish").click(function(){
        var username = $("#usernamePlaceholder").text();
        var title = $("#communityTitle").val();
        var religion = "Christianity";
        var topics = JSON.stringify(["sample1", "sample2"]);
        var description = $("#communityDescription").val();

        if ( $("#communityUpload")[0].files[0] != null){
            var filedata = $("#communityUpload")[0].files[0];
            var filename = filedata.name;
            var filetype = filedata.type;
            var filesize = filedata.size;
        } else {
            var filedata = "";
            var filename = "";
            var filetype = "";
            var filesize = "";
        }

        var status = "Published";
        var date = new Date().toISOString().slice(0, 10);

        var creation = new FormData();
        creation.append("username", username);
        creation.append("title", title);
        creation.append("religion", religion);
        creation.append("topics", topics);
        creation.append("description", description);
        creation.append("filedata", filedata);
        creation.append("filename", filename);
        creation.append("filetype", filetype);
        creation.append("filesize", filesize);
        creation.append("status", status);
        creation.append("date", date);

        $.ajax({
          url: "../../ajax/submitCommunityCreations.ajax.php",
          method: "POST",
          data: creation,
          dataType: "text",
          processData: false,
          contentType: false,
          success: function(data) {
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
          },
          error: function() {
            $("#communityModal").removeClass("fade").modal("hide");
            $("#communityModal").modal("dispose");

            $("#communityNoticeHeader").html("Upload Failed");
            $("#communityNoticeContent").html("Something went wrong.");
            $("#communityNoticeModal").modal();
            $("#communityNoticeModal").show();

            setTimeout(function(){
                $("#communityNoticeHeader").html("");
                $("#communityNoticeContent").html("");

                $("#communityNoticeModal").removeClass("fade").modal("hide");
                $("#communityNoticeModal").modal("dispose");
                }, 1500);
            },
            complete: function() {
                $("#communityUpload").val("");
                $("#communityTitle").val("");
                $("#communityCategory").val("");
                $("#communityDescription").val("");
              }
        });
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

    document.getElementById("communityPhotosMore").addEventListener("click", function() {
        window.location.href = "communitySubmissions.php?openTab=communitySubPhotos";
    });

    document.getElementById("communityVideosMore").addEventListener("click", function() {
        window.location.href = "communitySubmissions.php?openTab=communitySubVideos";
    });

    document.getElementById("communityBlogsMore").addEventListener("click", function() {
        window.location.href = "communitySubmissions.php?openTab=communitySubBlogs";
    });  

    // document.getElementById("communityPhotosMore").addEventListener("click", function() {
    //     window.location.href = "communitySubmissions.php?openTab=communityPhotos";
    // });  
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
                        if (contentDetails == "creationid" && communityData[fileType][content][contentDetails] == creationid) {
                            if (fileType == "photos") {
                                for (let photo in communityData["photos"]) {
                                    var photoList = communityData["photos"][photo];
                                    for (photoData in photoList) {
                                        var photoData = photoList[photoData];

                                        var modalContent = "<div> <img src='../assets/img/community-download.png' onclick='downloadContent(\"" + photoData.file + "\")'>" +
                                        "<img src='../assets/img/community-report.png' onclick='reportContent(\"" + photoData + "\")'>" + 
                                        "<img src='../assets/img/community-copy.png' id='copyContent' onclick='copyContent(\"" + photoData.file + "\")'>" +
                                        "<img src='../assets/img/community-bookmark.png' id='bookmarkContent' onclick='bookmarkContent(\"" + creationid + "\")'>" + 
                                        "<img src=" + photoData.file +">" + 
                                        "<br>" + photoData + "<br>" + photoData.accountid + " | " + photoData.date +
                                        "<br>" + photoData.description + "</div>";
                                    }
                                }
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