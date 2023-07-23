<?php
require_once "../../models/login.model.php";

class ControllerLogin {
    public function loginUser($username, $password) {
        $model = new ModelLogin();
        $result = $model->checkCredentials($username, $password);

        if ($result === "Success") {
            if ($_SESSION['acctype'] === 'regular'){
                // Redirect to the appropriate page based on user settings
                if ($_SESSION['displayPage'] === '1') {
                    $displayPage = "userProfile.php";
                } elseif ($_SESSION['displayPage'] === '2') {
                    $displayPage = "library.php";
                } elseif ($_SESSION['displayPage'] === '3') {
                    $displayPage = "discussionForum.php";
                } elseif ($_SESSION['displayPage'] === '4') {
                    $displayPage = "calendar.php";
                } elseif ($_SESSION['displayPage'] === '0') {
                    $displayPage = "map.php";
                }
                
                header("Location: " . $displayPage);
                exit();
            } else if ($_SESSION['acctype'] === 'admin'){
                header("Location: dashboard.php");
                exit();
            }
        } elseif ($result === "Account suspended") {
            $errorMessage = "Your account is currently suspended. You can log in again in ";

            if ($_SESSION['yearsLeft'] > 0) {
                $errorMessage .= $_SESSION['yearsLeft'] . " years and " . $_SESSION['monthsLeft'] . " months";
            } else if ($_SESSION['monthsLeft'] > 0) {
                $errorMessage .= $_SESSION['monthsLeft'] . " months";
            } else if ($_SESSION['daysLeft'] > 0) {
                $errorMessage .= $_SESSION['daysLeft'] . " days";
            } elseif ($_SESSION['hoursLeft'] > 0) {
                $errorMessage .= $_SESSION['hoursLeft'] . " hours";
            } elseif ($_SESSION['minutesLeft'] > 0) {
                $errorMessage .= $_SESSION['minutesLeft'] . " minutes";
            } else {
                $errorMessage .= $_SESSION['secondsLeft'] . " seconds";
            }

            $errorMessage .= ".";

        } elseif ($result === "Account banned") {
            $errorMessage = "Account was banned";
        } elseif ($result === "Invalid credentials") {
            $errorMessage = "Invalid credentials";
        } else {
            $errorMessage = "Oops. Something went wrong!";
        }

        return $errorMessage;
    }
}
?>

