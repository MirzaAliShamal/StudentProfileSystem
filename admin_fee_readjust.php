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

    <title>Dashboard: Fee Re-Adjustment</title>
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
	<div class="row bg-white">
	<div class="col-3"></div>
	<div class="container-fluid text-center p-3 rounded">
		<h3>Unpaid Vouchers</h3>
		<p class="text-white">
				<?php
	
		$sql = "SELECT * from fee_vouchers WHERE paid=''";
if($result = mysqli_query($con, $sql)){
    if(mysqli_num_rows($result) > 0){
        echo "<table id='fee_vouchers' class='col-12 table  text-center table-hover '>";
            echo "<thead><tr>";
                echo "<th>Roll No.</th>";
                echo "<th>Amount</th>";
                echo "<th>Voucher No.</th>";
				echo "<th>Issue Date</th>";
				echo "<th>Bank</th>";		
				echo "<th>Status</th>";
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
				echo "<td style='border: 1px solid black' class='bg-danger'>Not Paid</td>";
				echo "<td style='border: 1px solid black'><a href='admin_edit_fee_voucher.php?voucher_no=".$row['voucher_no']."' >Edit</a></td>";
				echo "<td style='border: 1px solid black'><a href='admin_delete_fee_voucher.php?voucher_no=".$row['voucher_no']."' class='confirmation'>Delete</a></td>";
            echo "</tr>";
        }
        echo "</table>";
        mysqli_free_result($result);
    } else{
        echo "<div class='text-'>All Students Dues are Clear.</div>";
	}}
		?>
<script type="text/javascript">
    $('.confirmation').on('click', function () {
        return confirm('Are you sure?');
    });
</script>
<script>
$(document).ready(function() {
    $('#fee_vouchers').DataTable();
} );
</script>
				</p>
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