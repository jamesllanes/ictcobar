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
	<link rel="stylesheet" href="css/view_status.css">
    <link rel="stylesheet" href="../Design Template/custom.css">
    <link rel="stylesheet" href="../Design Template/css/bootstrap.min.css">
	<link href="../Design Template/local-fonts/Orbitron/Orbitron.css" rel="stylesheet">   
	<link href="../Design Template/local-fonts/Open-Sans/Open-Sans.css" rel="stylesheet">
</head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ICTC OBaR | Request Status</title>
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
		</div>
		<div>
			<?php
				$query1="SELECT * FROM request WHERE user_ID=$_SESSION[user_ID]";
				$result1=mysqli_query($connect,$query1);

				if(mysqli_num_rows($result1)>0)
				{
					while($row=mysqli_fetch_array($result1))
					{
						$comment=$row['comment'];
						$status=$row['status'];
						if(($comment!=NULL) && ($status!='PENDING') && ($status!='CANCELLED'))
						{
							$size='13';
						}
						else
						{
							$size='12';
						}
					}
				}
				else
				{
					$size='11';
				}
			?>
			<table class="status_table" border=1>
				<th colspan='<?php echo $size ?>'><center>Equipment Request Form</center></th>
				<tr>
					<td><label>Request ID</label></td>
					<td><label>Request Date From</label></td>
					<td><label>Request Date To</label></td>
					<td><label>Time</label></td>
					<td><label>Room</label></td>
					<td><label>College</label></td>
					<td><label>Item Name</label></td>
					<td><label>Quantity</label></td>
					<td><label>Return Date</label></td>
					<td><label>Return Time</label></td>
					<td><label>Status</label></td>

					<?php
					$query="SELECT * FROM request";
					$result=mysqli_query($connect,$query);

					if(mysqli_num_rows($result)>0)
					{
						while($row=mysqli_fetch_array($result))
						{
							$status=$row['status'];
						}
						if($status=='CANCELLED')
						{
							?><td></td><?php
						}
						else
						{
							?><td><label>Action</label></td><?php
						}
					}
					?>

					<?php
					$query1="SELECT * FROM request WHERE user_ID='$_SESSION[user_ID]'";
					$result1=mysqli_query($connect,$query1);

					if(mysqli_num_rows($result1)>0)
					{
						while($row=mysqli_fetch_array($result1))
						{
							$comment=$row['comment'];
							if($comment!=NULL)
							{
								?>
								<td><label>Comment</label></td>
								<?php
							}
						}
					}
					?>
				</tr>
				<?php
					$query="SELECT * FROM request WHERE user_ID=$_SESSION[user_ID]";
					$result=mysqli_query($connect,$query);

					if(mysqli_num_rows($result)>0)
					{
						while($row=mysqli_fetch_array($result))
						{
							$request_ID=$row['request_ID'];
							$date_from=$row['date_from'];
							$date_to=$row['date_to'];
							$time_rqstd=$row['time_rqstd'];
							$room=$row['room'];
							$college=$row['college'];
							$item_name=$row['item_name'];
							$quantity=$row['quantity'];
							$date_rtrn=$row['return_date'];
							$time_rtrn=$row['return_time'];
							$status=$row['status'];
							

							echo "<tr>";
							echo "<tr><td class='info'>".$request_ID."</td>";
							echo "<td>".$date_from."</td>";
							echo "<td>".$date_to."</td>";
							echo "<td>".date('h:i A', strtotime($time_rqstd))."</td>";
							//echo "<td>".$time_r."</td>";
							echo "<td>".$room."</td>";
							echo "<td>".$college."</td>";
							echo "<td>".$item_name."</td>";
							echo "<td>".$quantity."</td>";
							echo "<td>".$date_rtrn."</td>";
							echo "<td>".date('h:i A', strtotime($time_rtrn))."</td>";
							echo "<td>".$status."</td>";
							
							if(($status=='Request for Cancellation') || ($status=='CANCELLED'))
							{
								?><td></td><?php
							}
							else
							{
								?><form action="view_status2.php" method="POST">
								<td><input type="submit" name="cancel" class="cancel_btn" value="Cancel"/></td>
								<input type="hidden" name="cancel_ID" value="<?php echo $request_ID?>">
								</form><?php
							}
							if($row['comment']!=NULL)
							{
								$comment=$row['comment'];
								?><td><?php echo $comment ?></td><?php
							}
							//Ang laman ng cancel request ay yung process ng update na magiging cancel ang request tapos nakaheader dito sa view status with alert na cancel request sent.
							echo "</tr>";
						}
					}
					else
					{?>
						<tr><td colspan='12'><b>NOTHING TO DISPLAY!!!</b></td></tr><?php
					}
				?>
			</table>
			<table>
				<tr><td><button class="back_to_menu" onclick="location='homepage_requestor.php'"/>◄ Back to Homepage</button></td></tr>
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