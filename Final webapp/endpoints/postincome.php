<?php
	include '../config.php';
	if(isset($_POST['submit'])){
		date_default_timezone_set("Asia/Kolkata");
		$block_flat_no = $_POST['flat_no'] ?? "NULL";
		$income_category = $_POST['income_category'] ?? "NULL";
		$mode_of_payment = $_POST['mode'] ?? "NULL";
		$amount = $_POST['amount'] ?? "NULL";
		$comments = $_POST['comments'] ?? "NULL";
		$two_thousand = $_POST['tt'] ?? "0";
		$five_hundred = $_POST['fh'] ?? "0";
		$two_hundred = $_POST['th'] ?? "0";
		$one_hundred = $_POST['oh'] ?? "0";
		$fifty = $_POST['fi'] ?? "0";
		$twenty = $_POST['tw'] ?? "0";
		$ten = $_POST['te'] ?? "0";
		$five = $_POST['fe'] ?? "0";
		$two = $_POST['to'] ?? "0";
		$one = $_POST['on'] ?? "0";

		if($block_flat_no == "NULL" && $income_category == "NULL" && $mode_of_payment == "NULL" && $amount == "NULL" && $comments == "NULL"){
			$return_json = array("status" => "unsuccessful", "statuscode" => 102, "message" => "Null values given as input");
			$json_return_object = json_encode($return_json);
			print_r($json_return_object);
			return;
		}

		$date_of_transaction = date('Y-m-d H:i:s');
		
		$year = date("Y");
		$voucher_no_query = "SELECT Voucher_no FROM transaction WHERE Transaction_ID = (SELECT MAX(t1.Transaction_ID) FROM transaction t1) AND Voucher_no LIKE '$year%'";
		$voucher_no_result = mysqli_query($conn, $voucher_no_query);
		if($voucher_no_result){
			if(mysqli_num_rows($voucher_no_result) > 0){
				$latest_voucher_no = explode("-", mysqli_fetch_assoc($voucher_no_result)['Voucher_no'])[1];
				$voucher_no = (int)$latest_voucher_no + 1;
				$voucher_no = $year."-".$voucher_no;
			}
			else{
				$voucher_no = $year.'-1';
			}
		}
		else{
			$return_json = array("status" => "unsuccessful", "statuscode" => 104, "message" => "Error while retreiving data from transaction table");
			$json_return_object = json_encode($return_json);
			print_r($json_return_object);
			return;
		}

		if($mode_of_payment == "Cash"){
			$amount_in_deno = (int)$two_thousand * 2000 + (int)$five_hundred * 500 + (int)$two_hundred * 200 + (int)$one_hundred * 100 + (int)$fifty * 50 + (int)$twenty * 20 + (int)$ten * 10 + (int)$five * 5 + (int)$two * 2 + (int)$one * 1;
			if($amount_in_deno != $amount){
				$return_json = array("status" => "unsuccessful", "statuscode" => 106, "message" => "Inconsistent data entered");
				$json_return_object = json_encode($return_json);
				print_r($json_return_object);
				return;
			}

		}

		$block_no = explode("-", $block_flat_no)[0];
		$flat_no = explode("-", $block_flat_no)[1];
		$get_from_account_no_query = "SELECT a.Account_no FROM accounts a, details d WHERE d.Details_ID = a.Details_ID AND d.Block = '$block_no' AND d.flat_no = '$flat_no' AND a.deleted = 0";
		$get_from_account_no_result = mysqli_query($conn, $get_from_account_no_query);
		if($get_from_account_no_result){
			if(mysqli_num_rows($get_from_account_no_result) > 0){
				$from_account_no = mysqli_fetch_assoc($get_from_account_no_result)['Account_no'];
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

		$get_category_id_query = "SELECT Category_ID FROM category WHERE Category_name = '$income_category' AND Type = 'Income'";
		$get_category_id_result = mysqli_query($conn, $get_category_id_query);
		if($get_category_id_result){
			if(mysqli_num_rows($get_category_id_result) > 0){
				$income_category_id = mysqli_fetch_assoc($get_category_id_result)['Category_ID'];
			}
			else{
				$return_json = array("status" => "unsuccessful", "statuscode" => 105, "message" => "Select from category table returned 0 rows");
				$json_return_object = json_encode($return_json);
				print_r($json_return_object);
				return;
			}
		}
		else{
			$return_json = array("status" => "unsuccessful", "statuscode" => 104, "message" => "Error while retreiving data from category table");
			$json_return_object = json_encode($return_json);
			print_r($json_return_object);
			return;
		}
		if($income_category != "Income - Resident Share"){
			$update_resident_balance_query = "UPDATE accounts SET Balance = Balance + $amount WHERE Account_no = '$from_account_no'";
			$update_resident_balance_result = mysqli_query($conn, $update_resident_balance_query);
			if($update_resident_balance_result){

			}
			else{
				$return_json = array("status" => "unsuccessful", "statuscode" => 107, "message" => "Error while updating data in accounts table in database");
				$json_return_object = json_encode($return_json);
				print_r($json_return_object);
				return;
			}

		}
		if($mode_of_payment == "Cash"){
			$denominations_insert_query = "INSERT INTO denominations(`2000`, `500`, `200`, `100`, `50`, `20`, `10`, `5`, `2`, `1`) VALUES('$two_thousand', '$five_hundred', '$two_hundred', '$one_hundred', '$fifty', '$twenty', '$ten', '$five', '$two', '$one')";
			$denominations_insert_result = mysqli_query($conn, $denominations_insert_query);
			if($denominations_insert_result){
				$denominations_id = mysqli_insert_id($conn);
				$update_recon_query = "UPDATE recon SET `2000` = `2000` + '$two_thousand', `500` = `500` + '$five_hundred', `200` = `200` + '$two_hundred', `100` = `100` + '$one_hundred', `50` = `50` + '$fifty', `20` = `20` + '$twenty', `10` = `10` + '$ten', `5` = `5` + '$five', `2` = `2` + '$two', `1` = `1` + '$one' WHERE Recon_ID = 1";
				$update_recon_result = mysqli_query($conn, $update_recon_query);
				if($update_recon_result){

				}
				else{
					$return_json = array("status" => "unsuccessful", "statuscode" => 107, "message" => "Error while updating data in recon table in database");
					$json_return_object = json_encode($return_json);
					print_r($json_return_object);
					return;
				}
			}
			else{
				$return_json = array("status" => "unsuccessful", "statuscode" => 101, "message" => "Error while inserting data into denominations table in database");
					$json_return_object = json_encode($return_json);
					print_r($json_return_object);
				return;
			}
		}
		else{
			$denominations_id = "NULL";
		}
		$to_account_no = "ARAMAIN1";

		$insert_transaction_query = "INSERT INTO transaction(From_acc, To_acc, Date_of_transaction, Category_ID, Mode_of_payment, Deno_ID, Voucher_no, Amount, Comments) VALUES('$from_account_no', '$to_account_no', '$date_of_transaction', '$income_category_id', '$mode_of_payment' , NULLIF('$denominations_id', 'NULL'), '$voucher_no', '$amount', '$comments')";
		$insert_transaction_result = mysqli_query($conn, $insert_transaction_query);
		if($insert_transaction_result){
			$transaction_id = mysqli_insert_id($conn);
			$return_result = array("transaction_id" => $transaction_id, "from_account" => $from_account_no, "to_account" => $to_account_no, "amount" => $amount, "category" => $income_category, "mode" => $mode_of_payment, "voucher_no" => $voucher_no, "comments" => $comments);
			$return_json = array("status" => "successful", "statuscode" => 1, "message" => "Transcation logged successfully", "data" => $return_result);
			$return_json_object = json_encode($return_json);
			print_r($return_json_object);
		}
		else{
			$return_json = array("status" => "unsuccessful", "statuscode" => 101, "message" => "Error while inserting data into transaction table in database");
					$json_return_object = json_encode($return_json);
					print_r($json_return_object);
			return;
		}
	}
	else{
		$return_json = array("status" => "unsuccessful", "statuscode" => 103, "message" => "Post request not made");
		$json_return_object = json_encode($return_json);
		print_r($json_return_object);
		return;
	}
?>