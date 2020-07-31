<?php




class LoginModel
{
	private $dbLogin;
	function __construct($dbLogin)
	{
		$this->dbLogin=$dbLogin;
	}

	function login(){
		if (isset($_POST['login'])) {
			$username = addslashes(strip_tags($_POST['username']));
			$password = addslashes(strip_tags($_POST['password']));
			$userCategory = addslashes(strip_tags($_POST['userCategory']));

			if (!empty($username) AND !empty($password) AND $userCategory == "Staff") {
				$sqlLogin = $this->dbLogin->prepare("SELECT * FROM user WHERE username = :username AND password= :password");
				$sqlLogin->execute(array('username'=>$username, 'password'=>$password));

				if ($sqlLogin->rowCount()) {
					$dataLogin = $sqlLogin->fetch();
					$_SESSION['id']=$dataLogin['userID'];
					$_SESSION['id']=true;
					$_SESSION['UID']=$dataLogin['userID'];
					header('Location:../../view/StaffView/Staff_AddTimetable.php');
				}
			}
			else if (!empty($username) AND !empty($password) AND $userCategory == "Student") {
				$sqlLogin = $this->dbLogin->prepare("SELECT * FROM user WHERE username = :username AND password= :password");
				$sqlLogin->execute(array('username'=>$username, 'password'=>$password));

				if ($sqlLogin->rowCount()) {
					$dataLogin = $sqlLogin->fetch();
					$_SESSION['id']=$dataLogin['userID'];
					$_SESSION['id']=true;
					$_SESSION['UID']=$dataLogin['userID'];
					header('Location:../../view/StudentView/Student_ChooseTimetable.php');
				}
			}
			else if (!empty($username) AND !empty($password) AND $userCategory == "Instructor") {
				$sqlLogin = $this->dbLogin->prepare("SELECT * FROM user WHERE username = :username AND password= :password");
				$sqlLogin->execute(array('username'=>$username, 'password'=>$password));

				if ($sqlLogin->rowCount()) {
					$dataLogin = $sqlLogin->fetch();
					$_SESSION['id']=$dataLogin['userID'];
					$_SESSION['id']=true;
					$_SESSION['UID']=$dataLogin['userID'];
					header('Location:../../view/InstructorView/Instructor_ViewTimetable.php');
				}
			}

			else{
				echo " not matching";
			}
		}else{
			//echo "login form not submitted";
		}
	}
}

?>