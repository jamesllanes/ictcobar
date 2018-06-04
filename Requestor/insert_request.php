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

	$name_rqstr=$_POST['name_rqstr'];
	$date_rqstd=$_POST['date_rqstd'];
	$time_r=$_POST['time_r'];
	$room=$_POST['room'];
	$college=$_POST['college'];
	$item_name=$_POST['item_name'];
	$quantity=$_POST['quantity'];
	$purpose=$_POST['purpose'];
	$date_rtrn=$_POST['date_rtrn'];
	$time_rtrn=$_POST['time_rtrn'];

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
						<a class="nav-link" href="../index.php">Home <span></span><span></span></a>
					</li>

					<li class="nav-item active">
						<a class="nav-link" href="#">ICTC Services </a>
					</li>

					<li class="nav-item active">
						<a class="nav-link" href="#">ICTC Overview</a>
					</li>

					<li class="nav-item active">
						<a class="nav-link" href="../faqs.php">View FAQ</a>
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
			<?php
			if ($a = "Acer Aspire E-15 Laptop"){
				?><button class="back" onclick="location='catalogue_laptop.php'"/>◄ Back</button><?php
			}
			elseif ($a = "Casio XJ-A242A Projector"){
				?><button class="back" onclick="location='catalogue_projector.php'"/>◄ Back</button><?php
			}
			elseif ($a = "A4tech Mouse and Keyboard"){
				?><button class="back" onclick="location='catalogue_peripherals.php'"/>◄ Back</button><?php
			}?>
			
<br>
	<table class="request_form" border=1>
		<form action="insert_request.php" method="POST">
			<th colspan='2'><center>Equipment Request Form</center></th>
			<tr>
				<td><label>Name of Requestor:</label></td>
				<td><input type="text" name="name" value="<?php echo $_SESSION['fullname']; ?>" readonly size="23"/></td>
			</tr>
			<tr>
				<td><label>Request Date:</label></td>
				<td><input type="date" name="date_rqstd" readonly value="<?php echo $date_rqstd; ?>"/></td>
			</tr>
			<tr>
				<td><label>Time:</label></td>
				<td><input type="time" name="time_r" readonly id="request_time" value="<?php echo $time_r ?>">
					</td>
			</tr>
			<tr>
				<td><label>Room:</label></td>
				<td><input type="text" name="room" readonly value="<?php echo $room ?>"></td>
			</tr>
			<tr>
				<td><label>College:</label></td>
				<td><input type="text" name="college" readonly value="<?php echo $college ?>"></td>
			</tr>
			<tr>
				<td><label>Item Name:</label></td>
				<td><input type="text" name="name" readonly value="<?php echo $item_name; ?>" size="22" readonly/></td>
			</tr>
			<tr>
				<td><label>Quantity:</label></td>
				<td><input type="text" name="quantity" readonly value="<?php echo $quantity; ?>"/></td>
			</tr>
			<tr>
				<td><label>Purpose:</label></td>
				<td><input type="text" name="purpose" readonly value="<?php echo $purpose; ?>"></td>
			</tr>
			<tr>
				<td><label>Expected Date of Return:</label></td>
				<td><input type="date" name="date_rtrn" readonly value="<?php echo $date_rtrn; ?>"/></td>
			</tr>
			<tr>
				<td><label>Expected Time of Return:</label></td>
				<td><input type="time" name="time_rtrn" readonly id="return_time" value="<?php echo $time_rtrn; ?>"/></td>
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
							<button name="Cancel"><b>Cancel Request</b></button>
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
		</form>
		<?php
		$query_ID="SELECT * FROM userinfotable WHERE fullname = '$name_rqstr'";
		$result_ID=mysqli_query($connect,$query_ID);
		if(mysqli_num_rows($result_ID)>0)
		{
			while($row=mysqli_fetch_array($result_ID))
			{
				$user_ID=$row['user_ID'];
			}
		$_SESSION['user_ID']=$user_ID;
		}



		$query="INSERT INTO request VALUES ('','".$_SESSION['user_ID']."','$name_rqstr','$date_rqstd','$time_r','$room','$college','$item_name','$quantity','$purpose','$date_rtrn','$time_rtrn','Pending')";
			$query=mysqli_query($connect,$query);

		$query_select="SELECT * FROM inventory WHERE equipment_name = '$item_name'";
		$result=mysqli_query($connect,$query_select);
		if(mysqli_num_rows($result)>0)
		{
			while($row=mysqli_fetch_array($result))
			{
				$quantity_onhand=$row['quantity_onhand'];
			}
		$requested_qty=$quantity_onhand-$quantity;
		$_SESSION['requested_qty']=$requested_qty;
		}
		else
		{
			echo '<script type="text/javascript"> alert("ERROR inventory") </script>';
						echo (mysql_error());
		}

		$query_inventory="UPDATE inventory SET quantity_onhand ='$requested_qty' WHERE equipment_name = '$item_name'";
		 //$sql = ' UPDATE tutorials_inf SET name="althamas" WHERE name="ram"';
			$query_update=mysqli_query($connect,$query_inventory);
					
					if($query_update)
					{
						echo '<script type="text/javascript"> alert("Request has been successfully submitted!"); window.location = "view_status.php"; </script>';
					}
					else
					{
						echo '<script type="text/javascript"> alert("ERROR update!") </script>';
						echo (mysql_error());
					}
		?>
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