<?php

if(isset($_GET['action'])){
	$action = $_GET['action'];
}else{
	$action = "";
}
switch ($action) {
	
	case "edit":
		if (isset($_GET['id'])) {
			$id = $_GET['id'];

			// foreach ($db->getData("SELECT * FROM vehicle WHERE id = '$id'") as $row ) {
			// 	$vehicleName = isset($row['vehicleName'])?$row['vehicleName']:'';
			// 	$vehicleModel = isset($row['vehicleModel'])?$row['vehicleModel']:'';
			// 	$vehiclePlate = isset($row['vehiclePlate'])?$row['vehiclePlate']:'';
			// 	$vehicleColor = isset($row['vehicleColor'])?$row['vehicleColor']:'';

			// }
		}
		if (isset($_POST['submit'])) {
			$vehicleName = $_POST['vehicleName'];
			$vehicleModel = $_POST['vehicleModel'];
			$vehiclePlate = $_POST['vehiclePlate'];
			$vehicleColor = $_POST['vehicleColor'];
			$Vid = $_GET['id'];

			if (empty($vehicleName) || empty($vehicleName) || empty($vehicleName)) {
				$error = "Please enter all the input";
			}else{
				$db->action("UPDATE vehicle SET vehicleName ='$vehicleName', vehicleModel='$vehicleModel',vehiclePlate='$vehiclePlate',vehicleColor='$vehicleColor' WHERE vehicleID='$id' ");
				header("Location:./view/StaffView/Staff_ViewVehicle.php");
			}
		}
		require_once "./view/StaffView/Staff_EditVehicle.php";
		break;

	case "delete":
		if (isset($_GET['id'])) {
			$id = $_GET['id'];
			$db->action("DELETE FROM vehicle WHERE vehicleID = '$id'") ;
			header("Location:./view/StaffView/Staff_ViewVehicle.php");
		}
		//require_once "./view/StaffView/Staff_EditVehicle.php";
		break;

	default:
		//get the data out of table
		//$data = $db->getData("SELECT * FROM student");
		require_once "./view/StaffView/Staff_ViewVehicle.php";
		break;
}

?>