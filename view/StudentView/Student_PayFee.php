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

$sqlDropDownVN = "SELECT * FROM fee WHERE studentID = '$SID'";

try{
  $stmt=$conn->prepare($sqlDropDownVN);
  $stmt->execute();
  $resultDropdown=$stmt->fetchAll();

}catch(Exception $e){
  echo ($e->getMessage());
}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Student Pay Fee</title>
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
      <center>
      <h2>PAY FEE</h2>

          <table class="mdl-data-table mdl-js-data-table">
            <thead>
              <tr>
                <th class="mdl-data-table__cell--non-numeric">Fee Details</th>
                <th class="mdl-data-table__cell--non-numeric">Amount</th>
                <th class="mdl-data-table__cell--non-numeric">Tax Amount</th>
                <th class="mdl-data-table__cell--non-numeric">Total Amount</th>
                <th class="mdl-data-table__cell--non-numeric">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($resultDropdown as $f) { ?>
                <tr>
                  <td class="mdl-data-table__cell--non-numeric"><?=$f['feeDetails']?></td>
                  <td class="mdl-data-table__cell--non-numeric"><?=$f['amount']?></td>
                  <td class="mdl-data-table__cell--non-numeric"><?=$f['taxAmount']?></td>
                  <td class="mdl-data-table__cell--non-numeric"><?=$f['totalAmount']?></td>
                  <td class="mdl-data-table__cell--non-numeric">
                    <a href="https://www.maybank2u.com.my/home/m2u/common/login.do">PAY</a> 
                  </td>
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