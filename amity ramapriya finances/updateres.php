<?php 
	session_start();
	$con = mysqli_connect('localhost', 'root', 'achar');
	mysqli_select_db($con, 'amity ramapriya details');
	$flatno = $_POST['flatno'];
	$name = $_POST['name'];
	$block = $_POST['block'];
	$phno = $_POST['phno'];

	$que = "UPDATE resident_details SET name = '$name', block = '$block', phno = '$phno' WHERE flatNo = '$flatno'";
	mysqli_query($con, $que);
	header("Location: viewres.php");
 ?>