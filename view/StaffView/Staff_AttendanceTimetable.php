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

$sqlAttendIns = "SELECT * FROM attandence WHERE studentID = 0";
$sqlAttendStud = "SELECT * FROM attandence WHERE instructorID = 0";


try{
  $stmt=$conn->prepare($sqlAttendIns);
  $stmt->execute();
  $resultAttend=$stmt->fetchAll();

  $stmtStud=$conn->prepare($sqlAttendStud);
  $stmtStud->execute();
  $resultAttendStud=$stmtStud->fetchAll();
  // foreach ($resultDropdown as $i ) {
  //   echo $i['instructorID'];
  // }
  

  // $sqlDropDownClass = "SELECT * FROM instructor WHERE";
  // $stmt1=$conn->prepare($sqlDropDownClass);
  // $stmt1->execute();
  // $resultDropdown1=$stmt1->fetchAll();
}catch(Exception $e){
  echo ($e->getMessage());
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Staff Attandance Timetable</title>
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
          <h2>INSTRUCTOR ATTENDANCE</h2>
          <table class="mdl-data-table mdl-js-data-table">
            <thead>
              <tr>
                <th class="mdl-data-table__cell--non-numeric">Timetable ID</th>
                <th class="mdl-data-table__cell--non-numeric">Timetable Details</th>
                <th class="mdl-data-table__cell--non-numeric">Instructor ID</th>
                <th class="mdl-data-table__cell--non-numeric">Instructor Name</th>
                <th class="mdl-data-table__cell--non-numeric">Status</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($resultAttend as $i) { ?>
              <tr>
                <?php  
                  $IID = $i['instructorID'];
                  $sqlInsName = "SELECT instructorName FROM instructor WHERE instructorID='$IID'";
                  $stmt1=$conn->prepare($sqlInsName);
                  $stmt1->execute();
                  $resultInsName=$stmt1->fetch(PDO::FETCH_ASSOC);

                  $TTID = $i['timetableID'];
                  $sqlInsName = "SELECT timetableDetails FROM timetable WHERE timetableID='$TTID'";
                  $stmt2=$conn->prepare($sqlInsName);
                  $stmt2->execute();
                  $resultTTName=$stmt2->fetch(PDO::FETCH_ASSOC);
                ?>
                <td class="mdl-data-table__cell--non-numeric"><?=$i['timetableID']?></td>
                <td class="mdl-data-table__cell--non-numeric"><?=$resultTTName['timetableDetails']?></td>
                <td class="mdl-data-table__cell--non-numeric"><?=$i['instructorID']?></td>
                <td class="mdl-data-table__cell--non-numeric"><?=$resultInsName['instructorName']?></td>
                <td class="mdl-data-table__cell--non-numeric"><?=$i['status']?></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>

          <br><br><br><br>

          <h2>STUDENT ATTENDANCE</h2>
          <table class="mdl-data-table mdl-js-data-table">
            <thead>
              <tr>
                <th class="mdl-data-table__cell--non-numeric">Timetable ID</th>
                <th class="mdl-data-table__cell--non-numeric">Timetable Details</th>
                <th class="mdl-data-table__cell--non-numeric">Student ID</th>
                <th class="mdl-data-table__cell--non-numeric">Student Name</th>
                <th class="mdl-data-table__cell--non-numeric">Status</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($resultAttendStud as $i) { ?>
              <tr>
                <?php  
                  $SID = $i['studentID'];
                  $sqlStudName = "SELECT studentName FROM student WHERE studentID='$SID'";
                  $stmt3=$conn->prepare($sqlStudName);
                  $stmt3->execute();
                  $resultStudName=$stmt3->fetch(PDO::FETCH_ASSOC);

                  $TTID = $i['timetableID'];
                  $sqlInsName = "SELECT timetableDetails FROM timetable WHERE timetableID='$TTID'";
                  $stmt4=$conn->prepare($sqlInsName);
                  $stmt4->execute();
                  $resultTTName=$stmt4->fetch(PDO::FETCH_ASSOC);
                ?>
                <td class="mdl-data-table__cell--non-numeric"><?=$i['timetableID']?></td>
                <td class="mdl-data-table__cell--non-numeric"><?=$resultTTName['timetableDetails']?></td>
                <td class="mdl-data-table__cell--non-numeric"><?=$i['studentID']?></td>
                <td class="mdl-data-table__cell--non-numeric"><?=$resultStudName['studentName']?></td>
                <td class="mdl-data-table__cell--non-numeric"><?=$i['status']?></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>

        </div>
      </center>
    </div>
  </main>
</div>

</body>
</html>