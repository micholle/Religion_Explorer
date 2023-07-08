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
	  
		  // Check if email already exists
		  $checkEmail = $pdo->prepare("SELECT COUNT(*) as count FROM accounts WHERE email = :email");
		  $checkEmail->bindParam(":email", $data["email"], PDO::PARAM_STR);
		  $checkEmail->execute();
		  $emailExists = $checkEmail->fetch(PDO::FETCH_ASSOC);
	  
		  if ($emailExists['count'] > 0) {
			return "email_exists";
		  }
	  
		  // Generate account ID
		  $account_id = $pdo->prepare("SELECT CONCAT('R', LPAD((count(id)+1),4,'0')) as gen_id  FROM accounts FOR UPDATE");
		  $account_id->execute();
		  $accountid = $account_id->fetchAll(PDO::FETCH_ASSOC);
	  
		  $password = password_hash($data["password"], PASSWORD_DEFAULT);
	  
		  $stmt = $pdo->prepare("INSERT INTO accounts(accountid, email, acctype, username, password, religion, verificationCode) VALUES (:accountid, :email, :acctype, :username, :password, :religion, :verificationCode)");
	  
		  $stmt->bindParam(":accountid", $accountid[0]['gen_id'], PDO::PARAM_STR);
		  $stmt->bindParam(":email", $data["email"], PDO::PARAM_STR);
		  $stmt->bindParam(":acctype", $data["acctype"], PDO::PARAM_STR);
		  $stmt->bindParam(":username", $data["username"], PDO::PARAM_STR);
		  $stmt->bindParam(":password", $password, PDO::PARAM_STR);
		  $stmt->bindParam(":religion", $data["religion"], PDO::PARAM_STR);
		  $stmt->bindParam(":verificationCode", $data["verificationCode"], PDO::PARAM_STR);
		  $stmt->execute();
	  
		  $pdo->commit();
	  
		  // Send verification email
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
			return "ok";
		  } catch (Exception $e) {
			return "error";
		  }
		} catch (Exception $e) {
		  $pdo->rollBack();
		  return "error";
		} finally {
		  $pdo = null;
		  $stmt = null;
		}
	  }
	  

	static public function mdlVerifyCode($data) {
		$db = new Connection();
		$pdo = $db->connect();
		
		try {
		  $stmt = $pdo->prepare("SELECT COUNT(*) FROM accounts WHERE email = :email AND verificationCode = :verificationCode");
		  $stmt->bindParam(":email", $data['email'], PDO::PARAM_STR);
		  $stmt->bindParam(":verificationCode", $data['verificationCode'], PDO::PARAM_STR);
		  $stmt->execute();
		  $count = $stmt->fetchColumn();
	  
		  if ($count > 0) {
			// Update the verified field to 1
			$updateStmt = $pdo->prepare("UPDATE accounts SET verified = 1 WHERE email = :email AND verificationCode = :verificationCode");
			$updateStmt->bindParam(":email", $data['email'], PDO::PARAM_STR);
			$updateStmt->bindParam(":verificationCode", $data['verificationCode'], PDO::PARAM_STR);
			$updateStmt->execute();
	  
			return true;
		  } else {
			return false;
		  }
		} catch (PDOException $e) {
		  // Handle database errors
		  return false;
		} finally {
		  // Close the database connection and statements
		  $pdo = null;
		  $stmt = null;
		}
	  }
	  

	static public function mdlCheckEmail($email) {
		$db = new Connection();
		$pdo = $db->connect();
	  
		try {
		  $stmt = $pdo->prepare("SELECT COUNT(*) FROM accounts WHERE email = :email");
		  $stmt->bindParam(":email", $email, PDO::PARAM_STR);
		  $stmt->execute();
		  $count = $stmt->fetchColumn();
	  
		  if ($count > 0) {
			session_start();
			$_SESSION['email'] = $email;
			try {
			  $mail = new PHPMailer\PHPMailer\PHPMailer(true);
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
			  $mail->addAddress($email); // Recipient's email address
			  $mail->Subject = 'Reset Password'; // Email subject
			  $mail->Body = 'Click the link to reset your password: http://localhost/religion_explorer/views/modules/resetPassword.php'; // Email body
	  
			  // Send the email
			  $mail->send();
			  return true; // Email sent successfully
			} catch (Exception $e) {
			  return false; // Error occurred while sending email
			}
		  } else {
			return false; // Email not found in the database
		  }
		} catch (Exception $e) {
		  return false; // Error occurred while verifying email
		}
	  
		$pdo = null;
		$stmt = null;
	}

	static public function mdlResetPassword($email, $password) {
		$db = new Connection();
		$pdo = $db->connect();
	  
		try {
		  // Hash the password
		  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
	  
		  $stmt = $pdo->prepare("UPDATE accounts SET password = :password WHERE email = :email");
		  $stmt->bindParam(":password", $hashedPassword, PDO::PARAM_STR);
		  $stmt->bindParam(":email", $email, PDO::PARAM_STR);
		  $stmt->execute();
	  
		  // Check the affected rows to determine if the password was updated successfully
		  if ($stmt->rowCount() > 0) {
			return true; // Password reset successfully
		  } else {
			return false; // Error occurred while resetting password
		  }
		} catch (Exception $e) {
		  return false; // Error occurred while resetting password
		}
	  
		$pdo = null;
		$stmt = null;
	}
}
?>
