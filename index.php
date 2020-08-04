<html>
<head>
  <?php 
	include"system/fileslink.php";
  ?>
</head>
<body style="background-image: url('assets/img/logo.png'); background-attachment: fixed;  ">

<div class="text-center mt-3 mb-3"><h2 class="display-4" style="font-weight: 400">Student Profile System</h2></div>
<div class="container text-center">
    <div id="home" class="tab-pane  in active">
      
      <p>
		<div>
		<div class="modal-dialog modal-login">
		<div class="modal-content bg-dark rounded">
		<h3 class="text-white">Login Form</h3>
			<div class="modal-body">
				<form method="post">
					<div class="form-group">
						<input type="text" name="username" class="form-control" placeholder="Username" required="required">
					</div>
					<div class="form-group">
						<input type="password" name="password" class="form-control" placeholder="Password" required="required">
					</div>
					<div class="form-group">
						<select class="form-control" name="role">
							<option>Select Role</option>
							<option value="Admin">Admin</option>
							<option value="Accountant">Accountant</option>
							<option value="Librarian">Librarian</option>
							<option value="User1">User1</option>
						</select>
					</div>
					<div class="form-group">
						<input type="submit" name="submit" class="btn btn-primary btn-block btn-lg" value="Login">
					</div>
				</form>				
				<div class="hint-text small"><a href="#">Forgot Your Password?</a></div>
				<div class="text-white">
				<?php 
	if (isset($_POST["submit"])){
	
	$username = $_POST['username'];
    $password = base64_encode($_POST['password']);
	$role = $_POST['role'];
	$sql ="SELECT `username`, `password` FROM `users` WHERE username='$username' AND password='$password' AND role='$role'";
	
	if($result = mysqli_query($con, $sql)){
    if(mysqli_num_rows($result) == 1){
	if ($role=='Admin'){
		session_start();
		$_SESSION['user']= $role ;
		header('location: admin_dashboard.php');
	}
	if ($role=='Accountant'){
		session_start();
		$_SESSION['user']= $role ;
		header('location: accounts_dashboard.php');
	}
	if ($role=='Librarian'){
		session_start();
		$_SESSION['user']= $role ;
		header('location: librarian_dashboard.php');
	}
	if ($role=='User1'){
		session_start();
		$_SESSION['user']= $role ;
		header('location: clerk_dashboard.php');
	}
	
	} else {
			
	echo"
		<p class='text-center text-white'>Username or Password incorrect</p>
		";
	}
	}
}
?></div>
			</div>
		</div>
		</div>
		</div>
	  </p>
	  
	  <div class="hint-text small text-center mt-5 p-2 text-white bg-dark rounded">Powered by: <a href="#">XYZ | ABC Developer's</a></div>
	  
    </div>
  </div>	
</body>
</html>