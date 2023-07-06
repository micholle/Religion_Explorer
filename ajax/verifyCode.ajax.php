<?php
require_once "../controllers/accounts.controller.php";

class SaveAccount {
  public $email;
  public $verificationCode;

  public function VerifyCode() {
    $email = $this->email;
    $verificationCode = $this->verificationCode;

    $data = array(
      "email" => $email,
      "verificationCode" => $verificationCode
    );

    $answer = (new ControllerAccount)->ctrVerifyCode($data);
    if ($answer) {
        echo 'ok'; // Email and verification code are correct
    } else {
        echo 'error'; // Email or verification code is incorrect
    }
  }
}

$save_account = new VerifyCode();
$save_account->email = $_POST["email"];
$save_account->verificationCode = $_POST["verificationCode"];

$save_account->VerifyCode();
?>