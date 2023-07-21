<?php
session_start(); // Start the session if it hasn't already been started
if($_SESSION['acctype'] === 'regular'){
    header("Location: ../views/modules/login.php");
} else if ($_SESSION['acctype'] === 'admin'){
    header("Location: ../views/modules/login.php");
} else {
    header("Location: ../views/modules/splash.php");
}

// Destroy the session data
session_destroy();

exit();
?>