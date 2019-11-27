<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Add Resident</title>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="jumbotron-fluid">
		<div class="container forms">
			<h1 class="display-4 text-center heading-1">Add Resident Details</h1>
			<form action="addres.php" method="post">
				<div class="form-group">
					<label for="name">Enter Resident Name</label>
					<input type="text" name="name" id="name" class="form-control" placeholder="Enter Name" required>
				</div>
				<div class="form-group">
					<label for="block">Enter block</label>
					<input type="text" name="block" id="block" placeholder="Enter Block" class="form-control" maxlength="1" required>
				</div>
				<div class="form-group">
					<label for="flatNo">Enter Flat Number</label>
					<input type="text" name="flatno" id="flatno" placeholder="Enter flat Number" class="form-control" maxlength="3" minlength="3" required>
				</div>
				<div class="form-group">
					<label for="phonenumber">Enter Phone Number</label>
					<input type="number" name="phno" id="phno" class="form-control" placeholder="Enter Phone Number" maxlength="10" min="1000000000" max="9999999999" required>
				</div>
				<?php if(isset($_SESSION['resident_exists'])): ?>
					<span><?php echo $_SESSION['resident_exists']; ?></span>
				<?php endif; ?>
				<button class="btn btn-primary btn-block" type="submit">Submit</button>
			</form>
		</div>
	</div>
</body>
</html>