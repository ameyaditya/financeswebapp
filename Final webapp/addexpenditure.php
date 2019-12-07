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
	<title>Amity Ramapriya Finances</title>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
	<style type="text/css">
		#main-heading
		{
			font-size: 2em;
			margin-top: 30px;
			text-align: center;
			font-family: sans-serif;
		}
		@media screen and (min-width: 700px)
		{
			.container-fluid
			{
				color: white;
				font-size: 2em;
			}
		}
		@media screen and (max-width: 700px)
		{
			.container-fluid
			{
				color: white;
				font-size: 1.5em;
			}
		}
		#denominations-box{
			display: none;
		}
	</style>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#mode').on('change', function(){
				if(this.value == "Cash"){
					$('#denominations-box').css('display', 'initial');
				}
				else{
					$('#denominations-box').css('display', 'none');
				}
			});
			$('#submit-exp').click(function(){
				if($('#expaccount').find(":selected").text() == "Choose an Option"){
					alert("Please choose an expense Account");
				}
				else if($('#itinerary').find(":selected").text() == "Choose an Option"){
					alert("Choose an Itinerary");
				}
				else if($('#mode').find(":selected").text() == "Choose an Option"){
					alert("Select a mode of payment");
				}
				else if($('#mode').find(":selected").text() == "Cash"){
					var income = document.getElementById('amount').value;
					var x = 2000*$('#2k').val() + 500*$('#5h').val() + 200*$('#2h').val() + 100*$('#oh').val() + 50*$('#fy').val() + 20*$('#ty').val() + 10*$('#tn').val() + 5*$('#fe').val() + 2*$('#to').val() + 1*$('#oe').val();
					if(income != x){
						alert("Enter correct number of Denominations");
					}
					else{
						$.ajax({
						type:"post",
						url: "/addexp",
						data:{
							"name": $('#expaccount').find(":selected").text(),
							"amount": $("#amount").val(),
							"itinerary": $('#itinerary').find(":selected").text(),
							"voucherno": $('#voucherno').val(),
							"description": $("#description").val(),
							"mode": $("#mode").find(":selected").text(),
							"tk":document.getElementById('2k').value,
							"fh":document.getElementById('5h').value,
							"th":document.getElementById('2h').value,
							"oh":document.getElementById('oh').value,
							"fy":document.getElementById('fy').value,
							"ty":document.getElementById('ty').value,
							"tn":document.getElementById('tn').value,
							"fe":document.getElementById('fe').value,
							"tw":document.getElementById('to').value,
							"oe":document.getElementById('oe').value,
							"comments": document.getElementById('comments').value
						},
						success: function(res){
							console.log(res);
						}
					});
					}
				}
				else{
					$.ajax({
						type:"post",
						url: "/addexp",
						data:{
							"name": $('#expaccount').find(":selected").text(),
							"amount": $("#amount").val(),
							"itinerary": $('#itinerary').find(":selected").text(),
							"voucherno": $('#voucherno').val(),
							"description": $("#description").val(),
							"mode": $("#mode").find(":selected").text(),
							"tk":document.getElementById('2k').value,
							"fh":document.getElementById('5h').value,
							"th":document.getElementById('2h').value,
							"oh":document.getElementById('oh').value,
							"fy":document.getElementById('fy').value,
							"ty":document.getElementById('ty').value,
							"tn":document.getElementById('tn').value,
							"fe":document.getElementById('fe').value,
							"tw":document.getElementById('to').value,
							"oe":document.getElementById('oe').value,
							"comments": document.getElementById('comments').value
						},
						success: function(res){
							console.log(res);
						}
					});
				}
			});	
		});
	</script>
