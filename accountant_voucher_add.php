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
			<div class="row">
			<div class="col-2"></div>
			<div class="col-8 border bg-dark m-2 p-5 text-white">			
<form method="post" enctype="multipart/form-data">
  <fieldset>
    <legend class="text-center">Add Voucher</legend>
    
	<div class="form-group">
		<label for="student_id">Roll No.</label>
		<select class="form-control" id="student_id" style="width: 100%;" name="student_id">
		<option>Select Student</option>
		<?php
			$sql = "SELECT * FROM students";
			if($result = mysqli_query($con, $sql)){
			if(mysqli_num_rows($result) > 0){
				while($row = mysqli_fetch_array($result)){
                echo "<option value='". $row['id'] ."'>".$row['rollno']."</option>";
		}}}
		?>
		</select>
		<script>
		$("#student_id").select2().select2();
		</script>
    </div>
	<div class="form-group">
		<label for="voucher_no">Voucher No.</label>
		<input type="number" class="form-control"  name="voucher_no"  id="voucher_no" placeholder="Enter Voucher Number" required>
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
	<div class="form-group">
      	<label for="amount">Amount</label>
      	<input type="text" class="form-control"  name="amount"  id="amount" placeholder="Enter Amount" required>
    </div>
    <div class="form-group">
      	<label for="session">Session</label>
      	<input type="text" class="form-control"  name="session"  id="session" placeholder="e.g. 2016-2020" required>
    </div>
    <div class="form-group">
		<label for="exampleInputEmail1">Program</label>
		<select class="form-control" id="programs" style="width: 100%;" name="program_id">
			<option value="" selected disabled>Select Program</option>
            <?php
              $sql = "SELECT * FROM programs";
              if($result = mysqli_query($con, $sql)){
              if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_array($result)){
                        echo "<option value='". $row['id'] ."'>".$row['program']."</option>";
            }}}
            ?>
		</select>
		<script>
			$("#programs").select2().select2();
		</script>
    </div>
    <div class="form-group">
		<label for="semester">Semester</label>
		<select class="form-control" id="semester" style="width: 100%;" name="semester">
			<option value="" selected disabled>Select Semester</option>
			<option value="1st">1st</option>
			<option value="2nd">2nd</option>
			<option value="3rd">3rd</option>
			<option value="4th">4th</option>
			<option value="5th">5th</option>
			<option value="6th">6th</option>
			<option value="7th">7th</option>
			<option value="8th">8th</option>
		</select>
		<script>
			$("#semester").select2().select2();
		</script>
    </div>
    <div class="form-group">
        <label for="issue_date">Issue Date</label>
        <div id="datepicker" class="input-group date" data-date-format="dd/mm/yyyy">
            <input type="text" class="form-control" name='issue_date' id="issue_date">
            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
        </div>
    </div>
    <script>
       	$(function () {
        	$("#datepicker").datepicker({ 
            	autoclose: true, 
               	todayHighlight: true
         	}).datepicker('update', new Date());
       	});
    </script>
    <div class="form-group">
		<label for="voucher_pic">Voucher Image</label><br>
		<input type="file" name="voucher_pic" id="voucher_pic" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
  </fieldset>
</form>	


<?php 
if (isset($_POST["submit"])) {
	
	$student_id =  $_POST["student_id"];
	$voucher_no =  $_POST["voucher_no"];
	$bank =  $_POST["bank"];
	$amount =  $_POST["amount"];
	$session =  $_POST["session"];
	$program_id =  $_POST["program_id"];
	$semester =  $_POST["semester"];
	$issue_date =  $_POST["issue_date"];

	$validation_sql = "SELECT * FROM fee_voucher WHERE student_id = '" . $student_id . "' AND semester = '" . $semester . "'";
	$validation_result = mysqli_query($con, $validation_sql);
	if(mysqli_num_rows($validation_result) > 0){
		echo"<script>alert('Voucher Already Exists!');</script>";
	}else{
		$result = mysqli_query($con,"SELECT * FROM students WHERE id='" . $student_id . "'");
	  	$student_data= mysqli_fetch_array($result);

	  	$filename   = uniqid() ."-". $student_data['rollno'] . "-" .str_replace(' ', '-', $student_data['name']) . "-voucher_img";
	  	$extension  = pathinfo( $_FILES["voucher_pic"]["name"], PATHINFO_EXTENSION );
	  	$basename   = $filename . '.' . $extension;
	  	$source     = $_FILES["voucher_pic"]["tmp_name"];
	  	$destination= "images/vouchers/" . $basename;
		if(move_uploaded_file( $source, $destination )){
	  		$msg = "Image uploaded successfully";
	  	}else{
			$msg = "Failed to upload image";
	  	}

	  	$sql = "INSERT INTO `fee_voucher`( `student_id`, `voucher_no`, `bank`, `amount`, `session`, `program_id`, `semester`, `issue_date`, `voucher_pic`) VALUES ('$student_id','$voucher_no','$bank','$amount','$session','$program_id','$semester','$issue_date','$basename')";
	  	$result = $con->query($sql);
  		echo"<script>alert('New Voucher Added.');</script>";
	}
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