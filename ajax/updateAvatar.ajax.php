<?php
require_once "../controllers/accounts.controller.php";
session_start();

if (isset($_POST["avatar"])) {
  $avatar = $_POST["avatar"];

  // Call the controller function to update the avatar
  $response = ControllerAccount::ctrUpdateAvatar($avatar);

  if ($response === "ok") {
    echo "ok";
  } else {
    echo "error";
  }
}
?>
