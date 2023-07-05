<?php
require_once "connection.php";

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
	
			$stmt = $pdo->prepare("INSERT INTO accounts(accountid, email, acctype, username, password, religion) VALUES (:accountid, :email, :acctype, :username, :password, :religion)");
	
			$stmt->bindParam(":accountid", $accountid[0]['gen_id'], PDO::PARAM_STR);
			$stmt->bindParam(":email", $data["email"], PDO::PARAM_STR);
			$stmt->bindParam(":acctype", $data["acctype"], PDO::PARAM_STR);
			$stmt->bindParam(":username", $data["username"], PDO::PARAM_STR);
			$stmt->bindParam(":password", $password, PDO::PARAM_STR);
			$stmt->bindParam(":religion", $data["religion"], PDO::PARAM_STR);
			$stmt->execute();
	
			$pdo->commit();
			return "ok";
		} catch (Exception $e) {
			$pdo->rollBack();
			return "error";
		}
		$pdo = null;
		$stmt = null;
	}	
}
?>
