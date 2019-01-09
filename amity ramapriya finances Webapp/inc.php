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
		$createtab = "CREATE TABLE resident_income_".$year." ( FlatNo VARCHAR(3) PRIMARY KEY, Current INT(2) DEFAULT 0, `1` INT(5) DEFAULT 0, `2` INT(5) DEFAULT 0, `3` INT(5) DEFAULT 0, `4` INT(5) DEFAULT 0, `5` INT(5) DEFAULT 0, `6` INT(5) DEFAULT 0, `7` INT(5) DEFAULT 0, `8` INT(5) DEFAULT 0, `9` INT(5) DEFAULT 0, `10` INT(5) DEFAULT 0, `11` INT(5) DEFAULT 0, `12` INT(5) DEFAULT 0) ";
		mysqli_query($con, $createtab);
	}
	$source = $_POST['source'];
	$description = $_POST['descr'];
	$flatno = $_POST['flatno'];
	$amount = $_POST['amount'];
	$payment = $_POST['payment'];
	$mode = $_POST['mode'];
	$s = "INSERT INTO income_details_".$year."(Source, Description, FlatNo, Amount, Date, Mode) values ('$source', '$description', '$flatno', '$amount', '$payment', '$mode')";
	$res = mysqli_query($con, $s);
	if(!$res)
		echo "Fail";
	if ($mode == 'Cash') {
		$quer = "UPDATE amount SET cash = cash+$amount WHERE ID=1";
		mysqli_query($con, $quer);
	}
	else{
		$quer = "UPDATE amount SET account = account+$amount WHERE ID=1";
		mysqli_query($con, $quer);
	}
	$flag = 1;
	$am = $amount;
	$cur = "SELECT *FROM resident_income_".$year." WHERE FlatNo = '$flatno'";
	$result = mysqli_query($con, $cur);
	$value = mysqli_fetch_object($result);
	$curmon = $value->Current;
	if($description == "Residence Maintenance" && $source == "Resident"){
		$que = "SELECT *FROM resident_income_".$year." WHERE FlatNo = '$flatno' LIMIT 1";
		$res = mysqli_query($con, $que);
		while($val = mysqli_fetch_array($res)){
			$cur = $val['Current'];
			$latest = $val[$cur];
		}
		//echo $latest;
		if($cur == 12){
			//echo "Entered";
			$valuetoadd = $latest + $am;
			//echo "LAtest".$latest;
			$qu = "UPDATE resident_income_".$year." SET `$cur` = ".$valuetoadd." WHERE FlatNo = '$flatno'";
			//echo "valuetoadd:".$valuetoadd;
			$res = mysqli_query($con, $qu);
			header("Location: homepage.php");
		}
		else{
			if($latest < 4000){
			$dif = 4000 - $latest;
			if($am <= $dif){
				$valuetoadd = $latest + $am;
				$qu = "UPDATE resident_income_".$year." SET `$cur` = ".$valuetoadd." WHERE FlatNo = '$flatno'";
				$res = mysqli_query($con, $qu);
				$flag = 0;
			}
			else{
				$qu = "UPDATE resident_income_".$year." SET `$cur` = 4000 WHERE FlatNo = '$flatno'";
				$res = mysqli_query($con, $qu);
				$am = $am - $dif;
				$flag = 1;
			}
		}
		if($flag == 1){
			while ($am > 4000) {
				$curmon++;
				$que = "UPDATE resident_income_".$year." SET `$curmon` = 4000 WHERE FlatNo = '$flatno'";
				$res = mysqli_query($con, $que);
				if(!$res)
					echo "Fail 2";
				$am = $am - 4000;
			}
			$curmon++;
			$que = "UPDATE resident_income_".$year." SET `$curmon` = ".$am." WHERE FlatNo = '$flatno'";
			$res = mysqli_query($con, $que);
			if(!$res)
				echo "Fail 3";
			$curupdate = "UPDATE resident_income_".$year." SET Current = '$curmon' WHERE FlatNo = '$flatno'";
			$res = mysqli_query($con, $curupdate);
			if(!$res)
				echo "Fail";
		}
		}
	}
	header("location: homepage.php");
?>