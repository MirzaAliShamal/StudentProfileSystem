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

    <title>Dashboard: Recieve Fee</title>
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
			
<div class="row">
	
	<div class="col-lg-12 col-md-12 bg-white">			
	<p class="card-text">
	<?php
		$sql ="SELECT * FROM fee_vouchers";
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
				echo "<th>Edit</th>";
				echo "<th>Delete</th>";
            echo "</tr></thead>";
        while($row = mysqli_fetch_array($result)){
            echo "<tr style='border: 1px solid black'>";
                echo "<td style='border: 1px solid black'>" . $row['rollno'] . "</td>";
                echo "<td style='border: 1px solid black'>" . $row['amount'] . "</td>";
                echo "<td style='border: 1px solid black'>" . $row['voucher_no'] . "</td>";
				echo "<td style='border: 1px solid black'>" . $row['date'] . "</td>";
				echo "<td style='border: 1px solid black'>" . $row['bank'] . "</td>";
				echo "<td style='border: 1px solid black'>" . $row['paid'] . "</td>";
				echo "<td style='border: 1px solid black; background-color: green;'><a href='accounts_edit_fee.php?voucher_no=".$row['voucher_no']."'>Edit</a></td>";
				echo "<td style='border: 1px solid black; background-color: Red;'><a class='confirmation' href='delete_voucher.php?voucher_no=".$row['voucher_no']."'>Delete</a></td>";
				
            echo "</tr>";
        }
        echo "</table>";
        mysqli_free_result($result);
    } else{
        echo "<div class='text-center alert bg-dark text-white'>No Voucher Found for this Roll Number</div>";
	}}
		?>
<script type="text/javascript">
    $('.confirmation').on('click', function () {
        return confirm('Are you sure to Delete?');
    });
</script>
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

	
<script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
</script>
</body>
</html>