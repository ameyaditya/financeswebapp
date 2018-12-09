<?php  
	session_start();
	$con = mysqli_connect('localhost', 'root', 'achar');
	mysqli_select_db($con, 'amity ramapriya details');
	$data = "SELECT *FROM denominations";
	$res = mysqli_query($con, $data);
	while($row = mysqli_fetch_array($res)){
		$balance = $row['2000']*2000 + $row['500']*500 + $row['200']*200 + $row['100']*100 + $row['50']*50 + $row['20']*20 + $row['10']*10 + $row['5']*5 + $row['2']*2 + $row['1']*1;
		$_2000 = $row['2000'];
		$_500 = $row['500'];
		$_200 = $row['200'];
		$_100 = $row['100'];
		$_50 = $row['50'];
		$_20 = $row['20'];
		$_10 = $row['10'];
		$_5 = $row['5'];
		$_2 = $row['2'];
		$_1 = $row['1'];

	}
	function money($val){
		$val2 = (string)$val;
		$j = 0;
		$ans = "";
		$val2 = strrev($val2);
		$ans[$j] = $val2[0];
		$j++;
		for($i = 1; $i< strlen($val2); $i++){
			$ans[$j] = $val2[$i];
			$j++;
			if($i%2 == 0 && $i!=(strlen($val2)-1))
			{
				$ans[$j] = ",";
				$j++;
			}
		}
		return strrev($ans);
	} 
?>
<!DOCTYPE html>
<html>
<head>
	<title>Amount left</title>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<h1 class="display-4 heading-1 text-center">Amount Left: <?php 
		echo "₹".money($balance).".00" ?></h1>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th scope="col">₹2000</th>
					<th scope="col">₹500</th>
					<th scope="col">₹200</th>
					<th scope="col">₹100</th>
					<th scope="col">₹50</th>
					<th scope="col">₹20</th>
					<th scope="col">₹10</th>
					<th scope="col">₹5</th>
					<th scope="col">₹2</th>
					<th scope="col">₹1</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$res = mysqli_query($con, $data);
					while($row = mysqli_fetch_array($res)){
						echo "<tr>";
						echo "<td>".$row['2000']."</td>";
						echo "<td>".$row['500']."</td>";
						echo "<td>".$row['200']."</td>";
						echo "<td>".$row['100']."</td>";
						echo "<td>".$row['50']."</td>";
						echo "<td>".$row['20']."</td>";
						echo "<td>".$row['10']."</td>";
						echo "<td>".$row['5']."</td>";
						echo "<td>".$row['2']."</td>";
						echo "<td>".$row['1']."</td>";
						echo "<tr>";
					}
				?>
				<?php
					echo "<tr>";
					echo "<td>₹".($_2000*2000)."</td>";
					echo "<td>₹".($_500*500)."</td>";
					echo "<td>₹".($_200*200)."</td>";
					echo "<td>₹".($_100*100)."</td>";
					echo "<td>₹".($_50*50)."</td>";
					echo "<td>₹".($_20*20)."</td>";
					echo "<td>₹".($_10*10)."</td>";
					echo "<td>₹".($_5*5)."</td>";
					echo "<td>₹".($_2*2)."</td>";
					echo "<td>₹".($_1*1)."</td>";
					echo "</tr>";
				?>
			</tbody>
		</table>

		<div class="forms" style="margin-top: 100px;">
			<h4 class="display-4 heading-1">Update Denominations</h4>
			<form action="updatebalance.php" method="post">
				<div class="form-row">
					<div class="form-group col-md-3">
						<label for="2000" style="text-align: center; display: block;">₹2000</label>
						<input type="number" name="2000" id="2000" class="form-control" placeholder="2000" value= <?php echo "\"".$_2000."\"" ?> required>
					</div>
					<div class="form-group col-md-3">
						<label for="500" style="text-align: center; display: block;">₹500</label>
						<input type="number" name="500" id="500" class="form-control" placeholder="500" value= <?php echo "\"".$_500."\"" ?> required>
					</div>
					<div class="form-group col-md-3">
						<label for="200" style="text-align: center; display: block;">₹200</label>
						<input type="number" name="200" id="200" class="form-control" placeholder="200" value= <?php echo "\"".$_200."\"" ?> required>
					</div>
					<div class="form-group col-md-3">
						<label for="100" style="text-align: center; display: block;">₹100</label>
						<input type="number" name="100" id="100" class="form-control" placeholder="100" value= <?php echo "\"".$_100."\"" ?> required>
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-3">
						<label for="50" style="text-align: center; display: block;">₹50</label>
						<input type="number" name="50" id="50" class="form-control" placeholder="50" value= <?php echo "\"".$_50."\"" ?> required>
					</div>
					<div class="form-group col-md-3">
						<label for="20" style="text-align: center; display: block;">₹20</label>
						<input type="number" name="20" id="20" class="form-control" placeholder="20" value= <?php echo "\"".$_20."\"" ?> required>
					</div>
					<div class="form-group col-md-3">
						<label for="10" style="text-align: center; display: block;">₹10</label>
						<input type="number" name="10" id="10" class="form-control" placeholder="10" value= <?php echo "\"".$_10."\"" ?> required>
					</div>
					<div class="form-group col-md-3">
						<label for="5" style="text-align: center; display: block;">₹5</label>
						<input type="number" name="5" id="5" class="form-control" placeholder="5" value= <?php echo "\"".$_5."\"" ?> required>
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-3">
						<label for="2" style="text-align: center; display: block;">₹2</label>
						<input type="number" name="2" id="2" class="form-control" placeholder="2" value= <?php echo "\"".$_2."\"" ?> required>
					</div>
					<div class="form-group col-md-3">
						<label for="1" style="text-align: center; display: block;">₹1</label>
						<input type="number" name="1" id="1" class="form-control" placeholder="1" value= <?php echo "\"".$_1."\"" ?> required>
					</div>
				</div>
				<button type="submit" class="btn btn-primary btn-block">Update</button>
			</form>
		</div>
	</div>
	
</body>
</html>