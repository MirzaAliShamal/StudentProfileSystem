<?php
session_start();
	if ($_SESSION['user'] != 'Accountant'){
		header('location:index.php');

	}
?>     
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Dashboard: Accounts Section</title>
	<?php 
	include"system/fileslink.php";
	?>
</head>

<body style="background-image: url('assets/img/logo.png'); background-attachment: fixed;">
    <div class="wrapper">
        <!-- Sidebar  -->
        <?php 
			include"navs/accounts_nav.php";
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
			
			<div class="card col-lg-4 col-xs-6 bg-white text-center rounded">
				<div class="card-body">
					Number of Students
					<h1>
					<?php
							$result = mysqli_query($con, "SELECT COUNT(*) AS `count` FROM `students");
							$row = mysqli_fetch_assoc($result);
							$count = $row['count'];
							echo $count;
						?>
					</h1>
				</div>
			</div>
			
			<div class="card col-lg-4 col-xs-6 bg-white text-center rounded">
				<div class="card-body">
					Vouchers Paid
					<h1>
					<?php
							$result = mysqli_query($con, "SELECT COUNT(*) AS COUNTS from fee_vouchers WHERE paid='yes'");
							$row = mysqli_fetch_assoc($result);
							$count = $row['COUNTS'];
							echo $count;
						?>
					</h1>
				</div>
			</div>
			
			<div class="card col-lg-4 col-xs-6 bg-white text-center rounded">
				<div class="card-body">
					Outstanding Dues
					<h1>
					<?php
							$result = mysqli_query($con, "SELECT COUNT(*) AS COUNTS from fee_vouchers WHERE paid=''");
							$row = mysqli_fetch_assoc($result);
							$count = $row['COUNTS'];
							echo $count;
						?>
					</h1>
				</div>
			</div>
			
			
			
			
			</div>

			<div class="card bg-white mt-5">
			<div class="card-body">
				<h4 class="card-title text-center">Students with Clear Dues</h4>
				<p class="text-white">
				<?php
	
		$sql = "SELECT * from fee_vouchers WHERE paid='yes'";
if($result = mysqli_query($con, $sql)){
    if(mysqli_num_rows($result) > 0){
        echo "<table id='paid' class='col-12 table text-center table-hover'>";
            echo "<thead><tr>";
                echo "<th>Roll No.</th>";
                echo "<th>Amount</th>";
                echo "<th>Voucher No.</th>";
				echo "<th>Issue Date</th>";
				echo "<th>Bank</th>";
				echo "<th>Status</th>";
            echo "</tr>";
        while($row = mysqli_fetch_array($result)){
            echo "<tr style='border: 1px solid black'>";
                echo "<td style='border: 1px solid black'>" . $row['rollno'] . "</td>";
                echo "<td style='border: 1px solid black'>" . $row['amount'] . "</td>";
                echo "<td style='border: 1px solid black'>" . $row['voucher_no'] . "</td>";
				echo "<td style='border: 1px solid black'>" . $row['date'] . "</td>";
				echo "<td style='border: 1px solid black'>" . $row['bank'] . "</td>";
				echo "<td style='border: 1px solid black' class='bg-success'>Paid</td>";
				
            echo "</tr></thead>";
        }
        echo "</table>";
        mysqli_free_result($result);
    } else{
        echo "No Voucher Paid Yet.";
	}}
		?>
<script>
$(document).ready(function() {
    $('#paid').DataTable();
} );
</script>
				</p>
			<h4 class="card-title text-center">Students with Outstanding Dues</h4>
				<p class="text-white">
				<?php
	
		$sql = "SELECT * from fee_vouchers WHERE paid=''";
if($result = mysqli_query($con, $sql)){
    if(mysqli_num_rows($result) > 0){
        echo "<table id='unpaid' class='col-12 table text-center table-hover'>";
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
    $('#unpaid').DataTable();
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