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
	<title>Amity Rampriya Finances</title>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
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
		#table-container{
			margin-top: 40px;
		}
		#filter-btn{
			position: fixed;
			bottom: 20px;
			right: 20px;
			border-radius: 50%;
			height: 80px;
			width: 80px;
			box-shadow: 0 0 10px 5px rgba(0, 0, 0, 0.1);
			background-image: url('images/filter-icon.png');
			background-repeat: no-repeat;
			background-size: 50px 55px;
			background-position: center center;
		}
		.filter-subheadings{
			font-size: 1.2em;

		}
		#accounts-filter-submit{
			width: 100%;
		}
		#account-type-group{
			margin-top: 10px;
			margin-bottom: 25px;
		}
	</style>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#account-resident").change(function(){
				if(this.checked){
					$("#account-block-container").css("display", "inline");
					$("#account-block-A").prop("checked", true);
					$("#account-block-B").prop("checked", true);
					$("#account-block-C").prop("checked", true);
				}
				else{
					$("#account-block-container").css("display", "none");
					$("#account-block-A").prop("checked", false);
					$("#account-block-B").prop("checked", false);
					$("#account-block-C").prop("checked", false);
				}
			});
			$.ajax({
				type: "get",
				url: "/endpoints/getaccounts.php",
				data:{
					"resident": "true",
					"payment": "true",
					"expense": "true",
				},
				success: function(obj){
					var html_data = "";
					var data = JSON.parse(obj);
					if(data['statuscode'] == 1){
						for (var i = 0; i < data['data'].length; i++) {
							html_data += "<tr>";
							html_data += "<td>"+data['data'][i]['Account_No']+"</td>";
							html_data += "<td>"+data['data'][i]['Name']+"</td>";
							html_data += "<td>"+data['data'][i]['Account_Type']+"</td>";
							html_data += "<td>"+data['data'][i]['Block']+"</td>";
							html_data += "<td>"+data['data'][i]['Flat_No']+"</td>";
							html_data += "<td>"+data['data'][i]['Phone_No']+"</td>";
							html_data += "<td>"+data['data'][i]['Email_ID']+"</td>";
							html_data += "<td>"+data['data'][i]['Balance']+"</td>";
							html_data += "</tr>";
						}
						document.getElementById("account-details-body").innerHTML = html_data;
					}

				}
			});
		});
		function applyaccountfilter(){
			if($("#account-resident").is(':checked')){
				resident = "true";
				if($("#account-block-A").is(':checked'))
					A = "true";
				else
					A = "false";
				if($("#account-block-B").is(':checked'))
					B = "true";
				else
					B = "false";
				if($("#account-block-C").is(':checked'))
					C = "true";
				else
					C = "false";
			}
			else{
				resident = "false";
				A = "false";
				B = "false";
				C = "false";
			}
			var block_list = [];
			if(A == "true")
				block_list.push("A");
			if(B == "true")
				block_list.push("B");
			if(C == "true")
				block_list.push("C");
			block_list = block_list.join("-");
			if($("#account-payment").is(':checked'))
				payment = "true";
			else
				payment = "false";
			
			if($("#account-expense").is(':checked'))
				expense = "true";
			else
				expense = "false";
			$.ajax({
				type: "get",
				url: "endpoints/getaccounts.php",
				data:{
					"resident" : resident,
					"payment" : payment,
					"expense" : expense,
					"block" : block_list
				},
				success: function(obj){
					data = JSON.parse(obj);
					if(data['statuscode'] == 1){
						html_data = "";
						for (var i = 0; i < data['data'].length; i++) {
							html_data += "<tr>";
							html_data += "<td>"+data['data'][i]['Account_No']+"</td>";
							html_data += "<td>"+data['data'][i]['Name']+"</td>";
							html_data += "<td>"+data['data'][i]['Account_Type']+"</td>";
							html_data += "<td>"+data['data'][i]['Block']+"</td>";
							html_data += "<td>"+data['data'][i]['Flat_No']+"</td>";
							html_data += "<td>"+data['data'][i]['Phone_No']+"</td>";
							html_data += "<td>"+data['data'][i]['Email_ID']+"</td>";
							html_data += "<td>"+data['data'][i]['Balance']+"</td>";
							html_data += "</tr>";
						}
						document.getElementById("account-details-body").innerHTML = html_data;
						$("#view-accounts-filter-modal").modal('hide');
					}
				}
			});
		}
	</script>
</head>
<body style="background-color: #f5f5f5">
	<nav class="navbar navbar-expand navbar-dark bg-dark">
		<div class="container-fluid">Amity Ramapriya Finances
		</div>
		 <button class="btn btn-light navbar-right" onclick="window.location.href='homepage.php' ">Home</button>
	</nav>
	<button type="button" class="btn" id="filter-btn" data-toggle="modal" data-target="#view-accounts-filter-modal"></button>
	<div class="modal fade" id="view-accounts-filter-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="accounts-filter-heading">Accounts Filter</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<h1 class="display-4 filter-subheadings">Account Type</h1>
					<div id="account-type-group">
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="checkbox" value="" id="account-resident" checked>
							<label class="form-check-label" for="account-resident">
							Resident
							</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="checkbox" value="" id="account-payment" checked>
							<label class="form-check-label" for="account-payment">
							Payment
							</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="checkbox" value="" id="account-expense" checked>
							<label class="form-check-label" for="account-expense">
							Expense
							</label>
						</div>
					</div>

					<div id="account-block-container">
						<h1 class="display-4 filter-subheadings">Block Number</h1>
						<div id="account-type-group">
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="checkbox" value="" id="account-block-A" checked>
								<label class="form-check-label" for="account-block-A">
								Block A
								</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="checkbox" value="" id="account-block-B" checked>
								<label class="form-check-label" for="account-block-B">
								Block B
								</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="checkbox" value="" id="account-block-C" checked>
								<label class="form-check-label" for="account-block-C">
								Block C
								</label>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" id="accounts-filter-submit" onclick="applyaccountfilter()">Submit</button>
				</div>
			</div>
		</div>
	</div>
	<h1 class="display-4" id="main-heading">Account Details</h1>
	<div class="container" id="table-container">
		<table class="table">
			<thead class="thead-light">
				<tr>
					<th scope="col">A/C No.</th>
					<th scope="col">Name</th>
					<th scope="col">A/C Type</th>
					<th scope="col">Block</th>
					<th scope="col">Flat No.</th>
					<th scope="col">Phone </th>
					<th scope="col">Email ID</th>
					<th scope="col">Balance</th>
				</tr>
			</thead>
			<tbody class="table-body" id="account-details-body">
				
			</tbody>
		</table>
	</div>
</body>
</html>