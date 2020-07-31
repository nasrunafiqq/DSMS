<?php
require_once "config.php";
class crud extends dbConfig{
	public function __construct(){
		parent::__construct();
	}

	//print the screen data
	public function getData($sql){
		$stmt=$this->conn->prepare($sql);
		$stmt->execute();
		$result=$stmt->fetchAll();
		return $result;
	}

	//action for delete
	public function action($sql){
		$this->conn->exec($sql);
	}
}


?>