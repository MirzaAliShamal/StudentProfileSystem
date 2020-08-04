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

    <title>Dashboard: Search Student</title>
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
	<div class=""></div>
	<div class="col-md-12 col-lg-12 bg-white p-5">			
	<p >
	<?php
	
		$sql = "SELECT * FROM users";
if($result = mysqli_query($con, $sql)){
    if(mysqli_num_rows($result) > 0){
        echo "<table id='students' class='col-12 table  text-center bg-white p-5'>";
            echo "<thead><tr>";			
                echo "<th>id</th>";
                echo "<th>username</th>";
                echo "<th>password</th>";
                echo "<th>Role</th>";
				echo "<th>Delete</th>";	
            echo "</tr></thead>";
        while($row = mysqli_fetch_array($result)){
            echo "<tr style='border: 1px solid black'>";
                echo "<td style='border: 1px solid black'>" . $row['id'] . "</td>";
                echo "<td style='border: 1px solid black'>" . $row['username'] . "</td>";
                echo "<td style='border: 1px solid black'>" . $row['password'] . "</td>";
                echo "<td style='border: 1px solid black'>" . $row['role'] . "</td>";
				echo "<td style='border: 1px solid black'><a href='admin_delete_user_click.php?id=".$row['id']."' class='confirmation'>Delete</a></td>";
            echo "</tr>";
        }
        echo "</table>";
        mysqli_free_result($result);
    } else{
        echo "<div class='text-center'>No records Found.</div>";
	}}
		?>
<script type="text/javascript">
    $('.confirmation').on('click', function () {
        return confirm('Are you sure?');
    });
</script>
<script>
$(document).ready(function() {
    $('#students').DataTable();
} );
</script>

</p>
	</div>


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