<!DOCTYPE html>

<!--?php 
ob_start();		   //start output buffering
session_start();   //create new session
include 'db-fl.php';  //connect to inventory database (invdb)
?-->

<html>
<head>

	<title>Finish-Line</title>
	<meta name="keywords" content="contact, point venture, inventory, tracker, database, retail"/>
	<meta type="description" content="Point Venture Retail Inventory Tracking Database"/>
	<meta name="robots" contents="nofollow">
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="main7less.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script src="//cdn.jsdelivr.net/npm/less@3.13" ></script>

</head>
<body>
	
	<!-- Navbar Container -->
	<div class="container-fluid" style="background-color:white">

		<!-- Navbar toggle to hamburger menu -->
		<nav class="navbar navbar-expand-xl bg-white navbar-light">
			<a class="navbar-brand" href="#">
				<img src="logo2.JPG" width="70" height="45" alt="brand logo">
			</a>

			<!-- Navbar Hamburger Icon -->
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
				<span class="navbar-toggler-icon"></span>
			</button>

			<!-- Navbar Link List -->
			<div class="collapse navbar-collapse" id="collapsibleNavbar" role="navigation">
				<ul class="navbar-nav">
					<li class="nav-item">
					<a class="nav-link" href="index-fl.php">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="login-fl.php">Account Login</a>
					</li>    
				</ul>
			</div>  
		</nav>
	</div>

	<div id="topHeader" class="container-fluid">
		
		<header role="banner">
			<div class="row">
				<div class="col-md-12 col-border-padding-2">
					<h3>Finish-Line Chore and Allowance Tracker</h3>
				</div>
			</div>
		</header>
		<div class="row" role="main">
			
			<div class="col-md-6 col-border-topBottom">
				
				<div class="col-border-padding-1">
					<article>
						<h4>Welcome to Finish-Line Version 0.1.1-a.1 </h4>
						<p>
						Please make your selection on the top menu.
						</p>
					</article>
				</div>
				
			</div>
			
			<div class="col-md-6 col-border-left">
			
				<div class="col-border-padding-2">

					<article>
						<h4>Finish-Line will be able to track the following:</h4>
						<p>
						<ul>
							<li>1. Chorelist</li>
							<li>2. Piggybank Transactions </li>
							<li>3. Amount of Money Currently in the Piggybank</li>
						</ul>
						</p>
					</article>

				</div>

			</div>

		</div>


		

	</div>	
</body>

	<!-- Footer -->
	<div id="bottomFooter" class="container-fluid col-border-padding-3">
		<footer style="text-align: center;" role="contentinfo">
			<h7>Copyright 2022 Finish-Line.</h7>
		</footer>
	</div>	
</html>