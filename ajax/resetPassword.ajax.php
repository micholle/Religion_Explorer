<?php
require_once "../controllers/accounts.controller.php";
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $password = $_POST['password'];
  $email = $_SESSION['email'];

  $result = (new ControllerAccount)->ctrResetPassword($email, $password);

  if ($result === true) {
    echo 'success'; // Password reset successfully
  } else {
    echo 'error'; // Error occurred while resetting password
  }
}
?>
