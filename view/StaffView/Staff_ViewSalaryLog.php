<?php  
session_start();
ob_start();

if ($_SESSION['id']==false) {
  header('location:../../view/Login/logout.php');
}

include '../../model/StaffModel/StaffModel.php';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",$user,$pass);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Staff Salary Log </title>
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
      
      <center>
        <div>
          <h2>VIEW SALARY LOG</h2>

          <form method="POST">
            <table>
              <tr>
                <td class="mdl-data-table__cell--non-numeric">Insert Salary ID:&nbsp;&nbsp;&nbsp;<input type="number" name="salaryID"></td>
                <td class="mdl-data-table__cell--non-numeric"><button type="submit" name="updateSalary">Pay Salary</button></td>
              </tr>
              <tr>
                
              </tr>
            </table>
        </form>
        <br><br>

          <table class="mdl-data-table mdl-js-data-table">
            <thead>
              <tr>
                <th class="mdl-data-table__cell--non-numeric">Salary ID</th>
                <th class="mdl-data-table__cell--non-numeric">Instructor Name</th>
                <th class="mdl-data-table__cell--non-numeric">Salary Details</th>
                <th class="mdl-data-table__cell--non-numeric">Amount</th>
                <th class="mdl-data-table__cell--non-numeric">Status</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($dbStaff->fetchSalaryLog() as $datas) { ?>
              <tr>
                <?php  
                  $SID = $datas->instructorID;;
                  $sqlStudName = "SELECT instructorName FROM instructor WHERE instructorID='$SID'";
                  $stmt3=$conn->prepare($sqlStudName);
                  $stmt3->execute();
                  $resultStudName=$stmt3->fetch(PDO::FETCH_ASSOC);

                ?>
                <td class="mdl-data-table__cell--non-numeric"><?php echo $datas->salaryID; ?></td>
                <td class="mdl-data-table__cell--non-numeric"><?=$resultStudName['instructorName']?></td>
                <td class="mdl-data-table__cell--non-numeric"><?php echo $datas->salaryDetails; ?></td>
                <td class="mdl-data-table__cell--non-numeric"><?php echo $datas->amount; ?></td>
                <td class="mdl-data-table__cell--non-numeric"><?php echo $datas->status; ?></td>
              </tr>
              <?php }?>
            
            </tbody>
          </table>
          <?php  $dbStaff->updateSalary(); ?>


        </div>
      </center>
      
    </div>
  </main>
</div>

</body>
</html>