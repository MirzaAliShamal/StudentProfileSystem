<?php
session_start();
	if ($_SESSION['user'] != 'Accountant'){
		header('location:index.php');

	}
?> 
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Dashboard: Accounts Section</title>
	<?php 
	include"system/fileslink.php";
	?>
</head>

<body style="background-image: url('assets/img/logo.png'); background-attachment: fixed;">
    <div class="wrapper">
        <!-- Sidebar  -->
        <?php 
      include"navs/accounts_nav.php";
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
    if(mysqli_num_rows($result) > 0){ ?>
        <table id="fee_voucher" class="col-12 table table-bordered text-center table-hover">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Voucher No</th>
                    <th>Roll No</th>
                    <th>Amount</th>
                    <th>Session</th>
                    <th>Semester</th>
                    <th>Issue Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_array($result)){ ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['voucher_no']; ?></td>
                        <td><?php echo $row['rollno']; ?></td>
                        <td><?php echo $row['amount']; ?></td>
                        <td><?php echo $row['session']; ?></td>
                        <td><?php echo $row['semester']; ?></td>
                        <td><?php echo $row['issue_date']; ?></td>
                        <td>
                            <a href="accountant_voucher_edit.php?id=<?php echo $row['id']; ?>"><i class='icofont-edit'></i></a>
                            <a class='confirmation' href="accountant_voucher_delete.php?id=<?php echo $row['id']; ?>"><i class='icofont-trash'></i></a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else{
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