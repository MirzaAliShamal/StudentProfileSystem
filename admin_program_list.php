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
    $sql ="SELECT * FROM programs";
if($result = mysqli_query($con, $sql)){
    if(mysqli_num_rows($result) > 0){ ?>
      <table id='programs' class='col-12 table table-bordered text-center table-hover'>
        <thead>
          <tr>
            <th>ID</th>
            <th>Progam</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php while($row = mysqli_fetch_array($result)){ ?>
            <tr>
              <td><?php echo $row['id']; ?></td>
              <td><?php echo $row['program']; ?></td>
              <td>
                <a href="admin_program_edit.php?id=<?php echo $row['id']; ?>"><i class='icofont-edit'></i></a>
                <a class='confirmation' href="admin_program_delete.php?id=<?php echo $row['id']; ?>"><i class='icofont-trash'></i></a>
              </td>
            </tr>
          <?php } ?>
    <?php } else{
        echo "<div class='text-center alert bg-dark text-white'>No Programs Found</div>";
  }}
    ?>
<script type="text/javascript">
    $('.confirmation').on('click', function () {
        return confirm('Are you sure to Delete?');
    });
</script>
<script>
$(document).ready(function() {
    $('#programs').DataTable();
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