<?php


class StaffModel
{
	private $dbStaff;
	function __construct($dbStaff)
	{
		$this->dbStaff=$dbStaff;
	}

	function addTimetable(){
		if (isset($_POST['addTimetable'])) {
			$timetableDetails = addslashes(strip_tags($_POST['timetableDetails']));
			$date = addslashes(strip_tags($_POST['date']));
			$timeFrom = addslashes(strip_tags($_POST['timeFrom']));
			$timeTo = addslashes(strip_tags($_POST['timeTo']));
			$instructorName = addslashes(strip_tags($_POST['instructorName']));
			

			$sqlAddTimetable = $this->dbStaff->prepare("INSERT INTO timetable (instructorID,timetableDetails,date,timeFrom,timeTo) VALUES (:instructorID,:timetableDetails,:date,:timeFrom,:timeTo)");
			$sqlAddTimetable->execute(array('instructorID'=>$instructorName, 'timetableDetails'=>$timetableDetails, 'date'=>$date,'timeFrom'=>$timeFrom, 'timeTo'=>$timeTo));

			$sqlgetTT = $this->dbStaff->prepare("SELECT * FROM timetable WHERE instructorID = :instructorID AND timetableDetails= :timetableDetails AND date= :date AND timeFrom= :timeFrom AND timeTo= :timeTo");
			$sqlgetTT->execute(array('instructorID'=>$instructorName, 'timetableDetails'=>$timetableDetails, 'date'=>$date, 'timeFrom'=>$timeFrom, 'timeTo'=>$timeTo));


			if ($sqlgetTT->rowCount()) {
				$sqlgetTTResult = $sqlgetTT->fetch();
				$TTID = $sqlgetTTResult['timetableID'];

				$sqlAddAttendance = $this->dbStaff->prepare("INSERT INTO attandence (instructorID,timetableID,status,studentID) VALUES (:instructorID,:timetableID,:status,:studentID)");
				$sqlAddAttendance->execute(array('instructorID'=>$instructorName, 'timetableID'=>$TTID, 'status'=>"ABSENT",'studentID'=>"NOT A STUDENT"));
				
			}	

			

		}
	}

	function setupFee(){
		if (isset($_POST['setupFee'])) {
			$studentName = addslashes(strip_tags($_POST['studentName']));
			$feeAmount = addslashes(strip_tags($_POST['feeAmount']));
			$feeDetails = addslashes(strip_tags($_POST['feeDetails']));
			$taxAmount = addslashes(strip_tags($_POST['taxAmount']));
			$totalAmount = addslashes(strip_tags($_POST['totalAmount']));
			

			$sqlAddTimetable = $this->dbStaff->prepare("INSERT INTO fee (studentID,amount,feeDetails,taxAmount,totalAmount) VALUES (:studentName,:feeAmount,:feeDetails,:taxAmount,:totalAmount)");
			$sqlAddTimetable->execute(array('studentName'=>$studentName, 'feeAmount'=>$feeAmount, 'feeDetails'=>$feeDetails,'taxAmount'=>$taxAmount, 'totalAmount'=>$totalAmount));
		}
	}


	function regVehicle(){
		if (isset($_POST['registerVehicle'])) {
			$vehicleName = addslashes(strip_tags($_POST['vehicleName']));
			$vehicleModel = addslashes(strip_tags($_POST['vehicleModel']));
			$vehiclePlate = addslashes(strip_tags($_POST['vehiclePlate']));
			$vehicleColor = addslashes(strip_tags($_POST['vehicleColor']));
			

			$sqlregVehicle = $this->dbStaff->prepare("INSERT INTO vehicle (vehicleName,vehicleModel,vehiclePlate,vehicleColor) VALUES (:vehicleName,:vehicleModel,:vehiclePlate,:vehicleColor)");
			$sqlregVehicle->execute(array('vehicleName'=>$vehicleName, 'vehicleModel'=>$vehicleModel, 'vehiclePlate'=>$vehiclePlate,'vehicleColor'=>$vehicleColor));

		}
	}

	function bookVehicle(){
		if (isset($_POST['bookVehicle'])) {
			$vehicleID = addslashes(strip_tags($_POST['vehicleID']));
			$timetableID = addslashes(strip_tags($_POST['timetableID']));
			$date = addslashes(strip_tags($_POST['date']));
			

			$sqlbookVehicle = $this->dbStaff->prepare("INSERT INTO bookedvehicle (vehicleID,bookedDate,timetableID) VALUES (:vehicleID,:date,:timetableID)");
			$sqlbookVehicle->execute(array('vehicleID'=>$vehicleID, 'date'=>$date, 'timetableID'=>$timetableID));

		}
	}

	function paySalary(){
		if (isset($_POST['paySalary'])) {
			$instructorID = addslashes(strip_tags($_POST['instructorID']));
			$amount = addslashes(strip_tags($_POST['amount']));
			$salaryDetails = addslashes(strip_tags($_POST['salaryDetails']));
			$status = "Unpaid";
			
			$sqlregVehicle = $this->dbStaff->prepare("INSERT INTO salary (instructorID,amount,salaryDetails,status) VALUES (:instructorID,:amount,:salaryDetails,:status)");
			$sqlregVehicle->execute(array('instructorID'=>$instructorID, 'amount'=>$amount,'salaryDetails'=>$salaryDetails,'status'=>$status));

		}
	}

	function fetchSalaryLog(){

		$stmt = $this->dbStaff->prepare("SELECT * FROM salary");
		$stmt->setFetchMode(PDO::FETCH_OBJ);
		$stmt->execute();
		$data = $stmt->fetchAll();
		return $data;

	}

	function updateSalary(){
		if (isset($_POST['updateSalary'])) {
			$salaryID = addslashes(strip_tags($_POST['salaryID']));
			$stmt = $this->dbStaff->prepare("UPDATE salary SET status='Paid' WHERE salaryID=$salaryID");
			$stmt->setFetchMode(PDO::FETCH_OBJ);
			$stmt->execute();

			header("location:../../view/StaffView/Staff_ViewSalaryLog.php");
		}

	}

}

?>