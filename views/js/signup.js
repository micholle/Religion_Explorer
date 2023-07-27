$(function() {
  // SAVE account
  $("form").submit(function(e) {
    e.preventDefault();
    var email = $("#email").val().trim();
    var verificationCode = Math.floor(100000 + Math.random() * 900000);
    var username = $("#username").val();
    var password = $("#password").val();
    var confirmPassword = $("#confirmPassword").val();
    var religion = $("#religion").val();

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
    } else if (religion === null || religion === "") {
      $("#toast").html("Select a religion.");
      $("#toast").css("background-color", "#E04F5F");
      $("#toast").addClass('show');

      setTimeout(function() {
          $("#toast").removeClass('show');
      }, 2000);

      return;
    }

    checkUsername(username)
    .then((promiseResult) => {
      if (promiseResult === "safe") {
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
              $("#toast").html("Please enter a valid email address.")
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
      } else {
        $("#inputCheckIcon").attr("src", "../assets/img/verification-error.png");
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
