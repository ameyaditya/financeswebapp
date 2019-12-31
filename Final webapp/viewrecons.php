<?php
	session_start();
	if(!isset($_SESSION['session']))
	{
		header('location:index.php');
	}
	include 'config.php';
	$get_details = "SELECT * FROM main_details WHERE ID = 1";
	$get_details_result = mysqli_query($conn, $get_details);
	if($get_details_result){
		$data = mysqli_fetch_assoc($get_details_result);
	}
	else{
		echo "cannot make connection to the database";
		return;
	}
	$get_recon = "SELECT * FROM recon WHERE recon_ID = 1";
	$get_recon_result = mysqli_query($conn, $get_recon);
	if($get_recon_result){
		$recon_data = mysqli_fetch_assoc($get_recon_result);
	}
	else{
		echo "cannot make connection to the database";
		return;
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
		#recon-table{
			table-layout: fixed;
			width: 50%;
			margin: 0 auto;
			text-align: center
		}
		#recon-table td{
			text-align: center;
		}
		@media screen and (min-width: 700px)
		{
			#navi
			{
				color: white;
				font-size: 2em;
			}
		}
		@media screen and (max-width: 700px)
		{
		}
	</style>
	</head>
<body style="background-color: #f5f5f5;">
	<nav class="navbar navbar-expand navbar-dark bg-dark">
		<div class="container-fluid" id="navi">Amity Ramapriya Finances
		</div>
		 <button class="btn btn-light navbar-right" onclick="window.location.href='homepage.php' ">Home</button>
	</nav>
	<h1 class="display-4" id="main-heading">Summary</h1>
	<div class="container-fluid">
		<table class="table table-dark">
		  <thead>
		    <tr>
		      <th scope="col">Maintenance Amount</th>
		      <th scope="col">Total Cash</th>
		      <th scope="col">Total Account</th>
		      <th scope="col">Total</th>
		    </tr>
		  </thead>
		  <tbody>
		    <tr>
		      <td scope="row"><?php echo $data['Maintenance_amount']; ?></th>
		      <td><?php echo $data['Cash_amount']; ?></td>
		      <td><?php echo $data['Account_amount']; ?></td>
		      <td><?php echo $data['Total_amount']; ?></td>
		    </tr>
		  </tbody>
		</table>
	</div>
	<h1 class="display-4" id="main-heading" style="margin-top: 50px !important;">Recon</h1>
	<div class="container">
		<table class="table table-hover" id="recon-table">
		  <thead class="thead-dark">
		    <tr>
		      <th scope="col">Denomination</th>
		      <th scope="col">Count</th>
		    </tr>
		  </thead>
		  <tbody>
		    <tr>
		      <th scope="row">2000</th>
		      <td><?php echo $recon_data['2000']; ?></td>
		    </tr>
		    <tr>
		      <th scope="row">500</th>
		      <td><?php echo $recon_data['500']; ?></td>
		    </tr>
		    <tr>
		      <th scope="row">200</th>
		      <td><?php echo $recon_data['200']; ?></td>
		    </tr>
		    <tr>
		      <th scope="row">100</th>
		      <td><?php echo $recon_data['100']; ?></td>
		    </tr>
		    <tr>
		      <th scope="row">50</th>
		      <td><?php echo $recon_data['50']; ?></td>
		    </tr>
		    <tr>
		      <th scope="row">20</th>
		      <td><?php echo $recon_data['20']; ?></td>
		    </tr>
		    <tr>
		      <th scope="row">10</th>
		      <td><?php echo $recon_data['10']; ?></td>
		    </tr>
		    <tr>
		      <th scope="row">5</th>
		      <td><?php echo $recon_data['5']; ?></td>
		    </tr>
		    <tr>
		      <th scope="row">2</th>
		      <td><?php echo $recon_data['2']; ?></td>
		    </tr>
		    <tr>
		      <th scope="row">1</th>
		      <td><?php echo $recon_data['1']; ?></td>
		    </tr>
		  </tbody>
		</table>
	</div>
</body>
</html>