<?php
require_once "connection.php";
require_once '../views/assets/plugins/PHPMailer/src/PHPMailer.php';
require_once '../views/assets/plugins/PHPMailer/src/SMTP.php';
require_once '../views/assets/plugins/PHPMailer/src/Exception.php';

class ModelAccount{
	static public function mdlAddAccount($data) {
		$db = new Connection();
		$pdo = $db->connect();
		try {
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$pdo->beginTransaction();
	
			$account_id = $pdo->prepare("SELECT CONCAT('R', LPAD((count(id)+1),4,'0')) as gen_id  FROM accounts FOR UPDATE");
			$account_id->execute();
			$accountid = $account_id->fetchAll(PDO::FETCH_ASSOC);
	
			$password = password_hash($data["password"], PASSWORD_DEFAULT);
	
			$stmt = $pdo->prepare("INSERT INTO accounts(accountid, email, acctype, username, password, religion, verified, verificationCode) VALUES (:accountid, :email, :acctype, :username, :password, :religion, :verified, :verificationCode)");
	
			$stmt->bindParam(":accountid", $accountid[0]['gen_id'], PDO::PARAM_STR);
			$stmt->bindParam(":email", $data["email"], PDO::PARAM_STR);
			$stmt->bindParam(":acctype", $data["acctype"], PDO::PARAM_STR);
			$stmt->bindParam(":username", $data["username"], PDO::PARAM_STR);
			$stmt->bindParam(":password", $password, PDO::PARAM_STR);
			$stmt->bindParam(":religion", $data["religion"], PDO::PARAM_STR);
			$stmt->bindParam(":verified", $data["verified"], PDO::PARAM_STR);
			$stmt->bindParam(":verificationCode", $data["verificationCode"], PDO::PARAM_STR);
			$stmt->execute();
	
			$pdo->commit();

			$mail = new PHPMailer\PHPMailer\PHPMailer(true);

			try {
				// SMTP configuration for Hostinger
				$mail->isSMTP();
				$mail->Host = 'smtp.hostinger.com'; // SMTP server address
				$mail->SMTPAuth = true;
				$mail->Username = 'religionexplorer@religionexplorer.uno'; // SMTP username (your email address)
				$mail->Password = 'Religion_explorer619'; // SMTP password
				$mail->SMTPSecure = 'tls'; // Enable TLS encryption
				$mail->Port = 587; // SMTP port number

				// Email Content
				$mail->setFrom('religionexplorer@religionexplorer.uno', 'Religion Explorer'); // Sender's email address and name
				$mail->addAddress($data["email"]); // Recipient's email address
				$mail->Subject = 'Religion Explorer Email Verification'; // Email subject
				$mail->Body = 'Your verification code is: ' . $data["verificationCode"]; // Email body

				// Send the email
				$mail->send();
				echo 'Email sent successfully';
			} catch (Exception $e) {
				echo 'Email could not be sent. Error: ', $mail->ErrorInfo;
			}

			return "ok";
		} catch (Exception $e) {
			$pdo->rollBack();
			return "error";
		}
		$pdo = null;
		$stmt = null;
	}	

	static public function mdlVerifyCode($data) {
        $db = new Connection();
        $pdo = $db->connect();
        try {
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM accounts WHERE email = :email AND verification_code = :verificationCode");
            $stmt->bindParam(":email", $data['email'], PDO::PARAM_STR);
            $stmt->bindParam(":verificationCode", $data['verificationCode'], PDO::PARAM_STR);
            $stmt->execute();
            $count = $stmt->fetchColumn();

            if ($count > 0) {
                // Update the verified field to 1
                $updateStmt = $pdo->prepare("UPDATE accounts SET verified = 1 WHERE email = :email AND verification_code = :verificationCode");
                $updateStmt->bindParam(":email", $data['email'], PDO::PARAM_STR);
                $updateStmt->bindParam(":verificationCode", $data['verificationCode'], PDO::PARAM_STR);
                $updateStmt->execute();

                return true; // Email and verification code are correct
            } else {
                return false; // Email or verification code is incorrect
            }
        } catch (Exception $e) {
            return false; // Error occurred while verifying email and code
        }

        $pdo = null;
        $stmt = null;
    }
}
?>
