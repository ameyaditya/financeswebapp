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
	<title>Front Page</title>
	 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<style type="text/css">

	@media screen and (max-width:700px)
	{
		.button{
		margin-bottom: 20px;
		width:130px;
		height: 80px;
		font-weight: 2em;
		border-radius: 15px;
		box-shadow:5px 5px 10px 5px rgba(0,0,0,.4) ;
		cursor: pointer;
		padding: 15px;
		font-size: 18px;
		font-family: sans-serif;
		}
	
		.container-fluid
		{
			color: white;
			font-size: 1.5em;
		}

		
	}
	
	

	@media screen and (min-width:700px)
	{
		.button{
			margin-bottom: 20px;
			width:240px;
			height: 100px;
			border-radius: 15px;
			box-shadow:5px 5px 10px 5px rgba(0,0,0,.4) ;
			padding: 30px;
			font-weight: 1.7em;
			cursor: pointer;

			}

			#selection
			{
			text-align: center;
			font-size:  1.7em;
			}
			
			.container-fluid
			{
				color: white;
				font-size: 2em;
			}
			
	}

	
</style>

</head>
<body style="background-color: #f5f5f5;">
	<nav class="navbar navbar-expand navbar-dark bg-dark">
	<div class="container-fluid" >Amity Ramapriya Finances
	</div>
	 <button class="btn btn-light navbar-right" onclick="window.location.href='index.php' ">Logout</button>
	</nav>

	<div  class="container">
	
		   <div class="row " style="margin-top: 80px;" >
            <div class="col-4 d-flex justify-content-center justify-align-center">
		         <div class="bg-light button" id="selection" onclick="window.location.href='addaccount.php'"> Add Account   </div>
            </div>    
             <div class="col-4 d-flex justify-content-center justify-align-center">
		          <div class="bg-light button" id="selection" onclick="window.location.href='addincome.php'"> Add Income
		          </div>
		     </div> 
		     <div class="col-4 d-flex justify-content-center justify-align-center">
		        <div class="bg-light button" id="selection" onclick="window.location.href='addexpenditure.php'" style="padding-top:10px;"> Add Expenditure</div>
            </div>       
               
		   </div>
		     <div class="row " style="margin-top: 58px;" >
                <div class="col-4 d-flex justify-content-center justify-align-center">
		       	 <div class="bg-light button" id="selection" onclick="window.location.href='viewaccount.php'"> View Accounts
		        </div>
            	</div>   
            	 <div class="col-4 d-flex justify-content-center justify-align-center">
		       	 <div class="bg-light button" id="selection" onclick="window.location.href='viewtransaction.php'" style="padding-top:10px;"> View Transactions
		        </div>
            	</div>  
            	 <div class="col-4 d-flex justify-content-center justify-align-center">
		       	 <div class="bg-light button" id="selection" onclick="window.location.href='viewrecons.php'"> View Summary
		        </div>
            	</div>
		   </div>
		     <div class="row " style="margin-top: 58px;" >
	            
			    <div class="col-4 d-flex justify-content-center justify-align-right">
			         <div class="bg-light button" id="selection" onclick="window.location.href='generatereport.php'" style="padding-top:10px;"> Generate Report</div>
			   </div>
			   <div class="col-4 d-flex justify-content-center justify-align-center">
			         <div class="bg-light button" id="selection" onclick="window.location.href='viewduers.php'" > View Duers</div>
			   </div>
			   <div class="col-4 d-flex justify-content-center justify-align-center">
			         <div class="bg-light button" id="selection" onclick="window.location.href='addtoaccount.php'" style="padding-top:10px;"> Transfer to Account</div>
			   </div>
	</div>

</body>

</html>