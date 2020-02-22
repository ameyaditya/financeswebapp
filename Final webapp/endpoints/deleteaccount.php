<?php
    include '../config.php';
    if(isset($_POST['submit'])){
        $accountno = $_POST['accountno'] ?? "NULL";
        $password = $_POST['delpassword'] ?? "NULL";
        $accountno = strtoupper($accountno);
        $select_account_no_query = "SELECT *FROM accounts WHERE Account_no = '$accountno' AND deleted=0";
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
        if($res_rows == 0){
            $return_json = array("status" => "unsuccessful", "statuscode" => 110, "message" => "Account no doesn't Exists");
			$json_return_object = json_encode($return_json);
			print_r($json_return_object);
			return;   
        }
        if($password != '9449649410'){
            $return_json = array("status" => "unsuccessful", "statuscode" => 112, "message" => "Password Incorrect");
			$json_return_object = json_encode($return_json);
			print_r($json_return_object);
			return; 
        }
        $delete_account_query = "UPDATE accounts SET deleted = 1, Balance = 0 WHERE Account_no = '$accountno'";
        $delete_account_result = mysqli_query($conn, $delete_account_query);
        if($delete_account_result){
            $return_json = array("status" => "successful", "statuscode" => 1, "message" => "Successfully deleted the Account", "data" => "$accountno");
			$json_return_object = json_encode($return_json);
			print_r($json_return_object);
			return; 
        }
        else{
            $return_json = array("status" => "unsuccessful", "statuscode" => 113, "message" => "Error while deleting the account, contact admin.");
			$json_return_object = json_encode($return_json);
			print_r($json_return_object);
			return; 
        }
    }
    else{
		$return_json = array("status" => "unsuccessful", "statuscode" => 103, "message" => "Post request not made");
		$json_return_object = json_encode($return_json);
		print_r($json_return_object);
	}
?>