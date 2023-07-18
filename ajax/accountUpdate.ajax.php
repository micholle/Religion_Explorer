<?php
require_once "../controllers/accounts.controller.php";
session_start();

class UpdateAccount {
  public $email;
  public $religion;
  public $username;
  public $displayNotification;
  public $displayCalendar;
  public $displayNickname;
  public $displayBookmark;
  public $displayReligion;
  public $displayPage;
  public $accountid;

  public function updateAccountRecord() {
    $email = $this->email;
    $religion = $this->religion;
    $username = $this->username;
    $displayNotification = $this->displayNotification;
    $displayCalendar = $this->displayCalendar;
    $displayNickname = $this->displayNickname;
    $displayBookmark = $this->displayBookmark;
    $displayReligion = $this->displayReligion;
    $displayPage = $this->displayPage;
    $accountid = $this->accountid;

    $data = array(
      "email" => $email,
      "religion" => $religion,
      "username" => $username,
      "displayNotifications" => $displayNotification,
      "displayCalendar" => $displayCalendar,
      "displayNickname" => $displayNickname,
      "displayBookmark" => $displayBookmark,
      "displayReligion" => $displayReligion,
      "displayPage" => $displayPage,
      "accountid" => $accountid
    );

    $answer = (new ControllerAccount)->ctrUpdateAccount($data);

    if ($answer === "ok") {
      echo "ok";
    } else {
      echo "error";
    }
  }
}

$save_account = new UpdateAccount();
$save_account->email = $_POST["email"];
if ($_POST["religion"] === "null"){
    $save_account->religion = $_SESSION["religion"];
} else {
    $save_account->religion = $_POST["religion"];
}
$save_account->username = $_POST["username"];
$save_account->displayNotification = $_POST["displayNotification"];
$save_account->displayCalendar = $_POST["displayCalendar"];
$save_account->displayNickname = $_POST["displayNickname"];
$save_account->displayBookmark = $_POST["displayBookmark"];
$save_account->displayReligion = $_POST["displayReligion"];
$save_account->displayPage = $_POST["displayPage"];
$save_account->accountid = $_SESSION['accountid'];

$save_account->updateAccountRecord();
?>