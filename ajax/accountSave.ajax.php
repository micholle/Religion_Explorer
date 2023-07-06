<?php
require_once "../controllers/accounts.controller.php";

class SaveAccount {
  public $email;
  public $acctype;
  public $religion;
  public $username;
  public $password;
  public $verified;
  public $verificationCode;

  public function saveAccountRecord() {
    $email = $this->email;
    $acctype = $this->acctype;
    $religion = $this->religion;
    $username = $this->username;
    $password = $this->password;
    $verified = $this->verified;
    $verificationCode = $this->verificationCode;

    $data = array(
      "email" => $email,
      "acctype" => $acctype,
      "religion" => $religion,
      "username" => $username,
      "password" => $password,
      "verified" => $verified,
      "verificationCode" => $verificationCode
    );

    $answer = (new ControllerAccount)->ctrAddAccount($data);
  }
}

$save_account = new SaveAccount();
$save_account->email = $_POST["email"];
$save_account->acctype = $_POST["acctype"];
$save_account->religion = $_POST["religion"];
$save_account->username = $_POST["username"];
$save_account->password = $_POST["password"];
$save_account->verified = $_POST["verified"];
$save_account->verificationCode = $_POST["verificationCode"];

$save_account->saveAccountRecord();
?>
