<?php
session_start();
$con = mysqli_connect('localhost','root','achar');
mysqli_select_db($con, 'amity ramapriya details');
$login_id = $_POST['user'];
$pass = $_POST['password'];
$s = "SELECT *from admin where login_id = '$login_id' && password = '$pass'";
$result = mysqli_query($con, $s);
$num = mysqli_num_rows($result);

if($num == 1)
{
	$_SESSION['logged_in'] = 1;
	$_SESSION['username'] = $login_id;
	unset($_SESSION['name_error']);
	header("Location: homepage.php");
}
else
{
	$_SESSION['name_error'] = "Login Name and password incorrect";
	header("Location:login.php");
}
?>