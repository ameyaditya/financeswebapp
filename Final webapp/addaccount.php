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
	 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  
	<style type="text/css">
		#main-heading{
			font-size: 2em;
			margin-top: 30px;
			text-align: center;
			font-family: sans-serif;
		}
		#account-no-heading{
			font-size: 1.4em;
			font-weight: 400;
			text-align: center;
		}
		.modal-subheadings{
			font-size: 1em;
			text-align: left;
			font-weight: 300;
			margin-top: 3px;
		}
		#account-success-modal-head{
			text-align: center;
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
	
	</style>
	<script type="text/javascript">
		function validate(type, name, email, phone, block_no, flat_no, amount)
		{
			var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
			if(type == "Select an option"){
				alert("Select an Account type");
				return false;
			}
			if(name == ""){
				alert("Enter a name");
				return false;
			}
			if(amount == ""){
				alert("Enter initial amount");
				return false;
			}
			if(email != ""){
				if(!re.test(email)){
					alert("email format incorrect");
					return false;
				}
			}
			if(type == "Resident" && (block_no == "Select an option" || flat_no == "")){
				alert("Choose a Block for resident and enter flat_no");
				return false;
			}
			return true;
		}
		function submitaccount(){
				var type = $('#typeofacc').find(":selected").text();
				var name = document.getElementById('name').value;
				var email = document.getElementById('email').value;
				var phone = document.getElementById('phone').value;
				var block_no = $("#block").find(":selected").text();
				var flat_no =  document.getElementById('flatno').value;
				var amount = document.getElementById('amount').value;
				if(validate(type, name, email, phone, block_no, flat_no, amount))
					{
						if(email == "")
							email = "NULL";
						if(phone == "")
							phone = "NULL";
						if(block_no == "Select an option")
							block_no = "NULL";
						if(flat_no == "")
							flat_no = "NULL";
						$.ajax({
						type: "post",
						url: "/endpoints/postaccount.php",
						data:{
							"type": type,
							"acc_name": name,
							"acc_email": email,
							"acc_phone": phone,
							"acc_block_no": block_no,
							"acc_flat_no": flat_no,
							"acc_ini_amount": amount,
							"submit": "form-submit"
						},
						success: function(obj){
							console.log(obj);
							var data = JSON.parse(obj);
							console.log(data);
							if(data['statuscode'] == 1)
							{
								$("#maccno").text(data['data']['account_no']);
								$('#mname').text(data['data']['name']);
								$('#mphone').text(data['data']['phone']);
								$('#memail').text(data['data']['email']);
								$('#mtype').text(data['data']['type']);
								$('#mblock').text(data['data']['block_no']);
								$('#mflat').text(data['data']['flat_no']);
								$('#account-success-modal').modal('show');
							}
							else
							{
								var errormessage = data['message'];
								alert("Error code: "+data['statuscode']+" Error message: "+errormessage);
							}
						},
						error: function(obj){
							console.log(obj);
						}
					});
				}
			}
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
		});
	</script>
</head>
<body style="background-color: #f5f5f5;">
	<nav class="navbar navbar-expand navbar-dark bg-dark">
		<div class="container-fluid">Amity Ramapriya Finances
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
			<select class="form-control" id="block" style="margin-bottom: 15px;">
				<option>Select an option</option>
				<option>A</option>
				<option>B</option>
				<option>C</option>
			</select>
		
		</div>

		<div class="form-group" id="flat-group">
			<label for="flatNo">Enter Flat Number</label>
			<input type="text" name="flatno" id="flatno" placeholder="Enter flat Number" class="form-control" maxlength="3" minlength="3" required style="margin-bottom: 15px;">

		</div>
		<div class="form-group">
			<label for="name">Enter Initial Amount</label>
			<input type="number" name="amount" id="amount" class="form-control" placeholder="Enter initial Amount" value="4000" required>
		</div>
		<button class="btn btn-primary" id="submit-account" onclick="submitaccount()" style="width: 100%">
			Submit
		</button>
	</div>

<!-- Modal -->
<div class="modal fade" id="account-success-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="account-success-modal-head">Account Added</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container forms">
        	<div class="row">
        		<div class="col-1"></div>
        		<div class="col-10">
        			<h1 class="display-4" id="account-no-heading">Account No - <span id="maccno"></span> (<span id="mtype"></span>)</h1>
        		</div>
        		<div class="col-1"></div>
        	</div>
        	<div class="row">
        		<div class="col-3"><h1 class="display-4 modal-subheadings">Name: </h1></div><div class="col-9"><h1 class="display-4 modal-subheadings"><span id="mname"></span></h1></div>
        		<div class="col-3"><h1 class="display-4 modal-subheadings">Email ID: </h1></div><div class="col-9"><h1 class="display-4 modal-subheadings"><span id="memail"></span></h1></div>
        		<div class="col-3"><h1 class="display-4 modal-subheadings">Phone No: </h1></div><div class="col-9"><h1 class="display-4 modal-subheadings"><span id="mphone"></span></h1></div>
        	</div>
        	<div class="row" id="flat-no-block-block">
    			<div class="col-3"><h1 class="display-4 modal-subheadings">Flat-No: </h1></div><div class="col-9"><h1 class="display-4 modal-subheadings"><span id="mblock"></span> - <span id="mflat"></span></h1></div>
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