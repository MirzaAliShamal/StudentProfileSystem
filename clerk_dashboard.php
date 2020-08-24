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
		<div class="col-1"></div>
		<div class="col-10">	
			<div class="card  bg-white mb-3">
			<div class="card-header">Dashboard: Admission Department</div>
				<div class="card-body">
				<h4 class="card-title text-center">Currently Enrolled Students are:</h4>
				<p class="">
				<h2 class="text-center">
					<?php
						$result = mysqli_query($con, "SELECT COUNT(*) AS `count` FROM `students`");
						$row = mysqli_fetch_assoc($result);
						$count = $row['count'];
						echo $count;
					?>
				</h2>
				</div>
			</div>
        </div>
    </div>

    		<div class="row container-fluid mt-5">
				<div class="col-12 bg-white pt-1 pb-4">			
					<p class="card-text ">
					<h2 class="text-center">Search Student Record</h2>

					<div class="form-group">
						<select class="form-control" id="student_id" style="width: 100%;" name="student_id">
						<option value="" selected disabled>Search Student Roll no</option>
						<?php
							$sql = "SELECT * FROM students";
							if($result = mysqli_query($con, $sql)){
							if(mysqli_num_rows($result) > 0){
								while($row = mysqli_fetch_array($result)){
				                echo "<option value='". $row['id'] ."'>".$row['rollno']."</option>";
						}}}
						?>
						</select>
						<script>
						$("#student_id").select2().select2();
						</script>
				    </div>
				</div>
			</div>

			<div class="row container-fluid mt-5 ajax-load">
				
			</div>
	
<script type="text/javascript">
	$(document).ready(function () {
		$('#sidebarCollapse').on('click', function () {
			$('#sidebar').toggleClass('active');
		});

		$('select').on('change', function (e) {
		    var optionSelected = $(this).find("option:selected").val();
		    $.ajax({
	            type: "GET",
	            url: 'clerk_ajax.php?id='+optionSelected,
	            success: function(response)
	            {
	                var jsonData = JSON.parse(response);

	                $('.ajax-load').html(jsonData);
	                console.log(jsonData);
	           }
	       });
		});
	});
</script>
</body>
</html>