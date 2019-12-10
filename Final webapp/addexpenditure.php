<?php
session_start();
if(!isset($_SESSION['session']))
{
	header('location:index.php');
}
include 'config.php';
$select_account_nos_query = "SELECT t.Account_no, t.Name FROM transaction t, account_type at WHERE t.Type_ID = at.Type_ID AND at.Type_name IN ('Expense', 'Payment')";
$select_account_nos_result = mysqli_query($conn, $select_account_nos_query);
$account_data = array();
if($select_account_nos_result){
	while($row = mysqli_fetch_assoc($select_account_nos_result)){
		$account_data[] = $row;
	}
}
else{
	echo "Not able to make query to database, contact admin.";
	return;
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Amity Ramapriya Finances</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
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
				<?php
				include 'config.php';
				$q="SELECT Account_no , Name FROM accounts WHERE Type_id IN (SELECT Type_id FROM account_type WHERE  Type_name = 'Expense' OR Type_name = 'Payment')";
				$res=mysqli_query($conn,$q);
				if(mysqli_num_rows($res)>=0)
				{
					while($r=mysqli_fetch_assoc($res))
					{
						echo "<option>".$r['Account_no']."-".$r['Name']."</option>";

					}
				}
				?>

			</select>
		</div>
		<div class="form-group">
			<label for="itinerary">Choose an Itinerary</label>
			<select class="form-control" id="itinerary">
				<option>Choose an Option</option>
				<?php
				
				$q="SELECT Category_name FROM category WHERE Type='Expense' OR Type = 'Payment'";
				$res=mysqli_query($conn,$q);
				if(mysqli_num_rows($res)>=0)
				{
					while($r=mysqli_fetch_assoc($res))
					{
						echo "<option>".$r['Category_name']."</option>";

					}
				}
				?>

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