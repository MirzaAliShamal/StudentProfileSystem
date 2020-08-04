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

    <title>Dashboard: Edit Fee</title>
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
	<div class="col-2 c0l-md-2"></div>
	<div class="col-md-8 col-lg-8 bg-dark text-white p-5 rounded">			
	<p class="card-text">
	<h3 class="text-center">Edit Fee Voucher</h3>
	<?php
	if(count($_POST)>0) {
mysqli_query($con,"UPDATE fee_vouchers set amount='" . $_POST['amount'] . "', bank='" . $_POST['bank'] . "' WHERE voucher_no='" . $_GET['voucher_no'] . "'");
echo"<script>alert('Record Updated.!')
	location.replace('admin_fee_readjust.php')
</script>";
}
$result = mysqli_query($con,"SELECT * FROM fee_vouchers WHERE voucher_no='" . $_GET['voucher_no'] . "'");
$row= mysqli_fetch_array($result);
$rowcount=mysqli_num_rows($result);
	if($rowcount == 0){
		echo"<script>alert('No Record Found.!')
	location.replace('admin_fee_readjust.php')
</script>";
	}
?>
				<div class="row">
			<div class="col-2"></div>
			<div class="col-8 bg-dark text-white p-5">			
<form method="post" enctype="multipart/form-data">
  <fieldset>
    <legend class="text-center">Edit Fee Voucher</legend>
    <div class="form-group">
      <label for="exampleInputEmail1">Roll No.</label>
      <input type="text" class="form-control"  name="rollno" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $row['rollno']; ?>" readonly>
    </div>
	    <div class="form-group">
      <label for="exampleInputEmail1">Voucher No.</label>
      <input type="text" class="form-control"  name="voucher_no"  id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $row['voucher_no']; ?>" readonly >
    </div>
	<div class="form-group">
      <label for="exampleInputEmail1">Amount</label>
      <input type="text"  class="form-control"  name="amount"  id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $row['amount']; ?>">
    </div>
	<div class="form-group">
      <label for="exampleInputEmail1">Bank</label>
      <select class="form-control" id="space" name="bank">
	  <option value="<?php echo $row['bank']; ?>"><?php echo $row['bank']; ?></option>
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
</div>
</div>
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