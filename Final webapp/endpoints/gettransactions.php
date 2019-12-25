<?php
	include '../config.php';
	$debit = $_GET['debit'] ?? "true";
	$credit = $_GET['credit'] ?? "true";
	$mode = $_GET['mode'] ?? "cash-account";
	$fromdate = $_GET['fromdate'] ?? "2019-12-07";
	$todate = $_GET['todate'] ?? date("Y-m-d");
	$orderby = $_GET['orderby'] ?? "dot";
	$order = $_GET['order'] ?? "DESC";
	$category_ids = array();
	$get_all_category_id_query = "SELECT Category_ID FROM category";
	$get_all_category_id_result = mysqli_query($conn, $get_all_category_id_query);
	if($get_all_category_id_result){
		while ($row = mysqli_fetch_assoc($get_all_category_id_result)) {
			$category_ids[] = $row['Category_ID'];
		}
		$category_ids = join("-", $category_ids);
	}
	else{
		$return_json = array("status" => "unsuccessful", "statuscode" => 104, "message" => "Error while retreiving data from accounts table");
		$json_return_object = json_encode($return_json);
		print_r($json_return_object);
		return;
	}
	if(isset($_GET['category'])){
		$category = $_GET['category'];
		$get_category_id_query = "SELECT Category_ID FROM category WHERE Category_name = '$category'";
		$get_category_id_result = mysqli_query($conn, $get_category_id_query);
		if($get_category_id_result){
			if(mysqli_num_rows($get_category_id_result) > 0){
				$row = mysqli_fetch_assoc($get_category_id_result)['Category_ID'];
				$category = $row;
			}
			else{
				$return_json = array("status" => "unsuccessful", "statuscode" => 105, "message" => "Select from category table returned 0 rows");
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
	}
	else{
		$category = $category_ids;
	}

	$account = $_GET['account'] ?? "%";
	$get_main_account_no_query = "SELECT Account_no FROM accounts WHERE Name = 'Main Account'";
	$get_main_account_no_result = mysqli_query($conn, $get_main_account_no_query);
	if($get_main_account_no_result){
		if(mysqli_num_rows($get_main_account_no_result) > 0){
			$main_account_no = mysqli_fetch_assoc($get_main_account_no_result)['Account_no'];
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

	$base_query = "SELECT Transaction_ID AS Transaction_ID, From_acc AS `From`, To_acc AS `To`, Date_of_transaction AS `Date`, Category_name AS `Category`, Mode_of_payment AS `Mode`, Voucher_no AS `Voucher`, Amount AS `Amount`, Comments AS `Comments` FROM transaction NATURAL JOIN category WHERE (From_acc LIKE '$account' OR To_acc LIKE '$account') AND DATE(Date_of_transaction) BETWEEN '$fromdate' AND '$todate'";
	$generate_query = "";

	if($debit == "true" && $credit == "false")
		$generate_query .= "AND From_acc = '$main_account_no'";
	elseif($debit == "false" && $credit == "true")
		$generate_query .= "AND To_acc = '$main_account_no'";

	$mode_list = explode("-", $mode);
	if(in_array("cash", $mode_list) && !in_array("account", $mode_list))
		$generate_query .= " AND Mode_of_payment = 'Cash'";
	elseif(!in_array("cash", $mode_list) && in_array("account", $mode_list))
		$generate_query .= " AND Mode_of_payment = 'Account'";

	$categories = explode("-", $category);
	$generate_query .= " AND Category_ID IN ('".join("','", $categories)."')";
	$order_by_array = array("dot" => "Date_of_transaction", "catname" => "Category_name","trid" => "Transaction_ID");
	$orderby_value = $order_by_array[$orderby] ?? $order_by_array['dot'];
	$generate_query .= " ORDER BY ".$orderby_value." ".$order;	

	$get_transaction_details_query = $base_query.$generate_query;
	$get_transaction_details_result = mysqli_query($conn, $get_transaction_details_query);
	if($get_transaction_details_result){
		if(mysqli_num_rows($get_transaction_details_result) > 0){
			$data = array();
			while ($row = mysqli_fetch_assoc($get_transaction_details_result)) {
				$data[] = $row;
			}
			$return_json = array("status" => "successful", "statuscode" => 1, "message" => "got results successfully", "data" => $data);
			print_r(json_encode($return_json));
			return;
		}
		else{
			$return_json = array("status" => "unsuccessful", "statuscode" => 105, "message" => "Select from transaction table returned 0 rows");
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