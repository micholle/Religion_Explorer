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
});