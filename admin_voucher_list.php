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
  
  <div class="col-lg-12 col-md-12 bg-white">      
  <p class="card-text">
  <?php
    $sql ="SELECT fee_voucher.*,programs.program,students.rollno FROM fee_voucher INNER JOIN programs ON programs.id=fee_voucher.program_id INNER JOIN students ON students.id = fee_voucher.student_id";
if($result = mysqli_query($con, $sql)){
    if(mysqli_num_rows($result) > 0){
        echo "<table id='fee_voucher' class='col-12 table table-bordered text-center table-hover'>";
          echo "<thead><tr>";
            echo "<th>Id</th>";
            echo "<th>Voucher No</th>";
            echo "<th>Roll No</th>";
            echo "<th>Amount</th>";
            echo "<th>Session</th>";
            echo "<th>Semester</th>";
            echo "<th>Action</th>";
          echo "</tr></thead>";
        while($row = mysqli_fetch_array($result)){
          echo "<tbody><tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['voucher_no'] . "</td>";
            echo "<td>" . $row['rollno'] . "</td>";
            echo "<td>" . $row['amount'] . "</td>";
            echo "<td>" . $row['session'] . "</td>";
            echo "<td>" . $row['semester'] . "</td>";
            echo "<td><a href='admin_voucher_edit.php?id=".$row['id']."'><i class='icofont-edit'></i></a> <a class='confirmation' href='admin_voucher_delete.php?id=".$row['id']."'><i class='icofont-trash'></i></a></td>";
          echo "</tr></tbody>";
        }
        echo "</table>";
        mysqli_free_result($result);
    } else{
        echo "<div class='text-center alert bg-dark text-white'>No Vouchers Found</div>";
  }}
    ?>
<script type="text/javascript">
    $('.confirmation').on('click', function () {
        return confirm('Are you sure to Delete?');
    });
</script>
<script>
$(document).ready(function() {
    $('#fee_voucher').DataTable();
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