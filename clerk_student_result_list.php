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
    $sql ="SELECT results.*,programs.program,students.rollno FROM results INNER JOIN programs ON programs.id=results.program_id INNER JOIN students ON students.id = results.student_id";
if($result = mysqli_query($con, $sql)){
    if(mysqli_num_rows($result) > 0){ ?>
        <table id="results" class='col-12 table table-bordered text-center table-hover'>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Roll No</th>
                    <th>Session</th>
                    <th>Semester</th>
                    <th>GPA</th>
                    <th>CGPA</th>
                    <th>PCGPA</th>
                    <th>Failed Subjects</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_array($result)){ ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['rollno']; ?></td>
                        <td><?php echo $row['session']; ?></td>
                        <td><?php echo $row['semester']; ?></td>
                        <td><?php echo $row['GPA']; ?></td>
                        <td><?php echo $row['CGPA']; ?></td>
                        <td><?php echo $row['PCGPA']; ?></td>
                        <td>
                            <?php $fail_res = mysqli_query($con,"SELECT * FROM failed_courses WHERE result_id='" . $row['id'] . "'"); ?>
                            <?php $f_rowcount=mysqli_num_rows($fail_res); ?>
                            <?php if ($f_rowcount > 0) { ?>
                                <ul>
                                    <?php while($f_row = mysqli_fetch_array($fail_res)){ ?>
                                    <li><?php echo $f_row['course_code']; ?></li>
                                    <?php } ?>
                                </ul>
                            <?php } else { ?>
                                No Failed Course
                            <?php } ?>
                        </td>
                        <td>
                            <a href="clerk_student_result_edit.php?id=<?php echo $row['id'] ?>"><i class='icofont-edit'></i></a> 
                            <a class='confirmation' href="clerk_student_result_delete.php?id=<?php echo $row['id']; ?>"><i class='icofont-trash'></i></a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php    }
     } else{
        echo "<div class='text-center alert bg-dark text-white'>No Vouchers Found</div>";
  }
    ?>
<script type="text/javascript">
    $('.confirmation').on('click', function () {
        return confirm('Are you sure to Delete?');
    });
</script>
<script>
$(document).ready(function() {
    $('#results').DataTable();
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