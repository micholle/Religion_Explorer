$(function() {
   // SAVE account
   $("form").submit(function(e) {
     e.preventDefault();
 
     var email = $("#email").val();
     var acctype = "regular";
     var religion = $("#religion").val();
     var username = $("#username").val();
     var password = $("#password").val();
 
     var account = new FormData();
     account.append("email", email);
     account.append("acctype", acctype);
     account.append("religion", religion);
     account.append("username", username);
     account.append("password", password);
 
     $.ajax({
       url: "../../ajax/accountSave.ajax.php",
       method: "POST",
       data: account,
       cache: false,
       contentType: false,
       processData: false,
       dataType: "text",
       success: function(answer) {
       },
       error: function() {
         alert("Oops. Something went wrong!");
       },
       complete: function() {

       }
     });
   });
 });
 
