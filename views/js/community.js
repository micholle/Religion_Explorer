$(function() {    
    $.ajax({
        url: "../../ajax/showSidebar.ajax.php",
        method: "POST",
        success:function(data){
            $("#communitySidebar").html(data);
            var currentPage = window.location.pathname.split("/").pop();

            $("#communitySidebar ul.dropdownMenu li a").each(function() {
                var tabPage = $(this).attr("href");
                if (tabPage === currentPage) {
                    $(this).closest("ul.dropdownMenu").siblings("a").addClass("active");
                }
            });
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

    var filtersArray = [];

    $("#Religious_Traditions").click(function(){
        if ($("#Religious_Traditions").css("background-color") == "rgb(236, 236, 236)") {
            $("#Religious_Traditions").css("background-color", "#BFE3D0");
            $("#Religious_Traditions").css("border", "solid #2CA464 2px");
            filtersArray.push("Religious Traditions");
        } else {
            $("#Religious_Traditions").css("background-color", "#ECECEC");
            $("#Religious_Traditions").css("border", "solid #D6D6D6 2px");
            filtersArray.splice(filtersArray.indexOf("Religious Traditions"), 1);
        }
    });

    $("#Historical_Context").click(function(){
        if ($("#Historical_Context").css("background-color") == "rgb(236, 236, 236)") {
            $("#Historical_Context").css("background-color", "#BFE3D0");
            $("#Historical_Context").css("border", "solid #2CA464 2px");
            filtersArray.push("Historical Context");
        } else {
            $("#Historical_Context").css("background-color", "#ECECEC");
            $("#Historical_Context").css("border", "solid #D6D6D6 2px");
            filtersArray.splice(filtersArray.indexOf("Historical Context"), 1);
        }
    });
    
    $("#Theology").click(function(){
        if ($("#Theology").css("background-color") == "rgb(236, 236, 236)") {
            $("#Theology").css("background-color", "#BFE3D0");
            $("#Theology").css("border", "solid #2CA464 2px");
            filtersArray.push("Theology");
        } else {
            $("#Theology").css("background-color", "#ECECEC");
            $("#Theology").css("border", "solid #D6D6D6 2px");
            filtersArray.splice(filtersArray.indexOf("Theology"), 1);
        }
    });

    $("#Religious_Practices").click(function(){
        if ($("#Religious_Practices").css("background-color") == "rgb(236, 236, 236)") {
            $("#Religious_Practices").css("background-color", "#BFE3D0");
            $("#Religious_Practices").css("border", "solid #2CA464 2px");
            filtersArray.push("Religious Practices");
        } else {
            $("#Religious_Practices").css("background-color", "#ECECEC");
            $("#Religious_Practices").css("border", "solid #D6D6D6 2px");
            filtersArray.splice(filtersArray.indexOf("Religious Practices"), 1);
        }
    });

    $("#Ethics").click(function(){
        if ($("#Ethics").css("background-color") == "rgb(236, 236, 236)") {
            $("#Ethics").css("background-color", "#BFE3D0");
            $("#Ethics").css("border", "solid #2CA464 2px");
            filtersArray.push("Ethics");
        } else {
            $("#Ethics").css("background-color", "#ECECEC");
            $("#Ethics").css("border", "solid #D6D6D6 2px");
            filtersArray.splice(filtersArray.indexOf("Ethics"), 1);
        }
    });

    $("#Social_Issues").click(function(){
        if ($("#Social_Issues").css("background-color") == "rgb(236, 236, 236)") {
            $("#Social_Issues").css("background-color", "#BFE3D0");
            $("#Social_Issues").css("border", "solid #2CA464 2px");
            filtersArray.push("Social Issues");
        } else {
            $("#Social_Issues").css("background-color", "#ECECEC");
            $("#Social_Issues").css("border", "solid #D6D6D6 2px");
            filtersArray.splice(filtersArray.indexOf("Social Issues"), 1);
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
        var accountid = $("#accountidPlaceholder").text();
        var title = $("#communityTitle").val();
        var religion = $("#communityCategory").val();
        var description = $("#communityDescription").val();
        var filters = filtersArray.join(", ");

        (async () => {
            try {        
                if(title == "" || religion == null || description == "") {
                    $("#toast").html("Please fill out all required fields.")
                    $("#toast").css("background-color", "#E04F5F");
                    $("#toast").addClass('show');
                
                    setTimeout(function() {
                        $("#toast").removeClass('show');
                    }, 2000);
                } else {
                    var contentEvaluationTitle = await checkContent(title);
                    var contentEvaluationDescription = await checkContent(description);
                    
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
                
                                if ((dataUsed + filesizeMB) >= 500) {
                                    $("#communityModal").removeClass("fade").modal("hide");
                                    $("#communityModal").modal("dispose");
                        
                                    $("#communityNoticeIcon").attr("src", "../assets/img/verification-error.png");
                                    $("#communityNoticeHeader").html("Upload Failed");
                                    $("#communityNoticeContent").html("You have exceeded your maximum total upload file size of 100 MB.");
                                    $("#communityNoticeModal").modal();
                                    $("#communityNoticeModal").show();
                
                                    // $("#communityUpload").val("");
                                    // $("#communityTitle").val("");
                                    // $("#communityCategory").val("Religion");
                                    // $("#communityDescription").val("");
                                    // $("#uploadedFilename").text("");
                                    
                                } else {
                                    if (contentEvaluationTitle == "nsfw" || contentEvaluationDescription == "nsfw") {
                                        $("#communityNoticeIcon").attr("src", "../assets/img/verification-error.png");
                                        $("#communityNoticeHeader").text("Error");
                                        $("#communityNoticeContent").text("Your content has been blocked due to a violation of our community standards. We take these standards seriously to maintain a positive and respectful environment for all users. If you believe this action was taken in error, please reach out to our support team with further details. Thank you for your understanding and cooperation in upholding our community guidelines.");
                                        
                                        $("#communityModal").removeClass("fade").modal("hide");
                                        $("#communityModal").modal("dispose");
                                        $("#communityNoticeModal").modal();
                                        $("#communityNoticeModal").show();
                    
                                        // $("#communityUpload").val("");
                                        // $("#communityTitle").val("");
                                        // $("#communityCategory").val("Religion");
                                        // $("#communityDescription").val("");
                                    } else {
                                        var creation = new FormData();
                                        creation.append("accountid", accountid);
                                        creation.append("title", title);
                                        creation.append("religion", religion);
                                        creation.append("description", description);
                                        creation.append("filedata", filedata);
                                        creation.append("filename", filename);
                                        creation.append("filetype", filetype);
                                        creation.append("filesize", filesize);
                                        creation.append("filters", filters);
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
                                                console.log(data);

                                                $("#communityModal").removeClass("fade").modal("hide");
                                                $("#communityModal").modal("dispose");
                                        
                                                $("#communityNoticeIcon").attr("src", "../assets/img/verification-check.png");
                                                $("#communityNoticeHeader").html("Upload Complete");
                                                $("#communityNoticeContent").html("Your content was uploaded successfully.");
                                                $("#communityNoticeModal").modal();
                                                $("#communityNoticeModal").show();

                                                //add explorer points: community creations upload                
                                                var accountid = $("#accountidPlaceholder").text();

                                                var explorerPoint = new FormData();
                                                explorerPoint.append("accountid", accountid);
                                                explorerPoint.append("pointsource", accountid + "_cc_upload_" + data.substr(-15));
                                                explorerPoint.append("points", 3);

                                                $.ajax({
                                                    url: '../../ajax/addExplorerPoints.ajax.php',
                                                    method: "POST",
                                                    data: explorerPoint,
                                                    cache: false,
                                                    contentType: false,
                                                    processData: false,
                                                    dataType: "text"
                                                });
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
                                                $(".communityFilterCategory").css("background-color", "#ECECEC");
                                                $(".communityFilterCategory").css("border", "solid #D6D6D6 2px");
                                            }
                                        });
                                    }
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
            } catch (error) {
                $("#toast").html("Something went wrong. Please try again later.")
                $("#toast").css("background-color", "#E04F5F");
                $("#toast").addClass('show');
            
                setTimeout(function() {
                    $("#toast").removeClass('show');
                }, 2000);
            }
        })();
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

function checkContent(content) {
    const API_KEY = 'AIzaSyAMS69pJZVhNROCjcqryJNbhoQokBXPgNo';
    const DISCOVERY_URL = 'https://commentanalyzer.googleapis.com/$discovery/rest?version=v1alpha1';
  
    return new Promise((resolve, reject) => {
      function onGAPILoad() {
        gapi.client.load(DISCOVERY_URL)
          .then(() => {
            const analyzeRequest = {
              comment: {
                text: content,
              },
              requestedAttributes: {
                TOXICITY: {},
                SEVERE_TOXICITY: {},
                IDENTITY_ATTACK: {},
                INSULT: {},
                PROFANITY: {},
                THREAT: {}
              }
            };
  
            gapi.client.commentanalyzer.comments.analyze({
              key: API_KEY,
              resource: analyzeRequest,
            })
              .then(response => {
                const toxicity_score = response.result.attributeScores.TOXICITY.summaryScore.value;
                const severe_toxicity_score = response.result.attributeScores.SEVERE_TOXICITY.summaryScore.value;
                const indentity_atttack_score = response.result.attributeScores.IDENTITY_ATTACK.summaryScore.value;
                const insult_score = response.result.attributeScores.INSULT.summaryScore.value;
                const profanity_score = response.result.attributeScores.PROFANITY.summaryScore.value;
                const threat_score = response.result.attributeScores.THREAT.summaryScore.value;

                if (toxicity_score > 0.5 || severe_toxicity_score > 0.5 || indentity_atttack_score > 0.5 || insult_score > 0.5 || profanity_score > 0.5 || threat_score > 0.5) {
                  resolve("nsfw");
                } else {
                  resolve("safe");
                }
              })
              .catch(err => {
                resolve("safe");
              });
          })
          .catch(err => {
            reject(err);
          });
      }
  
      gapi.load('client', onGAPILoad);
    });
}  