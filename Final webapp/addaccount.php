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

			function validate
			{
				var type = $('#typeofacc').find(":selected").text();
				var name = document.getElementById('name').value;
				var email = document.getElementById('email').value;
				var phone = document.getElementById('phone').value;
				var block_no = $("#block").find(":selected").text();
				var flat_no =  document.getElementById('flatno').value;
				var amount = document.getElementById('amount').value;
				if(type=="" || name=="" || email=="" || phone=="" || block_no==""|| flatno="")
				{
					alert("please fill all details");
					return false;
				} 
				else{
					return true;
				}
			}

			$('#submit-account').click(function(){
				if(validate())
					{
						$.ajax({
						type: "post",
						url: "endpoints/postaccount.php",
						data:{
							"type": $('#typeofacc').find(":selected").text(),
							"acc_name": document.getElementById('name').value,
							"acc_email": document.getElementById('email').value,
							"acc_phone": document.getElementById('phone').value,
							"acc_block_no": $("#block").find(":selected").text(),
							"acc_flat_no": document.getElementById('flatno').value,
							"acc_ini_amount": document.getElementById('amount').value
						},
						success: function(obj){
							var data = JSON.parse(obj);
							
							if(data[status==1])
							{
							$('#mname').innerHTML=data[name];
							$('#mphone').innerHTML=data[phone];
							$('#memail').innerHTML=data[email];
							$('#mtype').innerHTML=data[type];
							$('#mblock').innerHTML=data[block_no];
							$('#mflat').innerHTML=data[flat_no];
							 $('#exampleModalCenter').modal('show');
							}
							else
							{
								alert("error");
							}
						}
					});
				}
			})
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
			<input type="number" name="amount" id="amount" class="form-control" placeholder="Enter initial Amount" required>
		</div>
		<button class="btn btn-primary" id="submit-account" style="width: 100%">
			submit
		</button>
	</div>
	<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
  Launch demo modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Account Added</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container forms">
	        <div class="form-group">
	       		 <input type="text" id="mname" class="form-control">
	        </div>	
	         <div class="form-group">
	       		 <input type="text" id="memail" class="form-control">
	        </div>	
	         <div class="form-group">
	       		 <input type="text" id="mphone" class="form-control">
	        </div>	
	         <div class="form-group">
	       		 <input type="text" id="mtype" class="form-control">
	        </div>	
	         <div class="form-group">
	       		 <input type="text" id="mblock" class="form-control">
	        </div>	
	         <div class="form-group">
	       		 <input type="text" id="mflat" class="form-control">
	        </div>	
      	</div>
  	</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
</body>
</html>