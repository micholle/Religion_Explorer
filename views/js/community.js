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
                    
                    $("#communityPhotos").append("<div><img class='communityFile' onclick='viewCreationImage(\"" + photoDetails.creationid + "\")' src='" + "../" + photoDetails.filedata +"'></div>");

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

                    $("#communityVideos").append("<div><video class='communityFile' onclick='viewCreationVideo(\"" + videoDetails.creationid + "\")' autoplay muted controls> <source src='" + "../" + videoDetails.filedata +"'> </video></div>");

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

                    var showReadingMaterial = "<div class='communityReadingMaterialsWidth'><div class='communityReadingMaterials' onclick='viewCreationReadingMaterial(\"" + readingMaterialDetails.creationid + "\")'>" + readingMaterialDetails.title + "<div class='libraryReadMatsTag' style='margin-left: 10px'>" + readingMaterialDetails.religion + "</div></div>" + readingMaterialDetails.author + " | " + formattedDate+ "<br>" + readingMaterialDetails.description + "</div> <br>"
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

    const dropZone = document.getElementById("communityUploadArea");
    const fileInput = document.getElementById("communityUpload");

    dropZone.addEventListener("dragover", (e) => {
        e.preventDefault();
        dropZone.classList.add("dragover");
    });

    dropZone.addEventListener("dragleave", () => {
        dropZone.classList.remove("dragover");
    });

    dropZone.addEventListener("drop", (e) => {
        e.preventDefault();
        dropZone.classList.remove("dragover");
        const files = e.dataTransfer.files;
        fileInput.files = files;

        handleFiles(files);
    });
    
    function handleFiles(files) {
        const fileName = files[0].name;
        $("#uploadedFilename").text(fileName);
    }

    $("#communityPublish").click(function(){
        var username = $("#accountUsernamePlaceholder").text();
        var title = $("#communityTitle").val();
        var religion = $("#communityCategory").val();
        var description = $("#communityDescription").val();

        if(title == "" || religion == null || description == "") {
            $("#toast").html("Please fill out all required fields.")
            $("#toast").css("background-color", "#E04F5F");
            $("#toast").addClass('show');
        
            setTimeout(function() {
                $("#toast").removeClass('show');
            }, 2000);
        } else {
            var filedata = "";
            var filename = "";
            var filetype = "";
            var filesize = 0;
    
            if ($("#communityUpload")[0].files[0] != null){
                filedata = $("#communityUpload")[0].files[0];
                filename = filedata.name;
                filetype = filedata.type;
                filesize = filedata.size;
    
                $("#uploadedFilename").text(filename);
            } else {
                var readingMaterial = new Blob([description], { type: 'text/plain' });
                filesize = readingMaterial.size;
            }
    
            var status = "Published";
            var date = new Date().toISOString().slice(0, 10);
    
            if (filedata == "" || (filedata && (filetype.includes("image") || filetype.includes("video")))) {
                var dataUsed = 0.00;
    
                $.ajax({
                    url: "../../ajax/getCommunityData.ajax.php",
                    method: "POST",
                    success:function(data){
                        var communityData = data;
            
                        for (let photo in communityData["photos"]) {
                            var photoList = communityData["photos"][photo];
                            for (photoData in photoList) {
                                var photoDetails = photoList[photoData];
                                var imageSize = 0.00;
            
                                if (photoDetails.author == $("#accountUsernamePlaceholder").text()) {
                                    imageSize = photoDetails.filesize  / (1024 * 1024);
                                    dataUsed += imageSize;
                                }
                            }
                        }
            
                        for (let video in communityData["videos"]) {
                            var videoList = communityData["videos"][video];
                            for (videoData in videoList) {
                                var videoDetails = videoList[videoData];
                                var videoSize = 0.00;
            
                                if (videoDetails.author == $("#accountUsernamePlaceholder").text()) {
                                    videoSize = videoDetails.filesize / (1024 * 1024);
                                    dataUsed += videoSize;
                                }
                            }
                        }
                        
                        for (let readingMaterial in communityData["readingMaterials"]) {
                            var readingMaterialList = communityData["readingMaterials"][readingMaterial];
                            for (readingMaterialData in readingMaterialList) {
                                var readingMaterialDetails = readingMaterialList[readingMaterialData];
                                var readingMaterialSize = 0.00;
            
                                if (readingMaterialDetails.author == $("#accountUsernamePlaceholder").text()) {
                                    readingMaterialSize = readingMaterialDetails.filesize / 1024;
                                    dataUsed += readingMaterialDetails.filesize / (1024 * 1024);
                                }
                            }
                        }
        
                        var filesizeMB = filesize / (1024 * 1024);
                        if ((dataUsed + filesizeMB) >= 100) {
                            $("#communityModal").removeClass("fade").modal("hide");
                            $("#communityModal").modal("dispose");
                
                            $("#communityNoticeIcon").attr("src", "../assets/img/verification-error.png");
                            $("#communityNoticeHeader").html("Upload Failed");
                            $("#communityNoticeContent").html("You have exceeded your maximum total upload file size of 100 MB.");
                            $("#communityNoticeModal").modal();
                            $("#communityNoticeModal").show();
        
                            $("#communityUpload").val("");
                            $("#communityTitle").val("");
                            $("#communityCategory").val("Religion");
                            $("#communityDescription").val("");
                            $("#uploadedFilename").text("");
                            
                        } else {
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
                            
                                    $("#communityNoticeIcon").attr("src", "../assets/img/verification-check.png");
                                    $("#communityNoticeHeader").html("Upload Complete");
                                    $("#communityNoticeContent").html("Your content was uploaded successfully.");
                                    $("#communityNoticeModal").modal();
                                    $("#communityNoticeModal").show();
                                },
                                error: function() {
                                    $("#communityModal").removeClass("fade").modal("hide");
                                    $("#communityModal").modal("dispose");
                        
                                    $("#communityNoticeIcon").attr("src", "../assets/img/verification-error.png");
                                    $("#communityNoticeHeader").html("Upload Failed");
                                    $("#communityNoticeContent").html("Something went wrong.");
                                    $("#communityNoticeModal").modal();
                                    $("#communityNoticeModal").show();
                                },
                                complete: function() {
                                    $("#communityUpload").val("");
                                    $("#communityUpload").val("");
                                    $("#communityTitle").val("");
                                    $("#communityCategory").val("Religion");
                                    $("#communityDescription").val("");
                                }
                            });
                        }
                    }
                });
            } else {
                $("#communityModal").removeClass("fade").modal("hide");
                $("#communityModal").modal("dispose");
    
                $("#communityNoticeIcon").attr("src", "../assets/img/verification-error.png");
                $("#communityNoticeHeader").html("Upload Failed");
                $("#communityNoticeContent").html("Invalid file type.");
                $("#communityNoticeModal").modal();
                $("#communityNoticeModal").show();
    
                $("#communityUpload").val("");
                $("#communityTitle").val("");
                $("#communityCategory").val("Religion");
                $("#communityDescription").val("");
            }
        }
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
});

function viewCreationImage(creationid) {
    var imageLink = "http://localhost/religion_explorer/views/modules/communitySubmissions.php?openTab=communitySubPhotos" + "&view=" +  encodeURIComponent(creationid);
    window.location.href = imageLink;
}

function viewCreationVideo(creationid) {
    var videoLink = "http://localhost/religion_explorer/views/modules/communitySubmissions.php?openTab=communitySubVideos" + "&view=" +  encodeURIComponent(creationid);
    window.location.href = videoLink;
}

function viewCreationReadingMaterial(creationid) {
    var readingMaterialLink = "http://localhost/religion_explorer/views/modules/communitySubmissions.php?openTab=communitySubBlogs" + "&view=" +  encodeURIComponent(creationid);
    window.location.href = readingMaterialLink;
}