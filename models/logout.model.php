<?php
session_start(); // Start the session if it hasn't already been started

// Destroy the session data
session_destroy();

// Redirect the user to the login page or any other desired page
header("Location: ../views/modules/login.php");
exit();
?>