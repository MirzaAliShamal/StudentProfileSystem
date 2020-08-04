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
<?php 
  $id = $_GET['id'];
  $result = mysqli_query($con,"SELECT * FROM book_categories WHERE id='" . $id . "'");
  $row= mysqli_fetch_array($result);
  $rowcount=mysqli_num_rows($result);
  if($rowcount == 0){
    echo"<script>alert('No Record Found.!')
      location.replace('admin_dashboard.php')
    </script>";
  }
?>
      <form method="post" enctype="multipart/form-data">
        <fieldset>
          <legend class="text-center">Edit a Book category</legend>
          <div class="form-group">
            <label for="program">Category</label>
            <input type="text" class="form-control" name="category" id="category" placeholder="e.g. Novel" maxlength="15" value="<?php echo $row['category']; ?>" required>
          </div>
          <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </fieldset>
      </form>

<?php 
if (isset($_POST["submit"])) {
	$id = $_GET['id'];
	$category =  $_POST["category"];
  $sql = "UPDATE book_categories set category='" . $category . "' WHERE id='" . $id . "'";
  $result = $con->query($sql);
  echo"<script>alert('Record Updated.!')
  location.replace('admin_book_category_list.php')
</script>";
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