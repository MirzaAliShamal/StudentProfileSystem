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
			<div class="col-8 border bg-dark m-2 p-5 text-white">			
        <?php  
$result = mysqli_query($con,"SELECT * FROM results WHERE id='" . $_GET['id'] . "'");
$row= mysqli_fetch_array($result);
$rowcount=mysqli_num_rows($result);
  if($rowcount == 0){
    echo"<script>alert('No Record Found.!')
  location.replace('clerk_student_result_list.php')
</script>";
  }
?>
<form method="post" enctype="multipart/form-data">
  <fieldset>
    <legend class="text-center">Edit Student Result</legend>
    
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
			$("#semester").select2().select2();
		</script>
    </div>
            <?php  
$fail_res = mysqli_query($con,"SELECT course_code FROM failed_courses WHERE result_id='" . $_GET['id'] . "'");
$f_row= mysqli_fetch_array($fail_res);
$f_rowcount=mysqli_num_rows($fail_res);
  if($f_rowcount > 0){
    $failed_courses =  implode(", ",$f_row);
    ?>
    <div class="form-group">
        <label for="course_codes">Failed Courses (If any)</label>
        <input type="text" class="form-control" name="course_codes" value="<?php echo $failed_courses ?>" id="course_codes" placeholder="e.g. MT203, CS304">
    </div>
    <?php
  }else{
    ?>
    <div class="form-group">
        <label for="course_codes">Failed Courses (If any)</label>
        <input type="text" class="form-control" name="course_codes"  id="course_codes" placeholder="e.g. MT203, CS304">
    </div>
    <?php
  }
?>
    
    <div class="form-group">
      	<label for="GPA">GPA</label>
      	<input type="text" class="form-control" value="<?php echo $row['GPA'] ?>"  name="GPA" onKeyPress="if(this.value > 4 || this.value > 4.00) return false;"  id="GPA" placeholder="4.00" step="0.01" min="1.00" max="4.00" required>
    </div>
    <div class="form-group">
      	<label for="CGPA">CGPA</label>
      	<input type="text" class="form-control" value="<?php echo $row['CGPA'] ?>" name="CGPA" onKeyPress="if(this.value > 4 || this.value > 4.00) return false;"  id="CGPA" placeholder="4.00" step="0.01" min="1.00" max="4.00" required>
    </div>
    <div class="form-group">
      	<label for="PCGPA">PCGPA</label>
      	<input type="text" class="form-control" value="<?php echo $row['PCGPA'] ?>" name="PCGPA" onKeyPress="if(this.value > 4 || this.value > 4.00) return false;"  id="PCGPA" placeholder="4.00" step="0.01" min="1.00" max="4.00" required>
    </div>
    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
  </fieldset>
</form>	


<?php 
if (isset($_POST["submit"])) {
  $id = $_GET['id'];
  $student_id = $_POST['student_id'];
  $semester = $_POST['semester'];
  mysqli_query($con,"UPDATE results set student_id='" . $_POST['student_id'] . "', session='" . $_POST['session'] . "', program_id='" . $_POST['program_id'] . "',semester='" . $_POST['semester'] . "',GPA='" . $_POST['GPA'] . "',CGPA='" . $_POST['CGPA'] . "',PCGPA='" . $_POST['PCGPA'] . "' WHERE id='" . $_GET['id'] . "'");

	if ($_POST["course_codes"]) {
    $courses = explode(", ",$_POST["course_codes"]);

    if (count($courses) != count(array_unique($courses))) {
      echo "<script>alert('Error, You have entered same failed course more than 1 time');</script>";
    } else {
      $check_fail = mysqli_query($con,"SELECT * FROM failed_courses WHERE result_id='" . $_GET['id'] . "'");
      $check_fail_count=mysqli_num_rows($fail_res);
      if ($check_fail_count > 0) {
        mysqli_query($con,"DELETE FROM failed_courses WHERE result_id = '" . $_GET['id'] . "'");

        foreach ($courses as $value) {
        $sql = "INSERT INTO `failed_courses`( `student_id`, `result_id`, `semester`, `course_code`) VALUES ('$student_id', '$id', '$semester','$value')";
          $result = $con->query($sql);
        }
      } else {
        foreach ($courses as $value) {
        $sql = "INSERT INTO `failed_courses`( `student_id`, `result_id`, `semester`, `course_code`) VALUES ('$student_id', '$id', '$semester','$value')";
          $result = $con->query($sql);
        }
      }
    } 
  }

   echo"<script>alert('Record Updated.!')
          location.replace('clerk_student_result_list.php')
        </script>";
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