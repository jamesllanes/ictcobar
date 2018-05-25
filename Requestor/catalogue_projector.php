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

	$view_query="SELECT * FROM inventory";
	$result=mysqli_query($connect, $view_query);
	if(mysqli_num_rows($result)>0)
	{
		while($row=mysqli_fetch_assoc($result))
		{
			if ($row['equipment_name'] == 'Casio XJ-A242A Projector')
			{
				$_SESSION['b']=$row['equipment_name'];
			}
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/catalogue_laptop.css">
    <link rel="stylesheet" href="../Design Template/custom.css">
    <link rel="stylesheet" href="../Design Template/css/bootstrap.min.css">
	<link href="../Design Template/local-fonts/Orbitron/Orbitron.css" rel="stylesheet">   
	<link href="../Design Template/local-fonts/Open-Sans/Open-Sans.css" rel="stylesheet">
</head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ICTC OBaR | Catalogue</title>
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
			<p><b>Online Borrowing and Returning of Equipment</b></p><hr>
			<button class="back" onclick="location='view_catalogue.php'"/>◄ Back</button>
			<p class="Equipment_Name"><?php echo $_SESSION['b']?></p>
			<img src="css/images/projector.png"></a><br>
			<div class="Equipment_Description">
				<?php
					$view_query="SELECT * FROM inventory";
					$result=mysqli_query($connect, $view_query);
					if(mysqli_num_rows($result)>0)
					{
						while($row=mysqli_fetch_assoc($result))
						{
							if ($row['equipment_name'] == $_SESSION['b']){
								echo $row['description'];
								$_SESSION['quantity']=$row['quantity'];
								$quantity_onhand=$row['quantity_onhand'];
							}
						}
					}
				?>
			</div>
			<div class="Availability">Availability: <?php echo $quantity_onhand ?>/<?php echo $_SESSION['quantity'] ?> <!--from database--></div>
			<div class="Quantity">
				<form action="request_form_projector.php" method="POST">
				  <b>Quantity:</b>
				  <input type="number" name="quantity" min="1" max="<?php echo $quantity_onhand ?>" value="1">
				  <input type="hidden" name="b" value="<?php echo $_SESSION['b'] ?>">
				  <input type="submit" class="submit_request" value="Request Equipment">
				</form>
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