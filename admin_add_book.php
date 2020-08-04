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

    <title>Library: Add New Book</title>
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
    <legend class="text-center">Add a Book</legend>
	<div class="form-group">
      <label for="exampleInputEmail1">Book Name</label>
      <input type="text" class="form-control"  name="book_name" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Book Name" required>
    </div>
	<div class="form-group">
      <label for="exampleInputEmail1">Author</label>
      <input type="text" class="form-control"  name="author"  id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Author Name" required>
    </div>
	<div class="form-group">
		<label for="exampleInputEmail1">Category</label>
		<select class="form-control" id="category" style="width: 100%;" name="category">
		<?php
			$sql = "SELECT * FROM books_category";
			if($result = mysqli_query($con, $sql)){
			if(mysqli_num_rows($result) > 0){
				while($row = mysqli_fetch_array($result)){
                echo "<option value='". $row['category'] ."'>".$row['category']."</option>";
		}}}
		?>
		</select>
		<script>
		$("#category").select2().select2();
		</script>
    </div>
	<div class="form-group">
      <label for="exampleInputEmail1">Publishers</label>
      <input type="text"  class="form-control"  name="publishers"  id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Publishers Name"  required>
    </div>
    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
  </fieldset>
</form>	


<?php 
if (isset($_POST["submit"])) {
	
	$book_name =  $_POST["book_name"];
	$auhtor =  $_POST["author"];
	$category =  $_POST["category"];
	$publishers =  $_POST["publishers"];
	
  $sql = "INSERT INTO `books`( `book_name`, `author`, `category`, `publishers`) VALUES ('$book_name','$auhtor','$category','$publishers')";
  $result = $con->query($sql);
  echo"<script>alert('New Book Added into Library');</script>";
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