<?php 

// session_start();
// ob_start();

 $host = "localhost";
 $user = "root";
 $pass = "";
 $dbname = "dsms";


try{
	$conn3 = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",$user,$pass);
	$conn3->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOexception $e){
	echo $e->getMessage();
}

include '../../controller/StudentController/StudenController.php';
$dbStudent=new StudentModel($conn3);

?>