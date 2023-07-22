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
            alert("Oops. Something went wrong!");
          },
          complete: function() {
    
          }
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
            alert("AJAX request failed");
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
          alert("Please select an avatar image");
        }
      });


      document.getElementById("uploadButton").addEventListener("click", function() {
        var fileInput = document.createElement("input");
        fileInput.type = "file";
        fileInput.style.display = "none";
      
        document.body.appendChild(fileInput);
      
        fileInput.click();
      
        fileInput.addEventListener("change", function(event) {
          var file = event.target.files[0];
          var formData = new FormData();
          formData.append("avatar", file);
      
          var xhr = new XMLHttpRequest();
          xhr.open("POST", "../../ajax/uploadAvatar.ajax.php", true);
          xhr.onload = function() {
            if (xhr.status === 200) {
              window.location.href = "userProfileEditProfile.php";
            } else {
              alert("Error uploading the file");
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
              alert('Invalid credentials!');
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
            alert("AJAX request failed");
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
            alert("Please fill in all fields.");
            return;
        }
    
        if (newPassword !== confirmPassword) {
            alert("New password and confirm password do not match.");
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
                  alert("Old password did not match.");
                } else {
                  successEditPassword();
                }
            },
            error: function() {
                alert("Oops. Something went wrong with the ajax!");
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