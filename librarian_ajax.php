<?php
	include"system/dbconfig.php";

	if (isset($_GET['id'])) {
		$id = $_GET['id'];

		$books_issued = mysqli_query($con, "SELECT books_issued.*,books.book_name FROM books_issued INNER JOIN books ON books.id=books_issued.book_id WHERE books_issued.student_id='" . $id . "' AND books_issued.status='issued'");

		$html = '';

		if(mysqli_num_rows($books_issued) > 0){
			$html.= '
				<div class="col-12 pt-3 bg-white">
					<h4>Issued Books</h4>
					<div class="table-responsive">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>Book</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>';
							while($row = mysqli_fetch_array($books_issued)){
							$html.='
								<tr>
									<td>' . $row["book_name"] . '</td>
									<td><span class="badge badge-success">issued</span></td>
								</tr>';
							}
							$html.='
							</tbody>
						</table>
					</div>
				</div>
			';
		}else{
			$html.= '
				<div class="col-12 pt-3 bg-white">
					<h4>No Books Issued</h4>
				</div>
			';
		}
		

		echo json_encode($html);
	}

?>