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

    <title>Dashboard: Generate  Voucher</title>
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
			<div class="col-2"></div>
			<div class="col-8 border bg-dark m-2 p-5 text-white">			
<form method="post" enctype="multipart/form-data">
  <fieldset>
    <legend class="text-center">Add Voucher</legend>
    
	<div class="form-group">
		<label for="exampleInputEmail1">Roll No.</label>
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
      <label for="exampleInputEmail1">Amount</label>
      <input type="number" class="form-control"  name="amount"  id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Amount" required>
    </div>
	<div class="form-group">
		<label for="exampleInputEmail1">Voucher No.</label>
		<input type="number" class="form-control"  name="voucher_no"  id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Voucher Number" required>
    </div>
	<div class="form-group">
      <label for="exampleInputEmail1">Issue Date</label>
      <br><b>
      <?php	echo date('d/m/y'); 
	  ?></b>
    </div>
	<div class="form-group">
      <label for="exampleInputEmail1">Bank</label>
      <select class="form-control" id="space" name="bank">
	  <option>Select Bank</option>
	  <option value="HBL">HBL</option>
	  <option value="MCB">MCB</option>
	  <option value="ABL">ABL</option>
	  <option value="UBL">UBL</option>
	  <option value="Meezan">Meezan</option>
	  <option value="National">National</option>
	  </select>
	  <script>
		$("#space").select2().select2();
		</script>
    </div>
    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
  </fieldset>
</form>	


<?php 
if (isset($_POST["submit"])) {
	
	$rollno =  $_POST["rollno"];
	$amount =  $_POST["amount"];
	$voucher_no =  $_POST["voucher_no"];
	$bank =  $_POST["bank"];
	
  $sql = "INSERT INTO `fee_vouchers`( `rollno`, `amount`, `voucher_no`, `bank`) VALUES ('$rollno','$amount','$voucher_no','$bank')";
  $result = $con->query($sql);
  echo"<script>alert('New Voucher Added.');</script>";
}
?>
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