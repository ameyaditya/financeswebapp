<?php
	session_start();
	$year = date('Y');
	$con = mysqli_connect('localhost', 'root', 'achar');
	mysqli_select_db($con, 'amity ramapriya details');
	if(isset($_SESSION['limit']))
	{
		$lim = $_SESSION['limit'];
	}
	else
	{
		$_SESSION['limit'] = 25;
		$lim = 25;
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>View Income</title>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="jumbotron-fluid">
		<h1 class="display-4 text-center heading-1">Income Details</h1>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th scope="col">Sl.No</th>
					<th scope="col">Source</th>
					<th scope="col">Description</th>
					<th scope="col">Flat No.</th>
					<th scope="col">Amount</th>
					<th scope="col">Date</th>
					<th scope="col">Mode</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$s = "SELECT *FROM income_details_".$year." LIMIT 0,".$lim;
					$res = mysqli_query($con, $s);
					if(!$res){
						echo "data empty";
					}
					else{
						while($row = mysqli_fetch_array($res)){
							echo "<tr>";
							echo "<th scope =\"row\">".$row['ID']."</th>";
							echo "<td>".$row['Source']."</td>";
							echo "<td>".$row['Description']."</td>";
							echo "<td>".$row['FlatNo']."</td>";
							echo "<td>".$row['Amount']."</td>";
							echo "<td>".$row['Date']."</td>";
							echo "<td>".$row['Mode']."</td>";
						}
					}
				?>
			</tbody>
		</table>
		<h1 class="text-center"><a href="updateses.php">Load more</a></h1>
	</div>
</body>
</html>