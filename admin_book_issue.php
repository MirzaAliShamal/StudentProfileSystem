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

    <title>Library: Issue A Book</title>
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
<form method="post" enctype="multipart/form-data">
  <fieldset>
    <legend class="text-center">Issue a Book</legend>
<?php

$result = mysqli_query($con,"SELECT * FROM books WHERE id='" . $_GET['id'] . "'");
$row= mysqli_fetch_array($result);
$rowcount=mysqli_num_rows($result);
	if($rowcount == 0){
		echo"<script>alert('No Record Found.!')
	location.replace('admin_book_list.php')
</script>";
	}
?>
	<div class="form-group">
		<div class="form-group">
		<label for="exampleInputEmail1">Book id</label>
		<input type="text" class="form-control"  name="id" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $row['id']; ?>" readonly required>
		</div>
		<div class="form-group">
		<label for="exampleInputEmail1">Book Name</label>
		<input type="text" class="form-control"  name="book_name" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $row['book_name']; ?>" readonly required>
		</div>
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
    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
  </fieldset>
</form>	

<?php 
if (isset($_POST["submit"])) {
	
	$book_id =  $_GET['id'];
	$student_id =  $_POST["student_id"];
	
  $sql = "INSERT INTO `books_issued`(`student_id`, `book_id`, `status`) VALUES ('$student_id','$book_id','issued')";
  $result = $con->query($sql);
  echo"<script>alert('Book Issued to the Student');</script>";
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