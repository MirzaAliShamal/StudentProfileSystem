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

    <title>Library: Issue A Book</title>
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




<p>
<div class="card bg-white mt-5">
			<div class="card-body">
				<h4 class="card-title">Currently Available Books</h4>
				<p class="">
				<?php
	
		$sql = "SELECT * FROM books where issue=''";
if($result = mysqli_query($con, $sql)){
    if(mysqli_num_rows($result) > 0){
        echo "<table id='books' class='col-12 table text-center table-hover'>";
            echo "<thead><tr>";
                echo "<th>Book ID</th>";
                echo "<th>Book Name</th>";
                echo "<th>Author</th>";
				echo "<th>Category</th>";
				echo "<th>Publisher</th>";
				echo "<th>Issue</th>";
            echo "</tr></thead>";
        while($row = mysqli_fetch_array($result)){
            echo "<tr style='border: 1px solid black'>";
                echo "<td style='border: 1px solid black'>" . $row['id'] . "</td>";
                echo "<td style='border: 1px solid black'>" . $row['book_name'] . "</td>";
                echo "<td style='border: 1px solid black'>" . $row['author'] . "</td>";
				echo "<td style='border: 1px solid black'>" . $row['category'] . "</td>";
				echo "<td style='border: 1px solid black'>" . $row['publishers'] . "</td>";
				echo "<td style='border: 1px solid black'><a href='librarian_issue_book_confirm.php?id=".$row['id']."'>Issue</a></td>";
            echo "</tr>";
        }
        echo "</table>";
        mysqli_free_result($result);
    } else{
        echo "No records Found.";
	}}
		?>
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
        });
</script>
</body>
</html>