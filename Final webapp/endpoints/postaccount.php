<?php
	include '../config.php';
	if($_POST['submit']){
		date_default_timezone_set("Asia/Kolkata");
		$type = $_POST['type'] ?? "NULL";
		$acc_name = $_POST['acc_name'] ?? "NULL";
		$acc_email = $_POST['acc_email'] ?? "NULL";
		$acc_phone = $_POST['acc_phone'] ?? "NULL";
		$acc_ini_amount = $_POST['acc_ini_amount'] ?? "0";
		$acc_flat_no = $_POST['acc_flat_no'] ?? "NULL";
		$acc_block_no = $_POST['acc_block_no'] ?? "NULL";
		$ini_date = date('d-m-Y H:i:s');

		$random_num = rand(10000, 99999);
		$account_no = "ARA".$random_num;
		$res_rows = mysqli_num_rows(mysqli_query($conn, "SELECT *FROM accounts WHERE Account_no = '$account_no'"));
		while($res_rows != 0){
			$random_num = rand(10000, 99999);
			$account_no = "ARA".$random_num;
			$res_rows = mysqli_num_rows(mysqli_query($conn, "SELECT *FROM accounts WHERE Account_no = '$account_no'"));
		}
		$acc_type_id = mysqli_fetch_assoc(mysqli_query($conn, "SELECT Type_ID FROM account_type WHERE Type_name = '$type'"))['Type_ID'] ?? "NULL";
		if($acc_name != "NULL" && $acc_type_id != "NULL" && $type != "NULL"){
			$details_query = "INSERT INTO details(Name, Block, Flat_no, Phone, Email) VALUES('$acc_name', '$acc_block_no', '$acc_flat_no', '$acc_phone', '$acc_email')";
			$details_res = mysqli_query($conn, $details_query);
			if($details_res){
				$details_id = mysqli_insert_id($conn);
				$accounts_query = "INSERT INTO accounts(Name, Init_date, Balance, Details_ID, Type_ID) VALUES ('$acc_name', '$ini_date' , '$acc_ini_amount', '$details_id', '$acc_type_id')";
				$accounts_res = mysqli_query($conn, $accounts_query);
				if($accounts_res){
					echo "true";
				}
				else{
					echo "false";
				}
			}
			else{
				echo "false";
			}
		}
		else{
			echo "false";
		}
	}
	else{
		echo "false";
	}
?>