<?php
	session_start();
	$con = mysqli_connect('localhost','root','achar');
	mysqli_select_db($con, 'amity ramapriya details');

	$login_name = $_POST['loginname'];
	$password = $_POST['pass'];
	$s = "SELECT *from admin where login_id = '$login_name' and password = '$password'";
	$result = mysqli_query($con,$s);
	$num = mysqli_num_rows($result);

	if($num == 1)
	{
		$_SESSION['name_exists'] = "Email ID already exists";
		header("Location:signup.php");
	}
	else
	{
		$reg = "INSERT into admin(login_id, password) values ('$login_name', '$password')";
		mysqli_query($con, $reg);
		unset($_SESSION['name_exists']);
		header("Location:index.php");

	}
?>