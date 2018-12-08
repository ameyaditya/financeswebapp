<?php
	session_start();
	$con = mysqli_connect('localhost', 'root', 'achar');
	mysqli_select_db($con, 'amity ramapriya details');
	$s = "SELECT *from resident_details";
	$result = mysqli_query($con, $s);
?>
<!DOCTYPE html>
<html>
<head>
	<title>View Resident Details</title>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#edit").click(function(){
				$("#panel").slideToggle("slow");
			});
		});
	</script>
</head>
<body>
	<div class="modal fade" id="editdetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="Editmodaltitle">Edit Resident Details</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          			<span aria-hidden="true">&times;</span>
        			</button>
				</div>
				<div class="modal-body">
					<div class="container forms edit-modal">
						<form action="" method="post">
							<div class="form-group">
								<label for="flatno">Flat No </label>
								<select class="custom-select form-control" id="flatno" name="flatno">
									<?php 
										$que = "SELECT flatNo FROM resident_details";
										$flatnos = mysqli_query($con, $que);
										//echo '$flatnos';

										while ($row = mysqli_fetch_array($flatnos)) {
											echo "<option>".$row['flatNo']."</option>";
										}
									?>
								</select>
							</div>
							<div class="form-group">
								<label for="block">Block </label>
								<input type="text" name="block" id="block" maxlength="1" placeholder="Enter Block" class="form-control" required>
							</div>
							<div class="form-group">
								<label for="name">Name</label>
								<input type="text" name="name" id="name" class="form-control" placeholder="Enter name" required>
							</div>
							<div class="form-group">
								<label for="phno">Phone Number </label>
								<input type="number" name="phno" id="phno" class="form-control" placeholder="Enter Phone number" min="10000000000" max="9999999999">
							</div>
							<button type="submit" class="btn btn-primary" style="width: 100%;">Update Details</button>
						</form>
					</div>

				</div>
			</div>
		</div>
	</div>

	<div class="jumbotron-fluid" style="margin-top: 20px;">
		<h1 class="display-4 text-center heading-1">Resident Details</h1>
		<div class="container-fluid">
			<div class="row" style="margin-bottom: 20px;">
				<div class="col-sm-8">
					
				</div>
				<div class="col-sm-2">
					<button class="btn btn-primary btn-block" data-toggle="modal" data-target="#editdetails">
					Edit
					</button>
				</div>
				<div class="col-sm-2">
					<button class="btn btn-primary btn-block">
					Delete
					</button>
				</div>
			</div>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th scope="col">Sl. No</th>
						<th scope="col">Name</th>
						<th scope="col">Block</th>
						<th scope="col">Flat Number</th>
						<th scope="col">Phone Number</th>
					</tr>
				</thead>
				<tbody>
					<?php while ($row = mysqli_fetch_array($result)) { 
					echo"<tr>";
					echo "<th scope=\"row\">".$row['Sl. No']."</th>";
					echo "<td>".$row['name']."</td>";
					echo "<td>".$row['block']."</td>";
					echo "<td>".$row['flatNo']."</td>";
					echo "<td>".$row['phno']."</td>";
					?>
				</tbody>
					<?php
					echo "</tr>";
					 }?>
				</tbody>
			</table>
		</div>
	</div>
</body>
</html>