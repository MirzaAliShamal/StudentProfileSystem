<?php
	include"system/dbconfig.php";

	if (isset($_GET['id'])) {
		$id = $_GET['id'];

		$students = mysqli_query($con, "SELECT students.*,programs.program FROM students INNER JOIN programs ON programs.id=students.program_id WHERE students.id='" . $id . "'");

		$student_scholarships = mysqli_query($con, "SELECT student_scholarships.*,scholarships.name FROM student_scholarships INNER JOIN scholarships ON scholarships.id=student_scholarships.scholarship_id WHERE student_scholarships.student_id='" . $id . "'");

		$results = mysqli_query($con, "SELECT * FROM results WHERE student_id='" . $id . "'");

		$fee_voucher = mysqli_query($con, "SELECT * FROM fee_voucher WHERE student_id='" . $id . "'");

		$failed_courses = mysqli_query($con, "SELECT * FROM failed_courses WHERE student_id='" . $id . "'");

		$books_issued = mysqli_query($con, "SELECT books_issued.*,books.book_name FROM books_issued INNER JOIN books ON books.id=books_issued.book_id WHERE books_issued.student_id='" . $id . "' AND books_issued.status='issued'");

		$html = '';
		while($row = mysqli_fetch_array($students)){
			$html = '
				<div class="col-12 pt-3 bg-white">
					<div class="text-center"><img id="profilepic" class="img-fluid" src="images/' . $row["profile_img"] . '" ></div>
					<div class="row">
						<div class="col-6">
							<div class="row">
								<div class="col-6"><b>Roll No:</b></div>
								<div class="col-6">' . $row["rollno"] . '</div>
							</div>
							<div class="row">
								<div class="col-6"><b>CNIC:</b></div>
								<div class="col-6">' . $row["cnic"] . '</div>
							</div>
							<div class="row">
								<div class="col-6"><b>Session:</b></div>
								<div class="col-6">' . $row["session"] . '</div>
							</div>
							<div class="row">
								<div class="col-6"><b>DOB:</b></div>
								<div class="col-6">' . $row["dob"] . '</div>
							</div>
							<div class="row">
								<div class="col-6"><b>Email:</b></div>
								<div class="col-6">' . $row["email"] . '</div>
							</div>
							<div class="row">
								<div class="col-6"><b>Gender:</b></div>
								<div class="col-6">' . $row["gender"] . '</div>
							</div>
						</div>
						<div class="col-6">
							<div class="row">
								<div class="col-6"><b>Name:</b></div>
								<div class="col-6">' . $row["name"] . '</div>
							</div>
							<div class="row">
								<div class="col-6"><b>Father Name:</b></div>
								<div class="col-6">' . $row["father_name"] . '</div>
							</div>
							<div class="row">
								<div class="col-6"><b>Program:</b></div>
								<div class="col-6">' . $row["program"] . '</div>
							</div>
							<div class="row">
								<div class="col-6"><b>Contact Number:</b></div>
								<div class="col-6">' . $row["contact_number"] . '</div>
							</div>
							<div class="row">
								<div class="col-6"><b>Address:</b></div>
								<div class="col-6">' . $row["address"] . '</div>
							</div>
						</div>
					</div>
				</div>
			';
		}
		if(mysqli_num_rows($student_scholarships) > 0){
			$html.= '
				<div class="col-6 pt-3 bg-white">
					<h4>Scholarships</h4>
					<div class="table-responsive">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>Scholarship</th>
									<th>Amount</th>
									<th>Semester</th>
								</tr>
							</thead>
							<tbody>';
							while($row = mysqli_fetch_array($student_scholarships)){
							$html.='
								<tr>
									<td>' . $row["name"] . '</td>
									<td>' . $row["amount"] . '</td>
									<td>' . $row["semester"] . '</td>
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
				<div class="col-6 pt-3 bg-white">
					<h4>No Scholarships</h4>
				</div>
			';
		}

		if(mysqli_num_rows($results) > 0){
			$html.= '
				<div class="col-6 pt-3 bg-white">
					<h4>Results</h4>
					<div class="table-responsive">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>Semester</th>
									<th>GPA</th>
									<th>CGPA</th>
									<th>PCGPA</th>
								</tr>
							</thead>
							<tbody>';
							while($row = mysqli_fetch_array($results)){
							$html.='
								<tr>
									<td>' . $row["semester"] . '</td>
									<td>' . $row["GPA"] . '</td>
									<td>' . $row["CGPA"] . '</td>
									<td>' . $row["PCGPA"] . '</td>
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
				<div class="col-6 pt-3 bg-white">
					<h4>No Results</h4>
				</div>
			';
		}
		
		if(mysqli_num_rows($fee_voucher) > 0){
			$html.= '
				<div class="col-6 pt-3 bg-white">
					<h4>Fee Vouchers</h4>
					<div class="table-responsive">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>Voucher No</th>
									<th>Semester</th>
									<th>Amount</th>
								</tr>
							</thead>
							<tbody>';
							while($row = mysqli_fetch_array($fee_voucher)){
							$html.='
								<tr>
									<td>' . $row["voucher_no"] . '</td>
									<td>' . $row["semester"] . '</td>
									<td>' . $row["amount"] . '</td>
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
				<div class="col-6 pt-3 bg-white">
					<h4>No Fee Vouchers</h4>
				</div>
			';
		}
		if(mysqli_num_rows($failed_courses) > 0){
			$html.= '
				<div class="col-6 pt-3 bg-white">
					<h4>Failed Courses</h4>
					<div class="table-responsive">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>Course Code</th>
									<th>Semester</th>
								</tr>
							</thead>
							<tbody>';
							while($row = mysqli_fetch_array($failed_courses)){
							$html.='
								<tr>
									<td>' . $row["course_code"] . '</td>
									<td>' . $row["semester"] . '</td>
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
				<div class="col-6 pt-3 bg-white">
					<h4>No Failed Courses</h4>
				</div>
			';
		}

		if(mysqli_num_rows($books_issued) > 0){
			$html.= '
				<div class="col-6 pt-3 bg-white">
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
				<div class="col-6 pt-3 bg-white">
					<h4>No Books Issued</h4>
				</div>
			';
		}
		

		echo json_encode($html);
	}

?>