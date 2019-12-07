<?php
session_start();
if(!isset($_SESSION['session']))
{
	header('location:index.php');
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Add Account</title>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
	<style type="text/css">
		#main-heading{
			font-size: 2em;
			margin-top: 30px;
			text-align: center;
			font-family: sans-serif;
		}
		@media screen and (min-width: 700px)
		{
			.container-fluid
			{
				color: white;
				font-size: 2em;
			}
		}
		@media screen and (max-width: 700px)
		{
			.container-fluid
			{
				color: white;
				font-size: 1.5em;
			}
		}

	</style>
	</head>
<body style="background-color: #f5f5f5;">
	<nav class="navbar navbar-expand navbar-dark bg-dark">
		<div class="container-fluid">Amity Ramapriya Finances
		</div>
		 <button class="btn btn-light navbar-right" onclick="window.location.href='homepage.php' ">Home</button>
	</nav>
	<h1 class="display-4" id="main-heading">Generate Report</h1>
</body>
</html>