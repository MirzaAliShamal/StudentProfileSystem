<?php
session_start();
	if ($_SESSION['user'] != 'Librarian'){
		header('location:index.php');

	}
?> 
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Dashboard: Library</title>
	<?php 
	include"system/fileslink.php";
	?>
</head>

<body style="background-image: url('assets/img/logo.png'); background-attachment: fixed;">
    <div class="wrapper">
        <!-- Sidebar  -->
        <?php 
			include"navs/librarian_nav.php";
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
	<div class="card bg-white mt-5">
	<div class="row">
	<div class="col-2 c0l-md-2"></div>
	<div class="col-md-8 col-lg-8 bg-dark text-white p-5 rounded">			
	<p class="card-text">
	<h3 class="text-center">Edit Student Profile</h3>
	<?php
	if(count($_POST)>0) {
mysqli_query($con,"UPDATE books set book_name='" . $_POST['book_name'] . "', author='" . $_POST['author'] . "', category='" . $_POST['category'] . "', publishers='" . $_POST['publishers'] . "'  WHERE id='" . $_GET['id'] . "'");
echo"<script>alert('Record Updated.!')
	location.replace('librarian_dashboard.php')
</script>";
}
$result = mysqli_query($con,"SELECT * FROM books WHERE id='" . $_GET['id'] . "'");
$row= mysqli_fetch_array($result);
$rowcount=mysqli_num_rows($result);
	if($rowcount == 0){
		echo"<script>alert('No Book Found.!')
	location.replace('librarian_dashboard.php')
</script>";
	}

?>
				<div class="row">
			<div class="col-2"></div>
			<div class="col-8 bg-dark text-white p-5">			
<form method="post" enctype="multipart/form-data">
  <fieldset>
    <legend class="text-center">Edit Book</legend>
    <div class="form-group">
      <label for="exampleInputEmail1">Book ID</label>
      <input type="text" class="form-control"  name="id" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $row['id']; ?>" readonly="readonly" required>
    </div>
	    <div class="form-group">
      <label for="exampleInputEmail1">Book Name</label>
      <input type="text" class="form-control"  name="book_name"  id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $row['book_name']; ?>" required>
    </div>
	<div class="form-group">
      <label for="exampleInputEmail1">Author</label>
      <input type="text"  class="form-control"  name="author"  id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $row['author']; ?>"  >
    </div>
	<div class="form-group">
      <label for="exampleInputEmail1">Category</label>
      <input type="text"  class="form-control"  name="category"  id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $row['category']; ?>"  required>
    </div>
	<label for="exampleInputEmail1">Publishers</label>
	<div id="datepicker" class="input-group date" data-date-format="yyyy-mm-dd">
    <input type="text"  class="form-control"  name="publishers"  id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $row['publishers']; ?>"  required>
    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
	</div><br>
    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
  </fieldset>
</form>
</div>
</div>
	</p>
			</div>
			</div>
	</div> 
        </div>
	</div>
<script type="text/javascript">
    $('.confirmation').on('click', function () {
        return confirm('Are you sure?');
    });
</script>
<script>
$(document).ready(function() {
    $('#books').DataTable();
} );
</script>
				      
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