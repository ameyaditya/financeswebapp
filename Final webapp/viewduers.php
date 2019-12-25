<?php
	session_start();
	if(!isset($_SESSION['session']))
	{
		header('location:index.php');
	}
	include 'config.php';
	$get_duers_details_query = "SELECT Account_no, a.Name AS Name, Balance, Block, Flat_no FROM accounts a, details d, account_type at WHERE a.Details_ID = d.Details_ID AND a.deleted = 0 AND a.Balance > 0 AND a.Type_ID = at.Type_ID AND at.Type_name = 'Resident' ORDER BY Block";
	$get_duers_details_result = mysqli_query($conn, $get_duers_details_query);
	$duers_data = "";
	if($get_duers_details_result){
		while($row = mysqli_fetch_assoc($get_duers_details_result)){
			$duers_data .= "<tr>";
			$duers_data .= "<td>".$row['Account_no']."</td>";
			$duers_data .= "<td>".$row['Name']."</td>";
			$duers_data .= "<td>".$row['Block']."-".$row['Flat_no']."</td>";
			$duers_data .= "<td>".$row['Balance'].'</td>';
			$duers_data .= "</tr>";
		}
	}
	else{
		echo "Not able to make connection with database, contact admin";
		return;
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Duers List</title>
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
			#navi
			{
				color: white;
				font-size: 2em;
			}
		}
		@media screen and (max-width: 700px)
		{
			#main-table{
				margin-top: 50px;
			}
		}

	</style>
	</head>
<body style="background-color: #f5f5f5;">
	<nav class="navbar navbar-expand navbar-dark bg-dark">
		<div class="container-fluid" id="navi">Amity Ramapriya Finances
		</div>
		 <button class="btn btn-light navbar-right" onclick="window.location.href='homepage.php' ">Home</button>
	</nav>
	<h1 class="display-4" id="main-heading">Duers</h1>
	<div class="container-fluid" id="main-table">
		<table class="table">
			<thead char="thead-light"> 
				<tr>
					<th scope="col">Account No</th>
					<th scope="col">Name</th>
					<th scope="col">Flat No</th>
					<th scope="col">Due Amount</th>
				</tr>
			</thead>
			<tbody class="table-body" id="duers-table-body">
				<?php echo $duers_data; ?>
			</tbody>
		</table>
	</div>
</body>
</html>