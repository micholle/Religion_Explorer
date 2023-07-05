<?php
require_once "../controllers/accounts.controller.php";

class saveAccount {
  public $email;
  public $acctype;
  public $religion;
  public $username;
  public $password;

  public function saveAccountRecord() {
    $email = $this->email;
    $acctype = $this->acctype;
    $religion = $this->religion;
    $username = $this->username;
    $password = $this->password;

    $data = array(
      "email" => $email,
      "acctype" => $acctype,
      "religion" => $religion,
      "username" => $username,
      "password" => $password
    );

    $answer = (new ControllerAccount)->ctrAddAccount($data);
  }
}

$save_account = new saveAccount();
$save_account->email = $_POST["email"];
$save_account->acctype = $_POST["acctype"];
$save_account->religion = $_POST["religion"];
$save_account->username = $_POST["username"];
$save_account->password = $_POST["password"];

$save_account->saveAccountRecord();