</head>
<body  style="background-color: #f5f5f5;">
	<nav class="navbar navbar-expand navbar-dark bg-dark">
		<div class="container-fluid">Amity Ramapriya Finances
		</div>
		 <button class="btn btn-light navbar-right" onclick="window.location.href='homepage.php' ">Home</button>
	</nav>
	<h1 class="display-4" id="main-heading">Add Expenditure</h1>
	<div class="container forms">
		<div class="form-group">
			<label for="expaccount">Choose Expenditure Account</label>
			<select class="form-control" id="expaccount">
				<option>Choose an Option</option>
				{% for name,type in data %}
				<option>{{ type }}-{{ name }}</option>
				{% endfor %}
			</select>
		</div>
		<div class="form-group">
			<label for="itinerary">Choose an Itinerary</label>
			<select class="form-control" id="itinerary">
				<option>Choose an Option</option>
				<option>Payment - Garden Maintenance</option>
				<option>Payment - Lift AMC</option>
				<option>Payment - Generator AMC</option>
				<option>Payment - Security Guard</option>
				<option>Payment - House Keeping</option>
				<option>Payment - Water Charges</option>
				<option>Payment - Swimming Pool Maintenance</option>
				<option>Payment - Garbage</option>
				<option>Payment - Common Electricity</option>
				<option>Expense - Cleaning and Electrical Material</option>
				<option>Expense - Generator Diesel</option>
				<option>Expense - Furnitures</option>
				<option>Expense - Generator Service</option>
				<option>Expense - Sump and Tank Cleaning</option>
				<option>Expense - Pest Control</option>
				<option>Expense - Others</option>
			</select>
		</div>
		<div class="form-group">
			<label for="voucherno">Enter Voucher Number</label>
			<input type="text" name="voucherno" id="voucherno" class="form-control" placeholder="Enter Voucher No" required>
		</div>
		<div class="form-group">
			<label for="description">Enter Description</label>
			<input type="text" name="description" placeholder="Enter Description" id="description" class="form-control">
		</div>
		<div class="form-group">
			<label for="amount">Enter Amount</label>
			<input type="number" id="amount" name="amount" class="form-control" placeholder="Enter Amount" required>
		</div>
		<div class="form-group">
			<label for="mode">Choose Mode of Payment</label>
			<select class="form-control" id="mode">
				<option>Choose an Option</option>
				<option>Cash</option>
				<option>Account</option>
			</select>
		</div>
		<div id="denominations-box">
			<label>Enter Denominations</label>
			<div class="form-row">
				<div class="form-group col">
					<label for="2k">2000</label>
					<input type="number" name="2k" value="0" class="form-control" id="2k">
				</div>
				<div class="form-group col">
					<label for="5h">500</label>
					<input type="number" name="5h" value="0" class="form-control" id="5h">
				</div>
				<div class="form-group col">
					<label for="2h">200</label>
					<input type="number" name="2h" value="0" class="form-control" id="2h">
				</div>
				<div class="form-group col">
					<label for="oh">100</label>
					<input type="number" name="1h" value="0" class="form-control" id="oh">
				</div>
				<div class="form-group col">
					<label for="fy">50</label>
					<input type="number" name="fy" value="0" class="form-control" id="fy">
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col">
					<label for="ty">20</label>
					<input type="number" name="ty" value="0" class="form-control" id="ty">
				</div>
				<div class="form-group col">
					<label for="tn">10</label>
					<input type="number" name="tn" value="0" class="form-control" id="tn">
				</div>
				<div class="form-group col">
					<label for="fe">5</label>
					<input type="number" name="fe" value="0" class="form-control" id="fe">
				</div>
				<div class="form-group col">
					<label for="to">2</label>
					<input type="number" name="to" value="0" class="form-control" id="to">
				</div>
				<div class="form-group col">
					<label for="oe">1</label>
					<input type="number" name="oe" value="0" class="form-control" id="oe">
				</div>
			</div>
		</div>
		<div class="form-group">
			<label for="comments">Enter Comments</label>
			<input type="text" name="comments" placeholder="Enter comments" class="form-control" id="comments">
		</div>
		<button class="btn btn-primary" id="submit-exp" style="width: 100%">
			submit
		</button>
	</div>
</body>
</html>