<?php
require_once "../models/accounts.model.php";

class ControllerAccount{
  static public function ctrVerifyEmail($data) {
    $answer = (new ModelAccount)->mdlVerifyEmail($data);
    return $answer;
  }
  
  static public function ctrAddAccount($data) {
    $answer = (new ModelAccount)->mdlAddAccount($data);
    return $answer;
  }  

  static public function ctrCheckEmail($email) {
    // Check if the email exists in the database
    $result = (new ModelAccount)->mdlCheckEmail($email);
  
    if ($result === true) {
      return true; // Email exists and email sent successfully
    } else if ($result === false) {
      return false; // Email not found in the database or error occurred while sending email
    } else {
      return false; // Error occurred while verifying email
    }
  }

  static public function ctrResetPassword($email, $password) {
    // Update the password in the database for the given email
    $result = (new ModelAccount)->mdlResetPassword($email, $password);
  
    if ($result === true) {
      return true; // Password reset successfully
    } else {
      return false; // Error occurred while resetting password
    }
  }

  //userProfile
  static public function ctrUpdateAccount($data) {
    $answer = (new ModelAccount)->mdlUpdateAccount($data);
    return $answer;
  }  
}
?>
