<?php

include '../../model/UserModel/RegisterModel.php';

?>


<!DOCTYPE html>
<html>
<head>
	<title>REGISTER</title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
 <link href="https://fonts.googleapis.com/css?family=Yellowtail" rel="stylesheet">

</head>
<?php  $dbRegister->register(); ?>
<body style="background-image: url('../../img/1.jpg');">

  <p style="font-family: 'Yellowtail', cursive; font-size: 90px; text-align: center; margin-top: 100px">Driving School Management System</p>

  <div class="col-md-4" style="margin: auto">
    <div class="login-panel panel panel-default" >

      <div class="signInDiv">

       <div class="panel-heading"><h3 class="panel-title">Sign Up</h3></div>
       <div class="panel-body">
        <form role="form" method="POST">
          <fieldset >
            <div class="form-group">
              <input class="form-control" type="text" placeholder="Enter Username" name="username" autofocus="" required="required">
            </div>
            <div class="form-group">
              <input class="form-control" type="password" placeholder="Enter Password" name="password" required="required" >
            </div>
            <div class="form-group">
              <select class="form-control" placeholder="User Category" name="userCategory" required="required">
                <option value="Student">Student</option>
                <option value="Staff">Staff</option>
                <option value="Instructor">Instructor</option>
              </select>
            </div>
            <div class="form-group">
              <input class="form-control" type="text" placeholder="Enter Your Name" name="name" autofocus="" required="required">
            </div>
            <div class="form-group">
              <input class="form-control" type="text" placeholder="Enter IC Number" name="ICNumber" autofocus="" required="required">
            </div>
            <div class="form-group">
              <input class="form-control" type="text" placeholder="Enter Phone Number" name="phoneNumber" required="required" >
            </div>
            <div class="form-group">
              <input class="form-control" type="text" placeholder="Enter Home Address" name="address" required="required" >
            </div>
          </fieldset>
          <div style="margin-top: 5px" align="center">
           <button type="submit" name="register" class="btn btn-md btn-success" >Register</button>
           <a href="Login.php" class="btn btn-md btn-danger">Back</a>
         </div>
       </form>
     </div> 
   </div>
 </div>

</body>
</html>