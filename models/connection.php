<?php

class Connection{
	public function connect(){
		$link = new PDO("mysql:host=localhost; dbname=religionexplorer", "root", "");

		$link -> exec("set names utf8mb4");
		return $link;
	}

}

?>