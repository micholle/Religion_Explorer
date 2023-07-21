<?php
require_once "../controllers/accounts.controller.php";
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $oldPassword = $_POST['oldPassword'];
  $password = $_POST['newPassword'];
  $accountid = $_SESSION['accountid'];

  $result = (new ControllerAccount)->ctrEditPassword($accountid, $password, $oldPassword);

  if ($result === 'ok') {
    echo 'success'; // Password reset successfully
  } else if ($result === 'incorrect_oldPass'){
    echo 'incorrect_oldPass'; // Error occurred while resetting password
  } else {
    echo 'error'; // Error occurred while resetting password
  }
}
?>
