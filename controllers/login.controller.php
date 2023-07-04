<?php
require_once "../../models/login.model.php";

class ControllerLogin {
    public function loginUser($username, $password) {
        $model = new ModelLogin();
        $result = $model->checkCredentials($username, $password);

        if ($result === "Success") {
            // Redirect to map.php
            header("Location: map.php");
            exit();
        } elseif ($result === "Invalid credentials") {
            $errorMessage = "Invalid credentials";
        } else {
            $errorMessage = "Oops. Something went wrong!";
        }

        return $errorMessage;
    }
}
?>
