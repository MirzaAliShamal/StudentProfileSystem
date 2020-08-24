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
			<div class="row">
			<div class="col-2"></div>
			<div class="col-8 bg-dark text-white p-5">			
      <form method="post" enctype="multipart/form-data">
        <fieldset>
          <legend class="text-center">Add a Book</legend>
          <div class="form-group">
            <label for="book_name">Book Name</label>
            <input type="text"  class="form-control"  name="book_name"  id="book_name" placeholder="e.g. Harry Potter and the deathly hallows" required>
          </div>
          <div class="form-group">
            <label for="author">Author</label>
            <input type="text"  class="form-control"  name="author"  id="author" placeholder="e.g. J.K Rowling" required>
          </div>
          <div class="form-group">
            <label for="book_category_id">Book Category</label>
            <select class="form-control" id="book_category_id" name="book_category_id" required>
              <option value="" selected disabled>Select Book Category</option>
              <?php 
                $result = mysqli_query($con, "SELECT * FROM book_categories");
                while($row = mysqli_fetch_array($result)){
                  echo "<option value='".$row['id']."'>" . $row['category'] . "</option>";
                }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label for="copies">No of Copies</label>
            <input type="number"  class="form-control"  name="copies"  id="copies" placeholder="e.g. 1" required>
          </div>
          <div class="form-group">
            <label for="publishers">Publishers</label>
            <input type="text"  class="form-control"  name="publishers"  id="publishers" placeholder="e.g. J.K Rowling" required>
          </div>
          <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </fieldset>
      </form>

<?php 
if (isset($_POST["submit"])) {
	
  $book_name =  $_POST["book_name"];
  $author =  $_POST["author"];
  $book_category_id =  $_POST["book_category_id"];
  $copies =  $_POST["copies"];
  $publishers =  $_POST["publishers"];

  $validation_sql = "SELECT * FROM books WHERE book_name = '" . $book_name . "'";
  $validation_result = mysqli_query($con, $validation_sql);
  if (mysqli_num_rows($validation_result) > 0) {
    echo"<script>alert('Book Already Exists!');</script>";
  } else{
    $sql = "INSERT INTO `books`(`book_name`, `author`, `book_category_id`, `copies`, `publishers`) VALUES ('$book_name','$author','$book_category_id','$copies','$publishers')";
    $result = $con->query($sql);
    echo"<script>alert('Book Added into system');</script>";
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