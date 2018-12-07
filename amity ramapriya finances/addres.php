<?php
	session_start();
	$name = $_POST['name'];
	$block = $_POST['block'];
	$flatno = $_POST['flatno'];
	$phno = $_POST['phno'];

	$con = mysqli_connect('localhost', 'root', 'achar');
	mysqli_select_db($con, 'amity ramapriya details');
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
		header("Location: homepage.php");
	}
?>