<?php
require_once "../controllers/accounts.controller.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = $_POST['email'];
  $answer = (new ControllerAccount)->ctrCheckEmail($email);

  if ($answer === true) {
    echo 'ok'; // Email exists and email sent successfully
  } else if ($answer === false) {
    echo 'notfound'; // Email not found in the database
  } else {
    echo 'error'; // Error occurred while sending email
  }
}
?>
