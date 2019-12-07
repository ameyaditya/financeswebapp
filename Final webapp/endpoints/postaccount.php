<?php
	include '../config.php';
	if(isset($_POST['submit'])){
		date_default_timezone_set("Asia/Kolkata");
		$type = $_POST['type'] ?? "NULL";
		$acc_name = $_POST['acc_name'] ?? "NULL";
		$acc_email = $_POST['acc_email'] ?? "NULL";
		$acc_phone = $_POST['acc_phone'] ?? "NULL";
		$acc_ini_amount = $_POST['acc_ini_amount'] ?? "0";
		$acc_flat_no = $_POST['acc_flat_no'] ?? "NULL";
		$acc_block_no = $_POST['acc_block_no'] ?? "NULL";
		$ini_date = date('Y-m-d H:i:s');
		$acc_block_no = strtoupper($acc_block_no);
		$acc_flat_no = strtoupper($acc_flat_no);
		$random_num = rand(10000, 99999);
		$account_no = "ARA".$random_num;
		$select_account_no_query = "SELECT *FROM accounts WHERE Account_no = '$account_no'";
		$select_account_no_result = mysqli_query($conn, $select_account_no_query);
		if($select_account_no_result){
			$res_rows = mysqli_num_rows($select_account_no_result);
		}
		else{
			$return_json = array("status" => "unsuccessful", "statuscode" => 104, "message" => "Error while retreiving data from accounts table");
			$json_return_object = json_encode($return_json);
			print_r($json_return_object);
			return;
		}
		while($res_rows != 0){
			$random_num = rand(10000, 99999);
			$account_no = "ARA".$random_num;
			$select_account_no_query = "SELECT *FROM accounts WHERE Account_no = '$account_no'";
			$select_account_no_result = mysqli_query($conn, $select_account_no_query);
			if($select_account_no_result){
				$res_rows = mysqli_num_rows($select_account_no_result);
			}
			else{
				$return_json = array("status" => "unsuccessful", "statuscode" => 104, "message" => "Error while retreiving data from accounts table");
				$json_return_object = json_encode($return_json);
				print_r($json_return_object);
				return;
			}
		}
		$acc_type_id = mysqli_fetch_assoc(mysqli_query($conn, "SELECT Type_ID FROM account_type WHERE Type_name = '$type'"))['Type_ID'] ?? "NULL";
		if($acc_name != "NULL" && $acc_type_id != "NULL" && $type != "NULL"){
			$details_query = "INSERT INTO details(Name, Block, Flat_no, Phone, Email) VALUES('$acc_name', NULLIF('$acc_block_no', 'NULL'), NULLIF('$acc_flat_no', 'NULL'), NULLIF('$acc_phone', 'NULL'), NULLIF('$acc_email', 'NULL'))";
			$details_res = mysqli_query($conn, $details_query);
			if($details_res){
				$details_id = mysqli_insert_id($conn);
				$accounts_query = "INSERT INTO accounts(Account_no, Name, Init_date, Balance, Details_ID, Type_ID) VALUES ('$account_no', '$acc_name', '$ini_date' , '$acc_ini_amount', '$details_id', '$acc_type_id')";
				$accounts_res = mysqli_query($conn, $accounts_query);
				if($accounts_res){
					$return_result = array("account_no" => $account_no, "name" => $acc_name, "email" => $acc_email, "phone" => $acc_phone, "type" => $type, "flat_no" => $acc_flat_no, "block_no" => $acc_block_no);
					$return_json = array("status" => "success", "statuscode" => 1, "message" => "Successfully created account", "data" => $return_result);
					$json_return_object = json_encode($return_json);
					print_r($json_return_object);
				}
				else{
					$return_json = array("status" => "unsuccessful", "statuscode" => 101, "message" => "Error while inserting data into accounts table in database");
					$json_return_object = json_encode($return_json);
					print_r($json_return_object);
				}
			}
			else{
				$return_json = array("status" => "unsuccessful", "statuscode" => 101, "message" => "Error while inserting data into details table in database");
				$json_return_object = json_encode($return_json);
				print_r($json_return_object);
			}
		}
		else{
			$return_json = array("status" => "unsuccessful", "statuscode" => 102, "message" => "Null values given as input");
			$json_return_object = json_encode($return_json);
			print_r($json_return_object);
		}
	}
	else{
		$return_json = array("status" => "unsuccessful", "statuscode" => 103, "message" => "Post request not made");
		$json_return_object = json_encode($return_json);
		print_r($json_return_object);
	}
?>