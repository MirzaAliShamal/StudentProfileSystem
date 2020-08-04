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

    <title>Dashboard: Admin</title>
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

            <nav class="navbar navbar-expand-lg navbar-light bg-dark text-white rounded">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-align-left"></i>
                        <span>Toggle Sidebar</span>
                    </button>
					
					<h3 class="ml-5">Student Profile System</h3>

                </div>
            </nav>
<div class="row container-fluid ml-1">
			
			<div class="card col-md-4 col-lg-4 col-xs-6 bg-white text-center rounded">
				<div class="card-header">
					<h1><i class="icofont-graduate-alt"></i><i class="icofont-graduate-alt"></i><i class="icofont-graduate-alt"></i></h1> 
				</div>
				<div class="card-body">
					<h5 class="card-title">Number of Students</h5>
					<h1>
<?php
	$result = mysqli_query($con, "SELECT COUNT(*) AS `count` FROM `Students`");
	$row = mysqli_fetch_assoc($result);
	$count = $row['count'];
	echo $count;
?></h1>
				</div>
			</div>
			
			<div class="card col-md-4 col-lg-4 col-xs-6 bg-white text-center rounded">
				<div class="card-header">
					<h1><i class="icofont-book"></i><i class="icofont-book"></i><i class="icofont-book"></i></h1> 
				</div>
				<div class="card-body">
					<h5 class="card-title">Issued Library Books</h5>
					<h1><?php
							$result = mysqli_query($con, "SELECT COUNT(*) AS `count` FROM books where issue!=''");
							$row = mysqli_fetch_assoc($result);
							$count = $row['count'];
							echo $count;
						?></h1>
				</div>
			</div>
			
			<div class="card col-md-4 col-lg-4 col-xs-6 bg-white text-center rounded">
				<div class="card-header">
					<h1><i class="icofont-look"></i><i class="icofont-look"></i><i class="icofont-look"></i></h1> 
				</div>
				<div class="card-body">
					<h5 class="card-title">Out Standing Dues</h5>
					<h1><?php
							$result = mysqli_query($con, "SELECT COUNT(*) AS COUNTS from fee_vouchers WHERE paid=''");
							$row = mysqli_fetch_assoc($result);
							$count = $row['COUNTS'];
							echo $count;
						?></h1>
				</div>
			</div>
			
			
</div>
        			<div class="row">
			<div class="col-12 bg-white pt-1 pb-4">			
			<p class="card-text ">
			<h2 class="text-center">Enrolled Students List</h2>
			
	<?php
		$sql = "SELECT * FROM students";
if($result = mysqli_query($con, $sql)){
    if(mysqli_num_rows($result) > 0){
            
		echo"<table id='enstudents' class='col-12 table table-hover table-bordered p-5'>";
		echo"	<thead><tr>";
		echo"	<th>Student</th>";
		echo"	<th>Father Name</th>";
		echo"	<th>Roll No.</th>";
		echo"	<th>Degree</th>";
		echo"	<th>Profile</th>";
		echo"	</tr>";
		echo"	</thead>";
        while($row = mysqli_fetch_array($result)){
            echo "<tr style='border: 1px solid black'>";
                echo "<td style='border: 1px solid black'>" . $row['s_name'] . "</td>";
                echo "<td style='border: 1px solid black'>" . $row['f_name'] . "</td>";
                echo "<td style='border: 1px solid black'>" . $row['rollno'] . "</td>";
				echo "<td style='border: 1px solid black'>" . $row['degree'] . "</td>";
				echo "<td style='border: 1px solid black'><a href='admin_student_profile.php?rollno=".$row['rollno']."'>View Profile</a></td>";
				
            echo "</tr>";
        }
        mysqli_free_result($result);
    } else{
        echo "No records Found.";
	}}
		?>
			</table>
	
<script>
$(document).ready(function() {
    $('#enstudents').DataTable();
} );
</script>
	
	
			</div>
			</div><br>
			<div class="row">
			<div class=""></div>
			<div class="col-12 bg-white p-5">			
<h3 class="text-center">Issued Books Log</h3>
			<?php
	
		$sql = "SELECT * FROM books where issue!=''";
