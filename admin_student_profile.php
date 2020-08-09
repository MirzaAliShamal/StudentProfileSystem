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
	<style>
		#profilepic {
		  border: 1px solid #ddd;
		  border-radius: 4px;
		  padding: 5px;
		  width: 150px;
		}
	</style>
    <title>Student Profile Section</title>
	<?php 
	include"system/fileslink.php";
	?>
</head>

<body style="background-image: url('assets/img/logo.png'); background-attachment: fixed;  ">
    <div class="wrapper">
        <!-- Sidebar  -->
        <?php 
			include"navs/admin_nav.php";
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
	<div class="col-1"></div>
	<div class="col-md-12 col-lg-10">			
	<p class="card-text">
	<h3 class="text-center">Student Profile</h3>
	<?php

	$id = $_GET['id'];
	
		$sql ="SELECT students.*,programs.program FROM students INNER JOIN programs ON programs.id=students.program_id WHERE students.id='$id'";
if($result = mysqli_query($con, $sql)){
    if(mysqli_num_rows($result) > 0){
        echo "<table class='table table-dark text-center'>";
        while($row = mysqli_fetch_array($result)){
			
			echo "<tr style='border: 1px solid black'>";
                echo "<td class='text-center'  colspan='2'><img id='profilepic' class='img-fluid' src='images/".$row['profile_img']."' ></td>";
			echo "</tr>";
			echo "<tr style='border: 1px solid black'>";
                echo "<td class='text-right'>Roll no:</td><td class='text-left'>" . $row['rollno'] . "</td>";
			echo "</tr>";
            echo "<tr style='border: 1px solid black'>";
                echo "<td class='text-right'>Student Name:</td><td class='text-left'>" . $row['name'] . "</td>";
			echo "</tr>";
			echo "<tr style='border: 1px solid black'>";
                echo "<td class='text-right'>Father Name:</td><td class='text-left'>" . $row['father_name'] . "</td>";
			echo "</tr>";
			echo "<tr style='border: 1px solid black'>";
				echo "<td class='text-right'>CNIC:</td><td class='text-left'>" . $row['cnic'] . "</td>";
			echo "</tr>";
			echo "<tr style='border: 1px solid black'>";
				echo "<td class='text-right'>Session:</td><td class='text-left'>" . $row['session'] . "</td>";
			echo "</tr>";
			echo "<tr style='border: 1px solid black'>";
				echo "<td class='text-right'>Program:</td><td class='text-left'>" . $row['program'] . "</td>";
			echo "</tr>";
			echo "<tr style='border: 1px solid black'>";
				echo "<td class='text-right'>Date of Birth:</td><td class='text-left'>" . $row['dob'] . "</td>";
			echo "</tr>";
			echo "<tr style='border: 1px solid black'>";
				echo "<td class='text-right'>Contact:</td><td class='text-left'>" . $row['contact_number'] . "</td>";
			echo "</tr>";
			echo "<tr style='border: 1px solid black'>";
				echo "<td class='text-right'>Address:</td><td class='text-left'>" . $row['address'] . "</td>";
			echo "</tr>";
			echo "<tr style='border: 1px solid black'>";
				echo "<td class='text-right'>E Mail:</td><td class='text-left'>" . $row['email'] . "</td>";
			echo "</tr>";
			echo "<tr style='border: 1px solid black'>";
				echo "<td class='text-right'>Gender:</td><td class='text-left'>" . $row['gender'] . "</td>";
			echo "</tr>";
			
        }
        echo "</table>";
        mysqli_free_result($result);
    } else{
        echo "<div class='text-center alert alert-danger text-dark'>No Record Found for this Roll Number</div>";
	}}
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