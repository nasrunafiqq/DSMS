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


$sqlDropDown = "SELECT * FROM salary where instructorID=$SID";

try{
  $stmt=$conn->prepare($sqlDropDown);
  $stmt->execute();
  $resultDropdown=$stmt->fetchAll();
}catch(Exception $e){
  echo ($e->getMessage());
}

?>
<?php error_reporting(0); ?>
<!DOCTYPE html>
<html>
<head>
  <title>Instructor View Salary Monthly</title>
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
      <a class="mdl-navigation__link" href="../InstructorView/Instructor_CheckInAttendance.php">ATTENDANCE</a>
     
    </nav>
  </div>
  <main class="mdl-layout__content">
    <div class="page-content">
      
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
                <td style="text-align: center;padding-right: 20px;" colspan="2"><h3>View Salary Monthly</h3></td>
              </tr>
              <tr>
                <td style="text-align: right;padding-right: 20px;">Salary Month :</td>
                <td><select style="width: 400px;" name="salaryID">
                    <?php foreach ($resultDropdown as $output) { ?>
                    <option value="<?= $output['salaryID']?>"><?php echo $output['salaryDetails'] ?></option>
                    <?php }?></td>
              </tr>
              <tr>
                <td></td>
                <input type="hidden" name="instructorID" value="$id" />
                <td style="text-align: right;margin-top: 20px;"><button type="submit" name="displaySalarySlip" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">Search</button></td>
                <td></td>
              </tr>
            </table>
			<button style="margin-left: 500%" type="submit" name="print" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" onclick="window.print();">Print Slip</button>
          </div>
        </form>

        <center>
        <table class="mdl-data-table mdl-js-data-table">
            <thead>
              <tr>
                <th class="mdl-data-table__cell--non-numeric">Salary Details</th>
                <th class="mdl-data-table__cell--non-numeric">Amount</th>
                <th class="mdl-data-table__cell--non-numeric">Status</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($dbInstructor->displaySalarySlip() as $datas) { ?>
              <tr>
              <td><?php echo $datas->salaryDetails; ?></td>
              <td><?php echo $datas->amount; ?></td>
                <td><?php echo $datas->status; ?></td>
              </tr>
              <?php }?>
            
            </tbody>
          </table>
          </center>
      </div>

    </div>
  </main>
</div>

</body>
</html>