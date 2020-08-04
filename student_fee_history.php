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

    <title>Dashboard: Fee History</title>
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
			<div class="row container-fluid">
			
			<div class="col-3"></div>
			<div class="col-lg-6 col-md-12 bg-dark p-5 rounded mb-3">
			<h3 class="text-center text-white">Search Student</h3>
			<form method="post" enctype="multipart/form-data">
			<fieldset>
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
			<button type="submit" class="btn btn-primary" name="submit">Submit</button>
			</fieldset>
			</form>
			</div>
			<div class="col-3"></div>
			
			
			<div class=""></div>
			<div class="card col-12 bg-white pt-5">
			<div class="card-body">
				<h4 class="card-title text-center">Student Payment's History</h4>
				<p class="">
				<?php
	if (isset($_POST["submit"])) {
		$rollno =  $_POST["rollno"];
		$sql = "SELECT * from fee_vouchers WHERE rollno='$rollno'";
if($result = mysqli_query($con, $sql)){
    if(mysqli_num_rows($result) > 0){
        echo "<table id='vouchers' class='col-12 table text-center table-hover'>";
            echo "<thead><tr>";
                echo "<th>Roll No.</th>";
                echo "<th>Amount</th>";
                echo "<th>Voucher No.</th>";
				echo "<th>Issue Date</th>";
				echo "<th>Bank</th>";		
				echo "<th>Paid</th>";		
            echo "</tr></thead>";
        while($row = mysqli_fetch_array($result)){
            echo "<tr style='border: 1px solid black'>";
                echo "<td style='border: 1px solid black'>" . $row['rollno'] . "</td>";
                echo "<td style='border: 1px solid black'>" . $row['amount'] . "</td>";
                echo "<td style='border: 1px solid black'>" . $row['voucher_no'] . "</td>";
				echo "<td style='border: 1px solid black'>" . $row['date'] . "</td>";
				echo "<td style='border: 1px solid black'>" . $row['bank'] . "</td>";
				echo "<td style='border: 1px solid black'>" . $row['paid'] . "</td>";
				
            echo "</tr>";
        }
        echo "</table>";
        mysqli_free_result($result);
    } else{
        echo "<div class='text-center'>No Vouchers Paid</div>";
	}}}
		?>

<script>
$(document).ready(function() {
    $('#vouchers').DataTable();
} );
</script>
				</p>
			</div>      
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