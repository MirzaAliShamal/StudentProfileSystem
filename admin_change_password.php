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
    <legend class="text-center">Change Passwords</legend>
	<div class="form-group">
	<select class="form-control" id="voucher" style="width: 100%;" name="username">
		<option>Select User Name</option>
		<?php
			$sql = "SELECT * FROM users";
			if($result = mysqli_query($con, $sql)){
			if(mysqli_num_rows($result) > 0){
				while($row = mysqli_fetch_array($result)){
                echo "<option value='". $row['username'] ."'>".$row['username']."</option>";
		}}}
		?>
		</select>
		<script>
		$("#voucher").select2().select2();
		</script>
	</div>
	<div class="form-group">
      <label for="exampleInputEmail1">Change Password</label>
      <input type="password" class="form-control"  name="password"  id="exampleInputEmail1" aria-describedby="emailHelp"  required>
    </div>
    <input type="submit" class="btn btn-primary" name="submit">
  </fieldset>
</form>	


<?php 
if (isset($_POST["submit"])) {
	
	$username =  $_POST["username"];
	$password =  base64_encode($_POST["password"]);
  $sql = "UPDATE `users` SET `password`='$password' where username ='$username'";
	if($result = mysqli_query($con, $sql)){
	echo"<script>alert('Password Changed');</script>";
  } else{
	  echo "No Data Inserted";
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