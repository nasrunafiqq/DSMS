<?php

if(isset($_GET['action'])){
	$action = $_GET['action'];
}else{
	$action = "";
}
switch ($action) {
	case "add":
		
		require_once "view/add.php";
		break;
	
	case "edit":
		
		require_once "view/edit.php";
		break;

	case "delete":
		
		//require_once "view/insert.php";
		break;

	default:
		//get the data out of table
		require_once '../../view/Login/Register.php';
		break;
}


class RegisterModel
{
	private $dbRegister;
	function __construct($dbRegister)
	{
		$this->dbRegister=$dbRegister;
	}

	function register(){
		if (isset($_POST['register'])) {
			$username = addslashes(strip_tags($_POST['username']));
			$password = addslashes(strip_tags($_POST['password']));
			$userCategory = addslashes(strip_tags($_POST['userCategory']));
			$name = addslashes(strip_tags($_POST['name']));
			$ICNumber = addslashes(strip_tags($_POST['ICNumber']));
			$phoneNumber = addslashes(strip_tags($_POST['phoneNumber']));
			$address = addslashes(strip_tags($_POST['address']));

			if ($userCategory == "Staff") {
				$sqlStaffRegisterUser = $this->dbRegister->prepare("INSERT INTO user (username,password,userType) VALUES (:username, :password, :userCategory)");
				$sqlStaffRegisterUser->execute(array('username'=>$username, 'password'=>$password, 'userCategory'=>$userCategory));
				
				$sqlStaffRegisterUser1 = $this->dbRegister->prepare("SELECT * FROM user WHERE username = :username AND password= :password");
				$sqlStaffRegisterUser1->execute(array('username'=>$username, 'password'=>$password));


				if ($sqlStaffRegisterUser1->rowCount()) {
					$dataRegisterUserStaff = $sqlStaffRegisterUser1->fetch();
					$usrTypeID = $dataRegisterUserStaff['userID'];

					$sqlStaffRegister = $this->dbRegister->prepare("INSERT INTO staff (userID,staffName,staffIC,staffMobile,staffAddress) VALUES (:usrTypeID, :name, :ICNumber,:phoneNumber, :address)");
					$sqlStaffRegister->execute(array('usrTypeID'=>$usrTypeID, 'name'=>$name, 'ICNumber'=>$ICNumber,'phoneNumber'=>$phoneNumber, 'address'=>$address, ));
					header('Location:../../view/Login/Login.php');
				}	
			}
			if ($userCategory == "Student") {
				$sqlStudRegisterUser = $this->dbRegister->prepare("INSERT INTO user (username,password,userType) VALUES (:username, :password, :userCategory)");
				$sqlStudRegisterUser->execute(array('username'=>$username, 'password'=>$password, 'userCategory'=>$userCategory));
				
				$sqlStudRegisterUser1 = $this->dbRegister->prepare("SELECT * FROM user WHERE username = :username AND password= :password");
				$sqlStudRegisterUser1->execute(array('username'=>$username, 'password'=>$password));


				if ($sqlStudRegisterUser1->rowCount()) {
					$dataRegisterUserStud = $sqlStudRegisterUser1->fetch();
					$usrTypeID = $dataRegisterUserStud['userID'];

					$sqlStudRegister = $this->dbRegister->prepare("INSERT INTO student (userID,studentName,studentIC,studentMobile,studentAddress) VALUES (:usrTypeID, :name, :ICNumber,:phoneNumber, :address)");
					$sqlStudRegister->execute(array('usrTypeID'=>$usrTypeID, 'name'=>$name, 'ICNumber'=>$ICNumber,'phoneNumber'=>$phoneNumber, 'address'=>$address, ));
					header('Location:../../view/Login/Login.php');
				}	
			}
			if ($userCategory == "Instructor") {
				$sqlInsRegisterUser = $this->dbRegister->prepare("INSERT INTO user (username,password,userType) VALUES (:username, :password, :userCategory)");
				$sqlInsRegisterUser->execute(array('username'=>$username, 'password'=>$password, 'userCategory'=>$userCategory));
				
				$sqlInsRegisterUser1 = $this->dbRegister->prepare("SELECT * FROM user WHERE username = :username AND password= :password");
				$sqlInsRegisterUser1->execute(array('username'=>$username, 'password'=>$password));


				if ($sqlInsRegisterUser1->rowCount()) {
					$dataRegisterUserIns = $sqlInsRegisterUser1->fetch();
					$usrTypeID = $dataRegisterUserIns['userID'];

					$sqlInsRegister = $this->dbRegister->prepare("INSERT INTO instructor (userID,instructorName,instructorIC,instructorMobile,instructorAddress) VALUES (:usrTypeID, :name, :ICNumber,:phoneNumber, :address)");
					$sqlInsRegister->execute(array('usrTypeID'=>$usrTypeID, 'name'=>$name, 'ICNumber'=>$ICNumber,'phoneNumber'=>$phoneNumber, 'address'=>$address, ));
					header('Location:../../view/Login/Login.php');
				}	
			}

			else{
				echo " ERR";
			}
		}else{
			//echo "login form not submitted";
		}
	}
}

?>