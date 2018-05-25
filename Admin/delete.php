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
    <title>ICTC OBaR | User Accounts</title>
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
				<?php
					$ID=$_SESSION['userID_selected'];
	
					$query="SELECT * FROM userinfotable WHERE user_ID='$ID'";
					$result=mysqli_query($connect,$query);

					if(mysqli_num_rows($result)>0)
					{
						while($row=mysqli_fetch_array($result))
						{?>
							<form action="delete.php" method="POST">
								<tr>
									<td><label>User ID</label></td>
									<td><?php echo $row['user_ID']?></td>
								</tr>
								<tr>
									<td><label>Fullname</label></td>
									<td><?php echo $row['fullname']?></td>
								</tr>
								<tr>
									<td><label>Gender</label></td>
									<td><?php echo $row['gender']?></td>
								</tr>
								<tr>
									<td><label>Birthday</label></td>
									<td><?php echo $row['birthday']?></td>
								</tr>
								<tr>
									<td><label>Contact Number</label></td>
									<td><?php echo $row['contact_num']?></td>
								</tr>
								<tr>
									<td><label>Email</label></td>
									<td><?php echo $row['email']?></td>
								</tr>
								<tr>
									<td><label>Username</label></td>
									<td><?php echo $row['username']?></td>
								</tr>
								<tr>
									<td><label>Password</label></td>
									<td><?php echo $row['password']?></td>
								</tr>
								<tr>
									<td><label>Usertype</label></td>
									<td><?php echo $row['usertype']?></td>
								</tr>
								<tr>
									<td colspan="2"><input type="submit" name="delete" value="Delete User Account"></td>
									<?php
										if(isset($_POST['delete']))
										{
											$delete_query="DELETE FROM userinfotable WHERE user_ID='$ID'";
											$delete_result=mysqli_query($connect,$delete_query);

											if($delete_result)
											{
												echo '<script type="text/javascript"> alert("User account has been successfully deleted!"); window.location = "manage_accounts.php"; </script>';
											}
											else
											{
												echo "<script type='javascript/text'> alert('Delete Error!') </script>";
											}
										}
										else
										{
											" ";
										}
									?>
								</tr>
							</form><?php
						}
					}
					else
					{
						echo " ";
					}?>
			</table>		
			<table>
				<tr><td><button class="back_to_menu" onclick="location='manage_accounts.php'"/>◄ Back to User Accounts</button></td></tr>
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