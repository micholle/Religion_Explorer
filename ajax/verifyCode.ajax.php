<?php
require_once "../controllers/accounts.controller.php";

class VerifyCode {
  public $email;
  public $verificationCode;

  public function verify() {
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

$verify = new VerifyCode();
$verify->email = $_POST["email"] ?? '';
$verify->verificationCode = $_POST["verificationCode"] ?? '';

$verify->verify();
