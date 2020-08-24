<?php
	include"system/dbconfig.php";

	if (isset($_GET['id'])) {
		$id = $_GET['id'];

		$fee_voucher = mysqli_query($con, "SELECT * FROM fee_voucher WHERE student_id='" . $id . "'");

		$html = '';
		
		if(mysqli_num_rows($fee_voucher) > 0){
			$html.= '
				<div class="col-12 pt-3 bg-white">
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
				<div class="col-12 pt-3 bg-white">
					<h4>No Fee Vouchers</h4>
				</div>
			';
		}

		echo json_encode($html);
	}

?>