<?php
	session_start();
	require('../dbconfig/config.php');

	if(!isset($_SESSION['username']))
	{
		header('location:../index.php');
	}

	if(isset($_POST['logout']))
	{
		session_unset();
		session_destroy();
		$_SESSION=array();?>
		<meta http-equiv="refresh" content=".000001;url=../index.php"/><?php
	}

?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="Requestor/css/view_status.css">
    <link rel="stylesheet" href="Design Template/custom.css">
    <link rel="stylesheet" href="Design Template/css/bootstrap.min.css">
	<link href="Design Template/local-fonts/Orbitron/Orbitron.css" rel="stylesheet">   
	<link href="Design Template/local-fonts/Open-Sans/Open-Sans.css" rel="stylesheet">
</head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ICTC OBaR | Login</title>
    <style>
    body{
            background: #344e35 ;
            font-family: 'open_sans_condensedlight', sans-serif;
            font-size: 20px;
        }
    </style>
<body>
	<div class="Header">	
		<img src="Design Template/images/DLSL-logo.png" class="logo" width="100px" height="100px">	
		<div class="Title">ICTC ONLINE</div>
		<div class="SubTitle">De La Salle Lipa </div>
	</div>
	<div id="Menubar_position">
		<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #1B1F1B;">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav">
					<li class="nav-item active">
						<a class="nav-link" href="index.php">Home <span></span><span></span></a>
					</li>

					<li class="nav-item active">
						<a class="nav-link" href="#">ICTC Services </a>
					</li>

					<li class="nav-item active">
						<a class="nav-link" href="#">ICTC Overview</a>
					</li>

					<li class="nav-item active">
						<a class="nav-link" href="faqs.php">View FAQ</a>
					</li>
					<?php
					if(isset($_SESSION['username']))
					{?>
				<li class="nav-item active">
						<div class="dropdown">
							<a class="dropdown" href="#"><?php echo $_SESSION['fullname']; ?></a>
							<div class="dropdown-content">
								<a href="../logout.php">Logout</a>
							</div>
						</div>
					</li><?php
						
					}
					?>
				</ul>
			</div>
		</nav>
	</div>

	<div class="main-body">

		<div class="Service">
			<p>Frequently Asked Questions</p>
		</div>
				<table class="status_table" border=1>
					<tr><td><b>How many equipments can I borrow at a time?</b></td>
						<td>The system permits multiple equipments of the same kind to be borrowed at a single request, but different kinds of equipments must be borrowed separately.</td></tr>

					<tr><td><b>Can i view a list of items I have on loan? </b></td>
					<td>Yes! List of items that the user currently have in possession is recorded and viewable. Just Log-in and go to the view request status tab.</td></tr>

					<tr><td><b>Can i view the status of my borrowing requests?</b></td>
						<td>Yes! Status of borrowing requests is recorded and viewable. Just Log-in and go to the view request status tab.</td></tr>

					<tr><td><b>Can i cancel my request to borrow an equipment?</b></td>
					<td>Cancellation of request is possible but upon request of cancellation, admin approval is still required to update the status of request for cancellation.</td></tr>
				</table>
	</div>

	<footer>
		<div class="footer-info">
		<br>
		<center>
			<div class="footer-img">
			<img src="Design Template/images/footer-img1.png">
			<img src="Design Template/images/footer-img2.png">
			</div>

			<br>
			De La Salle Lipa; ICTC<br>
			1962 JP Laurel National Highway<br>
			Mataas Na Lupa, Lipa City 4217<br>
			Tel. No. 63.43.756-5555<br>
			Telefax: 756-3117<br>
			© Copyright 2018
			<br>
		</center>
		</div>
	</footer>
</body>
</html>