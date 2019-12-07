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
		#denominations-box{
			display: none;
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
						url:"endpoint/postincome.php",
						data:{
							"flat_no": $('#flatno').find(":selected").text(),
							"amount": document.getElementById('amount').value,
							"mode": $('#incometype').find(":selected").text(),
							"income_category":$('#income').find(":selected").text(),
							"tt":document.getElementById('2k').value,
							"fh":document.getElementById('5h').value,
							"th":document.getElementById('2h').value,
							"oh":document.getElementById('oh').value,
							"fi":document.getElementById('fy').value,
							"tw":document.getElementById('ty').value,
							"te":document.getElementById('tn').value,
							"fe":document.getElementById('fe').value,
							"to":document.getElementById('to').value,
							"on":document.getElementById('oe').value,
							"comments": document.getElementById('comments').value
						},
						success: function(obj){
							var data = JSON.parse(obj);
							if(data[status==1])
							{
								
							$('#mtid').innerHTML=data[transaction_id];
							$('#mfromacc').innerHTML=data[form_account];
							$('#mtoacc').innerHTML=data[to_account];
							$('#mamount').innerHTML=data[amount];
							$('#mcategory').innerHTML=data[category];
							$('#mmode').innerHTML=data[mode];
							$('#mvoucher').innerHTML=data[voucher_no];
							$('#mcomments').innerHTML=data[comments];
							 $('#exampleModalCenter').modal('show');

							}
							else
							{
								alert("error");
							}

						}
					});

					}

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
	<h1 class="display-4" id="main-heading">Add Income</h1>
	<div class="container forms">
		<div class="form-group">
			<label for="flatno">Choose Flat No.</label>
			<select class="form-control" id="flatno">
				<option>Select an option</option>
				<?php
				include 'config.php';
				$q="SELECT Block,Flat_no FROM details WHERE Block is NOT NULL AND Flat_no is NOT NULL";
				$res=mysqli_query($conn,$q);
				if(mysqli_num_rows($res)>=0)
				{
					while($r = mysqli_fetch_assoc($res))
					{
					
					echo "<option>".$r['Block']."-".$r['Flat_no']."</option>";
					}
				}
				?>
			</select>
		</div>
		<div class="form-group">
			<label for="amount">Enter Income Amount</label>
			<input type="number" id="amount" name="amount" value="4000" class="form-control" placeholder="Enter income amount" required>
		</div>
		<div class="form-group">
			<label for="incometype">Enter Mode of Income</label>
			<select class="form-control" id="incometype">
				<option>Select an option</option>
				<option>Cash</option>
				<option>Account</option>
			</select>
		</div>
		<div class="form-group">
			<label for="flatno">Choose Income Category</label>
			<select class="form-control" id="category">
				<option>Select an option</option>
				<?php
				
				$q="SELECT Category_name FROM category WHERE Type='Income'";
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
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
  Launch demo modal
</button> -->
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
        	<div class="form-group">
	       		 <input type="text" id="mtid" class="form-control">
	        </div>	
	        <div class="form-group">
	       		 <input type="text" id="mfromacc" class="form-control">
	        </div>	
	         <div class="form-group">
	       		 <input type="text" id="mtoacc" class="form-control">
	        </div>	
	         <div class="form-group">
	       		 <input type="text" id="mamount" class="form-control">
	        </div>	
	         <div class="form-group">
	       		 <input type="text" id="mcategory" class="form-control">
	        </div>	
	         <div class="form-group">
	       		 <input type="text" id="mmode" class="form-control">
	        </div>	
	         <div class="form-group">
	       		 <input type="text" id="mvoucher" class="form-control">
	        </div>	
	        <div class="form-group">
	       		 <input type="text" id="mcomments" class="form-control">
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