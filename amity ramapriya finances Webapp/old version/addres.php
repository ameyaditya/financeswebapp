<?php
	session_start();
	$name = $_POST['name'];
	$block = $_POST['block'];
	$flatno = $_POST['flatno'];
	$phno = $_POST['phno'];
	$year = date('Y');
	$con = mysqli_connect('localhost', 'root', 'achar');
	mysqli_select_db($con, 'amity ramapriya details');
	$checktable = "SHOW TABLES LIKE 'resident_payment_".$year."'";
	if(mysqli_num_rows(mysqli_query($con, $checktable)) != 1)
	{
		$createtab = "CREATE TABLE resident_income_".$year." ( FlatNo VARCHAR(3) PRIMARY KEY, Current INT(2) DEFAULT 0, `1` INT(5) DEFAULT 0, `2` INT(5) DEFAULT 0, `3` INT(5) DEFAULT 0, `4` INT(5) DEFAULT 0, `5` INT(5) DEFAULT 0, `6` INT(5) DEFAULT 0, `7` INT(5) DEFAULT 0, `8` INT(5) DEFAULT 0, `9` INT(5) DEFAULT 0, `10` INT(5) DEFAULT 0, `11` INT(5) DEFAULT 0, `12` INT(5) DEFAULT 0) ";
		mysqli_query($con, $createtab);
	}
	$s = "SELECT *from resident_details where flatNo = '$flatno'";
	$result = mysqli_query($con, $s);
	$num = mysqli_num_rows($result);

	if($num == 1)
	{
		$_SESSION['resident_exists'] = "Resident details already in database";
		header("Location: addResident.php");
	}
	else
	{
		$reg = "INSERT into resident_details(name, block, flatNo, phno) values ('$name', '$block', '$flatno', '$phno')";
		mysqli_query($con, $reg);
		$_SESSION['registered_res'] = 1;
		unset($_SESSION['resident_exists']);
		$resin = "INSERT INTO resident_income_".$year."(flatNo) values ('$flatno')";
		mysqli_query($con, $resin);
		header("Location: homepage.php");
	}
?>