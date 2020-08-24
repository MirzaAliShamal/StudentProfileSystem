<?php
session_start();
    if ($_SESSION['user'] != 'Clerk'){
        header('location:index.php');

    }
?> 
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Dashboard: Clerk</title>
    <?php 
    include"system/fileslink.php";
    ?>
</head>

<body style="background-image: url('assets/img/logo.png'); background-attachment: fixed;">
    <div class="wrapper">
        <!-- Sidebar  -->
        <?php 
            include"navs/clerk_nav.php";
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
    $sql ="SELECT student_scholarships.*,scholarships.name,students.rollno FROM student_scholarships INNER JOIN scholarships ON scholarships.id=student_scholarships.scholarship_id INNER JOIN students ON students.id = student_scholarships.student_id";
if($result = mysqli_query($con, $sql)){
    if(mysqli_num_rows($result) > 0){ ?>
        <table id="scholarships" class='col-12 table table-bordered text-center table-hover'>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Rollno</th>
                    <th>Scholarship</th>
                    <th>Amount</th>
                    <th>Session</th>
                    <th>Semester</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_array($result)){ ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['rollno']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['amount']; ?></td>
                        <td><?php echo $row['session']; ?></td>
                        <td><?php echo $row['semester']; ?></td>
                        <td>
                            <a href="clerk_student_scholarship_view.php?id=<?php echo $row['id']; ?>"><i class='icofont-eye'></i></a>
                            <a href="clerk_student_scholarship_edit.php?id=<?php echo $row['id']; ?>"><i class='icofont-edit'></i></a>
                            <a class='confirmation' href="clerk_student_scholarship_delete.php?id=<?php echo $row['id']; ?>"><i class='icofont-trash'></i></a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
    <?php } else{
        echo "<div class='text-center alert bg-dark text-white'>No Scholarships Found</div>";
  }}
    ?>
<script type="text/javascript">
    $('.confirmation').on('click', function () {
        return confirm('Are you sure to Delete?');
    });
</script>
<script>
$(document).ready(function() {
    $('#scholarships').DataTable();
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