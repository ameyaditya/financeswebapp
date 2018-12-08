<!DOCTYPE html>
<html>
<head>
	<title>Add Income</title>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="jumbotron-fluid">
		<div class="container forms">
			<form action="inc.php" method="post">
				<h1 class="display-4 text-center heading-1">Income Details</h1>
				<div class="form-group">
					<label for="source">Source</label>
					<select class="custom-select" id="source" name="source" class="form-control">
						<option selected>Resident</option>
						<option>Others</option>
					</select>
				</div>
				<div class="form-group">
					<label for="descr">Description</label>
					<input type="text" name="descr" id="descr" value="Residence Maintenance" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="flatno">Flat Number</label>
					<input type="text" name="flatno" id="flatno" placeholder="Enter Flat Number" class="form-control" required maxlength="3" minlength="3">
				</div>
				<div class="form-group">
					<label for="amount">Enter Amount</label>
					<input type="number" name="amount" id="amount" value="4000" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="month">Paid for</label>
					<select class="custom-select" id="month" name="month" class="form-control">
						<option selected>January</option>
						<option>February</option>
						<option>March</option>
						<option>April</option>
						<option>May</option>
						<option>June</option>
						<option>July</option>
						<option>August</option>
						<option>September</option>
						<option>October</option>
						<option>November</option>
						<option>December</option>
					</select>
				</div>
				<div class="form-group">
					<label for="payment">Payment Date</label>
					<input type="date" name="payment" id="payment" class="form-control" required>
				</div>
				<div class="form-group">
					<label>Mode of Payment</label>
					<select class="custom-select" id="mode" name="mode" class="form-control">
						<option selected>Cash</option>
						<option>Account</option>						
					</select>
				</div>
				<button type="submit" class="btn btn-primary btn-block">Submit</button>
			</form>
		</div>
	</div>
</body>
</html>