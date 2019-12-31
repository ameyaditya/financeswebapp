<?php
session_start();
if(!isset($_SESSION['session']))
{
	header('location:index.php');
}
include 'config.php';
$category_data = "";
$q="SELECT Category_name FROM category";
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
	<title>Amity Rampriya Finances</title>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<style type="text/css">
		#main-heading{
			font-size: 2em;
			margin-top: 30px;
			text-align: center;
			font-family: sans-serif;
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
			margin-top: 10px;
		}
		.transaction-type-group{
			margin-top: 10px;
			margin-bottom: 25px;
		}
		#filter-icon{
			position: fixed;
			right: 30px;
			bottom: 30px;
		}
		#filter-icon button{
			background-image: url("../static/css/img/filter.png");
			height: 100px;
			width: 100px;
			background-position: center center;
			background-size: contain;
			border-radius: 50%;
			background-repeat: no-repeat;
			background-color: white;
			border: 2px black solid;
		}
		@media screen and (min-width: 700px)
		{
			#navi
			{
				color: white;
				font-size: 2em;
			}
		}
		@media screen and (max-width: 700px)
		{
			#navi{
				color: white;
				font-size: 1.5em;
			}
			#main-table{
				margin-top: 50px;
			}
			#accounts-filter-submit{
				width: 100%;
			}
			#fflatgrp{
				display: none;
			}
		}
	</style>
	<script type="text/javascript">
		function applytransactionfilter(){
			itinerary = $("#itinerary").find(":selected").val();
			orderby = $("#order").find(":selected").val();
			order = $("input[name=asdsoption]:checked").val();
			account_no = $("#accountno").val();
			fromdate = $("#fromdate").val();
			todate = $("#todate").val();
			if($("#transaction-debit").is(':checked'))
				debit = "true";
			else
				debit = "false";
			if($("#transaction-credit").is(":checked"))
				credit = "true";
			else
				credit = "false";
			mode = "";
			if($("#transaction-cash").is(":checked") || $("#transaction-account").is(":checked")){
				if($("#transaction-cash").is(":checked"))
					mode += "cash";
				if($("#transaction-account").is(":checked")){
					if(mode.length > 0)
						mode += "-account";
					else
						mode += "account";
				}
			}
			dataobject = {};
			dataobject['debit'] = debit;
			dataobject['credit'] = credit;
			dataobject['mode'] = mode;
			if(Date.parse(fromdate) && Date.parse(todate)){
				dataobject['fromdate'] = fromdate;
				dataobject['todate'] = todate;
			}
			if(itinerary != "Choose an Option")
				dataobject['category'] = itinerary;
			if(orderby = "Date of Transaction")
				dataobject['orderby'] = "dot";
			else if(orderby = "Category")
				dataobject['orderby'] = "catname";
			else
				dataobject['orderby'] = "trid";
			dataobject['order'] = order;
			if(account_no.length > 2){
				dataobject['account'] = account_no;
			}
			console.log(dataobject);
			$.ajax({
				type : "get",
				url : "/endpoints/gettransactions.php",
				data : dataobject,
				success : function(obj){
					var html_data = "";
					console.log(obj);
					var data = JSON.parse(obj);
					if(data['statuscode'] == 1){
						for (var i = 0; i < data['data'].length; i++){
							html_data += "<tr>";
							html_data += "<td>"+data['data'][i]['Transaction_ID']+"</td>";
							html_data += "<td>"+data['data'][i]['Date']+"</td>";
							html_data += "<td>"+data['data'][i]['Category']+"</td>";
							html_data += "<td>"+data['data'][i]['From']+"</td>";
							html_data += "<td>"+data['data'][i]['To']+"</td>";
							html_data += "<td>"+data['data'][i]['Mode']+"</td>";
							html_data += "<td>"+data['data'][i]['Amount']+"</td>";
							html_data += "<td>"+data['data'][i]['Voucher']+"</td>";
							html_data += "<td>"+data['data'][i]['Comments']+"</td>";
							html_data += "</tr>";
						}
						document.getElementById('transaction-details-body').innerHTML = html_data;
						$("#view-transactions-filter-modal").modal('hide');
					}
					else{

					}
				} 
			})
		}
		$(document).ready(function(){
			$('#fiternary').on('change', function(){
				if(this.value == "Maintainance Amount")
					$('#fflatgrp').css('display', 'flex');
				else
					$('#fflatgrp').css('display', 'none');
			});
			$.ajax({
				type : "get",
				url : "/endpoints/gettransactions.php",
				data:{

				},
				success: function(obj){
					var html_data = "";
					console.log(obj);
					var data = JSON.parse(obj);
					if(data['statuscode'] == 1){
						for (var i = 0; i < data['data'].length; i++){
							html_data += "<tr>";
							html_data += "<td>"+data['data'][i]['Transaction_ID']+"</td>";
							html_data += "<td>"+data['data'][i]['Date']+"</td>";
							html_data += "<td>"+data['data'][i]['Category']+"</td>";
							html_data += "<td>"+data['data'][i]['From']+"</td>";
							html_data += "<td>"+data['data'][i]['To']+"</td>";
							html_data += "<td>"+data['data'][i]['Mode']+"</td>";
							html_data += "<td>"+data['data'][i]['Amount']+"</td>";
							html_data += "<td>"+data['data'][i]['Voucher']+"</td>";
							html_data += "<td>"+data['data'][i]['Comments']+"</td>";
							html_data += "</tr>";
						}
						document.getElementById('transaction-details-body').innerHTML = html_data;
					}
				}
			});
		});
	</script>
