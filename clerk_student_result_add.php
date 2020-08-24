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
<form method="post" enctype="multipart/form-data">
  <fieldset>
    <legend class="text-center">Add Student Result</legend>
    
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
      	<label for="course_codes">Failed Courses (If any)</label>
      	<input type="text" class="form-control"  name="course_codes"  id="course_codes" placeholder="e.g. MT203, CS304">
    </div>
    <div class="form-group">
      	<label for="GPA">GPA</label>
      	<input type="number" class="form-control" name="GPA" onKeyPress="if(this.value > 4 || this.value > 4.00) return false;" id="GPA" placeholder="4.00" step="0.01" min="1.00" max="4.00" required>
    </div>
    <div class="form-group">
      	<label for="CGPA">CGPA</label>
      	<input type="number" class="form-control"  name="CGPA" onKeyPress="if(this.value > 4 || this.value > 4.00) return false;" id="CGPA" placeholder="4.00" step="0.01" min="1.00" max="4.00" required>
    </div>
    <div class="form-group">
      	<label for="PCGPA">PCGPA</label>
      	<input type="number" class="form-control"  name="PCGPA" onKeyPress="if(this.value > 4 || this.value > 4.00) return false;" id="PCGPA" placeholder="4.00" step="0.01" min="1.00" max="4.00" required>
    </div>
    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
  </fieldset>
</form>	


<?php 
if (isset($_POST["submit"])) {
	$student_id =  $_POST["student_id"];
	$session =  $_POST["session"];
	$program_id =  $_POST["program_id"];
	$semester =  $_POST["semester"];
	$GPA =  $_POST["GPA"];
	$CGPA =  $_POST["CGPA"];
	$PCGPA =  $_POST["PCGPA"];

  if ($GPA > 4 || $GPA > 4.0) {
    echo"<script>alert('Error, GPA can not be greater than 4.0');</script>";
  } elseif ($CGPA > 4 || $CGPA > 4.0) {
    echo"<script>alert('Error, CGPA can not be greater than 4.0');</script>";
  } elseif ($PCGPA > 4 || $PCGPA > 4.0) {
    echo"<script>alert('Error, PCGPA can not be greater than 4.0');</script>";
  } else {
    $validation_sql = "SELECT * FROM results WHERE student_id = '" . $student_id . "' AND semester = '" . $semester . "'";
    $validation_result = mysqli_query($con, $validation_sql);
    if(mysqli_num_rows($validation_result) > 0){
      echo"<script>alert('Result of this semester Already Exists!');</script>";
    }else{
        if ($_POST["course_codes"]) {
          $check_count = 0;

          $courses = explode(", ",$_POST["course_codes"]);

          foreach ($courses as $check) {
            $val_codes_sql = "SELECT * FROM failed_courses WHERE course_code = '" . $check . "' AND student_id = '" . $student_id . "'";
            $val_codes_result = mysqli_query($con, $val_codes_sql);
            if(mysqli_num_rows($val_codes_result) > 0){
              $check_count++;
            }
          }

          if ($check_count > 0) {
            echo"<script>alert('Sorry, Same failed courses in two different semesters are not allowed');</script>";
          } else {
            if (count($courses) != count(array_unique($courses))) {
              echo "<script>alert('Error, You have entered same failed course more than 1 time');</script>";
            } else {
              $sql = "INSERT INTO `results`( `student_id`, `session`, `program_id`, `semester`, `GPA`, `CGPA`, `PCGPA`) VALUES ('$student_id', '$session','$program_id','$semester','$GPA','$CGPA','$PCGPA')";
              $result = $con->query($sql);

              $last_id = $con->insert_id;

              foreach ($courses as $value) {
                $sql = "INSERT INTO `failed_courses`( `student_id`, `result_id`, `semester`, `course_code`) VALUES ('$student_id', '$last_id', '$semester','$value')";
                $result = $con->query($sql);
              echo"<script>alert('Result Added.');</script>";
              }
            }  
          }
               
        }
        else{
          $sql = "INSERT INTO `results`( `student_id`, `session`, `program_id`, `semester`, `GPA`, `CGPA`, `PCGPA`) VALUES ('$student_id', '$session','$program_id','$semester','$GPA','$CGPA','$PCGPA')";
          $result = $con->query($sql);

          $last_id = $con->insert_id;
          echo"<script>alert('Result Added.');</script>";
        }
        
    }
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