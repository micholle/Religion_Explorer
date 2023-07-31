$(function() {
    const resetContainer = document.getElementById("resetPasswordCont");
    const resetNewContent = `
    <div class="row">
        <div class="col-12 d-flex justify-content-center align-items-center flex-column">
            <img src="../assets/img/applogo.png" height="110px" width="110px">
            <h3 id="forgotPasswordSubmit">Change success!</h3>
            <p>Go back to the <a href="userProfile.php" class="redirectLink">Profile</a>.</p>
        </div>
    </div>
    `;

    const resetSubmitButton = document.getElementById("resetPasswordSubmit");

    resetSubmitButton.addEventListener("click", (e) => {
        e.preventDefault();

        const password = $("#password").val().trim(); // Get the entered password
        const confirmPassword = $("#confirmPassword").val().trim();

        if (password === "") {
            alert("Please enter a new password.");
            return;
        } else if (password !== confirmPassword) {
            alert("Passwords are not matching.");
            return;
        }

        // Make an AJAX request to reset the password
        $.ajax({
            url: "../../ajax/resetPassword.ajax.php",
            method: "POST",
            data: { password: password },
            dataType: "text",
            success: function(response) {
            // Handle the response from the server
            if (response === "success") {
                resetContainer.innerHTML = resetNewContent;
            } else if (password === "") {
                $("#toast").html("Please enter a new password.")
                $("#toast").css("background-color", "#E04F5F");
                $("#toast").addClass('show');

                setTimeout(function() {
                    $("#toast").removeClass('show');
                }, 2000);
            } else if (password !== confirmPassword) {
                $("#toast").html("Passwords are not matching.")
                $("#toast").css("background-color", "#E04F5F");
                $("#toast").addClass('show');

                setTimeout(function() {
                    $("#toast").removeClass('show');
                }, 2000);
            } else {
                $("#toast").html("Something went wrong.")
                $("#toast").css("background-color", "#E04F5F");
                $("#toast").addClass('show');

                setTimeout(function() {
                    $("#toast").removeClass('show');
                }, 2000);
            }
            },
            error: function() {
            alert("Oops. Something went wrong!");
            }
        });
    });
});
