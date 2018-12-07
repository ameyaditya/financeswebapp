<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Signup</title>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script type="text/javascript" src="check.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="jumbotron-fluid">
		<div class="container forms">
			<h1 class="heading-1 display-4 text-center">Signup</h1>
			<form action="sign.php" method="post" name="sign">
				<div class="form-group">
					<label for="loginName">
						Enter Login Name
					</label>
					<input type="text" name="loginname" id="loginName" placeholder="Enter Login Name" class="form-control" required>
				</div>
				<div>
					<label for="passwd">Enter Password</label>
					<input type="password" name="pass" id="passwd" placeholder="Password"  class="form-control" required>
				</div>
				<div class="form-group">
					<label for="passwd2">Re-enter password</label>
					<input type="password" name="pass2" id="passwd2" placeholder="Re-Enter Password" class="form-control" required>
				</div>
				<?php if(isset($_SESSION['name_exists'])): ?>
				<span><?php echo $_SESSION['name_exists']; ?></span>
				<?php endif ?>
				<div id="error_log">
					
				</div>
				<button type="submit" class="btn btn-primary btn-block" id="submit_button">Submit</button>
			</form>
		</div>
	</div>
</body>
</html>