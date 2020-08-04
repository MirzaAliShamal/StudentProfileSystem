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
  $id = $_GET['id'];
  $result = mysqli_query($con,"SELECT * FROM programs WHERE id='" . $id . "'");
  $row= mysqli_fetch_array($result);
  $rowcount=mysqli_num_rows($result);
  if($rowcount == 0){
    echo"<script>alert('No Record Found.!')
      location.replace('admin_dashboard.php')
    </script>";
  }
?>
      <form method="post" enctype="multipart/form-data">
        <fieldset>
          <legend class="text-center">Add a Program</legend>
          <div class="form-group">
            <label for="program">Program</label>
            <input type="text" class="form-control" name="program" id="program" placeholder="e.g. MCS(M)" maxlength="15" value="<?php echo $row['program']; ?>" required>
          </div>
          <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </fieldset>
      </form>

<?php 
if (isset($_POST["submit"])) {
	$id = $_GET['id'];
	$program =  $_POST["program"];
  $sql = "UPDATE programs set program='" . $program . "' WHERE id='" . $id . "'";
  $result = $con->query($sql);
  echo"<script>alert('Record Updated.!')
  location.replace('admin_program_list.php')
</script>";
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