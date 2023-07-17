$(function() {
  // SAVE account
  $("form").submit(function(e) {
    e.preventDefault();
    var email = $("#email").val().trim();
    var verificationCode = Math.floor(100000 + Math.random() * 900000);
    var username = $("#username").val();
    var password = $("#password").val();
    var confirmPassword = $("#confirmPassword").val();

    if (username === "") {
      alert("Please enter a username.");
      return;
    } else if (password === "") {
      alert("Please enter a password.");
      return;
    } else if (password !== confirmPassword) {
      alert("Passwords do not match.");
      return;
    } else if (password.length < 8) {
      alert("Password must be at least 8 characters long.");
      return;
    }

    var verify = new FormData();
    verify.append("email", email);
    verify.append("verificationCode", verificationCode);

    $.ajax({
      url: "../../ajax/verifyEmail.ajax.php",
      method: "POST",
      data: verify,
      dataType: "text",
      processData: false,
      contentType: false,
      success: function(answer) {
        if (answer === "email_exists") {
          alert("Email already exists!");
        } else if (answer === "username_exists") {
          alert("Username already exists!");
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
    var acctype = "regular";
    var religion = $("#religion").val();
    var username = $("#username").val().trim();
    var password = $("#password").val();
    var verificationCode = $("#verificationCode").val().trim();

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
        if (answer === "verification_failed") {
          alert("Verification Code did not match.");
        } else if (answer === "ok") {
          verifyContainer.innerHTML = verifyNewContent;
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
});
