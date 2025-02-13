<?php
require_once "connection.php";
require_once '../views/assets/plugins/PHPMailer/src/PHPMailer.php';
require_once '../views/assets/plugins/PHPMailer/src/SMTP.php';
require_once '../views/assets/plugins/PHPMailer/src/Exception.php';

class ModelAccount{
	static public function mdlVerifyEmail($data) {
		$db = new Connection();
		$pdo = $db->connect();
	  
		try {
		  // Check if email already exists
		  $checkEmail = $pdo->prepare("SELECT COUNT(*) as count FROM accounts WHERE email = :email");
		  $checkEmail->bindParam(":email", $data["email"], PDO::PARAM_STR);
		  $checkEmail->execute();
		  $emailExists = $checkEmail->fetch(PDO::FETCH_ASSOC);
	  
		  if ($emailExists['count'] > 0) {
			return "email_exists";
		  }
		  // Check if username already exists
		  $checkUsername = $pdo->prepare("SELECT COUNT(*) as count FROM accounts WHERE username = :username");
		  $checkUsername->bindParam(":username", $data["username"], PDO::PARAM_STR);
		  $checkUsername->execute();
		  $usernameExists = $checkUsername->fetch(PDO::FETCH_ASSOC);
	  
		  if ($usernameExists['count'] > 0) {
			return "username_exists";
		  }
	  
		  session_start();
		  $_SESSION['verificationCode'] = $data["verificationCode"];
		  $_SESSION['email'] = $data["email"];
	  
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
			$mailBody = '<!DOCTYPE html>
						<html>
							<head>
								<link href="https://fonts.googleapis.com/css2?family=Lexend+Deca&display=swap" rel="stylesheet">
							</head>
							<body>
								<table cellspacing="0" cellpadding="0" border="0" width="100%">
									<tr>
										<td align="center">
											<table cellspacing="0" cellpadding="0" border="0" width="100%" style="max-width: 600px;">
												<tr>
													<td align="center">
														<img src="religionexplorer.uno/views/assets/img/logo-and-text.png" style="width: 300px;">
													</td>
												</tr>
												<tr style="font-family: \'Lexend Deca\', sans-serif; font-size: 15px;">
													<td style="text-align: center; padding: 20px 20px 0px 20px;">
														<b>Hello, Explorer!</b><br><br>
														Welcome to Religion Explorer, a reliable religious resource for people from all walks of life!<br><br>
														Before you can create a profile, interact with fellow explorers, and share your creations, you\'ll need to verify your account.<br><br>
														Here is your verification code:
													</td>
												</tr>
												<tr>
													<td style="text-align: center; padding: 15px 0 20px 0; color: #2CA464; font-size: 40px; font-weight: 600; font-family: \'Lexend Deca\', sans-serif;">' . $data["verificationCode"] . '
													</td>
												</tr>
												<tr>
													<td style="font-family: \'Lexend Deca\', sans-serif; background-color: #89C68A; text-align: center; padding: 15px; font-size: 12px;">
														Copyright © 2023 Religion Explorer. All rights reserved.
													</td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
							</body>
						</html>';


			$mail->isHTML(true);
			$mail->Body = $mailBody; 
	  
			// Send the email
			$mail->send();
			return "ok";
		  } catch (Exception $e) {
			return "error";
		  }
		} catch (Exception $e) {
		  return "error";
		}
	  }
	  
	  static public function mdlAddAccount($data) {
		$db = new Connection();
		$pdo = $db->connect();

		if($data['religion'] === 'Buddhism'){
			$imagePath = '../views/assets/img/editProfile/lion.png';
		} else if ($data['religion'] === 'Christianity'){
			$imagePath = '../views/assets/img/editProfile/lamb.png';
		} else if ($data['religion'] === 'Hinduism'){
			$imagePath = '../views/assets/img/editProfile/cow.png';
		} else if ($data['religion'] === 'Islam'){
			$imagePath = '../views/assets/img/editProfile/cat.png';
		} else if ($data['religion'] === 'Judaism'){
			$imagePath = '../views/assets/img/editProfile/deer.png';
		} else if ($data['religion'] === 'Non-religious' || $data['religion'] === 'Other'){
			$imagePath = '../views/assets/img/editProfile/lion.png';
		}
		
		$imageData = file_get_contents($imagePath);
		try {
		  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		  $pdo->beginTransaction();
	  
		  // Generate account ID
		  $account_id = $pdo->prepare("SELECT CONCAT('R', LPAD((COUNT(accountid)+1), 4, '0')) as gen_id  FROM accounts FOR UPDATE");
		  $account_id->execute();
		  $accountid = $account_id->fetch(PDO::FETCH_ASSOC);
	  
		  $password = password_hash($data["password"], PASSWORD_DEFAULT);
	  
		  $stmt = $pdo->prepare("INSERT INTO accounts(accountid, email, acctype, username, password, religion, avatar) VALUES (:accountid, :email, :acctype, :username, :password, :religion, :avatar)");
	  
		  $stmt->bindParam(":accountid", $accountid['gen_id'], PDO::PARAM_STR);
		  $stmt->bindParam(":email", $data["email"], PDO::PARAM_STR);
		  $stmt->bindParam(":acctype", $data["acctype"], PDO::PARAM_STR);
		  $stmt->bindParam(":username", $data["username"], PDO::PARAM_STR);
		  $stmt->bindParam(":password", $password, PDO::PARAM_STR);
		  $stmt->bindParam(":religion", $data["religion"], PDO::PARAM_STR);
		  $stmt->bindParam(":avatar", $imageData, PDO::PARAM_LOB);
		  $stmt->execute();
	  
		  $pdo->commit();
		  return "ok";
		} catch (Exception $e) {
		  $pdo->rollBack();
		  return "error";
		} finally {
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
			  $mail->Body = '<!DOCTYPE html>
							<html>
								<head>
									<link href="https://fonts.googleapis.com/css2?family=Lexend+Deca&display=swap" rel="stylesheet">
								</head>
								<body>
									<table cellspacing="0" cellpadding="0" border="0" width="100%">
										<tr>
											<td align="center">
												<table cellspacing="0" cellpadding="0" border="0" width="100%" style="max-width: 600px;">
													<tr>
														<td align="center">
															<img src="religionexplorer.uno/views/assets/img/logo-and-text.png" style="width: 300px;">
														</td>
													</tr>
													<tr style="font-family: \'Lexend Deca\', sans-serif; font-size: 15px;">
														<td style="text-align: center; padding: 20px 20px 0px 20px;">
															<b>Hello, Explorer.</b><br><br>
															We\'re sorry to hear that you\'re having trouble logging in!<br><br>
															Your password change request has been received. Please click the link to reset your password:
														</td>
													</tr>
													<tr>
														<td style="text-align: center; padding: 15px 0 20px 0; font-size: 15px; font-family: \'Lexend Deca\', sans-serif;"><a href="http://localhost/religion_explorer/views/modules/resetPassword.php" style="text-decoration: none; color: #2CA464;">http://localhost/religion_explorer/views/modules/resetPassword.php</a>
														</td>
													</tr>
													<tr>
														<td style="font-family: \'Lexend Deca\', sans-serif; background-color: #89C68A; text-align: center; padding: 15px; font-size: 12px;">
															Copyright © 2023 Religion Explorer. All rights reserved.
														</td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
								</body>
							</html>';

				$mail->isHTML(true);

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

	//update User Profile
	static public function mdlUpdateAccount($data) {
		$db = new Connection();
		$pdo = $db->connect();
		
		try {
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$pdo->beginTransaction();
	
			$stmt = $pdo->prepare("UPDATE accounts 
								  SET username = CASE WHEN :username <> '' THEN :username ELSE username END, 
									  religion = CASE WHEN :religion <> '' THEN :religion ELSE religion END, 
									  notifications = :displayNotifications, 
									  displayCalendar = :displayCalendar, 
									  displayNickname = :displayNickname, 
									  displayBookmark = :displayBookmark, 
									  displayReligion = :displayReligion, 
									  displayPage = :displayPage 
								  WHERE accountid = :accountid");

			$stmt->bindValue(':username', $data['username'], PDO::PARAM_STR);
			$stmt->bindValue(':religion', $data['religion'], PDO::PARAM_STR);
			$stmt->bindValue(':displayNotifications', $data['displayNotifications'], PDO::PARAM_INT);
			$stmt->bindValue(':displayCalendar', $data['displayCalendar'], PDO::PARAM_INT);
			$stmt->bindValue(':displayNickname', $data['displayNickname'], PDO::PARAM_INT);
			$stmt->bindValue(':displayBookmark', $data['displayBookmark'], PDO::PARAM_INT);
			$stmt->bindValue(':displayReligion', $data['displayReligion'], PDO::PARAM_INT);
			$stmt->bindValue(':displayPage', $data['displayPage'], PDO::PARAM_INT);
			$stmt->bindValue(':accountid', $data['accountid'], PDO::PARAM_STR);
	
			$stmt->execute();
	
			$pdo->commit();
			self::mdlUpdateSession($data['accountid']);
			return "ok";
		} catch (PDOException $e) {
			$pdo->rollBack();
			return "error";
		} finally {
			$pdo = null;
			$stmt = null;
		}
	}
	
	static public function mdlUpdateSession($accountid) {
		$db = new Connection();
		$pdo = $db->connect();
	
		try {
			$stmt = $pdo->prepare("SELECT * FROM accounts WHERE accountid = :accountid");
			$stmt->bindParam(":accountid", $accountid, PDO::PARAM_STR);
			$stmt->execute();
			$user = $stmt->fetch(PDO::FETCH_ASSOC);
	
			if ($user) {
				$_SESSION['accountid'] = $user['accountid'];
				$_SESSION['username'] = $user['username'];
				$_SESSION['email'] = $user['email'];
				$_SESSION['religion'] = $user['religion'];
				$_SESSION['accountDate'] = $user['accountDate'];
			} else {
				return "User not found";
			}
		} catch (PDOException $e) {
			return "Error";
		}
	}

	static public function mdlUpdateAvatar($avatar) {
		// Update the avatar in the database for the current user
		// Add your code here to perform the database update operation
		$db = new Connection();
		$pdo = $db->connect();
		$imageData = file_get_contents($avatar);
		try {
			$stmt = $pdo->prepare("UPDATE accounts SET avatar = :avatar WHERE accountid = :accountid");
		
			$stmt->bindParam(":avatar", $imageData, PDO::PARAM_LOB);
			$stmt->bindParam(":accountid", $_SESSION['accountid'], PDO::PARAM_STR);
			$stmt->execute();

			$_SESSION['avatar'] = $imageData;
		
			$pdo->commit();
			return "ok";
		  } catch (Exception $e) {
			$pdo->rollBack();
			return "error";
		  } finally {
			$pdo = null;
			$stmt = null;
		  }
	  }


	  //delete
	  static public function mdlDeleteAccount($data) {
		$db = new Connection();
		$pdo = $db->connect();
	  
		$imagePath = '../views/assets/img/editProfile/anonymous.png';
		$imageData = file_get_contents($imagePath);
	  
		try {
		  // Verify the email and password
		  $stmtVerify = $pdo->prepare("SELECT password FROM accounts WHERE email = :email");
		  $stmtVerify->bindParam(":email", $data['email'], PDO::PARAM_STR);
		  $stmtVerify->execute();
		  $result = $stmtVerify->fetch(PDO::FETCH_ASSOC);
	  
		  if ($result) {
			$hashedPassword = $result['password'];
	  
			// Verify the password
			if (password_verify($data['password'], $hashedPassword)) {
			  // Delete the account
			  $stmtDelete = $pdo->prepare("UPDATE accounts SET
				email = '',
				acctype = '',
				username = '[Deleted_Account]',
				password = '',
				religion = '',
				avatar = :avatar
				WHERE accountid = :accountid"
			  );
			  $stmtDelete->bindParam(":accountid", $_SESSION['accountid'], PDO::PARAM_STR);
			  $stmtDelete->bindParam(":avatar", $imageData, PDO::PARAM_LOB);
			  $stmtDelete->execute();
	  
			  $pdo->commit();
			  return "ok";
			} else {
			  return "invalid_password";
			}
		  } else {
			return "invalid_email";
		  }
		} catch (Exception $e) {
		  $pdo->rollBack();
		  return "error";
		} finally {
		  $pdo = null;
		  $stmtVerify = null;
		  $stmtDelete = null;
		}
	  }

	  static public function mdlEditPassword($accountid, $password, $oldPassword) {
		$db = new Connection();
		$pdo = $db->connect();
	  
		try {
			// Retrieve the current password from the database
			$stmt = $pdo->prepare("SELECT password FROM accounts WHERE accountid = :accountid");
			$stmt->bindParam(":accountid", $accountid, PDO::PARAM_STR);
			$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
	
			// Check if the old password matches the current password
			if (password_verify($oldPassword, $result['password'])) {
				// Hash the new password
				$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
		  
				$stmt = $pdo->prepare("UPDATE accounts SET password = :password WHERE accountid = :accountid");
				$stmt->bindParam(":password", $hashedPassword, PDO::PARAM_STR);
				$stmt->bindParam(":accountid", $accountid, PDO::PARAM_STR);
				$stmt->execute();
		  
				// Check the affected rows to determine if the password was updated successfully
				if ($stmt->rowCount() > 0) {
					return 'ok'; // Password reset successfully
				} else {
					return 'error'; // Error occurred while resetting password
				}
			} else {
				return 'incorrect_oldPass'; // Old password does not match the current password
			}
		} catch (Exception $e) {
			return 'error'; // Error occurred while resetting password
		}
	  
		$pdo = null;
		$stmt = null;
	}
	  
}
?>
