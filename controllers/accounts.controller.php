<?php
require_once "../models/accounts.model.php";

class ControllerAccount{
  static public function ctrAddAccount($data){
    $answer = (new ModelAccount)->mdlAddAccount($data);
  }
}
?>
