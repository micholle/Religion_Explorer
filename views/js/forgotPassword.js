$(function() {
    const forgotContainer = document.getElementById("forgotPasswordCont");
    const forgotNewContent = `
    <div class="row d-flex justify-content-center align-items-center loginSignupContainer" >
        <div class="col-3 d-flex justify-content-center align-items-center flex-column">
            <img src="../assets/img/applogo.png" height="110px" width="110px">
            <h3 id="forgotPasswordSubmit">Thank you!</h3>
            <p>Check your email for the instructions.</p>
        </div>
    </div>
    `;

    const forgotSubmitButton = document.getElementById("forgotPasswordSubmit");

    forgotSubmitButton.addEventListener("click", (e) => {
        e.preventDefault();
        const email = $("#email").val().trim(); // Get the entered email
    
        if (email === "") {
          alert("Please enter your email address.");
          return;
        }

        // Make an AJAX request to check if email exists and send email
        $.ajax({
            url: "../../ajax/forgotPassword.ajax.php",
            method: "POST",
            data: { email: email },
            dataType: "text",
            success: function(response) {
            // Handle the response from the server
            if (response === "ok") {
                // Email exists and email sent successfully
                forgotContainer.innerHTML = forgotNewContent;
            } else if (response === "notfound") {
                // Email not found in the database
                alert("Email not found. Please try again.");
            } else {
                // Error occurred while sending email
                alert("Oops. Something went wrong!");
            }
            },
            error: function() {
            alert("Oops. Something went wrong!");
            }
        });
    });
});
