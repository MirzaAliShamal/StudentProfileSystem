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
          <legend class="text-center">Enter Student Scholarship</legend>
          <div class="form-group">
            <label for="exampleInputEmail1">Student Roll No.</label>
            <select class="form-control" id="rollno" style="width: 100%;" name="student_id">
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
            $("#rollno").select2().select2();
            </script>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Scholarship</label>
            <select class="form-control" id="scholarship" style="width: 100%;" name="scholarship_id">
            <option>Select Scholorship</option>
            <?php
              $sql = "SELECT * FROM scholarships";
              if($result = mysqli_query($con, $sql)){
              if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_array($result)){
                        echo "<option value='". $row['id'] ."'>".$row['name']."</option>";
            }}}
            ?>
            </select>
            <script>
            $("#scholarship").select2().select2();
            </script>
          </div>
          <div class="form-group">
            <label for="amount">Amount</label>
            <input type="text" class="form-control"  name="amount" id="amount" placeholder="e.g 10000" required>
          </div>
      	    <div class="form-group">
            <label for="nature">Nature</label>
            <input type="text" class="form-control"  name="nature"  id="nature" placeholder="Nature" required>
          </div>
          <div class="form-group">
            <label for="session">Session</label>
            <input type="text" class="form-control"  name="session"  id="session" placeholder="e.g 2016-2020" required>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Program</label>
            <select class="form-control" id="programs" style="width: 100%;" name="program_id">
            <option>Select Scholorship</option>
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
            <label for="exampleInputEmail1">Semester</label>
            <select class="form-control" id="semester" style="width: 100%;" name="semester">
              <option>Select Scholorship</option>
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
            <label for="scholarship_img">Scholarship Image</label><br>
            <input type="file" name="scholarship_img" id="scholarship_img" class="form-control" required>
          </div>
          <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </fieldset>
      </form>

<?php 
if (isset($_POST["submit"])) {
	
  $student_id =  $_POST["student_id"];
	$scholarship_id =  $_POST["scholarship_id"];
  $amount =  $_POST["amount"];
	$nature =  $_POST["nature"];
	$session =  $_POST["session"];
	$program_id =  $_POST["program_id"];
  $semester =  $_POST["semester"];

  $result = mysqli_query($con,"SELECT * FROM students WHERE id='" . $student_id . "'");
  $student_data= mysqli_fetch_array($result);

  $result_s = mysqli_query($con,"SELECT * FROM scholarships WHERE id='" . $scholarship_id . "'");
  $scholarship_data= mysqli_fetch_array($result_s);

  $filename   = uniqid() ."-". $student_data['rollno'] . "-" .str_replace(' ', '-', $student_data['name']) . "-" .str_replace(' ', '-', $scholarship_data['name']) . "-scholarship_img";
  $extension  = pathinfo( $_FILES["scholarship_img"]["name"], PATHINFO_EXTENSION );
  $basename   = $filename . '.' . $extension;
  $source     = $_FILES["scholarship_img"]["tmp_name"];
  $destination= "images/scholarships/" . $basename;
	if(move_uploaded_file( $source, $destination )){
  	$msg = "Image uploaded successfully";
  }else{
		$msg = "Failed to upload image";
  }
	
  $sql = "INSERT INTO `student_scholarships`( `student_id`, `scholarship_id`, `amount`, `nature`, `session`, `program_id`, `semester`, `scholarship_img`) VALUES ('$student_id','$scholarship_id','$amount','$nature','$session','$program_id','$semester', '$basename')";
  $result = $con->query($sql);
  echo"<script>alert('Student Scholorship Added into system');</script>";
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