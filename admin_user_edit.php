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

    <title>Student Registration Section</title>
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
			<div class="col-2"></div>
			<div class="col-8 bg-dark text-white p-5">			
<?php  
$result = mysqli_query($con,"SELECT * FROM users WHERE id='" . $_GET['id'] . "'");
$row= mysqli_fetch_array($result);
$rowcount=mysqli_num_rows($result);
  if($rowcount == 0){
    echo"<script>alert('No Record Found.!')
  location.replace('admin_user_list.php')
</script>";
  }
?>
      <form method="post" enctype="multipart/form-data">
        <fieldset>
          <legend class="text-center">Edit a User</legend>
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text"  class="form-control"  name="username" value="<?php echo $row['username']; ?>" id="username" placeholder="Username" required>
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control"  name="password" value="" id="password" placeholder="Password">
          </div>
      	    
          <div class="form-group">
            <label for="role">Role</label>
            <select class="form-control"   name="role" id="role" required>
              	<option value="admin" <?php if($row['role'] == "admin"){?> selected <?php } ?>>Admin</option>
				<option value="accountant" <?php if($row['role'] == "accountant"){?> selected <?php } ?>>Accountant</option>
				<option value="librarian" <?php if($row['role'] == "librarian"){?> selected <?php } ?>>Librarian</option>
				<option value="clerk" <?php if($row['role'] == "clerk"){?> selected <?php } ?>>Clerk</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </fieldset>
      </form>

<?php 
if (isset($_POST["submit"])) {
	$username = $_POST['username'];
	$role = $_POST['role'];
	if ($_POST["password"] != "") {
		$password =  base64_encode($_POST["password"]);
	  	mysqli_query($con,"UPDATE users set username='" . $username . "', password='" . $password . "', role='" . $role . "' WHERE id='" . $_GET['id'] . "'");

	  	echo"<script>alert('Record Updated.!')
	  			location.replace('admin_user_list.php')
	  		</script>";
	} else {
	  	mysqli_query($con,"UPDATE users set username='" . $username . "', password='" . $row['password'] . "', role='" . $role . "' WHERE id='" . $_GET['id'] . "'");

	  	echo"<script>alert('Record Updated.!')
	  			location.replace('admin_user_list.php')
	  		</script>";
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