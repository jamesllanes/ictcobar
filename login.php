<?php
	session_start();
	require('dbconfig/config.php');
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/index-new.css">
    <link rel="stylesheet" href="Design Template/custom.css">
    <link rel="stylesheet" href="Design Template/css/bootstrap.min.css">
	<link href="Design Template/local-fonts/Orbitron/Orbitron.css" rel="stylesheet">   
	<link href="Design Template/local-fonts/Open-Sans/Open-Sans.css" rel="stylesheet">
</head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OBAR: Login Page</title>
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

				</ul>
			</div>
		</nav>
	</div>

	<div class="main-body">

		<div class="Service">
			<p>Online Borrowing and Returning of Equipment</p>
		</div>

	<!--<div id="Login_Container">-->
		<div id="Login_Container">
			<div id="Login_Content">
				<form action ="login.php" method="POST">
					<?php
					if(isset($_POST['username']) && isset($_POST['password']))
					{
						$Username=$_POST['username'];
						$Password=$_POST['password'];
						
						$query="SELECT * FROM userinfotable WHERE username='$Username' AND password='$Password'";

						$result=mysqli_query($connect,$query);

						$count=mysqli_num_rows($result);

						if($count!=0)
						{
							while($row=mysqli_fetch_array($result))
							{
								$ID=$row['user_ID'];
								$username=$row['username'];
								$password=$row['password'];
								$fullname=$row['fullname'];
								$user_type=$row['usertype'];
								
								$_SESSION['user_ID']=$ID;
								$_SESSION['username']=$username;
								$_SESSION['password']=$password;
								$_SESSION['fullname']=$fullname;
								$_SESSION['usertype']=$user_type;

								if($_SESSION['usertype']=='ICTC_Admin')
								{
									if($Username==$username && $Password==$password)
									{
										header('location:Admin/admin_dashboard.php');
									}
									else
									{
										?><script type="text/javascript"> alert("Username or Password is incorrect!"); window.location = "index-new.php"; </script><?php
									}
									
								}
								elseif($_SESSION['usertype']=='Immediate_Superior')
								{
									if($Username==$username && $Password==$password)
									{	
										header('location:Immediate_Superior/immediate_superior_dashboard.php');
									}
									else
									{
										?><script type="text/javascript"> alert("Username or Password is incorrect!"); window.location = "index-new.php"; </script><?php
									}
								}
								elseif($_SESSION['usertype']=='ICTC_Approver')
								{
									if($Username==$username && $Password==$password)
									{
										header('location:Approver/approver_dashboard.php');

									}
									else
									{
										?><script type="text/javascript"> alert("Username or Password is incorrect!"); window.location = "index-new.php"; </script><?php
									}
								}
								else
								{
									if($Username==$username && $Password==$password)
									{?>
									<meta http-equiv="refresh" content=".000001;url=Requestor/homepage_requestor.php"/><?php
									}
									else
									{
										?><script type="text/javascript"> alert("Username or Password is incorrect!"); window.location = "index-new.php"; </script><?php
									}
								}
							}
						}
						else
						{
							//invalid
							?><script type="text/javascript"> alert("User Account Doesn't Exist!"); window.location = "index-new.php"; </script><?php
						}
					}
					/*else
					{
						//invalid
						?><script type="text/javascript"> alert("Invalid Username or Password!"); window.location = "index-new.php"; </script><?php
					}*/
				?>
				

					<form action="index-new.php" method="POST">
						<!--<input type="submit" value="Register" class="register"/>-->
						<br><br><br><br><br>
						<hr class="hr">
						<div class="register_msg">Don't have an account?</div>
						<button class="register"><a href="#loginScreen">Register</a></button>
						<div id="loginScreen">
							<b>Registration Form</b>
							<a href="" class="cancel_close">&times;</a>
							<table align="center" class="register_table">
								<th colspan="2">User Information</th>
								<hr class="hr_popup">
								<tr>
									<td><label>Fullname:</label></td>
									<td><input type="text" name="fullname" class="text_box" placeholder="Fullname" required/></td>
								</tr>
								<tr>
									<td><label>Gender:</label></td>
									<td>
									<input type="radio" name="gender" value="male" checked required/>Male
									<input type="radio" name="gender" value="female" required/>Female
									</td>
								</tr>
								<tr>
									<td><label>Email:</label></td>
									<td><input type="email" name="email" class="text_box" placeholder="Email" required/></td>
								</tr>
								<tr>
									<td><label>Username:</label></td>
									<td><input type="text" name="username" class="text_box" placeholder="Username" required/></td>
								</tr>
								<tr>
									<td><label>Password:</label></td>
									<td><input type="password" name="password" class="text_box" placeholder="Password" required/></td>
								</tr>
								<tr>
									<td><label>Confirm Password:</label></td>
									<td><input type="password" name="cpassword" class="text_box" placeholder="Confirm Password" required/></td>
								</tr><br>
								<tr>
									<td><button type="submit" name="register" class="register_form_btn" onclick="location='#'">Register</button></td>
									<td><button type="submit" name="cancel" class="cancel" onclick="location='#'">Cancel</button></td>
								</tr>
							</table>
						</div>
						<div id="cover" >
						</div>
					</form>
				</form>
			</div>
		</div>
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