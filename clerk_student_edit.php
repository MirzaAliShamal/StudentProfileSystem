<?php
session_start();
  if ($_SESSION['user'] != 'Clerk'){
    header('location:index.php');

  }
?> 
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Dashboard: Clerk</title>
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
<?php  
$result = mysqli_query($con,"SELECT * FROM students WHERE id='" . $_GET['id'] . "'");
$row= mysqli_fetch_array($result);
$rowcount=mysqli_num_rows($result);
  if($rowcount == 0){
    echo"<script>alert('No Record Found.!')
  location.replace('clerk_student_list.php')
</script>";
  }
?>
      <form method="post" enctype="multipart/form-data">
        <fieldset>
          <legend class="text-center">Add a Student</legend>
          <div class="form-group">
            <label for="rollno">Alloted Roll No.</label>
            <input type="text"  class="form-control"  name="rollno" value="<?php echo $row['rollno']; ?>" id="rollno" placeholder="Alloted Roll No." maxlength="15" required>
          </div>
          <div class="form-group">
            <label for="name">Student Name</label>
            <input type="text" class="form-control"  name="name" value="<?php echo $row['name']; ?>" id="name" placeholder="Student Name" required>
          </div>
      	    <div class="form-group">
            <label for="father_name">Father Name</label>
            <input type="text" class="form-control"  name="father_name" value="<?php echo $row['father_name']; ?>"id="father_name" placeholder="Father Name" required>
          </div>
          <div class="form-group">
            <label for="cnic">CNIC</label>
            <input type="text" class="form-control"  name="cnic" value="<?php echo $row['cnic']; ?>"id="cnic" placeholder="36302-1111111-2" maxlength="15" required>
          </div>
          <div class="form-group">
            <label for="dob">DOB</label>
            <div id="datepicker" class="input-group date" data-date-format="dd/mm/yyyy">
              <input class="form-control" value="<?php echo $row['dob']; ?>" name='dob'/>
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
            <input type="text" class="form-control"  name="contact_number" value="<?php echo $row['contact_number']; ?>"id="contact_number" maxlength="11" placeholder='Contact Number' required>
          </div>
      	<div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" name="address" value="<?php echo $row['address']; ?>"id="address" placeholder="Address" required>
          </div>
      	<div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email" value="<?php echo $row['email']; ?>" placeholder="Email" required>
          </div>
          <fieldset class="form-group">
            <legend>Gender</legend>
            <div class="form-check">
              <label for="male" class="form-check-label">
                <input type="radio" class="form-check-input" name="gender" id="male" value="male" <?php if($row['gender'] == "male"){?> checked <?php } ?>>
               Male
              </label>
            </div>
            <div class="form-check">
            <label for="female" class="form-check-label">
                <input type="radio" class="form-check-input" name="gender" id="female" value="female" <?php if($row['gender'] == "female"){?> checked <?php } ?>>
                Female
              </label>
            </div>
            <div class="form-check disabled">
            <label for="other" class="form-check-label">
                <input type="radio" class="form-check-input" name="gender" id="other" value="other" <?php if($row['gender'] == "other"){?> checked <?php } ?>>
              Other
              </label>
            </div>
          </fieldset>
          <div class="form-group">
            <label for="session">Session</label>
            <input type="text" class="form-control"  name="session" value="<?php echo $row['session']; ?>"id="session" placeholder='e.g. 2016-2020' required>
          </div>
          <div class="form-group">
            <label for="program_id">Program</label>
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
          </div>
          <div class="form-group">
            <img src="images/<?php echo $row['profile_img']; ?>" class="img-fluid" width="100"><br>
            <label for="profile_img">Profile Picture</label><br>
            <input type="file" name="profile_img" id="profile_img" class="form-control">
          </div>
          <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </fieldset>
      </form>

<?php 
if (isset($_POST["submit"])) {

	$roll_val_sql = "SELECT * FROM students WHERE rollno='" . $_POST['rollno'] . "' AND id != '" . $_GET['id'] . "'";
	$roll_val_result = $con->query($roll_val_sql);
	$rollcount = mysqli_num_rows($roll_val_result);

	$email_val_sql = "SELECT * FROM students WHERE email='" . $_POST['email'] . "' AND id != '" . $_GET['id'] . "'";
	$email_val_result = $con->query($email_val_sql);
	$emailcount = mysqli_num_rows($email_val_result);

	if ($rollcount > 0) {
    	echo"<script>alert('Student Rollno already registered into system');</script>";
	} elseif($rollcount > 0) {
	    echo"<script>alert('Student Email already registered into system');</script>";
	} else {
		if ($_FILES["profile_img"]["size"]>0) {
	      $filePath = "images/" . $row['profile_img'];

	      $filename   = uniqid() ."-". $_POST['rollno'] . "-" .str_replace(' ', '-', $_POST['name']) . "-profile_img";
	      $extension  = pathinfo( $_FILES["profile_img"]["name"], PATHINFO_EXTENSION );
	      $basename   = $filename . '.' . $extension;
	      $source     = $_FILES["profile_img"]["tmp_name"];
	      $destination= "images/" . $basename;
	      if(move_uploaded_file( $source, $destination )){

	        if (file_exists($filePath)) {
	          unlink($filePath);
	          
	        } else {
	          echo "File does not exists"; 
	        }

	        mysqli_query($con,"UPDATE students set name='" . $_POST['name'] . "', father_name='" . $_POST['father_name'] . "', rollno='" . $_POST['rollno'] . "', cnic='" . $_POST['cnic'] . "' ,dob='" . $_POST['dob'] . "',address='" . $_POST['address'] . "',contact_number='" . $_POST['contact_number'] . "',email='" . $_POST['email'] . "', gender='" . $_POST['gender'] . "', session='" . $_POST['session'] . "', program_id='" . $_POST['program_id'] . "', profile_img='" . $basename . "' WHERE id='" . $_GET['id'] . "'");
	        echo"<script>alert('Record Updated.!')
	          location.replace('clerk_student_list.php')
	        </script>";
	      }else{
	        $msg = "Failed to upload image";
	      }
		  } 
		  else {
		    mysqli_query($con,"UPDATE students set name='" . $_POST['name'] . "', father_name='" . $_POST['father_name'] . "', rollno='" . $_POST['rollno'] . "', cnic='" . $_POST['cnic'] . "' ,dob='" . $_POST['dob'] . "',address='" . $_POST['address'] . "',contact_number='" . $_POST['contact_number'] . "',email='" . $_POST['email'] . "', gender='" . $_POST['gender'] . "', session='" . $_POST['session'] . "', program_id='" . $_POST['program_id'] . "' WHERE id='" . $_GET['id'] . "'");
		      echo"<script>alert('Record Updated.!')
		        location.replace('clerk_student_list.php')
		      </script>";
		  }

	}
  
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