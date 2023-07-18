<?php
require_once "../controllers/accounts.controller.php";
session_start();

if (isset($_FILES["avatar"]) && $_FILES["avatar"]["error"] == UPLOAD_ERR_OK) {
  $avatar = $_FILES["avatar"]["tmp_name"];

  // Call the controller function to update the avatar
  $response = ControllerAccount::ctrUpdateAvatar($avatar);

  if ($response === "ok") {
    echo "ok";
  } else {
    echo "error";
  }
}
?>
