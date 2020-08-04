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

    <title>Student Registration Section</title>
	<?php 
	include"system/fileslink.php";
	?>
</head>

<body style="background-image: url('assets/img/logo.png'); background-attachment: fixed;  ">
    <div class="wrapper">
        <!-- Sidebar  -->
        <?php 
			include"navs/clerk_nav.php";
		?>

        <!-- Page Content  -->
        <div id="content">

            <nav class="navbar navbar-expand-lg col-12 navbar-light bg-dark text-white rounded">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-align-left"></i>
                        <span>Toggle Sidebar</span>
                    </button>
					
					<h3 class="ml-5">Student Profile System</h3>
                </div>
            </nav>
<div class="row">
<div class="col-lg-4"></div>
<div class="col-lg-4 col-md-12 bg-dark p-5 text-white">			
<form method="post">
  <fieldset>
    <legend class="text-center">Search Student</legend>
    <div class="form-group">
		<select class="form-control" id="rollno" style="width: 100%;" name="rollno">
		<option>Select Student</option>
		<?php
			$sql = "SELECT * FROM students";
			if($result = mysqli_query($con, $sql)){
			if(mysqli_num_rows($result) > 0){
				while($row = mysqli_fetch_array($result)){
                echo "<option value='". $row['rollno'] ."'>".$row['rollno']."</option>";
		}}}
		?>
		</select>
		<script>
		$("#rollno").select2().select2();
		</script>
    </div>
	<div class="form-group">
      <input type="submit" class="form-control"  name="submit" id="exampleInputEmail1" aria-describedby="emailHelp" value="Search" >
    </div>
	</fieldset>
	</form>
	</div>
</div>
<div class="row">
	<div class="col-lg-3"></div>
	<div class="col-lg-6 col-md-12">			
	<p class="card-text">
	<?php

	if (isset($_POST["submit"])){
	$rollno = $_POST['rollno'];
		$sql ="SELECT * FROM `students` WHERE rollno='$rollno'";
if($result = mysqli_query($con, $sql)){
    if(mysqli_num_rows($result) > 0){
        echo "<table class='table table-dark text-center'>";
        while($row = mysqli_fetch_array($result)){
            echo "<tr style='border: 1px solid black'>";
                echo "<td class='text-right'>Student Name:</td><td class='text-left'>" . $row['s_name'] . "</td>";
			echo "</tr>";
			echo "<tr style='border: 1px solid black'>";
                echo "<td class='text-right'>Father Name:</td><td class='text-left'>" . $row['f_name'] . "</td>";
			echo "</tr>";
			echo "<tr style='border: 1px solid black'>";
                echo "<td class='text-right'>Roll Number:</td><td class='text-left'>" . $row['rollno'] . "</td>";
			echo "</tr>";
			echo "<tr style='border: 1px solid black'>";
				echo "<td class='text-right'>Degree Title:</td><td class='text-left'>" . $row['degree'] . "</td>";
			echo "</tr>";
			echo "<tr style='border: 1px solid black'>";
				echo "<td class='text-right'>Profile</td><td class='text-left'>
				<a href='clerk_student_profile.php?rollno=".$row['rollno']."'>View Profile</a>
				</td>";
            echo "</tr>";
        }
        echo "</table>";
        mysqli_free_result($result);
    } else{
        echo "<div class='text-center alert alert-danger text-dark'>No Record Found for this Roll Number</div>";
	}}}
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