$(function() {
    var fullEmail = $("#email").attr("placeholder");
    var maskedEmail = maskEmail(fullEmail);
    $("#email").val(maskedEmail);

  $.ajax({
    url: "../../ajax/showSidebar.ajax.php",
    method: "POST",
    success: function(data) {
        $("#userProfileEditProfileSidebar").html(data);
        var currentPage = window.location.pathname.split("/").pop();

        $("#userProfileEditProfileSidebar li a").each(function() {
            var tabPage = $(this).attr("href");
            
            if (currentPage.includes("userProfile") || tabPage === currentPage) {
                $("#sidebarProfile").css({
                    "background-color": "#EAF7F0",
                    "border": "solid #75C884 2px",
                    "font-weight": "600",
                });
            }
        });
    }
});



    $("#editAvatar").click(function(){
        $('#editAvatarModal').modal();
        $('#editAvatarModal').show();
    });

    $("#editPasswordButton").click(function(){
        $('#editPasswordModal').modal();
        $('#editPasswordModal').show();
    });

    $("#deleteAccountButton").click(function(){
        $('#deleteAccountModal').modal();
        $('#deleteAccountModal').show();
    });

      function successEditPassword() {
        // Get a reference to the modal body element
        var modalBody = $('#editPasswordModal');
      
        // Change the content of the modal body
        modalBody.html(`
          <div class="modal-dialog modal-xs modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-body">
                <div class="container">
                  <div class="row">
                    <div class="col-12 d-flex justify-content-center align-items-center flex-column">
                        <img src="../assets/img/applogo.png" height="80px" width="80px">
                        <h5 class="modal-title w-100">Password changed!</h5>
                        <button type="button" id="" class="registrationSubmitButton" data-dismiss="modal">Nice!</button></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        `);
      }

      $('#saveEdit').click(function(e){
        e.preventDefault();
        var religion = $("#religion").val();
        var username = $("#username").val().trim();
        var displayNotification = $("#displayNotification").is(":checked") ? 1 : 0;
        var displayCalendar = $("#displayCalendar").is(":checked") ? 1 : 0;
        var displayNickname = $("#displayNickname").is(":checked") ? 1 : 0;
        var displayBookmark = $("#displayBookmark").is(":checked") ? 1 : 0;
        var displayReligion = $("#displayReligion").is(":checked") ? 1 : 0;
        var displayPage = $("#libraryReligionFilter").val();

        checkUsername(username)
        .then((promiseResult) => {
          if (promiseResult === "safe") {
            var account = new FormData();
            account.append("religion", religion);
            account.append("username", username);
            account.append("displayNotification", displayNotification);
            account.append("displayCalendar", displayCalendar);
            account.append("displayNickname", displayNickname);
            account.append("displayBookmark", displayBookmark);
            account.append("displayReligion", displayReligion);
            account.append("displayPage", displayPage);
        
            $.ajax({
              url: "../../ajax/accountUpdate.ajax.php",
              method: "POST",
              data: account,
              cache: false,
              contentType: false,
              processData: false,
              dataType: "text",
              success: function(answer) {
                window.location.href = "userProfile.php";
              },
              error: function() {
                $("#toast").html("Something went wrong. Please try again later.")
                $("#toast").css("background-color", "#E04F5F");
                $("#toast").addClass('show');
            
                setTimeout(function() {
                    $("#toast").removeClass('show');
                }, 2000);
              },
              complete: function() {
        
              }
            });
          } else {
            $("#inputCheckHeader").text("Error");
            $("#inputCheckContent").text("Your username is invalid due to a violation of our community standards. We take these standards seriously to maintain a positive and respectful environment for all users. If you believe this action was taken in error, please reach out to our support team with further details. Thank you for your understanding and cooperation in upholding our community guidelines.");
            $("#inputCheckModal").modal();
            $("#inputCheckModal").show();
          }
        })
        .catch((error) => {
          console.error("Something went wrong:", error);
        });
      });

      function updateAvatar(imagePath) {
        $.ajax({
          url: "../../ajax/updateAvatar.ajax.php",
          method: "POST",
          data: { avatar: imagePath },
          success: function(response) {
            window.location.href = "userProfileEditProfile.php";
          },
          error: function() {
            $("#toast").html("AJAX request failed. Please try again later.")
            $("#toast").css("background-color", "#E04F5F");
            $("#toast").addClass('show');
        
            setTimeout(function() {
                $("#toast").removeClass('show');
            }, 2000);
          }
        });
      }

      $(".defaultAvatar").click(function() {
        $(".defaultAvatar").removeClass("highlight");

        $(this).addClass("highlight");
      });

      $("#updateAvatarBtn").click(function() {
        if ($(".defaultAvatar.highlight").length > 0) {
          var imagePath = $(".defaultAvatar.highlight").attr("value");

          updateAvatar(imagePath);
        } else {
          $("#toast").html("Please select an avatar image.")
          $("#toast").css("background-color", "#E04F5F");
          $("#toast").addClass('show');
      
          setTimeout(function() {
              $("#toast").removeClass('show');
          }, 2000);
        }
      });


      document.getElementById("uploadButton").addEventListener("click", function() {
        var fileInput = document.createElement("input");
        fileInput.type = "file";
        fileInput.style.display = "none";
        fileInput.accept = "image/*";
      
        document.body.appendChild(fileInput);
      
        fileInput.click();
      
        fileInput.addEventListener("change", function(event) {
          var file = event.target.files[0];
          if (!file || !file.type.startsWith("image/")) {
            $("#toast").html("Please select a valid file type.");
            $("#toast").css("background-color", "#E04F5F");
            $("#toast").addClass('show');
    
            setTimeout(function() {
              $("#toast").removeClass('show');
            }, 2000);

            return;
          }
          if (file.size > 15 * 1024 * 1024) {
            $("#toast").html("File size exceeds the limit. Please select an image up to 15MB.");
            $("#toast").css("background-color", "#E04F5F");
            $("#toast").addClass('show');
    
            setTimeout(function() {
              $("#toast").removeClass('show');
            }, 2000);

            return;
          }
      
          var formData = new FormData();
          formData.append("avatar", file);
      
          var xhr = new XMLHttpRequest();
          xhr.open("POST", "../../ajax/uploadAvatar.ajax.php", true);
          xhr.onload = function() {
            if (xhr.status === 200) {
              window.location.href = "userProfileEditProfile.php";
            } else {
              $("#toast").html("Error uploading the file. Please try again later.");
              $("#toast").css("background-color", "#E04F5F");
              $("#toast").addClass('show');
      
              setTimeout(function() {
                $("#toast").removeClass('show');
              }, 2000);
            }
          };
          xhr.send(formData);
        });
      
        // Remove the file input element from the body
        document.body.removeChild(fileInput);
      });      

      $('#confirmDeleteAccountBtn').click(function() {
        var email = $('#deleteEmail').val();
        var password = $('#deletePassword').val();
      
        // Send an AJAX request to delete the account
        $.ajax({
          url: "../../ajax/accountDelete.ajax.php",
          method: "POST",
          data: { email: email, password: password },
          success: function(response) {
            if (response === 'invalid_password' || response === 'invalid_email'){
              $('#deleteEmail').val("");
              $('#deletePassword').val("");
              $("#toast").html("Invalid Credentials.")
              $("#toast").css("background-color", "#E04F5F");
              $("#toast").addClass('show');
          
              setTimeout(function() {
                  $("#toast").removeClass('show');
              }, 2000);
            } else {
              var modalBody = $('#deleteAccountModal');
      
              // Change the content of the modal body
              modalBody.html(`
                <div class="modal-dialog modal-xs modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-body">
                      <div class="container">
                        <div class="row">
                          <div class="col-12 d-flex justify-content-center align-items-center flex-column">
                            <img src="../assets/img/applogo.png" height="80px" width="80px">
                            <h5 class="modal-title w-100">See you later, Explorer.</h5>
                            <a href="splash.php"><button type="button" id="" class="registrationSubmitButton">Redirect to the Splash Page</button></a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              `);
            }
          },
          error: function() {
            // AJAX request failed, show an error message or take appropriate action
            $("#toast").html("AJAX request failed. Please try again later.")
            $("#toast").css("background-color", "#E04F5F");
            $("#toast").addClass('show');
        
            setTimeout(function() {
                $("#toast").removeClass('show');
            }, 2000);
          }
        });
      });



      //edit password
      $('#confirmEditPasswordBtn').click(function(e){
        e.preventDefault();
        var oldPassword = $("#oldPassword").val().trim();
        var newPassword = $("#newPassword").val().trim();
        var confirmPassword = $("#confirmPassword").val().trim();
    
        if (oldPassword === '' || newPassword === '' || confirmPassword === '') {
          $("#toast").html("Please fill in all fields.")
          $("#toast").css("background-color", "#E04F5F");
          $("#toast").addClass('show');
      
          setTimeout(function() {
              $("#toast").removeClass('show');
          }, 2000);
            return;
        }
    
        if (newPassword !== confirmPassword) {
          $("#toast").html("New password and confirm password do not match.")
          $("#toast").css("background-color", "#E04F5F");
          $("#toast").addClass('show');
      
          setTimeout(function() {
              $("#toast").removeClass('show');
          }, 2000);
          
          return;
        }
    
        var account = new FormData();
        account.append("oldPassword", oldPassword);
        account.append("newPassword", newPassword);
    
        $.ajax({
            url: "../../ajax/editPassword.ajax.php",
            method: "POST",
            data: account,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "text",
            success: function(answer) {
                if (answer === "incorrect_oldPass"){
                  $("#oldPassword").val("");
                  $("#newPassword").val("");
                  $("#confirmPassword").val("");
                  $("#toast").html("Old password did not match.")
                  $("#toast").css("background-color", "#E04F5F");
                  $("#toast").addClass('show');
              
                  setTimeout(function() {
                      $("#toast").removeClass('show');
                  }, 2000);
                } else {
                  successEditPassword();
                }
            },
            error: function() {
              $("#toast").html("Something went wrong. Please try again later.")
              $("#toast").css("background-color", "#E04F5F");
              $("#toast").addClass('show');
          
              setTimeout(function() {
                  $("#toast").removeClass('show');
              }, 2000);
            },
            complete: function() {
    
            }
        });
    });    

    function maskEmail(email) {
      var [username, domain] = email.split("@");
      var maskedUsername = username.substring(0, 2);

      for (var i = 2; i < username.length; i++) {
          maskedUsername += "*";
      }
        var maskedEmail = maskedUsername + "@" + domain;
  
      return maskedEmail;
  }
});

async function checkUsername(username) {
  try {
    var contentEvaluationUsername = await checkContent(username);
    if (contentEvaluationUsername === "nsfw") {
      return "nsfw";
    } else {
      return "safe";
    }
  } catch (error) {
    $("#toast").html("Something went wrong. Please try again later.")
    $("#toast").css("background-color", "#E04F5F");
    $("#toast").addClass('show');

    setTimeout(function() {
        $("#toast").removeClass('show');
    }, 2000);

    throw error;
  }
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