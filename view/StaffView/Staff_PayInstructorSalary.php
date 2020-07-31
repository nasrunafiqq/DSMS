<?php  
session_start();
ob_start();

if ($_SESSION['id']==false) {
  header('location:../../view/Login/logout.php');
}

include '../../model/StaffModel/StaffModel.php';

 $host = "localhost";
 $user = "root";
 $pass = "";
 $dbname = "dsms";
 $id = $_SESSION['id'];

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",$user,$pass);

$sqlDropDown = "SELECT * FROM instructor";

try{
  $stmt=$conn->prepare($sqlDropDown);
  $stmt->execute();
  $resultDropdown=$stmt->fetchAll();
}catch(Exception $e){
  echo ($e->getMessage());
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Staff Pay Salary </title>
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
      <?php  $dbStaff->paySalary(); ?>
      <div>
        <?php  
        if (isset($error)) {
          ?><p><?=$error?></p><?php
        }

        ?>
        <form method="POST">
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <table style="margin-left: 600px;margin-right: auto;width: 800px;margin-top: 40px;">
              <tr>
                <td style="text-align: center;padding-right: 20px;" colspan="2"><h3>SETUP SALARY</h3></td>
              </tr>
              <tr>
                <td style="text-align: right;padding-right: 20px;">Instructor Name :</td>
                <td><select style="width: 400px;" name="instructorID">
                    <?php foreach ($resultDropdown as $output) { ?>
                    <option value="<?= $output['instructorID']?>"><?php echo $output['instructorName'] ?></option>
                    <?php }?>
                  </select></td>
              </tr>
              <tr>
                <td style="text-align: right;padding-right: 20px;">Salary Amount :</td>
                <td><input style="width: 400px;margin-top: 5px;" type="number" id="amount" name="amount" maxlength="50" required /></td>
              </tr>
              <tr>
                <td style="text-align: right;padding-right: 20px;">Salary Details :</td>
                <td><input style="width: 400px;margin-top: 5px;" type="text" id="salaryDetails" name="salaryDetails" maxlength="50" required /></td>
              </tr>
              <tr>
                <td></td>
                <input type="hidden" name="userID" value="<?php echo $data['userID']?>" />
                <td style="text-align: right;margin-top: 20px;"><button type="submit" name="paySalary" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">SETUP SALARY</button></td>
              </tr>
            </table>
          </div>
        </form>
      </div>

    </div>
  </main>
</div>

</body>
</html>