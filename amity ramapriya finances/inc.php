<?php 
	session_start();
	$con = mysqli_connect('localhost', 'root', 'achar');
	mysqli_select_db($con, 'amity ramapriya details');

	$source = $_POST['source'];
	$description = $_POST['descr'];
	$flatno = $_POST['flatno'];
	$amount = $_POST['amount'];
	$payment = $_POST['payment'];
	$mode = $_POST['mode'];

	$s = "INSERT INTO income_details(Source, Description, FlatNo, Amount, Date, Mode) values ('$source', '$description', '$flatno', '$amount', '$payment', '$mode')";
	mysqli_query($con, $s);
	header("location: homepage.php");
?>