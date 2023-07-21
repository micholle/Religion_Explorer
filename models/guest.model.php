<?php
session_start();

$_SESSION['acctype'] = 'guest';
$_SESSION['accountid'] = 'guest';
header("Location: ../views/modules/map.php");
exit();
?>