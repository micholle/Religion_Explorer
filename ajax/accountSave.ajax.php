<?php
require_once "../controllers/accounts.controller.php";
session_start();

class SaveAccount {
  public $email;
  public $acctype;
  public $religion;
  public $username;
  public $password;
  public $verificationCode;

  public function saveAccountRecord() {
    $email = $this->email;
    $acctype = $this->acctype;
    $religion = $this->religion;
    $username = $this->username;
    $password = $this->password;
    $verificationCode = $this->verificationCode;

    $data = array(
      "email" => $email,
      "acctype" => $acctype,
      "religion" => $religion,
      "username" => $username,
      "password" => $password,
      "verificationCode" => $verificationCode
    );

    $answer = (new ControllerAccount)->ctrAddAccount($data);

    if ($answer === "ok") {
      echo "ok";
    } else {
      echo "error";
    }
  }
}

$save_account = new SaveAccount();
$save_account->email = $_POST["email"];
$save_account->acctype = $_POST["acctype"];
$save_account->religion = $_POST["religion"];
$save_account->username = $_POST["username"];
$save_account->password = $_POST["password"];
$save_account->verificationCode = $_POST["verificationCode"];

if ($_POST["verificationCode"] === $_SESSION["verificationCode"]) {
  $save_account->saveAccountRecord();
} else {
  echo "verification_failed";
}
?>