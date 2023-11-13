<?php
require_once "connection.php";

class ModelLogin {
    public function checkCredentials($username, $password) {
        $db = new Connection();
        $pdo = $db->connect();
    
        try {
            // Check if the user is suspended or banned
            $statusStmt = $pdo->prepare("SELECT status, endDate FROM accounts_status WHERE accountid IN (SELECT accountid FROM accounts WHERE username = :username OR email = :email)");
            $statusStmt->bindParam(":username", $username, PDO::PARAM_STR);
            $statusStmt->bindParam(":email", $username, PDO::PARAM_STR);
            $statusStmt->execute();
            $statusResult = $statusStmt->fetch(PDO::FETCH_ASSOC);
    
            if ($statusResult) {
                if ($statusResult['status'] === 'Suspended') {
                    // Check if the user's suspension period has expired
                    date_default_timezone_set('Asia/Manila');
                    $endDate = new DateTime($statusResult['endDate']);
                    $currentTime = new DateTime();
                    if ($currentTime < $endDate) {
                        session_start();
                        $timeLeft = $endDate->diff($currentTime);

                        $_SESSION['yearsLeft'] = $timeLeft->y;
                        $_SESSION['monthsLeft'] = $timeLeft->m;
                        $_SESSION['daysLeft'] = $timeLeft->d;
                        $_SESSION['hoursLeft'] = $timeLeft->h;
                        $_SESSION['minutesLeft'] = $timeLeft->i;
                        $_SESSION['secondsLeft'] = $timeLeft->s;

                        // The user is still suspended
                        return "Account suspended";
                    } else {
                        // The suspension period has expired, continue with login check
                    }
                } elseif ($statusResult['status'] === 'Banned') {
                    // The user is banned
                    return "Account banned";
                }
            }            
    
            $stmt = $pdo->prepare("SELECT * FROM accounts WHERE (username = :username OR email = :email)");
            $stmt->bindParam(":username", $username, PDO::PARAM_STR);
            $stmt->bindParam(":email", $username, PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($user && password_verify($password, $user['password'])) {
                // Credentials are valid, and the user is not suspended or banned
                session_start();

                try {
                    if($user['acctype'] == "regular"){
                        $status = "registered";
                        $datetime = date("Y-m-d H:i:s");
                        
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $pdo->beginTransaction();
    
                        $accesslogstmt = $pdo->prepare("INSERT INTO accesslog(status, accesslogid, datetime) VALUES (:status, :accesslogid, :datetime)");
                        $accesslogstmt->bindParam(":status", $status, PDO::PARAM_STR);
                        $accesslogstmt->bindParam(":accesslogid", $user['accountid'], PDO::PARAM_STR);
                        $accesslogstmt->bindParam(":datetime", $datetime, PDO::PARAM_STR);
    
                        $accesslogstmt->execute();
                        $pdo->commit();
                    }

                    $_SESSION['accountid'] = $user['accountid'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['religion'] = $user['religion'];
                    $_SESSION['accountDate'] = $user['accountDate'];
                    $_SESSION['acctype'] = $user['acctype'];
                    $_SESSION['avatar'] = $user['avatar'];
                    $_SESSION['displayPage'] = $user['displayPage'];

                    return "Success";
                } catch (PDOException $e) {
                    return "Error: " . $e->getMessage();
                }
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
