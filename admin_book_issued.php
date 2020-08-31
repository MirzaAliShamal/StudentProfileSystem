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

<?php 
if (isset($_GET["id"])) {
    
  $result = mysqli_query($con,"UPDATE books_issued set status ='received' WHERE id='" . $_GET['id'] . "'");

  $book_check = mysqli_query($con,"SELECT * FROM books_issued WHERE id='" . $_GET['id'] . "'");
  $book_check_row= mysqli_fetch_array($book_check);
  $book_id = $book_check_row['book_id'];

  $check = mysqli_query($con,"SELECT * FROM books WHERE id='" . $book_id . "'");
  $check_row= mysqli_fetch_array($check);
  $copies = $check_row['no_of_copies'];
  $copies = $copies + 1;
  $update = mysqli_query($con,"UPDATE books set no_of_copies = '" . $copies . "' WHERE id='" . $book_id . "'");
  
echo"<script>alert('Record Updated.!')
  location.replace('admin_book_issued.php')
</script>";
}
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
  
  <div class="col-lg-12 col-md-12 bg-white">      
  <p class="card-text">
  <?php
    $sql ="SELECT books_issued.*,books.book_name,students.rollno FROM books_issued INNER JOIN books ON books.id=books_issued.book_id INNER JOIN students ON students.id = books_issued.student_id WHERE books_issued.status='issued'";
if($result = mysqli_query($con, $sql)){
    if(mysqli_num_rows($result) > 0){ ?>
      <table id="book_name" class='col-12 table table-bordered text-center table-hover'>
        <thead>
          <tr>
            <th>Book Name</th>
            <th>Copy No</th>
            <th>Student Rollno</th>
            <th>Status</th>
            <th>Issued At</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php while($row = mysqli_fetch_array($result)){ ?>
            <tr>
              <td><?php echo $row['book_name']; ?></td>
              <td><?php echo $row['copy_no']; ?></td>
              <td><?php echo $row['rollno']; ?></td>
              <td><span class='badge badge-success'><?php echo $row['status']; ?></span></td>
              <td><?php echo $row['created_at']; ?></td>
              <td><a class="btn btn-sm btn-danger" href="admin_book_issued.php?id=<?php echo $row['id']; ?>">Receive book</a></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    <?php } else{
        echo "<div class='text-center alert bg-dark text-white'>No Issued Books Found</div>";
  }}
    ?>
<script>
$(document).ready(function() {
    $('#book_name').DataTable();
} );
</script>
    </p>
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