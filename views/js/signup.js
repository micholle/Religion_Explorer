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
      $("#toast").html("Please enter a username.")
      $("#toast").css("background-color", "#E04F5F");
      $("#toast").addClass('show');

      setTimeout(function() {
          $("#toast").removeClass('show');
      }, 2000);

      return;
    } else if (password === "") {
      $("#toast").html("Please enter a password.")
      $("#toast").css("background-color", "#E04F5F");
      $("#toast").addClass('show');

      setTimeout(function() {
          $("#toast").removeClass('show');
      }, 2000);
      
      return;
    } else if (password !== confirmPassword) {
      $("#toast").html("Passwords do not match.")
      $("#toast").css("background-color", "#E04F5F");
      $("#toast").addClass('show');

      setTimeout(function() {
          $("#toast").removeClass('show');
      }, 2000);

      return;
    } else if (password.length < 8) {
      $("#toast").html("Password must be at least 8 characters long.")
      $("#toast").css("background-color", "#E04F5F");
      $("#toast").addClass('show');

      setTimeout(function() {
          $("#toast").removeClass('show');
      }, 2000);

      return;
    }

    var verify = new FormData();
    verify.append("email", email);
    verify.append("username", username);
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
          $("#toast").html("Email already exists!")
          $("#toast").css("background-color", "#E04F5F");
        } else if (answer === "username_exists") {
          $("#toast").html("Username already exists!")
          $("#toast").css("background-color", "#E04F5F");
        } else if (answer === "ok") {
          $("#toast").html("Verification code sent, check your email!")
          $("#toast").css("background-color", "");
          $('#verificationCodeModal').modal();
          $('#verificationCodeModal').show();
        } else {
          $("#toast").html("Oops. Something went wrong!")
          $("#toast").css("background-color", "#E04F5F");
        }
      },
      error: function() {
        $("#toast").html("Oops. Something went wrong!")
        $("#toast").css("background-color", "#E04F5F");
      }, complete: function() {
        $("#toast").addClass('show');
    
        setTimeout(function() {
            $("#toast").removeClass('show');
        }, 2000);
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
          $("#toast").html("Verification Code did not match.")
          $("#toast").css("background-color", "#E04F5F");
        } else if (answer === "ok") {
          verifyContainer.innerHTML = verifyNewContent;
        } else {
          $("#toast").html("Oops. Something went wrong!")
          $("#toast").css("background-color", "#E04F5F");
        }
      },
      error: function() {
        $("#toast").html("Oops. Something went wrong!")
        $("#toast").css("background-color", "#E04F5F");
      },
      complete: function() {
        $("#toast").addClass('show');
    
        setTimeout(function() {
            $("#toast").removeClass('show');
        }, 2000);
      }
    });
  });

  $("#termsOfService").click(function() {
      window.location.href = "../modules/termsOfService.php";
  });

  $("#privacyPolicy").click(function() {
      window.location.href = "../modules/privacyPolicy.php";
  });  
});
