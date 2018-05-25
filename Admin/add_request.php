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

?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/manage_accounts.css">
    <link rel="stylesheet" href="../Design Template/custom.css">
    <link rel="stylesheet" href="../Design Template/css/bootstrap.min.css">
	<link href="../Design Template/local-fonts/Orbitron/Orbitron.css" rel="stylesheet">   
	<link href="../Design Template/local-fonts/Open-Sans/Open-Sans.css" rel="stylesheet">
	<!--FOR BADGE BOOTSTRAP
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	END OF BADGE BOOTSTRAP-->
</head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ICTC OBaR | Manage Requests</title>
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
					<li class="nav-item acstive">
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
								<a href="#">My Account</a>
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
			<p>Online Borrowing and Returning of Equipment</p>
		</div>
			<table class="status_table" border=1>
				<th colspan='14'><center>User Information</center></th>
					<form action="add_request.php" method="POST">
						<tr>
							<td><label>Name of Requestor:</label></td>
							<td><?php echo $_SESSION['fullname']; ?></td>
						</tr>
						<tr>
							<td><label>Request Date From:</label></td>
							<td><input type="date" name="date_from" required></td>
						</tr>
						<tr>
							<td><label>Request Date To:</label></td>
							<td><input type="date" name="date_to" required></td>
						</tr>
						<tr>
							<td><label>Time:</label></td>
							<td><input type="time" name="time_rqstd" required></td>
						</tr>
						<tr>
							<td><label>Room:</label></td>
							<td><input type="text" name="room" placeholder="Room" required></td>
						</tr>
						<tr>
							<td><label>College:</label></td>
							<td>
								<select name="college" required>
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
							<td><input type="text" name="item_name" placeholder="Item Name" required></td>
						</tr>
						<tr>
							<td><label>Quantity:</label></td>
							<td><input type="text" name="quantity" placeholder="Quantity" required></td>
						</tr>
						<tr>
							<td><label>Purpose:</label></td>
							<td><input type="text" name="purpose" placeholder="Purpose" required></td>
						</tr>
						<tr>
							<td><label>Return Date:</label></td>
							<td><input type="date" name="date_rtrn" required></td>
						</tr>
						<tr>
							<td><label>Return Time:</label></td>
							<td><input type="time" name="time_rtrn" required></td>
						</tr>
						<tr>
							<td colspan="2"><input type="submit" name="add" value="Add Request"></td>
							<?php
								if(isset($_POST['add']))
								{
									$UID=$_SESSION['user_ID'];
									$name=$_SESSION['fullname'];
									$date_from=$_POST['date_from'];
									$date_to=$_POST['date_to'];
									$time_rqstd=$_POST['time_rqstd'];
									$room=$_POST['room'];
									$college=$_POST['college'];
									$item_name=$_POST['item_name'];
									$quantity=$_POST['quantity'];
									$purpose=$_POST['purpose'];
									$date_rtrn=$_POST['date_rtrn'];
									$time_rtrn=$_POST['time_rtrn'];										

									/*$check_request_query="SELECT * FROM request WHERE request_ID='$RID'";
									$check_request_result=mysqli_query($connect,$check_request_query);

									if(mysqli_num_rows($check_request_result)>0)
									{
										//there is already an existing same username
										echo '<script type="text/javascript"> alert("There is already an existing request") </script>';
										?><meta http-equiv="refresh" content=".000001;url=add_request.php"/><?php
									}
									else
									{*/
										$insert_request_query="INSERT INTO request VALUES ('','$UID','$name','$date_from','$date_to','$time_rqstd','$room','$college','$item_name','$quantity','$purpose','$date_rtrn','$time_rtrn','APPROVED')";
										$result_request_query=mysqli_query($connect,$insert_request_query);

										if($result_request_query)
										{
											echo '<script type="text/javascript"> alert("Request has been successfully registered!") </script>';
											?><meta http-equiv="refresh" content=".000001;url=manage_requests.php"/><?php
										}
										else
										{
											echo '<script type="text/javascript"> alert("ERROR!") </script>';
										}   
									//}
								}
								else
								{
									" ";
								}
							?>
						</tr>
					</form>
				</table>		
			<table>
				<tr><td><button class="back_to_menu" onclick="location='manage_requests.php'"/>◄ Back to Manage Requests</button></td></tr>
			</table>
		</div>
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