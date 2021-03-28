<?php

include '../../model/UserModel/LoginModel.php';

?>
<!DOCTYPE html>
<html>
<head>
	<title>LOGIN DSMS</title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Yellowtail" rel="stylesheet">

</head>
<?php  $dbLogin->login(); ?>
<body  style="background-image: url('../../img/1.jpg');">

	<p style="font-family: 'Yellowtail', cursive; font-size: 90px; text-align: center; margin-top: 100px;">Driving School Management System</p>

	<div class="col-md-4" style="margin: auto">
		<div class="login-panel panel panel-default" >

			<div class="signInDiv">

				<div class="panel-heading"><h3 class="panel-title">Sign In</h3></div>
				<div class="panel-body">
					<form role="form" method="POST">
						<fieldset >
							<div class="form-group">
								<input class="form-control" type="text" placeholder="Username" name="username" autofocus="" required="required">
							</div>
							<div class="form-group">
								<input class="form-control" type="password" placeholder="Password" name="password" required="required" >
							</div>
							<div class="form-group">
								<select class="form-control" placeholder="User Category" name="userCategory" required="required">
									<option value="Student">Student</option>
									<option value="Staff">Staff</option>
									<option value="Instructor">Instructor</option>
								</select>
							</div>
						</fieldset>
<!--                        test-->
						<?php if(isset($fmsg)){ ?> <div role="alert" style="color: red; font-weight: 20px; text-align: center;"> <?php echo $fmsg; ?> </div><?php } ?>
						<div style="margin-top: 5px" align="center">
							<button type="submit" name="login" class="btn btn-md btn-success" >Login</button>
							<a href="register.php" class="btn btn-md btn-secondary">Sign Up</a>
						</div>
					</form>
				</div> 
			</div>
		</div>
	</div>

</body>
</html>