</head>
<body style="background-color: #f5f5f5">
	<button type="button" class="btn" id="filter-btn" data-toggle="modal" data-target="#view-transactions-filter-modal"></button>
	<div class="modal fade" id="view-transactions-filter-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="transaction-filter-heading">Transactions Filter</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<h1 class="display-4 filter-subheadings">Transaction Type</h1>
					<div class="transaction-type-group">
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="checkbox" value="" id="transaction-debit" checked>
							<label class="form-check-label" for="transaction-debit">
							Debit
							</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="checkbox" value="" id="transaction-credit" checked>
							<label class="form-check-label" for="transaction-credit">
							Credit
							</label>
						</div>
					</div>

					<h1 class="display-4 filter-subheadings">Mode of Transaction</h1>
					<div class="transaction-type-group">
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="checkbox" value="" id="transaction-cash" checked>
							<label class="form-check-label" for="transaction-cash">
							Cash
							</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="checkbox" value="" id="transaction-account" checked>
							<label class="form-check-label" for="transaction-account">
							Account
							</label>
						</div>
					</div>
					<h1 class="display-4 filter-subheadings">Date range</h1>
					<div class="container">
						<div class="row">
							<div class="col-6 form-check">
								<input type="date" name="fromdate" class="form-control" id="fromdate" max= <?php echo '"'.date("Y-m-d").'"'; ?>>
							</div>
							<div class="col-6">
								<input type="date" name="todate" class="form-control" id="todate" max= <?php echo '"'.date("Y-m-d").'"'; ?>>
							</div>
						</div>
					</div>
					<label for="itinerary">Itinerary</label>
					<select class="form-control" id="itinerary">
						<option>Choose an Option</option>
						<?php
							echo $category_data;
						?>
					</select>
					<h1 class="display-4 filter-subheadings">Order by</h1>
					<div class="container">
						<select class="form-control">
							<option>Date of Transaction</option>
							<option>Category</option>
							<option>Transaction ID</option>
						</select>
					</div>
					<h1 class="display-4 filter-subheadings">ascending/Descending</h1>
					<div class="container">
						 <div class="form-check form-check-inline">
						 	<input type="radio" name="asdsoption" class="form-check-input" id="asce" checked value="ASC">
						 	<label class="form-check-label" for="asce">Ascending</label>
						 </div>
						 <div class="form-check form-check-inline">
						 	<input type="radio" name="asdsoption" class="form-check-input" id="desc" value="DESC">
						 	<label class="form-check-label" for="desc">Descending</label>
						 </div>
					</div>
					<div class="container">
						<label for="accountno">Account No</label>
						<input type="text" name="accountno" id="accountno" class="form-control">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" id="accounts-filter-submit" onclick="applytransactionfilter()">Submit</button>
				</div>
			</div>
		</div>
	</div>
	<nav class="navbar navbar-expand navbar-dark bg-dark">
		<div class="container-fluid" id="navi">Amity Ramapriya Finances
		</div>
		 <button class="btn btn-light navbar-right" onclick="window.location.href='homepage.php' ">Home</button>
	</nav>
	<!-- <div class="modal fade" id="filtermodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Filters</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="container forms">
						<div class="form-row">
							<div class="form-group col">
								<label for="fiternary">Choose Iternary Filter</label>
							</div>
							<div class="form-group col">
								<select class="form-control" id="fiternary">
									<option>Choose an option</option>
									<option>Maintainance Amount</option>
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
						</div>
						<div class="form-row" id="fflatgrp">
							<div class="form-group col">
								<label for="fflatno">Flat No.</label>
							</div>
							<div class="form-group col">
								<select class="form-control" id="fflatno">
									<option>All</option>
									{% for flat, block in fdata %}
										<option>{{ block }}-{{ flat }}</option>
									{% endfor %}
								</select>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col">
								<label for="fmode">Mode</label>
							</div>
							<div class="form-group col">
								<select class="form-control" id="fmode">
									<option>Both</option>
									<option>Credit</option>
									<option>Debit</option>
								</select>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col">
								<label for="fyear">year filter</label>
							</div>
							<div class="form-group col">
								<div class="col-2">
									
								</div>
							</div>
						</div>
					</div>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary">Save changes</button>
				</div>
			</div>
		</div>
	</div> -->

	<h1 class="display-4" id="main-heading">Transactions</h1>
	<div class="container-fluid" id="main-table">
		<table class="table">
			<thead class="thead-light">
				<tr>
					<th scope="col">T-ID</th>
					<th scope="col">Date</th>
					<th scope="col">Itinerary</th>
					<th scope="col">From</th>
					<th scope="col">To</th>
					<th scope="col">Mode</th>
					<th scope="col">Amount</th>
					<th scope="col">Voucher No.</th>
					<th scope="col">Description</th>
				</tr>
			</thead>
			<tbody class="table-body" id="transaction-details-body">
			</tbody>
		</table>
	</div>
</body>
</html>