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

    <title>Library: Add New Category</title>
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
<div class="row">
			<div class="col-lg-4"></div>
			<div class="col-lg-4 border bg-dark m-2 p-5 text-white">
			
<form method="post" enctype="multipart/form-data">
  <fieldset>
    <legend class="text-center">Add New Book Category</legend>
    
	<div class="form-group">
      <input type="text" class="form-control"  name="category" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Name New Category" required>
    </div>
	
    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
  </fieldset>
</form>	


<?php 
if (isset($_POST["submit"])) {
	
	$category =  $_POST["category"];
	
  $sql = "INSERT INTO `books_category`( `category`) VALUES ('$category')";
  $result = $con->query($sql);
  echo"<script>alert('New Category Added in Library');</script>";
}
?>
</div>
</div>
<div class="row">
			<div class="col-lg-2"></div>
			<div class="col-lg-8 border bg-white m-2 p-5">
			<h3 class="text-center">Available Books Categories</h3>
			<?php 

  $sql = "SELECT * FROM books_category`";
if($result = mysqli_query($con, $sql)){
    if(mysqli_num_rows($result) > 0){
        echo "<table id='books' class='col-12 table text-center table-hover'>";
            echo "<thead><tr>";
                echo "<th>Categories</th>";
                echo "<th>Delete</th>";
            echo "</tr></thead>";
        while($row = mysqli_fetch_array($result)){
            echo "<tr style='border: 1px solid black'>";
				echo "<td style='border: 1px solid black'>" . $row['category'] . "</td>";
				echo "<td style='border: 1px solid black'><a href='delete_category.php?category=".$row['category']."' class='confirmation'>Delete</a></td>";
            echo "</tr>";
        }
        echo "</table>";
        mysqli_free_result($result);
    } else{
        echo "No records Found.";
	}}
?>
			</div>
</div>


</div>
</div>
<script type="text/javascript">
    $('.confirmation').on('click', function () {
        return confirm('Are you sure?');
    });
</script>	
<script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
</script>
</body>
</html>