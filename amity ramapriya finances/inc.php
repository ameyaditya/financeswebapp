<?php 
	session_start();
	$con = mysqli_connect('localhost', 'root', 'achar');
	mysqli_select_db($con, 'amity ramapriya details');
	$year = date('Y');
	$checktable = "SHOW TABLES LIKE 'income_details_".$year."'";
	if(mysqli_num_rows(mysqli_query($con, $checktable)) != 1)
	{
		$createtab = "CREATE TABLE income_details_".$year." ( ID INT(6) AUTO_INCREMENT PRIMARY KEY, Source VARCHAR(255), Description VARCHAR(255), FlatNo VARCHAR(3), Amount INT(5), Date DATE, Mode VARCHAR(10))";
		mysqli_query($con, $createtab);
	}
	$checktable = "SHOW TABLES LIKE 'resident_payment_".$year."'";
	if(mysqli_num_rows(mysqli_query($con, $checktable)) != 1)
	{
		$createtab = "CREATE TABLE resident_income_".$year." ( FlatNo VARCHAR(3) PRIMARY KEY, Current INT(2) DEFAULT 0, `1` INT(5), `2` INT(5), `3` INT(5), `4` INT(5), `5` INT(5), `6` INT(5), `7` INT(5), `8` INT(5), `9` INT(5), `10` INT(5), `11` INT(5), `12` INT(5)) ";
		mysqli_query($con, $createtab);
	}
	$source = $_POST['source'];
	$description = $_POST['descr'];
	$flatno = $_POST['flatno'];
	$amount = $_POST['amount'];
	$payment = $_POST['payment'];
	$mode = $_POST['mode'];
	$s = "INSERT INTO income_details_".$year."(Source, Description, FlatNo, Amount, Date, Mode) values ('$source', '$description', '$flatno', '$amount', '$payment', '$mode')";
	mysqli_query($con, $s);
	if ($mode == 'Cash') {
		$quer = "UPDATE amount SET cash = cash+$amount WHERE ID=1";
		mysqli_query($con, $quer);
	}
	else{
		$quer = "UPDATE amount SET account = account+$amount WHERE ID=1";
		mysqli_query($con, $quer);
	}
	$am = $amount;
	$cur = "SELECT *FROM resident_income_".$year." WHERE FlatNo = '$flatno'";
	$result = mysqli_query($con, $cur);
	$value = mysqli_fetch_object($result);
	$curmon = $value->Current;
	if($description == "Residence Maintenance" && $source == "Resident"){
		$que = "SELECT *FROM resident_income_".$year." WHERE FlatNo = '$flatno'";
		$res = mysqli_query($con, $que);
		$val = mysqli_fetch_object($res);
		$cur = $val->Current;
		$latest = $val->$cur;
		if($latest < 4000){
			$dif = 4000 - $latest;
			if($am < $dif){
				$
			}
		}
		while ($am > 4000) {
			$curmon++;
			$que = "UPDATE resident_income_".$year." SET `$curmon` = 4000 WHERE FlatNo = '$flatno'";
			mysqli_query($con, $que);
			$am = $am - 4000;
		}
		$curmon++;
		$que = "UPDATE resident_income_".$year." SET `$curmon` = ".$am." WHERE FlatNo = '$flatno'";
		$res = mysqli_query($con, $que);
		//2echo $curmon;
		$curupdate = "UPDATE resident_income_".$year." SET Current = '$curmon' WHERE FlatNo = '$flatno'";
		$res = mysqli_query($con, $curupdate);
		if(!$res)
			echo "Fail";
	}
	header("location: homepage.php");
?>