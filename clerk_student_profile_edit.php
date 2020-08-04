<?php
session_start();
	if ($_SESSION['user'] != 'User1'){
		header('location:index.php');

	}
?> 
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Dashboard: Edit Student Profile</title>
	<?php 
	include"system/fileslink.php";
	?>
</head>

<body style="background-image: url('assets/img/logo.png'); background-attachment: fixed;">
    <div class="wrapper">
        <!-- Sidebar  -->
        <?php 
			include"navs/clerk_nav.php";
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
	<div class="col-2 c0l-md-2"></div>
	<div class="col-md-8 col-lg-8 bg-dark text-white p-5 rounded">			
	<p class="card-text">
	<h3 class="text-center">Edit Student Profile</h3>
	<?php
	if(count($_POST)>0) {
mysqli_query($con,"UPDATE students set s_name='" . $_POST['s_name'] . "', f_name='" . $_POST['f_name'] . "', rollno='" . $_POST['rollno'] . "', cnic='" . $_POST['cnic'] . "' ,dob='" . $_POST['dob'] . "',address='" . $_POST['address'] . "',contact='" . $_POST['contact'] . "',email='" . $_POST['email'] . "' WHERE rollno='" . $_GET['rollno'] . "'");
echo"<script>alert('Record Updated.!')
	location.replace('clerk_student_list.php')
</script>";
}
$result = mysqli_query($con,"SELECT * FROM students WHERE rollno='" . $_GET['rollno'] . "'");
$row= mysqli_fetch_array($result);
$rowcount=mysqli_num_rows($result);
	if($rowcount == 0){
		echo"<script>alert('No Record Found.!')
	location.replace('clerk_student_list.php')
</script>";
	}

?>
				<div class="row">
			<div class="col-2"></div>
			<div class="col-8 bg-dark text-white p-5">			
<form method="post" enctype="multipart/form-data">
  <fieldset>
    <legend class="text-center">Edit Student</legend>
    <div class="form-group">
      <label for="exampleInputEmail1">Student Name</label>
      <input type="text" class="form-control"  name="s_name" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $row['s_name']; ?>" required>
    </div>
	    <div class="form-group">
      <label for="exampleInputEmail1">Father Name</label>
      <input type="text" class="form-control"  name="f_name"  id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $row['f_name']; ?>" required>
    </div>
	<div class="form-group">
      <label for="exampleInputEmail1">Roll No.</label>
      <input type="text"  class="form-control"  name="rollno"  id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $row['rollno']; ?>" maxlength="13" readonly="readonly">
	  <small>**This field is to be read only. Unable to change</small>
    </div>
	<div class="form-group">
      <label for="exampleInputEmail1">CNIC</label>
      <input type="text"  class="form-control"  name="cnic"  id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $row['cnic']; ?>" maxlength="13"  required>
    </div>
	<label for="exampleInputEmail1">DOB</label>
	<div id="datepicker" class="input-group date" data-date-format="yyyy-mm-dd">
    <input class="form-control" name='dob'/>
    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
	</div>
	<script>
$(function () {
  $("#datepicker").datepicker({ 
        autoclose: true, 
        todayHighlight: true
  }).datepicker('update', new Date());
});

</script>
	<div class="form-group">
      <label for="exampleInputEmail1">Phone Number</label>
      <input type="number" class="form-control"  name="contact"  id="exampleInputEmail1" aria-describedby="emailHelp" maxlength="11" value="<?php echo $row['contact']; ?>" required>
    </div>
	<div class="form-group">
      <label for="exampleInputEmail1">Address</label>
      <input type="text" class="form-control"  name="address"  id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $row['address']; ?>" required>
    </div>
	<div class="form-group">
      <label for="exampleInputEmail1">Email</label>
      <input type="text" class="form-control"   name="email"  id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $row['email']; ?>" required>
    </div>
    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
  </fieldset>
</form>
</div>
</div>
	</p>
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