if($result = mysqli_query($con, $sql)){
    if(mysqli_num_rows($result) > 0){
        echo "<table id='booklog' class='col-12 table table-hover text-center'>";
            echo "<thead><tr>";
                echo "<th>Roll No</th>";
                echo "<th>Book ID</th>";
                echo "<th>Book Name</th>";
				echo "<th>Author</th>";
				echo "<th>Category</th>";
				echo "<th>Publishers</th>";
            echo "</tr></thead>";
        while($row = mysqli_fetch_array($result)){
            echo "<tr style='border: 1px solid black'>";
                echo "<td style='border: 1px solid black'>" . $row['issue'] . "</td>";
                echo "<td style='border: 1px solid black'>" . $row['id'] . "</td>";
                echo "<td style='border: 1px solid black'>" . $row['book_name'] . "</td>";
                echo "<td style='border: 1px solid black'>" . $row['author'] . "</td>";
				echo "<td style='border: 1px solid black'>" . $row['category'] . "</td>";
				echo "<td style='border: 1px solid black'>" . $row['publishers'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        mysqli_free_result($result);
    } else{
        echo "<div class='alert alert-warning text-center'>No Book Issued at this Time.</div>";
	}}
		?>
<script>
$(document).ready(function() {
    $('#booklog').DataTable();
} );
</script>
	</div>
    </div>
			<h3 class="text-center mt-5">Students Fee Log</h3>
				<div class="card">
			<div class="card-body">
				<h3 class="text-center">Student With Clear Dues</h3>
				<p class="text-white">
				<?php
	
		$sql = "SELECT * from fee_vouchers WHERE paid='yes'";
if($result = mysqli_query($con, $sql)){
    if(mysqli_num_rows($result) > 0){
        echo "<table id='clrdue' class='col-12 table text-center table-hover'>";
            echo "<thead><tr>";
                echo "<th>Roll No.</th>";
                echo "<th>Amount</th>";
                echo "<th>Voucher No.</th>";
				echo "<th>Issue Date</th>";
				echo "<th>Bank</th>";
				echo "<th>Status</th>";
            echo "</tr></thead>";
        while($row = mysqli_fetch_array($result)){
            echo "<tr style='border: 1px solid black'>";
                echo "<td style='border: 1px solid black'>" . $row['rollno'] . "</td>";
                echo "<td style='border: 1px solid black'>" . $row['amount'] . "</td>";
                echo "<td style='border: 1px solid black'>" . $row['voucher_no'] . "</td>";
				echo "<td style='border: 1px solid black'>" . $row['date'] . "</td>";
				echo "<td style='border: 1px solid black'>" . $row['bank'] . "</td>";
				echo "<td style='border: 1px solid black' class='bg-success'>Paid</td>";
				
            echo "</tr>";
        }
        echo "</table>";
        mysqli_free_result($result);
    } else{
        echo "No Voucher Paid Yet.";
	}}
		?>
<script>
$(document).ready(function() {
    $('#clrdue').DataTable();
} );
</script>
				</p><br>
				<p class="text-white">
				<?php
	
		$sql = "SELECT * from fee_vouchers WHERE paid=''";
if($result = mysqli_query($con, $sql)){
    if(mysqli_num_rows($result) > 0){
        echo "<table id='outstanding' class='col-12 table text-center table-hover'>";
            echo "<thead><tr>";
                echo "<th>Roll No.</th>";
                echo "<th>Amount</th>";
                echo "<th>Voucher No.</th>";
				echo "<th>Issue Date</th>";
				echo "<th>Bank</th>";		
				echo "<th>Status</th>";		
            echo "</tr></thead>";
        while($row = mysqli_fetch_array($result)){
            echo "<tr style='border: 1px solid black'>";
                echo "<td style='border: 1px solid black'>" . $row['rollno'] . "</td>";
                echo "<td style='border: 1px solid black'>" . $row['amount'] . "</td>";
                echo "<td style='border: 1px solid black'>" . $row['voucher_no'] . "</td>";
				echo "<td style='border: 1px solid black'>" . $row['date'] . "</td>";
				echo "<td style='border: 1px solid black'>" . $row['bank'] . "</td>";
				echo "<td style='border: 1px solid black' class='bg-danger'>Not Paid</td>";
				
            echo "</tr>";
        }
        echo "</table>";
        mysqli_free_result($result);
    } else{
        echo "<div class='text-'>All Students Dues are Clear.</div>";
	}}
		?>
<script>
$(document).ready(function() {
    $('#outstanding').DataTable();
} );
</script>
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