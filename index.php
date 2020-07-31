<?php

include "./model/crud.php";
$db=new crud();
if(isset($_GET['controller'])){
	$controller = $_GET['controller'];
}else{
	$controller = "";
}
switch ($controller) {
	case 'editVeh':
	
		require_once "./controller/EDTcontroller.php";
		break;
	
	default:
		//require_once "./controller/StaffController/StaffController.php";
		header("location:view/Login/Login.php");
		break;
}




?>