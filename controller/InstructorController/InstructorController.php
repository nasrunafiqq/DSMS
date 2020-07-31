<?php

class InstructorModel
{
	private $dbInstructor;
	function __construct($dbInstructor)
	{
		$this->dbInstructor=$dbInstructor;
	}

	function fetchSalaryLog($value){

		$stmt = $this->dbInstructor->prepare("SELECT * FROM salary where InstructorID=$value");
		$stmt->setFetchMode(PDO::FETCH_OBJ);
		$stmt->execute();
		$data = $stmt->fetchAll();
		return $data;

	}
	
	function displaySalarySlip(){
		if (isset($_POST['displaySalarySlip'])) {
			$salaryID = addslashes(strip_tags($_POST['salaryID']));
			$stmt = $this->dbInstructor->prepare("SELECT * FROM salary WHERE salaryID=$salaryID");
			$stmt->setFetchMode(PDO::FETCH_OBJ);
			$stmt->execute();
			$data = $stmt->fetchAll();
			return $data;
		}

	}
	
	function fetchTimetable($value){

		$stmt = $this->dbInstructor->prepare("SELECT * FROM timetable where instructorID=$value");
		$stmt->setFetchMode(PDO::FETCH_OBJ);
		$stmt->execute();
		$data = $stmt->fetchAll();
		return $data;

	}

	function fetchAttendance($value){

		$stmt = $this->dbInstructor->prepare("SELECT * FROM attandence where instructorID=$value");
		$stmt->setFetchMode(PDO::FETCH_OBJ);
		$stmt->execute();
		$data = $stmt->fetchAll();
		return $data;

	}

	function attendClass(){
		if (isset($_POST['attendClass'])) {
			$attendanceID = addslashes(strip_tags($_POST['attendanceID']));
			$stmt = $this->dbInstructor->prepare("UPDATE attandence SET status='ATTEND' WHERE attendanceID=$attendanceID");
			$stmt->setFetchMode(PDO::FETCH_OBJ);
			$stmt->execute();

			header("location:../../view/InstructorView/Instructor_CheckInAttendance.php");
		}

	}
}



?>