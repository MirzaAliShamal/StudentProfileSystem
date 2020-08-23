<?php
session_start();
	if ($_SESSION['user'] != 'Admin'){
		header('location:index.php');

	}
?> 
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Dashboard: Search Student</title>
	<?php 
	include"system/fileslink.php";
	?>
	
</head>

<body style="background-image: url('assets/img/logo.png'); background-attachment: fixed;">
    <div class="wrapper">
        <!-- Sidebar  -->
        <?php 
			include"navs/admin_nav.php";
		?>

        <!-- Page Content  -->
        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-dark text-white rounded">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-align-left"></i>
                        <span>Toggle Sidebar</span>
                    </button>
					
					<h3 class="ml-5">Student Profile System</h3>

                </div>
            </nav>
	<div class="row">
	<div class="col-4"></div>
	<div class="col-md-12 col-lg-4 bg-dark text-white p-5">			
	<p class="card-text">
	<form method="POST">
  <fieldset>
    <legend class="text-center">Add New User</legend>
	<div class="form-group">
      <label for="exampleInputEmail1">User Name</label>
      <input type="text" class="form-control"  name="username"  id="exampleInputEmail1" aria-describedby="emailHelp"  required>
    </div>
	<div class="form-group">
      <label for="exampleInputEmail1">Password</label>
      <input type="password" class="form-control"  name="password"  id="exampleInputEmail1" aria-describedby="emailHelp"  required>
    </div>
	<div class="form-group">
	<label for="exampleInputEmail1">Select Role</label>
	<select class="form-control" id="role" style="width: 100%;" name="role">
		<option>Select Role</option>
		<option value="admin">Admin</option>
		<option value="accountant">Accountant</option>
		<option value="librarian">Librarian</option>
		<option value="clerk">Clerk</option>
		?>
		</select>
		<script>
		$("#role").select2().select2();
		</script>
	</div>
	
    <input type="submit" class="btn btn-primary" name="submit">
  </fieldset>
</form>	


<?php 
if (isset($_POST["submit"])) {
	
	$username =  $_POST["username"];
	$password =  base64_encode($_POST["password"]);
	$role =  $_POST["role"];

	$validation_sql = "SELECT * FROM users WHERE username = '" . $username . "'";
	$validation_result = mysqli_query($con, $validation_sql);
	if (mysqli_num_rows($validation_result) > 0) {
		echo"<script>alert('Sorry, Username must be unique! User already registerd with this username');</script>";
	} else{
	    $sql = "insert into `users` (username, password, role) value ('$username','$password','$role')";
		if($result = mysqli_query($con, $sql)){
			echo"<script>alert('User Added');</script>";
		}	
  	
  	}
}
?>
			</div>
			</div>
	</div> 
        </div>
	
<script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
</script>
</body>
</html>