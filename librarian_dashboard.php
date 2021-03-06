<?php
session_start();
	if ($_SESSION['user'] != 'Librarian'){
		header('location:index.php');

	}
?> 
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Dashboard: Library</title>
	<?php 
	include"system/fileslink.php";
	?>
</head>

<body style="background-image: url('assets/img/logo.png'); background-attachment: fixed;">
    <div class="wrapper">
        <!-- Sidebar  -->
        <?php 
			include"navs/librarian_nav.php";
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
					Total Books
					<h1>
					<?php
							$total_books = mysqli_query($con, "SELECT COUNT(*) AS `count` FROM `books");
							$row = mysqli_fetch_assoc($total_books);
							$ans1 = $row['count'];
							echo $ans1;
						?>
					</h1>
				</div>
			</div>
			
			<div class="card col-lg-6 col-xs-6 bg-white text-center rounded">
				<div class="card-body">
					Books Issued
					<h1>
					<?php
							$stock = mysqli_query($con, "SELECT COUNT(*) as issued FROM books_issued where status = 'issued'");
							$row = mysqli_fetch_assoc($stock);
							$ans2 = $row['issued'];
							echo $ans2;
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

<script>
$(document).ready(function() {
    $('#books').DataTable();
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

		$('select').on('change', function (e) {
		    var optionSelected = $(this).find("option:selected").val();
		    $.ajax({
	            type: "GET",
	            url: 'librarian_ajax.php?id='+optionSelected,
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