<?php


class StudentModel
{
	private $dbStudent;
	function __construct($dbStudent)
	{
		$this->dbStudent=$dbStudent;
	}

	function bookTimetable($studID){
		if (isset($_POST['joinClass'])) {
			$studentID = $studID;
			$timetableID = addslashes(strip_tags($_POST['timetableID']));
			

			$sqlbookTT = $this->dbStudent->prepare("INSERT INTO bookedtimetable (studentID,timetableID) VALUES (:studentID,:timetableID)");
			$sqlbookTT->execute(array('studentID'=>$studentID, 'timetableID'=>$timetableID));

			$sqlAddAttendance = $this->dbStudent->prepare("INSERT INTO attandence (instructorID,timetableID,status,studentID) VALUES (:instructorID,:timetableID,:status,:studentID)");
			$sqlAddAttendance->execute(array('instructorID'=>"NOT AN INSTRUCTOR", 'timetableID'=>$timetableID, 'status'=>"ABSENT",'studentID'=>$studentID));


			


		}
	}

	function fetchAttendance($value){

		$stmt = $this->dbStudent->prepare("SELECT * FROM attandence where studentID=$value");
		$stmt->setFetchMode(PDO::FETCH_OBJ);
		$stmt->execute();
		$data = $stmt->fetchAll();
		return $data;

	}

	function attendClass(){
		if (isset($_POST['attendClass'])) {
			$attendanceID = addslashes(strip_tags($_POST['attendanceID']));
			$stmt = $this->dbStudent->prepare("UPDATE attandence SET status='ATTEND' WHERE attendanceID=$attendanceID");
			$stmt->setFetchMode(PDO::FETCH_OBJ);
			$stmt->execute();

			header("location:../../view/StudentView/Student_CheckAttendance.php");
		}

	}
	

}

?>