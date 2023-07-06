$(function() {
    const resetContainer = document.getElementById("resetPasswordCont");
    const resetNewContent = `
    <div class="row d-flex justify-content-center align-items-center loginSignupContainer" >
        <div class="col-3 d-flex justify-content-center align-items-center flex-column">
            <img src="../assets/img/applogo.png" height="110px" width="110px">
            <h3 id="forgotPasswordSubmit">Change success!</h3>
            <p>Go back to the <a href="userProfile.php" class="redirectLink">Profile</a>.</p>
        </div>
    </div>
    `;

    const resetSubmitButton = document.getElementById("resetPasswordSubmit");

    resetSubmitButton.addEventListener("click", () => {
        resetContainer.innerHTML = resetNewContent;
    });
});