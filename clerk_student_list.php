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
			<div class="row bg-white">
			<div class="col-12 pt-1 pb-4">			
			<p >
	<?php
	
		$sql = "SELECT * FROM students";
if($result = mysqli_query($con, $sql)){
    if(mysqli_num_rows($result) > 0){
        echo "<table id='students' class='col-12 table  text-center bg-white p-5'>";
            echo "<thead><tr>";
                echo "<th>Student</th>";
                echo "<th>Father Name</th>";
                echo "<th>Roll No.</th>";
				echo "<th>Degree</th>";
				echo "<th>Profile</th>";
				echo "<th>Edit</th>";
				echo "<th>Delete</th>";
				
            echo "</tr></thead>";
        while($row = mysqli_fetch_array($result)){
            echo "<tr style='border: 1px solid black'>";
                echo "<td style='border: 1px solid black'>" . $row['s_name'] . "</td>";
                echo "<td style='border: 1px solid black'>" . $row['f_name'] . "</td>";
                echo "<td style='border: 1px solid black'>" . $row['rollno'] . "</td>";
				echo "<td style='border: 1px solid black'>" . $row['degree'] . "</td>";
				echo "<td style='border: 1px solid black'><a href='clerk_student_profile.php?rollno=".$row['rollno']."'>View Profile</a></td>";
				echo "<td style='border: 1px solid black'><a href='clerk_student_profile_edit.php?rollno=".$row['rollno']."'>Edit Profile</a></td>";
				echo "<td style='border: 1px solid black'><a href='clerk_delete_student.php?rollno=".$row['rollno']."' class='confirmation'>Delete</a></td>";
            echo "</tr>";
        }
        echo "</table>";
        mysqli_free_result($result);
    } else{
        echo "<div class='text-center'>No records Found.</div>";
	}}
		?>
<script>
$(document).ready(function() {
    $('#students').DataTable();
} );
</script>
			</div>
			
			
			</div>
        </div>
    </div>
<script type="text/javascript">
    $('.confirmation').on('click', function () {
        return confirm('Are you sure?');
    });
</script>
<script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
</script>
</body>
</html>