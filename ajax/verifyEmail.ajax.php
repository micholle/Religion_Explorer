<?php
require_once "../controllers/accounts.controller.php";

class VerifyEmail {
  public $email;
  public $username;
  public $verificationCode;

  public function verify() {
    $email = $this->email;
    $username = $this->username;
    $verificationCode = $this->verificationCode;

    $data = array(
      "email" => $email,
      "username" => $username,
      "verificationCode" => $verificationCode
    );

    $answer = (new ControllerAccount)->ctrVerifyEmail($data);
    if ($answer === "email_exists") {
      echo "email_exists";
    } elseif ($answer === "username_exists") {
      echo "username_exists";
    } elseif ($answer === "ok") {
      echo "ok";
    } else {
      echo "error";
    }
  }
}

$verify = new VerifyEmail();
$verify->email = $_POST["email"] ?? '';
$verify->username = $_POST["username"] ?? '';
$verify->verificationCode = $_POST["verificationCode"] ?? '';

$verify->verify();
?>
