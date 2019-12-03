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

	</style>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#flat-group').css('display', 'none');
			$('#block-group').css('display', 'none');
			$('#typeofacc').on('change', function(){
				console.log(this.value);
				if(this.value == 'Resident'){
					$('#flat-group').css('display', 'initial');
					$('#block-group').css('display', 'initial');
				}
				else{
					$('#flat-group').css('display', 'none');
					$('#block-group').css('display', 'none');
				}
			});
			$('#submit-account').click(function(){
				$.ajax({
					type: "post",
					url: "endpoints/postaccount.php",
					data:{
						"type": $('#typeofacc').find(":selected").text(),
						"name": document.getElementById('name').value,
						"email": document.getElementById('email').value,
						"phone": document.getElementById('phone').value,
						"block": $("#block").find(":selected").text(),
						"flat": document.getElementById('flatno').value,
						"amount": document.getElementById('amount').value
					},
					success: function(res){
						console.log(res);
					}
				});
			})
		});
	</script>
</head>
<body style="background-color: #f5f5f5;">
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container-fluid" style="color: white;font-size: 2em">Amity Ramapriya Finances
		</div>
		 <button class="btn btn-light navbar-right" onclick="window.location.href='homepage.php' ">Home</button>
		</nav>
	<h1 class="display-4" id="main-heading">Add New Account</h1>
	<div class="container forms">
		<div class="form-group">
			<label for="typeofacc">Choose Account Type</label>
			<select class="form-control" id="typeofacc">
				<option>Select an option</option>
				<option>Resident</option>
				<option>Expense</option>
				<option>Payment</option>
			</select>
		</div>
		<div class="form-group">
			<label for="name">Enter Account Holder Name</label>
			<input type="text" name="name" id="name" class="form-control" placeholder="Enter Name" required>
		</div>
		<div class="form-group">
			<label for="name">Enter Account Holder Email ID</label>
			<input type="text" name="email" id="email" class="form-control" placeholder="Enter Email ID" required>
		</div>
		<div class="form-group">
			<label for="name">Enter Account Holder Phone Number</label>
			<input type="text" name="phone" id="phone" class="form-control" placeholder="Enter Phone Number" required>
		</div>
		<div class="form-group" id="block-group">
			<label for="block">Enter block</label>
			<select class="form-control" id="block">
				<option>Select an option</option>
				<option>A</option>
				<option>B</option>
				<option>C</option>
			</select>
		</div>
		<div class="form-group" id="flat-group">
			<label for="flatNo">Enter Flat Number</label>
			<input type="text" name="flatno" id="flatno" placeholder="Enter flat Number" class="form-control" maxlength="3" minlength="3" required>
		</div>
		<div class="form-group">
			<label for="name">Enter Initial Amount</label>
			<input type="number" name="amount" id="amount" class="form-control" placeholder="Enter initial Amount" required>
		</div>
		<button class="btn btn-primary" id="submit-account" style="width: 100%">
			submit
		</button>
	</div>
</body>
</html>