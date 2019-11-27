<!DOCTYPE html>
<html>
<head>
	<title>Amity Rampriya Finances</title>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
	<style type="text/css">
		#main-heading{
			font-size: 1.9em;
			margin-top: 30px;
			text-align: center;
		}
		#filter-cont{
			margin-top: 50px;
			margin-bottom: 50px;
		}
	</style>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#submit-button").click(function(){
				$.ajax({
					type: "post",
					url: "/viewfilter",
					data:{
						"filter": $("#filter-option").find(":selected").text()
					},
					success:function(res){
						console.log(res);
						document.getElementById("table-body").innerHTML = res;
					}
				});
			});
		});
	</script>
</head>
<body>
	<h1 class="display-4" id="main-heading">Account Details</h1>
	<div class="filter-box" id="filter-cont">
		<div class="container forms">
			<div class="container">
				<div class="form-row">
					<div class="form-group col-2">
						<label for="filter-text">Filter: (by account)</label>
					</div>
					<div class="form-group col-8">
						<select id="filter-option" class="form-control">
							<option>All</option>
							<option>Account type - Resident</option>
							<option>Account type - Expense</option>
							<option>Account type - Payment</option>
						</select>
					</div>
					<div class="form-group col-2">
						<button class="btn btn-primary" id="submit-button" style="width:100%;">Apply Filter</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<table class="table">
			<thead class="thead-light">
				<tr>
					<th scope="col">A/C No.</th>
					<th scope="col">A/C Type</th>
					<th scope="col">Name</th>
					<th scope="col">Email ID</th>
					<th scope="col">Phone Number</th>
					<th scope="col">Flat No.</th>
				</tr>
			</thead>
			<tbody id="table-body">
					{% for acno, type, name, email, phone, flat, block in data %}
					<tr>
						<td>{{ acno }}</th>
						<td>{{ type }}</td>
						<td>{{ name }}</td>
						<td>{{ email }}</td>
						<td>{{ phone }}</td>
						{% if block == None %}
							<td></td>
						{% else %}
							<td>{{ block }}-{{ flat }}</td>
						{% endif %}
					</tr>
				{% endfor %}
			</tbody>
		</table>
	</div>
</body>
</html>