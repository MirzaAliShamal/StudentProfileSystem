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

    <title>Dashboard: Recieve Fee</title>
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
<div class="col-lg-4"></div>
<div class="col-lg-4 col-md-8 bg-dark p-5 text-white">			
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
	<div class="col-1"></div>
	<div class="col-lg-10 col-md-12">			
	<p class="card-text">
	<?php

	if (isset($_POST["submit"])){
	$rollno = $_POST['rollno'];
		$sql ="SELECT * FROM `fee_vouchers` WHERE rollno='$rollno' and paid =''";
if($result = mysqli_query($con, $sql)){
    if(mysqli_num_rows($result) > 0){
        echo "<table class='col-12 table table-dark text-center table-hover table-sm'>";
            echo "<tr>";
                echo "<th>Roll No.</th>";
                echo "<th>Amount</th>";
                echo "<th>Voucher No.</th>";
				echo "<th>Issue Date</th>";
				echo "<th>Bank</th>";
				echo "<th>Recieve Fee</th>";
            echo "</tr>";
        while($row = mysqli_fetch_array($result)){
            echo "<tr style='border: 1px solid black'>";
                echo "<td style='border: 1px solid black'>" . $row['rollno'] . "</td>";
                echo "<td style='border: 1px solid black'>" . $row['amount'] . "</td>";
                echo "<td style='border: 1px solid black'>" . $row['voucher_no'] . "</td>";
				echo "<td style='border: 1px solid black'>" . $row['date'] . "</td>";
				echo "<td style='border: 1px solid black'>" . $row['bank'] . "</td>";
				echo "<td style='border: 1px solid black'><a href='admin_fee.php?voucher_no=".$row['voucher_no']."'>Click to Pay</a></td>";
				
            echo "</tr>";
        }
        echo "</table>";
        mysqli_free_result($result);
    } else{
        echo "<div class='text-center alert bg-dark text-white'>No Voucher Found for this Roll Number</div>";
	}}}
		?>
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