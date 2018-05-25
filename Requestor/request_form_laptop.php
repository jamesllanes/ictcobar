<?php
	session_start();
	require('../dbconfig/config.php');

	if(!isset($_SESSION['username']))
	{
		header('location:../index-new.php');
	}

	if(isset($_POST['logout']))
	{
		session_unset();
		session_destroy();
		$_SESSION=array();?>
		<meta http-equiv="refresh" content=".000001;url=../index-new.php"/><?php
	}

	$quantity=$_REQUEST['quantity'];
	$_SESSION['quantity']=$quantity;
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/request_form.css">
    <link rel="stylesheet" href="../Design Template/custom.css">
    <link rel="stylesheet" href="../Design Template/css/bootstrap.min.css">
	<link href="../Design Template/local-fonts/Orbitron/Orbitron.css" rel="stylesheet">   
	<link href="../Design Template/local-fonts/Open-Sans/Open-Sans.css" rel="stylesheet">
</head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ICTC OBaR | Request Form</title>
    <style>
    body{
            background: #344e35 ;
            font-family: 'open_sans_condensedlight', sans-serif;
            font-size: 20px;
        }
    </style>
<body>
	<div class="Header">	
		<img src="../Design Template/images/DLSL-logo.png" class="logo" width="100px" height="100px">	
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
						<a class="nav-link" href="#">Home <span></span><span></span></a>
					</li>

					<li class="nav-item active">
						<a class="nav-link" href="#">ICTC Services </a>
					</li>

					<li class="nav-item active">
						<a class="nav-link" href="#">ICTC Overview</a>
					</li>

					<li class="nav-item active">
						<a class="nav-link" href="#">View FAQ</a>
					</li>
					<li class="nav-item active">
						<div class="dropdown">
							<a class="dropdown" href="#"><?php echo $_SESSION['fullname']; ?></a>
							<div class="dropdown-content">
								<a href="../logout.php">Logout</a>
							</div>
						</div>
					</li>
				</ul>
			</div>
		</nav>
	</div>

	<div class="main-body">

		<div class="Service">
			<p><b>Online Borrowing and Returning of Equipment</b></p><hr><br>
			<table class="request_form" border="1">
				<form action="insert_request_laptop.php" method="POST">
					<th colspan='2'><center>Equipment Request Form</center></th>
					<tr>
						<td><label>Name of Requestor:</label></td>
						<td><?php echo $_SESSION['fullname']; ?></td>
					</tr>
					<tr>
						<td colspan=2><label>Request Date From: </label><input type="date" name="date_rqstd" required/><label>Request Date To: </label><input type="date" name="date_r" required/></td>
					</tr>
					<tr>
						<td><label>Time:</label></td>
						<td><input type="time" name="time_r" id="request_time" required></td>
					</tr>
					<tr>
						<td><label>Room:</label></td>
						<td><input type="text" name="room" placeholder="Room" required></td>
					</tr>
					<tr>
						<td><label>College:</label></td>
						<td>
							<select name="college">
								<option name="CITE" value="CITE">CITE</option>
								<option name="CBEAM" value="CBEAM">CBEAM</option>
								<option name="CEAS" value="CEAS">CEAS</option>
								<option name="CIHTM" value="CIHTM">CIHTM</option>
								<option name="CON" value="CON">CON</option>
							</select>
						</td>
					</tr>
					<tr>
						<td><label>Item Name:</label></td>
						<td><?php echo $_SESSION['a']; ?></td>
					</tr>
					<tr>
						<td><label>Quantity:</label></td>
						<td><?php echo $_SESSION['quantity']; ?></td>
					</tr>
					<tr>
						<td><label>Purpose:</label></td>
						<td><input type="text" size="40" name="purpose" placeholder="Write your Purpose here." required/></td>
					</tr>
					<tr>
						<td><label>Expected Date of Return:</label></td>
						<td><input type="date" name="date_rtrn" required/></td>
					</tr>
					<tr>
						<td><label>Expected Time of Return:</label></td>
						<td><input type="time" name="time_rtrn" id="return_time" required/></td>
					</tr>
					<tr>
						<td colspan='2'><hr>
							<p>
								Terms & Conditions:</br>

								I agree that the equipment issued to me shall be returned</br> 
								at any time specified. I understand that I am required to </br>
								return the equipment in a reasonable condition at that time.</br></br>

								If any, or part, of the equipment is damaged or lost through</br> 
								my own negligence I understand that I am liable to repay the</br>
								costs of repair or replacement of the quipment at an agreed rate.</br>

								<center>
									<input type="checkbox" id="toggle" name="terms" onclick="Enable(this, 'submit')"/><b> I Accept the Terms and Conditions</b></br><hr>  
									<button id="submit" disabled><b>Submit Request</b></button>
									</form>
									<button class="cancel_btn" onclick="location='view_catalogue.php'"/><b>Cancel</b></button>
								</center>
							</p>
						</td>
					</tr>

					<script type="text/javascript">
						Enable = function(checkbox, submit)
					    {
					        document.getElementById(submit).disabled = !checkbox.checked; // ← !
					    }
					</script>
			</table>
		</div>
	</div>

	<footer>
		<div class="footer-info">
		<br>
		<center>
			<div class="footer-img">
			<img src="../Design Template/images/footer-img1.png">
			<img src="../Design Template/images/footer-img2.png">
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