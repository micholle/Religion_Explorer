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
                    
                    $("#communityPhotos").append("<div><img class='communityFile' onclick='viewContent(\"" + photoDetails.creationid + "\")' src='" + photoDetails.filedata +"'></div>");

                    photosCounter++;

                    if (photosCounter == 5) {
                        break;
                    }
                }
            }

            for (let video in communityData["videos"]) {
                var videoList = communityData["videos"][video];
                for (videoData in videoList) {
                    var videoDetails = videoList[videoData];

                    $("#communityVideos").append("<div><video class='communityFile' onclick='viewContent(\"" + videoDetails.creationid + "\")' autoplay muted controls> <source src='" + videoDetails.filedata +"'> </video></div>");

                    videosCounter++

                    if (videosCounter == 5) {
                        break;
                    }
                }
            }
            
            for (let readingMaterial in communityData["readingMaterials"]) {
                var readingMaterialsList = communityData["readingMaterials"][readingMaterial];
            
                for (let readingMaterialData in readingMaterialsList) {
                    var readingMaterialDetails = readingMaterialsList[readingMaterialData];

                    var [year, month, day] = readingMaterialDetails.date.split('-');
                    var formattedDate = `${month}-${day}-${year}`;   

                    var showReadingMaterial = "<div><div class='communityReadingMaterials' onclick='viewContent(\"" + readingMaterialDetails.contentid + "\")'>" + readingMaterialData + "<div class='libraryReadMatsTag' style='margin: 3px'>" + readingMaterialDetails.religion + "</div></div>" + readingMaterialDetails.author + " | " + formattedDate+ "<br>" + readingMaterialDetails.description + "</div> <br>"
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
        var username = $("#accountUsernamePlaceholder").text();
        var title = $("#communityTitle").val();
        var religion = $("#communityCategory").val();
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
          success: function() {
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
                $("#communityCategory").val("Religion");
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
    //redirect to community creations submission page and filter to only show file with matching content id
}