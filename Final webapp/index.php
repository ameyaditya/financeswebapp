<?php
session_start();
 if(isset($_POST['submit']))
 {
 	$pass = $_POST['pass'];
 	if($pass=="1234")
 	{
 		header("location:homepage.php");
 		$_SESSION['session']='123';
 	}
 	else
 	{
 		header("location:index.php");
 	}
 }

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<style type="text/css">
		@media screen and (min-width: 700px)
		{
		.container {
			margin-top: 150px;
			border-radius: 15px;
			height: 280px;
			width: 500px;
			box-shadow:5px 5px 10px 5px rgba(0,0,0,.4) ;
		}
		.container-fluid
		{
			color: white;
			font-size: 2em;
		}
	}
			@media screen and (max-width: 700px)
		{
		.container {
			margin-top: 120px;
			border-radius: 15px;
			height: 250px;
			width: 450px;
			box-shadow:5px 5px 10px 5px rgba(0,0,0,.4) ;
		}
		.container-fluid
		{
			color: white;
			font-size: 1.5em;
		}
	}
		#header
		{
			/*padding-top: 30px;*/
			font-size: 2.5em;
			font-family: sans-serif;
		}
		#input
		{
			text-align: center;
			width: 300px;
			height: 50px;
			border-radius: 7px;
			border:none;
			font-size: 1.5em;
			font-family: sans-serif;
			box-shadow:5px 5px 10px 5px rgba(0,0,0,.4) ;
		}
		#login
		{
			border:none;
			height: 40px;
			width: 150px;
			margin-top: 40px;
			border-radius: 7px;
			color: white;
			font-size: 1.5em;
			font-family: sans-serif;
		}
	</style>
</head>

<body style="background-color: #f5f5f5;">
	<nav class="navbar navbar-expand navbar-dark bg-dark">
		<div class="container-fluid" >Amity Ramapriya Finances
		</div>
	</nav>
	<div class="container ">
		<form method="post">
			<div class="d-flex justify-content-center justify-align-center">
				<h2 id="header" style="padding-top: 30px">Welcome, Mr.Jayram</h2> 
			</div>
			<br>
			<div class="d-flex justify-content-center justify-align-center">
				<input type="password" name="pass"  placeholder="Enter your password" id="input">
			</div>
			<div class="d-flex justify-content-center justify-align-center">
				<button type="submit" class="bg-dark" id="login" name="submit">Login</button>
			</div>
		</form>
	</div>
</body>
</html>