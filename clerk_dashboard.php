<?php
session_start();
	if ($_SESSION['user'] != 'User1'){
		header('location:index.php');

	}
?> 
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Dashboard: Admissions</title>
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
		<div class="col-1"></div>
		<div class="col-10">	
			<div class="card  bg-white mb-3">
			<div class="card-header">Dashboard: Admission Department</div>
				<div class="card-body">
				<h4 class="card-title text-center">Currently Enrolled Students are:</h4>
				<p class="">
				<h2 class="text-center">
<?php
	$result = mysqli_query($con, "SELECT COUNT(*) AS `count` FROM `Students`");
	$row = mysqli_fetch_assoc($result);
	$count = $row['count'];
	echo $count;
?>
				</h2>
				<p>
						<h3>Doctorate Students are : <b>
						<?php
							$result = mysqli_query($con, "SELECT COUNT(*) AS `count` FROM `Students` where degree='Doctorate'");
							$row = mysqli_fetch_assoc($result);
							$count = $row['count'];
							echo $count;
						?></b></h3><br>
						<h3>Masters Students are:<b>
						<?php
							$result = mysqli_query($con, "SELECT COUNT(*) AS `count` FROM `Students` where degree='Masters'");
							$row = mysqli_fetch_assoc($result);
							$count = $row['count'];
							echo $count;
						?></b></h3><br>
						<h3>Bachelors Students are :<b>
						<?php
							$result = mysqli_query($con, "SELECT COUNT(*) AS `count` FROM `Students` where degree='Bachelors'");
							$row = mysqli_fetch_assoc($result);
							$count = $row['count'];
							echo $count;
						?></b></h3>
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