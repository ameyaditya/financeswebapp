<?php 
function alert($msg) {
    		echo "<script type='text/javascript'>alert('$msg');</script>";
		}
	session_start();
	if(isset($_SESSION['registered_res'])){
		alert("Successfully Registered user");
		unset($_SESSION['registered_res']);
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Homepage</title>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<nav class="navbar navbar-light bg-light justify-content-between">
  <a class="navbar-brand">Amity Ramapriya Finances</a>
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit" onclick="window.location='logout.php'">Logout</button>
</nav>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-3 events">
				<a href="addResident.php">
					<h1 class="display-4">Add resident</h1>
				</a>
			</div>
			<div class="col-md-3 events">
				<a href="addinc.php">
					<h1 class="display-4">Add Income</h1>
				</a>
			</div>
			<div class="col-md-3 events">
				<a href="addexpense.php">
					<h1 class="display-4">Add Expenses</h1>
				</a>
			</div>
			<div class="col-md-3 events">
				<a href="viewres.php">
					<h1 class="display-4">View Residents</h1>
				</a>
			</div>
		</div>

		<div class="row">
			<div class="col-md-3 events">
				<a href="amount.php">
					<h1 class="display-4">Amount and Denomination</h1>
				</a>
			</div>
			<div class="col-md-3 events">
				<a href="addinc.php">
					<h1 class="display-4"></h1>
				</a>
			</div>
			<div class="col-md-3 events">
				<a href="addexpense.php">
					<h1 class="display-4"></h1>
				</a>
			</div>
			<div class="col-md-3 events">
				<a href="addexpense.php">
					<h1 class="display-4"></h1>
				</a>
			</div>
		</div>
	</div>
</body>
</html>