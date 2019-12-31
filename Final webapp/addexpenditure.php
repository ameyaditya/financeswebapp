<?php
session_start();
if(!isset($_SESSION['session']))
{
	header('location:index.php');
}
include 'config.php';
$account_data = "";
$category_data = "";
$q="SELECT Account_no , Name FROM accounts WHERE Type_id IN (SELECT Type_id FROM account_type WHERE  Type_name = 'Expense' OR Type_name = 'Payment')";
$res=mysqli_query($conn,$q);
if(!($res)){
	echo "Not able to make connection with database, contact admin";
	return;
}
if(mysqli_num_rows($res) >= 0)
{
	while($r=mysqli_fetch_assoc($res))
	{
		$account_data .= "<option>".$r['Account_no']."-".$r['Name']."</option>";

	}
}
$q="SELECT Category_name FROM category WHERE Type='Expense' OR Type = 'Payment'";
$res=mysqli_query($conn,$q);
if(!($res)){
	echo "Not able to make connection with database, contact admin";
	return;
}
if(mysqli_num_rows($res)>=0)
{
	while($r=mysqli_fetch_assoc($res))
	{
		$category_data .= "<option>".$r['Category_name']."</option>";

	}
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
		#transaction-no-heading{
			font-size: 1.4em;
			font-weight: 400;
			text-align: center;
		}
		.amount-subheading{
			font-size: 1.4em;
			font-weight: 400;
		}
		#denominations-box{
			display: none;
		}
		.modal-subheadings{
			font-size: 1em;
			text-align: left;
			font-weight: 300;
			margin-top: 3px;
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
		function validate(){
			if($('#expaccount').find(":selected").text() == "Choose an Option"){
				alert("Please choose an expense Account");
				return false;
			}
			if($('#itinerary').find(":selected").text() == "Choose an Option"){
				alert("Choose an Itinerary");
				return false;
			}
			if($("#amount").val() == ""){
				alert("Please enter proper amount");
				return false;
			}
			if($('#mode').find(":selected").text() == "Choose an Option"){
				alert("Select a mode of payment");
				return false;
			}
			if($('#mode').find(":selected").text() == "Cash"){
				var income = document.getElementById('amount').value;
				var x = 2000*$('#2k').val() + 500*$('#5h').val() + 200*$('#2h').val() + 100*$('#oh').val() + 50*$('#fy').val() + 20*$('#ty').val() + 10*$('#tn').val() + 5*$('#fe').val() + 2*$('#to').val() + 1*$('#oe').val();
				if(income != x){
					alert("Enter correct number of Denominations");
					return false;
				}
			}
			if($("#comments").val() == ""){
				alert("Please enter comments");
				return false;
			}
			return true;
		}
		function submitexpenditure(){
			if(validate()){
				var account_no = $('#expaccount').find(":selected").text();
				var itinerary = $('#itinerary').find(":selected").text();
				var amount = $("#amount").val();
				var mode = $('#mode').find(":selected").text();
				var comments = $("#comments").val();
				var tk = document.getElementById('2k').value;
				var fh = document.getElementById('5h').value;
				var th = document.getElementById('2h').value;
				var oh = document.getElementById('oh').value;
				var fy = document.getElementById('fy').value;
				var ty = document.getElementById('ty').value;
				var tn = document.getElementById('tn').value;
				var fe = document.getElementById('fe').value;
				var tw = document.getElementById('to').value;
				var oe = document.getElementById('oe').value;
				$.ajax({
					type: "post",
					url: '/endpoints/postexpenditure.php',
					data:{
						"expenditure_account" : account_no,
						"expenditure_category" : itinerary,
						"mode_of_payment" : mode,
						"amount" : amount,
						"comments" : comments,
						"tt" : tk,
						"fh" : fh,
						"th" : th,
						"oh" : oh,
						"fi" : fy,
						"tw" : ty,
						"te" : tn,
						"fe" : fe,
						"to" : tw,
						"on" : oe,
						"submit" : "submit expenditure"
					},
					success: function(obj){
						console.log(obj);
						var data = JSON.parse(obj);
						console.log(data);
						if(data['statuscode'] == 1){
							$('#mtid').text(data['data']['transaction_id']);
							$('#mfromacc').text(data['data']['from_account']);
							$('#mtoacc').text(data['data']['to_account']);
							$('#mamount').text(data['data']['amount']);
							$('#mcategory').text(data['data']['category']);
							$('#mmode').text(data['data']['mode']);
							$('#mvoucher').text(data['data']['voucher_no']);
							$('#mcomments').text(data['data']['comments']);
							$('#exampleModalCenter').modal('show');
						}
						else{
							var errormessage = data['message'];
							alert("Error code: "+data['statuscode']+" Error message: "+errormessage);
						}
					}
				});

			}
		}
		$(document).ready(function(){
			$('#mode').on('change', function(){
				if(this.value == "Cash"){
					$('#denominations-box').css('display', 'initial');
				}
				else{
					$('#denominations-box').css('display', 'none');
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
					echo $account_data;
				?>

			</select>
		</div>
		<div class="form-group">
			<label for="itinerary">Choose an Itinerary</label>
			<select class="form-control" id="itinerary">
				<option>Choose an Option</option>
				<?php
					echo $category_data;
				?>

			</select>
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
		<button class="btn btn-primary" id="submit-exp" style="width: 100%" onclick="submitexpenditure()">
			submit
		</button>
	</div>
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Added Income</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container forms">
        	<div class="row">
        		<div class="col-1"></div>
        		<div class="col-10">
        			<h1 class="display-4" id="transaction-no-heading">Transaction ID - <span id="mtid"></span></h1>
        		</div>
        		<div class="col-1"></div>
        	</div>
        	<div class="row">
        		<div class="col-2"><h1 class="display-4 modal-subheadings">From: </h1></div><div class="col-4"><h1 class="display-4 modal-subheadings"><span id="mfromacc"></span></h1></div>
        		<div class="col-2"><h1 class="display-4 modal-subheadings">To: </h1></div><div class="col-4"><h1 class="display-4 modal-subheadings"><span id="mtoacc"></span></h1></div>
        	</div>
        	<div class="row">
        		<div class="col-2">
        			<h1 class="display-4 modal-subheadings">
        				Mode:  
        			</h1>
        		</div>
        		<div class="col-4">
        			<h1 class="display-4 modal-subheadings">
        				<span id="mmode"></span>
        			</h1>
        		</div>

        		<div class="col-3">
        			<h1 class="display-4 modal-subheadings">
        				Voucher No: 
        			</h1>
        		</div>
        		<div class="col-3">
        			<h1 class="display-4 modal-subheadings">
        				<span id="mvoucher"></span>
        			</h1>
        		</div>

        		<div class="col-3">
        			<h1 class="display-4 modal-subheadings">
        				Itinerary: 
        			</h1>
        		</div>
        		<div class="col-9">
        			<h1 class="display-4 modal-subheadings">
        				<span id="mcategory"></span>
        			</h1>
        		</div>
        		<div class="col-3">
        			<h1 class="display-4 modal-subheadings">
        				Comments: 
        			</h1>
        		</div>
        		<div class="col-9">
        			<h1 class="display-4 modal-subheadings">
        				<span id="mcomments"></span>
        			</h1>
        		</div>
        	</div>
        	<div class="row">
        		<div class="col-3">
        			<h1 class="display-4 amount-subheading">Amount: </h1>
        		</div>
        		<div class="col-9"><h1 class="display-4 amount-subheading"><span id="mamount"></span></h1></div>
        	</div>
      	</div>
  	</div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
</body>
</html>