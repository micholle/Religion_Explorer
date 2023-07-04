$(function() {
   $("#btn-alert").click(function (e) {
      e.preventDefault();
      var email = $("#email").val();
      var acctype = "regular";
      var religion = $("#religion").val();
      var username = $("#username").val();
      var password = $("#password").val();
  
      // Create an object to hold the data
      var formData = {
        email: email,
        acctype: acctype,
        religion: religion,
        username: username,
        password: password
      };
  
      // Display the data in an alert
      alert(JSON.stringify(formData));
    });
 
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
 