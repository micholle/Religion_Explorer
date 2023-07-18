<?php
require_once "../controllers/accounts.controller.php";
session_start();

class DeleteAccount {
  public $email;
  public $password;

  public function deleteAccountRecord() {
    $email = $this->email;
    $password = $this->password;

    $data = array(
      "email" => $email,
      "password" => $password
    );

    $answer = (new ControllerAccount)->ctrDeleteAccount($data);

    if ($answer === "ok") {
      echo "ok";
    } else {
      echo "error";
    }
  }
}

$delete_account = new DeleteAccount();
$delete_account->email = $_POST["email"];
$delete_account->password = $_POST["password"];
$delete_account->deleteAccountRecord();

?>