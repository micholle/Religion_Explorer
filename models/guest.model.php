<?php
session_start();
require_once "connection.php";

try {
    $db = new Connection();
    $pdo = $db->connect();

    $status = "guest";
    $datetime = date("Y-m-d H:i:s");

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->beginTransaction();

    $stmt = $pdo->prepare("INSERT INTO accesslog(status, datetime) VALUES (:status, :datetime)");
    $stmt->bindParam(":status", $status, PDO::PARAM_STR);
    $stmt->bindParam(":datetime", $datetime, PDO::PARAM_STR);

    $stmt->execute();
    $pdo->commit();

    $_SESSION['acctype'] = 'guest';
    $_SESSION['accountid'] = 'guest';
    header("Location: ../views/modules/map.php");
    exit();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}
?>
