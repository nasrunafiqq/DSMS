<?php  
session_start();
ob_start();

if ($_SESSION['id']==false) {
  header('location:../../view/Login/logout.php');
}

include '../../model/StudentModel/StudentModel.php';

 $host = "localhost";
 $user = "root";
 $pass = "";
 $dbname = "dsms";
 $id = $_SESSION['UID'];

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",$user,$pass);

$sqlDropDownVN = "SELECT * FROM timetable";

try{
  $stmt=$conn->prepare($sqlDropDownVN);
  $stmt->execute();
  $resultDropdown=$stmt->fetchAll();

}catch(Exception $e){
  echo ($e->getMessage());
}

$UID = $id;
$sqlStudID = "SELECT studentID FROM student WHERE userID='$UID'";
$stmtSID=$conn->prepare($sqlStudID);
$stmtSID->execute();
$resultStudID=$stmtSID->fetch(PDO::FETCH_ASSOC);
$SID = $resultStudID['studentID'];
// echo $SID;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Student Timetable</title>
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
    <span class="mdl-layout-title">ROLE : STUDENT</span>
    <nav class="mdl-navigation">
      <a class="mdl-navigation__link" href="../StudentView/Student_ChooseTimetable.php">TIMETABLE</a>
      <a class="mdl-navigation__link" href="../StudentView/Student_PayFee.php">FEE</a>
      <a class="mdl-navigation__link" href="../StudentView/Student_CheckAttendance.php">ATTENDANCE</a>
     
    </nav>
  </div>
  <main class="mdl-layout__content">
    <div class="page-content">
      
      <div>
        <?php  
        if (isset($error)) {
          ?><p><?=$error?></p><?php
        }?>
        <?php  $dbStudent->bookTimetable($SID); ?>
        <br><h3 style="margin-left: 39%;">CHOOSE TIMETABLE</h3>
        
        <form method="POST">
            <table style="margin-left: 38%;">
              <tr>
                <td class="mdl-data-table__cell--non-numeric">Insert Timetable ID:&nbsp;&nbsp;&nbsp;<input type="number" name="timetableID"></td>
                <td class="mdl-data-table__cell--non-numeric"><button type="submit" name="joinClass" >Join Class</button></td>
              </tr>
              <tr>
                
              </tr>
            </table>
        </form><br>
      </div>
      <div style="margin-left: 30%;">
          <?php   ?>
          <table class="mdl-data-table mdl-js-data-table">
            <thead>
              <tr>
                <th class="mdl-data-table__cell--non-numeric">Timetable ID</th>
                <th class="mdl-data-table__cell--non-numeric">Instructor Name</th>
                <th class="mdl-data-table__cell--non-numeric">Timetable Detail</th>
                <th class="mdl-data-table__cell--non-numeric">Date</th>
                <th class="mdl-data-table__cell--non-numeric">Class Start</th>
                <th class="mdl-data-table__cell--non-numeric">Class End</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($resultDropdown as $TT) { ?>
                <?php  
                  $IID = $TT['instructorID'];
                  $sqlInsName = "SELECT instructorName FROM instructor WHERE instructorID='$IID'";
                  $stmt1=$conn->prepare($sqlInsName);
                  $stmt1->execute();
                  $resultInsName=$stmt1->fetch(PDO::FETCH_ASSOC);

                ?>
                <tr>
                  <td class="mdl-data-table__cell--non-numeric"><?=$TT['timetableID']?></td>
                  <td class="mdl-data-table__cell--non-numeric"><?=$resultInsName['instructorName']?></td>
                  <td class="mdl-data-table__cell--non-numeric"><?=$TT['timetableDetails']?></td>
                  <td class="mdl-data-table__cell--non-numeric"><?=$TT['date']?></td>
                  <td class="mdl-data-table__cell--non-numeric"><?=$TT['timeFrom']?></td>
                  <td class="mdl-data-table__cell--non-numeric"><?=$TT['timeTo']?></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>

        </div>
    </div>
  </main>
</div>

</body>
</html>