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

    <title>Student Profile System</title>
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
			        <?php  
$result = mysqli_query($con,"SELECT * FROM fee_voucher WHERE id='" . $_GET['id'] . "'");
$row= mysqli_fetch_array($result);
$rowcount=mysqli_num_rows($result);
  if($rowcount == 0){
    echo"<script>alert('No Record Found.!')
  location.replace('admin_voucher_list.php')
</script>";
  }
?>	
<form method="post" enctype="multipart/form-data">
  <fieldset>
    <legend class="text-center">Edit Voucher</legend>
    
	<div class="form-group">
		<label for="student_id">Roll No.</label>
		<select class="form-control" id="rollno" style="width: 100%;" name="student_id">
              <option value="" selected disabled>Select Rollno</option>
              <?php 
                $result = mysqli_query($con, "SELECT * FROM students");
                while($stud = mysqli_fetch_array($result)){
              ?>
                <option value="<?php echo $stud['id'] ?>" <?php if($stud['id'] == $row['student_id']){?> selected <?php } ?>> <?php echo $stud['rollno'] ?> </option>
              <?php   }
              ?>
            </select>
		<script>
		$("#student_id").select2().select2();
		</script>
    </div>
	<div class="form-group">
		<label for="voucher_no">Voucher No.</label>
		<input type="number" class="form-control" value="<?php echo $row['voucher_no'] ?>" name="voucher_no"  id="voucher_no" placeholder="Enter Voucher Number" required>
    </div>
	<div class="form-group">
      	<label for="exampleInputEmail1">Bank</label>
      	<select class="form-control" id="space" name="bank">
			<option>Select Bank</option>
			<option value="HBL" <?php if($row['bank'] == "HBL"){ ?> selected <?php } ?> >HBL</option>
			<option value="MCB" <?php if($row['bank'] == "MCB"){ ?> selected <?php } ?> >MCB</option>
			<option value="ABL" <?php if($row['bank'] == "ABL"){ ?> selected <?php } ?> >ABL</option>
			<option value="UBL" <?php if($row['bank'] == "UBL"){ ?> selected <?php } ?> >UBL</option>
			<option value="Meezan" <?php if($row['bank'] == "Meezan"){ ?> selected <?php } ?> >Meezan</option>
			<option value="National" <?php if($row['bank'] == "National"){ ?> selected <?php } ?> >National</option>
	  	</select>
	  	<script>
			$("#space").select2().select2();
		</script>
    </div>
	<div class="form-group">
      	<label for="amount">Amount</label>
      	<input type="text" class="form-control" value="<?php echo $row['amount'] ?>" name="amount"  id="amount" placeholder="Enter Amount" required>
    </div>
    <div class="form-group">
      	<label for="session">Session</label>
      	<input type="text" class="form-control" value="<?php echo $row['session'] ?>" name="session"  id="session" placeholder="e.g. 2016-2020" required>
    </div>
    <div class="form-group">
		<label for="exampleInputEmail1">Program</label>
		<select class="form-control"   name="program_id" id="program_id" required>
              <option value="" selected disabled>Select Program</option>
              <?php 
                $result = mysqli_query($con, "SELECT * FROM programs");
                while($prog = mysqli_fetch_array($result)){
              ?>
                <option value="<?php echo $prog['id'] ?>" <?php if($prog['id'] == $row['program_id']){?> selected <?php } ?>> <?php echo $prog['program'] ?> </option>
              <?php   }
              ?>
            </select>
		<script>
			$("#programs").select2().select2();
		</script>
    </div>
    <div class="form-group">
		<label for="semester">Semester</label>
		<select class="form-control" id="semester" style="width: 100%;" name="semester">
              <option value selected disabled>Select Semester</option>
              <option value="1st" <?php if($row['semester'] == "1st"){ ?> selected <?php } ?> >1st</option>
              <option value="2nd" <?php if($row['semester'] == "2nd"){ ?> selected <?php } ?> >2nd</option>
              <option value="3rd" <?php if($row['semester'] == "3rd"){ ?> selected <?php } ?> >3rd</option>
              <option value="4th" <?php if($row['semester'] == "4th"){ ?> selected <?php } ?> >4th</option>
              <option value="5th" <?php if($row['semester'] == "5th"){ ?> selected <?php } ?> >5th</option>
              <option value="6th" <?php if($row['semester'] == "6th"){ ?> selected <?php } ?> >6th</option>
              <option value="7th" <?php if($row['semester'] == "7th"){ ?> selected <?php } ?> >7th</option>
              <option value="8th" <?php if($row['semester'] == "8th"){ ?> selected <?php } ?> >8th</option>
            </select>
            <script>
		<script>
			$("#semester").select2().select2();
		</script>
    </div>
    <div class="form-group">
        <label for="issue_date">Issue Date</label>
        <div id="datepicker" class="input-group date" data-date-format="dd/mm/yyyy">
            <input type="text" class="form-control" value="<?php echo $row['issue_date'] ?>" name='issue_date' id="issue_date">
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
    	<img src="images/vouchers/<?php echo $row['voucher_pic']; ?>" class="img-fluid" width="250"><br>
		<label for="voucher_pic">Voucher Image</label><br>
		<input type="file" name="voucher_pic" id="voucher_pic" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
  </fieldset>
</form>	


<?php 
if (isset($_POST["submit"])) {
	
	if ($_FILES["voucher_pic"]["size"]>0) {

    	$filePath = "images/vouchers/" . $row['voucher_pic'];

    	$result = mysqli_query($con,"SELECT * FROM students WHERE id='" . $student_id . "'");
	  	$student_data= mysqli_fetch_array($result);

	  	$filename   = uniqid() ."-". $student_data['rollno'] . "-" .str_replace(' ', '-', $student_data['name']) . "-voucher_img";
	  	$extension  = pathinfo( $_FILES["voucher_pic"]["name"], PATHINFO_EXTENSION );
	  	$basename   = $filename . '.' . $extension;
	  	$source     = $_FILES["voucher_pic"]["tmp_name"];
	  	$destination= "images/vouchers/" . $basename;

      	if(move_uploaded_file( $source, $destination )){
          if (file_exists($filePath)) {
            unlink($filePath);
          } else {
            echo "File does not exists"; 
          }

        mysqli_query($con,"UPDATE fee_voucher set student_id='" . $_POST['student_id'] . "', voucher_no='" . $_POST['voucher_no'] . "', amount='" . $_POST['amount'] . "', bank='" . $_POST['bank'] . "' ,session='" . $_POST['session'] . "',program_id='" . $_POST['program_id'] . "',semester='" . $_POST['semester'] . "',issue_date='" . $_POST['issue_date'] . "', voucher_pic='" . $basename . "' WHERE id='" . $_GET['id'] . "'");
        echo"<script>alert('Record Updated.!')
          location.replace('admin_voucher_list.php')
        </script>";
      }else{
        $msg = "Failed to upload image";
      }
  } else {
    mysqli_query($con,"UPDATE fee_voucher set student_id='" . $_POST['student_id'] . "', voucher_no='" . $_POST['voucher_no'] . "', amount='" . $_POST['amount'] . "', bank='" . $_POST['bank'] . "' ,session='" . $_POST['session'] . "',program_id='" . $_POST['program_id'] . "',semester='" . $_POST['semester'] . "',issue_date='" . $_POST['issue_date'] . "' WHERE id='" . $_GET['id'] . "'");
        echo"<script>alert('Record Updated.!')
          location.replace('admin_voucher_list.php')
        </script>";
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