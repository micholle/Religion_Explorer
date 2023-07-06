$(function() {
   // SAVE account
   $("form").submit(function(e) {
     e.preventDefault();
 
     var email = $("#email").val();
     var acctype = "regular";
     var religion = $("#religion").val();
     var username = $("#username").val();
     var password = $("#password").val();
     var verified = '0';
     var verificationCode = Math.floor(100000 + Math.random() * 900000);
 
     var account = new FormData();
     account.append("email", email);
     account.append("acctype", acctype);
     account.append("religion", religion);
     account.append("username", username);
     account.append("password", password);
     account.append("verified", verified);
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
        window.location.href = '../../models/accounts.model.php';
       },
       error: function() {
         alert("Oops. Something went wrong!");
       },
       complete: function() {

       }
     });
   });

   $("#verify").onclick(function() {
    var email = $("#email").val();
    var verificationCode = $("#verificationCode").val();

    var verify = new FormData();
    account.append("email", email);
    account.append("verificationCode", verificationCode);

    $.ajax({
      url: "../../ajax/verifyCode.ajax.php",
      method: "POST",
      data: {verify},
      dataType: "text",
      success: function(answer) {
        if (answer === "ok") {
          alert("Account verified Successfully!");
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
 
