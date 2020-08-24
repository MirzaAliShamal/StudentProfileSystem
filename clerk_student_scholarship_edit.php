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
$result = mysqli_query($con,"SELECT * FROM student_scholarships WHERE id='" . $_GET['id'] . "'");
$row= mysqli_fetch_array($result);
$rowcount=mysqli_num_rows($result);
  if($rowcount == 0){
    echo"<script>alert('No Record Found.!')
  location.replace('clerk_student_scholarship_list.php')
</script>";
  }
?>		
      <form method="post" enctype="multipart/form-data">
        <fieldset>
          <legend class="text-center">Enter Student Scholarship</legend>
          <div class="form-group">
            <label for="exampleInputEmail1">Student Roll No.</label>
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
            $("#rollno").select2().select2();
            </script>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Scholarship</label>
            <select class="form-control" id="scholarship" style="width: 100%;" name="scholarship_id">
            <option value="" selected disabled>Select Scholarship</option>
              <?php 
                $result = mysqli_query($con, "SELECT * FROM scholarships");
                while($schol = mysqli_fetch_array($result)){
              ?>
                <option value="<?php echo $schol['id'] ?>" <?php if($schol['id'] == $row['scholarship_id']){?> selected <?php } ?>> <?php echo $schol['name'] ?> </option>
              <?php   }
              ?>
            </select>
            <script>
            $("#scholarship").select2().select2();
            </script>
          </div>
          <div class="form-group">
            <label for="amount">Amount</label>
            <input type="text" class="form-control" value="<?php echo $row['amount'] ?>" name="amount" id="amount" placeholder="e.g 10000" required>
          </div>
      	    <div class="form-group">
            <label for="nature">Nature</label>
            <input type="text" class="form-control" value="<?php echo $row['nature'] ?>" name="nature"  id="nature" placeholder="Nature" required>
          </div>
          <div class="form-group">
            <label for="session">Session</label>
            <input type="text" class="form-control" value="<?php echo $row['session'] ?>" name="session"  id="session" placeholder="e.g 2016-2020" required>
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
            <label for="exampleInputEmail1">Semester</label>
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
            $("#semester").select2().select2();
            </script>
          </div>
      	  <div class="form-group">
            <img src="images/scholarships/<?php echo $row['scholarship_img']; ?>" class="img-fluid" width="250"><br>
            <label for="scholarship_img">Scholarship Image</label><br>
            <input type="file" name="scholarship_img" id="scholarship_img" class="form-control">
          </div>
          <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </fieldset>
      </form>

<?php 
if (isset($_POST["submit"])) {

  if ($_FILES["scholarship_img"]["size"]>0) {

    $filePath = "images/scholarships/" . $row['scholarship_img'];

    $result = mysqli_query($con,"SELECT * FROM students WHERE id='" . $_POST['student_id'] . "'");
      $student_data= mysqli_fetch_array($result);

      $result_s = mysqli_query($con,"SELECT * FROM scholarships WHERE id='" . $_POST['scholarship_id'] . "'");
      $scholarship_data= mysqli_fetch_array($result_s);

      $filename   = uniqid() ."-". $student_data['rollno'] . "-" .str_replace(' ', '-', $student_data['name']) . "-" .str_replace(' ', '-', $scholarship_data['name']) . "-scholarship_img";
      $extension  = pathinfo( $_FILES["scholarship_img"]["name"], PATHINFO_EXTENSION );
      $basename   = $filename . '.' . $extension;
      $source     = $_FILES["scholarship_img"]["tmp_name"];
      $destination= "images/scholarships/" . $basename;

      if(move_uploaded_file( $source, $destination )){
          if (file_exists($filePath)) {
            unlink($filePath);
          } else {
            echo "File does not exists"; 
          }

        mysqli_query($con,"UPDATE student_scholarships set student_id='" . $_POST['student_id'] . "', scholarship_id='" . $_POST['scholarship_id'] . "', amount='" . $_POST['amount'] . "', nature='" . $_POST['nature'] . "' ,session='" . $_POST['session'] . "',program_id='" . $_POST['program_id'] . "',semester='" . $_POST['semester'] . "', scholarship_img='" . $basename . "' WHERE id='" . $_GET['id'] . "'");
        echo"<script>alert('Record Updated.!')
          location.replace('clerk_student_scholarship_list.php')
        </script>";
      }else{
        $msg = "Failed to upload image";
      }
  } else {
    mysqli_query($con,"UPDATE student_scholarships set student_id='" . $_POST['student_id'] . "', scholarship_id='" . $_POST['scholarship_id'] . "', amount='" . $_POST['amount'] . "', nature='" . $_POST['nature'] . "' ,session='" . $_POST['session'] . "',program_id='" . $_POST['program_id'] . "',semester='" . $_POST['semester'] . "' WHERE id='" . $_GET['id'] . "'");
        echo"<script>alert('Record Updated.!')
          location.replace('clerk_student_scholarship_list.php')
        </script>";
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