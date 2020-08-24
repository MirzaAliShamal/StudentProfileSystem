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
			<div class="row container-fluid ml-1">
				
				<div class="card col-lg-6 col-xs-6 bg-white text-center rounded">
					<div class="card-body">
						Number of Students
						<h1>
						<?php
								$result = mysqli_query($con, "SELECT COUNT(*) AS `count` FROM `students");
								$row = mysqli_fetch_assoc($result);
								$count = $row['count'];
								echo $count;
							?>
						</h1>
					</div>
				</div>
				
				<div class="card col-lg-6 col-xs-6 bg-white text-center rounded">
					<div class="card-body">
						Number of Vouchers
						<h1>
						<?php
								$result = mysqli_query($con, "SELECT COUNT(*) AS COUNTS from fee_voucher");
								$row = mysqli_fetch_assoc($result);
								$count = $row['COUNTS'];
								echo $count;
							?>
						</h1>
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
			
		</div> 
    </div>
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
	            url: 'accountant_ajax.php?id='+optionSelected,
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