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

    <title>Dashboard: Student Profile</title>
	<?php 
	include"system/fileslink.php";
	?>
	<style>
#profilepic {
  border: 1px solid #ddd;
  border-radius: 4px;
  padding: 5px;
  width: 150px;
}
	</style>
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
	<div class="col-1"></div>
	<div class="col-md-12 col-lg-10">			
	<p class="card-text">
	<h3 class="text-center">Student Scholarship View</h3>
	<?php

	$id = $_GET['id'];
	
		$sql ="SELECT student_scholarships.*,scholarships.name,students.rollno,programs.program FROM student_scholarships INNER JOIN scholarships ON scholarships.id=student_scholarships.scholarship_id INNER JOIN students ON students.id = student_scholarships.student_id INNER JOIN programs ON programs.id = student_scholarships.program_id";
if($result = mysqli_query($con, $sql)){
    if(mysqli_num_rows($result) > 0){
        echo "<table class='table table-dark text-center'>";
        while($row = mysqli_fetch_array($result)){
			
			echo "<tr style='border: 1px solid black'>";
                echo "<td class='text-center'  colspan='2'><img id='profilepic' class='img-fluid' src='images/scholarships/".$row['scholarship_img']."' ></td>";
			echo "</tr>";
			
			echo "<tr style='border: 1px solid black'>";
                echo "<td class='text-right'>Roll Number:</td><td class='text-left'>" . $row['rollno'] . "</td>";
			echo "</tr>";
			echo "<tr style='border: 1px solid black'>";
                echo "<td class='text-right'>Scholarship:</td><td class='text-left'>" . $row['name'] . "</td>";
			echo "</tr>";
            echo "<tr style='border: 1px solid black'>";
                echo "<td class='text-right'>Amount:</td><td class='text-left'>" . $row['amount'] . "</td>";
			echo "</tr>";
            echo "<tr style='border: 1px solid black'>";
                echo "<td class='text-right'>Nature:</td><td class='text-left'>" . $row['nature'] . "</td>";
			echo "</tr>";
			echo "<tr style='border: 1px solid black'>";
				echo "<td class='text-right'>Session:</td><td class='text-left'>" . $row['session'] . "</td>";
			echo "</tr>";
			echo "<tr style='border: 1px solid black'>";
				echo "<td class='text-right'>Program:</td><td class='text-left'>" . $row['program'] . "</td>";
			echo "</tr>";
			echo "<tr style='border: 1px solid black'>";
                echo "<td class='text-right'>Semester:</td><td class='text-left'>" . $row['semester'] . "</td>";
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