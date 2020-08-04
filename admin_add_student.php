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

    <title>Student Registration Section</title>
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
			<div class="col-8 bg-dark text-white p-5">			
      <form method="post" enctype="multipart/form-data">
        <fieldset>
          <legend class="text-center">Add a Student</legend>
          <div class="form-group">
            <label for="rollno">Alloted Roll No.</label>
            <input type="text"  class="form-control"  name="rollno"  id="rollno" placeholder="Alloted Roll No." maxlength="15" required>
          </div>
          <div class="form-group">
            <label for="name">Student Name</label>
            <input type="text" class="form-control"  name="name" id="name" placeholder="Student Name" required>
          </div>
      	    <div class="form-group">
            <label for="father_name">Father Name</label>
            <input type="text" class="form-control"  name="father_name"  id="father_name" placeholder="Father Name" required>
          </div>
          <div class="form-group">
            <label for="cnic">CNIC</label>
            <input type="text" class="form-control"  name="cnic"  id="cnic" placeholder="36302-1111111-2" maxlength="15" required>
          </div>
          <div class="form-group">
            <label for="dob">DOB</label>
            <div id="datepicker" class="input-group date" data-date-format="dd/mm/yyyy">
              <input class="form-control" name='dob'/>
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
            <label for="contact_number">Contact Number</label>
            <input type="text" class="form-control"  name="contact_number"  id="contact_number" maxlength="11" placeholder='Contact Number' required>
          </div>
      	<div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" name="address"  id="address" placeholder="Address" required>
          </div>
      	<div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
          </div>
          <fieldset class="form-group">
            <legend>Gender</legend>
            <div class="form-check">
              <label for="male" class="form-check-label">
                <input type="radio" class="form-check-input" name="gender" id="male" value="male" checked="">
               Male
              </label>
            </div>
            <div class="form-check">
            <label for="female" class="form-check-label">
                <input type="radio" class="form-check-input" name="gender" id="female" value="female">
                Female
              </label>
            </div>
            <div class="form-check disabled">
            <label for="other" class="form-check-label">
                <input type="radio" class="form-check-input" name="gender" id="other" value="other">
              Other
              </label>
            </div>
          </fieldset>
          <div class="form-group">
            <label for="session">Session</label>
            <input type="text" class="form-control"  name="session"  id="session" placeholder='e.g. 2016-2020' required>
          </div>
          <div class="form-group">
            <label for="program_id">Program</label>
            <select class="form-control"   name="program_id" id="program_id" required>
              <option value="Doctorate">Doctorate</option>
              <option value="Masters">Masters</option>
              <option value="Bachelors">Bachelors</option>
            </select>
          </div>
      	<div class="form-group">
            <label for="profile_img">Profile Picture</label><br>
            <input type="file" name="profile_img" id="profile_img" class="form-control" required>
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