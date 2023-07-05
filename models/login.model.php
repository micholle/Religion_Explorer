<?php
session_start();
require_once "connection.php";

class ModelLogin {
    public function checkCredentials($username, $password) {
        $db = new Connection();
        $pdo = $db->connect();

        try {
            $stmt = $pdo->prepare("SELECT * FROM accounts WHERE (username = :username OR email = :email)");
            $stmt->bindParam(":username", $username, PDO::PARAM_STR);
            $stmt->bindParam(":email", $username, PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                // Credentials are valid
                session_start();
                $_SESSION['accountid'] = $user['accountid'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                return "Success";
            } else {
                // Invalid credentials
                return "Invalid credentials";
            }
        } catch (Exception $e) {
            // Error occurred
            return "Error";
        }
    }
}
