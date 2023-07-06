$(function() {
    const signUpContainer = document.getElementById("verificationCodeModal");
    const signUpNewContent = `
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

    const signUpSubmitButton = document.getElementById("verify");

    signUpSubmitButton.addEventListener("click", () => {
        signUpContainer.innerHTML = signUpNewContent;
    });

    $("#btn-signup").click(function(){
        $('#verificationCodeModal').modal();
        $('#verificationCodeModal').show();
    });
});