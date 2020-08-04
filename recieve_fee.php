<?php
include "system/dbconfig.php";

$voucher_no = $_GET['voucher_no'];

$sql = "UPDATE `fee_vouchers` SET `paid`='Yes' WHERE voucher_no = '$voucher_no'";
if($result = mysqli_query($con, $sql)){
    if($result > 0){
	header('Location: accounts_dashboard.php');}
	}
$conn->close();
?>