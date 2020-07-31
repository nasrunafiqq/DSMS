<?php 

// session_start();
// ob_start();

 $host = "localhost";
 $user = "root";
 $pass = "";
 $dbname = "dsms";


try{
	$conn2 = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",$user,$pass);
	$conn2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOexception $e){
	echo $e->getMessage();
}

include '../../controller/StaffController/StaffController.php';
$dbStaff=new StaffModel($conn2);

?>