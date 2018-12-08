<?php 
	session_start();
	$con = mysqli_connect('localhost', 'root', 'achar');
	mysqli_select_db($con, 'amity ramapriya details');
	$_2000 = $_POST['2000'];
	$_500 = $_POST['500'];
	$_200 = $_POST['200'];
	$_100 = $_POST['100'];
	$_50 = $_POST['50'];
	$_20 = $_POST['20'];
	$_10 = $_POST['10'];
	$_5 = $_POST['5'];
	$_2 = $_POST['2'];
	$_1 = $_POST['1'];
	$s = "UPDATE denominations SET `2000`=$_2000 WHERE ID=1";
	mysqli_query($con, $s);
	header("Location: amount.php");
?>