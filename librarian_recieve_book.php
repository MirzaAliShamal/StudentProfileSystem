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

    <title>Library: Recieve Book</title>
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
<div class="row">
			<div class=""></div>
			<div class="col-12 bg-white">			
<h3 class="text-center">Issued Books Log</h3>
			<?php
	
		$sql = "SELECT * FROM books where issue!=''";
if($result = mysqli_query($con, $sql)){
    if(mysqli_num_rows($result) > 0){
        echo "<table id='bookissue' class='col-12 table text-center'>";
            echo "<thead><tr>";
                echo "<th>Roll No.</th>";
                echo "<th>Book ID</th>";
                echo "<th>Book Name</th>";
				echo "<th>Author</th>";
				echo "<th>Category</th>";
				echo "<th>Recieve</th>";
            echo "</tr></thead>";
        while($row = mysqli_fetch_array($result)){
            echo "<tr style='border: 1px solid black'>";
                echo "<td style='border: 1px solid black'>" . $row['issue'] . "</td>";
                echo "<td style='border: 1px solid black'>" . $row['id'] . "</td>";
                echo "<td style='border: 1px solid black'>" . $row['book_name'] . "</td>";
				echo "<td style='border: 1px solid black'>" . $row['author'] . "</td>";
				echo "<td style='border: 1px solid black'>" . $row['category'] . "</td>";
				echo "<td style='border: 1px solid black'><a class='confirmation'href='book_recieved.php?id=".$row['id']."'>Click if Recieved</a></td>";
            echo "</tr>";
        }
        echo "</table>";
        mysqli_free_result($result);
    } else{
        echo "<div class='alert alert-warning text-center'>No Book Issued at this Time.</div>";
	}}
		?>
<script type="text/javascript">
    $('.confirmation').on('click', function () {
        return confirm('Are you sure?');
    });
</script>
<script>
$(document).ready(function() {
    $('#bookissue').DataTable();
} );
</script>
				
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