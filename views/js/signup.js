$(function() {
   // SAVE account
   $("form").submit(function(e) {
    e.preventDefault();
   
  
    var email = $("#email").val();
    var acctype = "regular";
    var religion = $("#religion").val();
    var username = $("#username").val();
    var password = $("#password").val();
    var password = $("#confirmPassword").val();
    var verificationCode = Math.floor(100000 + Math.random() * 900000);

    if (password === "") {
         alert("Please enter a new password.");
         return;
    } else if (password !== confirmPassword) {
         alert("Passwords are not matching.");
         return;
    }
  
    var account = new FormData();
    account.append("email", email);
    account.append("acctype", acctype);
    account.append("religion", religion);
    account.append("username", username);
    account.append("password", password);
    account.append("verificationCode", verificationCode);
  
    $.ajax({
      url: "../../ajax/accountSave.ajax.php",
      method: "POST",
      data: account,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "text",
      success: function(answer) {
        if (answer === "email_exists") {
          alert("Email already exists!");
        } else if (answer === "ok") {
          alert("Verification code sent, check your email!");
          $('#verificationCodeModal').modal();
          $('#verificationCodeModal').show();
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
  

   const verifyContainer = document.getElementById("verificationCodeModal");
    const verifyNewContent = `
    <div class="modal-dialog modal-xs modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center align-items-center flex-column">
                            <img src="../assets/img/verification-check.png" height="80px" width="80px">
                            <h5 class="modal-title w-100">Verification Code Accepted!</h5>
                            <a href="login.php"><button type="button" id="closeVerificationModal" class="registrationSubmitButton">Redirect to Login</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    `;

    const signUpVerifyButton = document.getElementById("verify");

    signUpVerifyButton.addEventListener("click", (e) => {
      e.preventDefault();
      var email = $("#email").val().trim();
      var verificationCode = $("#verificationCode").val().trim();
    
      var verify = new FormData();
      verify.append("email", email);
      verify.append("verificationCode", verificationCode);
    
      $.ajax({
        url: "../../ajax/verifyCode.ajax.php",
        method: "POST",
        data: verify,
        dataType: "text",
        processData: false, // Add this line to prevent jQuery from processing the FormData object
        contentType: false, // Add this line to prevent jQuery from automatically setting the content type
        success: function(answer) {
          if (answer === "ok") {
            alert("Account verified successfully!");
            verifyContainer.innerHTML = verifyNewContent;
          } else {
            // Verification code is incorrect
            alert("Verification code is incorrect. Please try again.");
          }
        },
        error: function() {
          alert("Oops. Something went wrong!");
        }
      });
    });    


 });
 
