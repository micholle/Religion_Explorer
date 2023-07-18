$(function() {
    $.ajax({
        url: "../../ajax/showSidebar.ajax.php",
        method: "POST",
        success:function(data){
            $("#userProfileEditProfileSidebar").html(data);
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

    $('#confirmDeleteAccountBtn').click(function() {
        // Get a reference to the modal body element
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
      });

      $('#confirmEditPasswordBtn').click(function() {
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
      });

      $('#saveEdit').click(function(e){
        e.preventDefault();
        var email = $("#email").val().trim();
        var religion = $("#religion").val();
        var username = $("#username").val().trim();
        var displayNotification = $("#displayNotification").is(":checked") ? 1 : 0;
        var displayCalendar = $("#displayCalendar").is(":checked") ? 1 : 0;
        var displayNickname = $("#displayNickname").is(":checked") ? 1 : 0;
        var displayBookmark = $("#displayBookmark").is(":checked") ? 1 : 0;
        var displayReligion = $("#displayReligion").is(":checked") ? 1 : 0;
        var displayPage = $("#libraryReligionFilter").val();
    
        var account = new FormData();
        account.append("email", email);
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
            if (answer === "ok") {
              alert("Saved successfully!");
              window.location.href = "userProfile.php";
            } else {
              alert("Oops. Something went wrong!");
            }
          },
          error: function() {
            alert("Oops. Something went wrong!");
          },
          complete: function() {
    
          }
        });
      });

      function updateAvatar(imagePath) {
        // Send an AJAX request to update the avatar
        $.ajax({
          url: "../../ajax/updateAvatar.ajax.php",
          method: "POST",
          data: { avatar: imagePath },
          success: function(response) {
            if (response === "ok") {
              // Avatar updated successfully
              alert("Avatar updated successfully");
            } else {
              // Error occurred while updating the avatar
              alert("Error updating the avatar");
              alert(imagePath);
            }
          },
          error: function() {
            // AJAX request failed
            alert("AJAX request failed");
          }
        });
      }

      // Handle click on avatar images
      $(".defaultAvatar").click(function() {
        // Remove the highlight from all avatar images
        $(".defaultAvatar").removeClass("highlight");

        // Add highlight class to the clicked avatar image
        $(this).addClass("highlight");
      });

      // Handle click on "Update Avatar" button
      $("#updateAvatarBtn").click(function() {
        // Check if any avatar image is selected
        if ($(".defaultAvatar.highlight").length > 0) {
          // Get the value (image path) of the selected avatar image
          var imagePath = $(".defaultAvatar.highlight").attr("value");

          // Call the function to update the avatar
          updateAvatar(imagePath);
        } else {
          // No avatar image selected, show an error message or take appropriate action
          alert("Please select an avatar image");
        }
      });


    // Function to handle file upload
    function handleUpload() {
      // Get the file input element
      var fileInput = document.getElementById("fileInput");

      // Get the selected file
      var file = fileInput.files[0];

      // Create a FormData object to store the file data
      var formData = new FormData();
      formData.append("file", file);

      // Send an AJAX request to upload the file
      $.ajax({
        url: "upload.php",
        method: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if (response === "ok") {
            // File uploaded successfully
            console.log("File uploaded successfully");
            // Get the file path or URL from the server response
            var imagePath = "path_to_uploaded_image.jpg";
            // Call the function to update the avatar in the database
            updateAvatar(imagePath);
          } else {
            // Error occurred while uploading the file
            console.log("Error uploading the file");
          }
        },
        error: function() {
          // AJAX request failed
          console.log("AJAX request failed");
        }
      });
    }

});