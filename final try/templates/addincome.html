<!DOCTYPE html>
<html>
<head>
	<title>Amity Ramapriya Finances</title>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
	<style type="text/css">
		#main-heading{
			font-size: 1.9em;
			margin-top: 30px;
			text-align: center;
		}
		#denominations-box{
			display: none;
		}
	</style>
	<script type="text/javascript">
		$(document).ready(function(){
			//$('#denominations-box').css('display', 'none');
			$('#incometype').on('change', function(){
				if(this.value == "Cash"){
					$('#denominations-box').css('display', 'initial');
				}
				else{
					$('#denominations-box').css('display', 'none');
				}
			});
			$('#submit-income').click(function(){
				if($('#flatno').find(":selected").text() == "Select an option"){
					alert("Please choose an income account");
				}
				else if($('#incometype').find(":selected").text() == "Select an option"){
					alert("Please choose an income type");
				}
				else if($('#incometype').find(":selected").text() == "Cash"){
					var income = document.getElementById('amount').value;
					var x = 2000*$('#2k').val() + 500*$('#5h').val() + 200*$('#2h').val() + 100*$('#oh').val() + 50*$('#fy').val() + 20*$('#ty').val() + 10*$('#tn').val() + 5*$('#fe').val() + 2*$('#to').val() + 1*$('#oe').val();
					console.log(x);
					if(income != x){
						alert("Enter correct number of Denominations");
					}
					else{
						$.ajax({
						type:"post",
						url:"/addinc",
						data:{
							"from": $('#flatno').find(":selected").text(),

							"amount": document.getElementById('amount').value,
							"mode": $('#incometype').find(":selected").text(),
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
						url:"/addinc",
						data:{
							"from": $('#flatno').find(":selected").text(),

							"amount": document.getElementById('amount').value,
							"mode": $('#incometype').find(":selected").text(),
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
							"comments": $('#comments').find(":selected").text()
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
<body>
	<h1 class="display-4" id="main-heading">Add Income</h1>
	<div class="container forms">
		<div class="form-group">
			<label for="flatno">Choose Flat No.</label>
			<select class="form-control" id="flatno">
				<option>Select an option</option>
				{% for flat,block in data %}
					<option>{{ block }}-{{ flat }}</option>
				{% endfor %}
			</select>
		</div>
		<div class="form-group">
			<label for="amount">Enter Income Amount</label>
			<input type="number" id="amount" name="amount" value="4000" class="form-control" placeholder="Enter income amount" required>
		</div>
		<div class="form-group">
			<label for="incometype">Enter Income Type</label>
			<select class="form-control" id="incometype">
				<option>Select an option</option>
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
			<select class="form-control" id="comments">
				<option>Choose an Option</option>
				<option>For the month of January</option>
				<option>For the month of February</option>
				<option>For the month of March</option>
				<option>For the month of April</option>
				<option>For the month of May</option>
				<option>For the month of June</option>
				<option>For the month of July</option>
				<option>For the month of August</option>
				<option>For the month of September</option>
				<option>For the month of October</option>
				<option>For the month of November</option>
				<option>For the month of December</option>
			</select>
		</div>
		<button class="btn btn-primary" id="submit-income" style="width: 100%">
			submit
		</button>
	</div>
</body>
</html>