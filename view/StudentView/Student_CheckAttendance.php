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
  <title>Student Check Attendance</title>
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
      
      <table style="margin-left: 600px;margin-right: auto;width: 800px;margin-top: 40px;">
              <tr>
                <td style="text-align: center;padding-right: 20px;" colspan="2"><h3>CHECK IN ATTENDANCE</h3></td>
              </tr>
            </table>

            <form method="POST">
              <table style="margin-left: 39%">
                <tr>
                  <td class="mdl-data-table__cell--non-numeric">Insert Attendance ID:&nbsp;&nbsp;<input type="number" name="attendanceID"></td>
                  <td class="mdl-data-table__cell--non-numeric"><button type="submit" name="attendClass">Attend Class</button></td>
                </tr>
                
              </table>
            </form>

      <form method="POST">
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
              <table class="mdl-data-table mdl-js-data-table" style="margin-left: 280%">
            <thead>
              <tr>
                <th class="mdl-data-table__cell--non-numeric">Attendance ID</th>
                <th class="mdl-data-table__cell--non-numeric">Timetable Details</th>
                <th class="mdl-data-table__cell--non-numeric">Status</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($dbStudent->fetchAttendance($SID) as $datas) { ?>
              <tr>
                <td class="mdl-data-table__cell--non-numeric"><?php echo $datas->attendanceID; ?></td>
                <td class="mdl-data-table__cell--non-numeric"><?php echo $datas->timetableID; ?></td>
                <td class="mdl-data-table__cell--non-numeric"><?php echo $datas->status; ?></td>
              </tr>
            <?php }?>
            </tbody>
          </table>

          <?php  $dbStudent->attendClass(); ?>
          </div>
        </form>

    </div>
  </main>
</div>

</body>
</html>