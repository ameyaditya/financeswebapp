<?php
	session_start();
	$_SESSION['limit'] = $_SESSION['limit'] + 25;
	header("Location: viewinc.php")
?>