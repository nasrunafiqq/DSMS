<?php  
session_start();
ob_start();

if ($_SESSION['id']==false) {
  header('location:../../view/Login/logout.php');
}

//include '../../model/StaffModel/StaffModel.php';
 $host = "localhost";
 $user = "root";
 $pass = "";
 $dbname = "dsms";
 $id = $_SESSION['id'];
 $Vid = $_GET['id'];
 //echo $Vid;
$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",$user,$pass);
$sqlDropDown = "SELECT * FROM vehicle WHERE vehicleID = '$Vid'";

try{
  $stmt=$conn->prepare($sqlDropDown);
  $stmt->execute();
  $resultV=$stmt->fetchAll();
}catch(Exception $e){
  echo ($e->getMessage());
}


?>




<!DOCTYPE html>
<html>
<head>
	<title>Staff Register Vehicle </title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.teal-indigo.min.css" />
	<script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
</head>
<body>

	<!-- Always shows a header, even in smaller screens. -->
  <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
    <header class="mdl-layout__header">
      <div class="mdl-layout__header-row">
        <!-- Title -->
        <span class="mdl-layout-title">DRIVING SCHOOL MANAGEMENT SYSTEM</span>
        <!-- Add spacer, to align navigation to the right -->
        <div class="mdl-layout-spacer"></div>
        <!-- Navigation. We hide it in small screens. -->
        <nav class="mdl-navigation mdl-layout--large-screen-only">
          <a class="mdl-navigation__link" href="../../view/Login/logout.php">LOGOUT</a>
        <!-- <a class="mdl-navigation__link" href="">Link</a>
        <a class="mdl-navigation__link" href="">Link</a>
        <a class="mdl-navigation__link" href="">Link</a> -->
      </nav>
    </div>
  </header>
  <div class="mdl-layout__drawer">
    <span class="mdl-layout-title">ROLE : STAFF</span>
    <nav class="mdl-navigation">
      <a class="mdl-navigation__link" href="../StaffView/Staff_AddTimetable.php">TIMETABLE</a>
      <a class="mdl-navigation__link" href="" style="pointer-events: none">VEHICLE</a>
      <a class="mdl-navigation__link" href="../StaffView/Staff_RegVehicle.php">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Register New Vehicle</a>
      <a class="mdl-navigation__link" href="../StaffView/Staff_ViewVehicle.php">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;View Vehicle</a>
      <a class="mdl-navigation__link" href="../StaffView/Staff_BookVehicle.php">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Book Vehicle</a>
      <a class="mdl-navigation__link" href="../StaffView/Staff_SetupFee.php">STUDENT FEE</a>
      <a class="mdl-navigation__link" href="" style="pointer-events: none">SALARY</a>
      <a class="mdl-navigation__link" href="../StaffView/Staff_PayInstructorSalary.php">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pay Salary</a>
      <a class="mdl-navigation__link" href="../StaffView/Staff_ViewSalaryLog.php">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Salary Log</a>
      <a class="mdl-navigation__link" href="../StaffView/Staff_AttendanceTimetable.php">ATTENDANCE</a>

    </nav>
  </div>
  <main class="mdl-layout__content">
    <div class="page-content">
     <div>
        <?php  
        if (isset($error)) {
          ?><p><?=$error?></p><?php
        }?><?php foreach ($resultV as $output) {?>
        <form method="POST">
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <table style="margin-left: 600px;margin-right: auto;width: 800px;margin-top: 40px;">
              <tr>
                <td style="text-align: center;padding-right: 20px;" colspan="2"><h3>EDIT VEHICLE</h3></td>
              </tr>
              <tr>
                <td style="text-align: right;padding-right: 20px;">Vehicle Brand :</td>
                <td><input style="width: 400px;" type="text" id="vehicleName" name="vehicleName" maxlength="50" value="<?=$output['vehicleName']?>" required /></td>
              </tr>
              <tr>
                <td style="text-align: right;padding-right: 20px;">Vehicle Model :</td>
                <td><input style="width: 400px;margin-top: 5px;" type="text" id="vehicleModel" name="vehicleModel" maxlength="50" value="<?=$output['vehicleModel']?>" required /></td>
              </tr>
              <tr>
                <td style="text-align: right;padding-right: 20px;">Plate Number :</td>
                <td><input style="width: 400px;margin-top: 5px;" type="text" id="vehiclePlate" name="vehiclePlate" maxlength="50" value="<?=$output['vehiclePlate']?>" required /></td>
              </tr>
              <tr>
                <td style="text-align: right;padding-right: 20px;">Vehicle Color :</td>
                <td><input style="width: 400px;margin-top: 5px;" type="text" id="vehicleColor" name="vehicleColor" maxlength="50" value="<?=$output['vehicleColor']?>" required /></td>
              </tr>
              <tr>
                <td></td>
                <input type="hidden" name="userID" value="<?php echo $data['userID']?>" />
                <td style="text-align: right;margin-top: 20px;"><button type="submit" name="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">UPDATE</button></td>
              </tr>
            </table>
          </div>
              <?php } ?>

        </form>
      </div>
  </div>
</main>
</div>

</body>
</html>