<!DOCTYPE html>
<html>
<head>
	<title>Add Expense</title>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="jumbotrom-fluid">
		<div class="container forms">
			<form action="addexp.php" method="post">
				<h1 class="display-4 text-center heading-1">Expense Details</h1>
				<div class="form-group">
					<label for="type">For</label>
					<select class="custom-select form-control" id="type" name="type">
						<option selected>Garden Maintenance</option>
						<option>Lift AMC</option>
						<option>Generator AMC</option>
						<option>Security Guard</option>
						<option>House Keeping</option>
						<option>Water Charges</option>
						<option>Electricity Bill</option>
						<option>Swimming Pool Maintenance</option>
						<option>Repairs</option>
						<option>Garbage</option>
						<option>Common Electricity</option>
						<option>Cleaning and Electical Materials</option>
						<option>Generator Diesel</option>
						<option>Furnitures</option>
						<option>Generator Service</option>
						<option>Sump and Tank Cleaning</option>
						<option>Pest Control</option>
						<option>Others</option>
					</select>
				</div>
				<div class="form-group">
					<label for="descr">Description</label>
					<input type="text" name="descr" id="descr" class="form-control" placeholder="Enter Description" required>
				</div>
				<div class="form-group">
				 <label for="paidto">Paid To</label>
				 <input type="text" name="paidto" id="paidto" class="form-control" placeholder="Enter name of person paid to" required>
				</div>
				<div class="form-group">
					<label for="vno">Voucher Number</label>
					<input type="text" name="vno" id="vno" class="form-control" placeholder="Enter Voucher Number" required>
				</div>
				<div class="form-group">
					<label for="amount">Enter Amount</label>
					<input type="number" name="amount" id="amount" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="date">Payment Date</label>
					<input type="date" name="payment" id="payment" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="mode">Mode of Payment</label>
					<select class="custom-select form-control" name="mode" id="mode">
						<option selected>Cash</option>
						<option>Account</option>
					</select>
				</div>
				<button class="btn btn-primary btn-block" type="submit">Submit</button>
			</form>
		</div>
	</div>
</body>
</html>