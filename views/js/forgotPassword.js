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

    forgotSubmitButton.addEventListener("click", () => {
        forgotContainer.innerHTML = forgotNewContent;
    });
});