<?php  
session_start();
ob_start();

if ($_SESSION['id']==false) {
  header('location:../../view/Login/logout.php');
}

include '../../model/InstructorModel/InstructorModel.php';
$host = "localhost";
 $user = "root";
 $pass = "";
 $dbname = "dsms";
 $id = $_SESSION['UID'];

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",$user,$pass);

$UID = $id;
$sqlStudID = "SELECT instructorID FROM instructor WHERE userID='$UID'";
$stmtSID=$conn->prepare($sqlStudID);
$stmtSID->execute();
$resultStudID=$stmtSID->fetch(PDO::FETCH_ASSOC);
$SID = $resultStudID['instructorID'];
// echo $SID;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Instructor View Timetable</title>
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
    <span class="mdl-layout-title" style="font-size: 16px">ROLE : INSTRUCTOR</span>
    <nav class="mdl-navigation">
      <a class="mdl-navigation__link" href="../InstructorView/Instructor_ViewTimetable.php">TIMETABLE</a>
      <a class="mdl-navigation__link" href="" style="pointer-events: none">SALARY</a>
      <a class="mdl-navigation__link" href="../InstructorView/Instructor_ViewSalaryMonth.php">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;View Salary Monthly</a>
      <a class="mdl-navigation__link" href="../InstructorView/Instructor_ViewSalaryLog.php">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;View Salary</a>
      <a class="mdl-navigation__link" href="../InstructorView/Instructor_CheckInAttendance.php">ATTENDANCE</a>
     
    </nav>
  </div>
  <main class="mdl-layout__content">
    <div class="page-content">
      
      <center>
        <div>
          <h2>VIEW TIMETABLE</h2>

          <table class="mdl-data-table mdl-js-data-table">
            <thead>
              <tr>
                <th class="mdl-data-table__cell--non-numeric">Timetable Details</th>
                <th class="mdl-data-table__cell--non-numeric">Date</th>
                <th class="mdl-data-table__cell--non-numeric">Time From</th>
                <th class="mdl-data-table__cell--non-numeric">Time To</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($dbInstructor->fetchTimetable($SID) as $datas) { ?>
              <tr>
                <td class="mdl-data-table__cell--non-numeric"><?php echo $datas->timetableDetails; ?></td>
                <td class="mdl-data-table__cell--non-numeric"><?php echo $datas->date; ?></td>
                <td class="mdl-data-table__cell--non-numeric"><?php echo $datas->timeFrom; ?></td>
                <td class="mdl-data-table__cell--non-numeric"><?php echo $datas->timeTo; ?></td>
              </tr>
            <?php }?>
            </tbody>
          </table>
        </div>
      </center>

    </div>
  </main>
</div>

</body>
</html>