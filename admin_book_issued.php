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
    
  mysqli_query($con,"UPDATE books_issued set status ='received' WHERE id='" . $_GET['id'] . "'");
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
    if(mysqli_num_rows($result) > 0){
        echo "<table id='book_name' class='col-12 table table-bordered text-center table-hover'>";
          echo "<thead><tr>";
            echo "<th>Id</th>";
            echo "<th>Book Name</th>";
            echo "<th>Student Rollno</th>";
            echo "<th>Status</th>";
            echo "<th>Action</th>";
          echo "</tr></thead>";
        while($row = mysqli_fetch_array($result)){
          echo "<tbody><tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['book_name'] . "</td>";
            echo "<td>" . $row['rollno'] . "</td>";
            echo "<td><span class='badge badge-success'>" . $row['status'] . "</span></td>";
            echo "<td><a class='btn btn-sm btn-danger' href='admin_book_issued.php?id=".$row['id']."'>Receive book</a></td>";
          echo "</tr></tbody>";
        }
        echo "</table>";
        mysqli_free_result($result);
    } else{
        echo "<div class='text-center alert bg-dark text-white'>No Issued Books Found</div>";
  }}
    ?>
<script type="text/javascript">
    $('.confirmation').on('click', function () {
        return confirm('Are you sure to Delete?');
    });
</script>
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