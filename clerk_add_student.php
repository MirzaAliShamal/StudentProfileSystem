<?php
session_start();
	if ($_SESSION['user'] != 'User1'){
		header('location:index.php');

	}
?> 
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Student Registration Section</title>
	<?php 
	include"system/fileslink.php";
	?>
</head>

<body style="background-image: url('assets/img/logo.png'); background-attachment: fixed;">
    <div class="wrapper">
        <!-- Sidebar  -->
        <?php 
			include"navs/clerk_nav.php";
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
			<div class="col-8 bg-dark text-white p-5">			
<form method="post" enctype="multipart/form-data">
  <fieldset>
    <legend class="text-center">Add a Student</legend>
    <div class="form-group">
      <label for="exampleInputEmail1">Student Name</label>
      <input type="text" class="form-control"  name="s_name" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Student Name" required>
    </div>
	    <div class="form-group">
      <label for="exampleInputEmail1">Father Name</label>
      <input type="text" class="form-control"  name="f_name"  id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Father Name" required>
    </div>
	<div class="form-group">
      <label for="exampleInputEmail1">CNIC</label>
      <input type="text"  class="form-control"  name="cnic"  id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="CNIC without dashes" maxlength="13"  required>
    </div>
	<div class="form-group">
      <label for="exampleInputEmail1">Alloted Roll No.</label>
      <input type="text"  class="form-control"  name="rollno"  id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Alloted Roll No." maxlength="13"  required>
    </div>
	<label for="exampleInputEmail1">DOB</label>
	<div id="datepicker" class="input-group date" data-date-format="yyyy-mm-dd">
    <input class="form-control" name='dob'/>
    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
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
      <label for="exampleInputEmail1">Phone Number</label>
      <input type="number" class="form-control"  name="contact"  id="exampleInputEmail1" aria-describedby="emailHelp" maxlength="11" placeholder='Contact Number' required>
    </div>
	<div class="form-group">
      <label for="exampleInputEmail1">Address</label>
      <input type="text" class="form-control"  name="address"  id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Home Address" required>
    </div>
	<div class="form-group">
      <label for="exampleInputEmail1">Email</label>
      <input type="text" class="form-control"   name="email"  id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email" required>
    </div>
	   <div class="form-group">
      <label for="exampleSelect1">Degree Level</label>
      <select class="form-control"   name="degree" id="exampleSelect1" required>
        <option value="Doctorate">Doctorate</option>
        <option value="Masters">Masters</option>
        <option value="Bachelors">Bachelors</option>
      </select>
    </div>
    
    <fieldset class="form-group">
      <legend>Gender</legend>
      <div class="form-check">
        <label class="form-check-label">
          <input type="radio" class="form-check-input" name="gender" id="optionsRadios1" value="male" checked="">
         Male
        </label>
      </div>
      <div class="form-check">
      <label class="form-check-label">
          <input type="radio" class="form-check-input" name="gender" id="optionsRadios2" value="female">
          Female
        </label>
      </div>
      <div class="form-check disabled">
      <label class="form-check-label">
          <input type="radio" class="form-check-input" name="gender" id="optionsRadios3" value="she male">
        She Male
        </label>
      </div>
    </fieldset>
	<div class="form-group">
      <label for="exampleInputEmail1">Profile Picture</label><br>
      <input type="file"   name="image"  id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Select Profile Picture" required>
    </div>
    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
  </fieldset>
</form>

<?php 
if (isset($_POST["submit"])) {
	
	$s_name =  $_POST["s_name"];
	$f_name =  $_POST["f_name"];
	$cnic =  $_POST["cnic"];
	$dob =  $_POST["dob"];
	$contact =  $_POST["contact"];
	$address =  $_POST["address"];
	$email =  $_POST["email"];
	$degree =  $_POST["degree"];
	$rollno =  $_POST["rollno"];
	$gender =  $_POST["gender"];
	
	$image = $_FILES['image']['name'];
	$target = "images/".basename($image);
	if(move_uploaded_file($_FILES['image']['tmp_name'], $target)){
  		$msg = "Image uploaded successfully";
  	}else{
  		$msg = "Failed to upload image";
  	}
	
  $sql = "INSERT INTO `students`( `s_name`, `f_name`, `cnic`, `dob`, `contact`, `address`, `email`, `degree`, `rollno`, `gender`, `image`) VALUES ('$s_name','$f_name','$cnic','$dob','$contact','$address','$email','$degree','$rollno','$gender','$image')";
  $result = $con->query($sql);
  echo"<script>alert('Student Profile Added into system');</script>";
}
?>
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