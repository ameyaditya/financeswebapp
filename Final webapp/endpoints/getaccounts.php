<?php
	include '../config.php';
	$resident = $_GET['resident'] ?? "false";
	$payment = $_GET['payment'] ?? "false";
	$expense = $_GET['expense'] ?? "false";
	$block = $_GET['block'] ?? "A-B-C";
	$account_no = $_GET['account'] ?? "false";
	
	if($account_no != "false"){
		$get_account_details_query = "SELECT a.Account_no AS Account_No, a.Name AS Name, a.Balance AS Balance, at.Type_name AS Account_Type, d.Block AS Block, d.Flat_no AS Flat_No, d.Phone AS Phone_No, d.Email AS Email_ID FROM accounts a, account_type at, details d WHERE a.Type_ID = at.Type_ID AND a.Details_ID = d.Details_ID AND a.Account_no = '$account_no'";
	}
	else{
		$generate_query = "";
		if($resident == "true"){
			$generate_query = $generate_query." OR Type_name = 'Resident'";
			$block_list = explode("-", $block);
			$generate_query = $generate_query." AND Block IN ('".join("','", $block_list)."')";
		}
		if($payment == "true"){
			$generate_query = $generate_query." OR Type_name = 'Payment'";
		}
		if($expense == "true"){
			$generate_query = $generate_query." OR Type_name = 'Expense'";
		}
		$get_account_details_query = "SELECT Account_no AS Account_No, accounts.Name AS Name, Balance AS Balance, Type_name AS Account_Type, Block AS Block, Flat_no AS Flat_No, Phone AS Phone_No, Email AS Email_ID FROM accounts NATURAL JOIN account_type NATURAL JOIN details WHERE";
		$generate_query = ltrim($generate_query, " OR");
		$get_account_details_query = $get_account_details_query." ".$generate_query;
	}
	$get_account_details_query .= "ORDER BY Block, Flat_no";
	$get_account_details_result = mysqli_query($conn, $get_account_details_query);
	if($get_account_details_result){
		if(mysqli_num_rows($get_account_details_result) > 0){
			$data = array();
			while($row = mysqli_fetch_assoc($get_account_details_result)){
				$data[] = $row;
			}
			$return_json = array("status" => "successful", "statuscode" => 1, "message" => "got results successfully", "data" => $data);
			print_r(json_encode($return_json));
			return;
		}
		else{
			$return_json = array("status" => "unsuccessful", "statuscode" => 105, "message" => "Select from accounts table returned 0 rows");
			$json_return_object = json_encode($return_json);
			print_r($json_return_object);
			return;
		}
	}
	else{
		$return_json = array("status" => "unsuccessful", "statuscode" => 104, "message" => "Error while retreiving data from accounts table");
		$json_return_object = json_encode($return_json);
		print_r($json_return_object);
		return;
	}
?>