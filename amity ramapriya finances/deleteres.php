<?php 
	session_start();
	$con = mysqli_connect('localhost', 'root', 'achar');
	mysqli_select_db($con, 'amity ramapriya details');
	$flatno = $_POST['flatno'];
	$s = "DELETE FROM resident_details where FlatNo = '$flatno'";
	mysqli_query($con, $s);
	header("Location: viewres.php");
?>