<?php
	session_start();
	require('dbconfig/config.php');
?>
<!DOCTYPE html>
<html>
<title>ICTC OBaR | Request Form</title>
<head>
    <link rel="stylesheet" href="Design Template/custom.css">
    <link rel="stylesheet" href="Design Template/css/bootstrap.min.css">
	<link href="Design Template/local-fonts/Orbitron/Orbitron.css" rel="stylesheet">   
	<link href="Design Template/local-fonts/Open-Sans/Open-Sans.css" rel="stylesheet"></head>
    <style>
        body{
            background: #344e35 ;
            font-family: 'open_sans_condensedlight', sans-serif;
            font-size: 20px;

        }
        
                
        .navbar-nav{
        	position: relative;
            left: 35%;
            font-family: 'open_sans_condensedlight', sans-serif;
            font-size: 20px;        
        }
        
        .navbar-nav *{
	        box-sizing: border-box; 
	        transition: all 0.35s ease;
	        
	     }
	     
	     .navbar-nav li {
		     display: inline-block
		     list-style: outside none none;
		     margin: .5em 1em;
		     padding: 0;
		     
		 
		 }
		 
		 .navbar-nav a{
		 	padding: .5em 0.8em;
		 	color: rgba(255,255,255,0.5);
		 	position: relative;
		 	text-decoration: none;
		 }
		 
		 .navbar-nav a:before,
		 .navbar-nav a:after{
			 height: 14px;
			 width: 14px;
			 position: absolute;
			 content: '';
			 transition: all 0.35s ease;
			 opacity: 0;
			 
		}
		
		.navbar-nav a:before{
			right: 0;
			top: 0;
			border-right: 3px solid #087830;
			border-top: 3px solid white;
			transform: translate(-100%,50%);
			}
			
		.navbar-nav a:after{
			left: 0;
			bottom: 0;
			border-left: 3px solid #087830;
			border-bottom: 3px solid white;
			transform: translate(100%,-50%)
		}
	    a:hover:before,    
	    a:hover:after{
		    transform: translate(0%,0%);
		    opacity: 1;
		    }
        
        
        li{
            padding-left: 70px;
        }
        
        .ServiceTitle{
	        width: 1290px;
	        height: 30px;
	        background-color: #151815;
			color: white;
			text-align: 
        }
        
        .Header{
	        width: 100%;
	        height: 190px;
	        background: #151815;
	        color: white;
	        top: 90px;       
        }
        
        .Title{
			font-family: 'orbitronlight', sans-serif;
	        font-size: 200%;
	        margin: 0 auto;
	        position: absolute;
	        top: 108px;
	        left: 48%;
        }
        
        .SubTitle{
        	font-family: 'open_sans_condensedlight', sans-serif;
	        font-size: 20px;
	        position: absolute;
	        left: 50%;
	        top: 155px;
        }

        
        .logo{
	        position: absolute;
	        left: 50%;
	        top: 10px;
        }
        
        .main-body{
	        width: 1300px;
	        height: 1200px;
	        border-style: solid;
	        border-width: 5px;
	        border-color: #333;
	        background: #f2f2f2;
	        margin-top: 20px;
	        
        }
        
        footer{
	        width: 102.5%;
	        height: 320px;
	        background-color: #21282E; 
	        border-style: solid;
	        border-width: 2px;
	        border-color: #444;
	        color: white;
	        font-family: 'open_sans_condensedlight', sans-serif;
	        position: absolute;
	        top: 135%;
        }
        
        .footer-info{
	        margin-left: 50px;
	        margin-top: 0px;
	        font-size: 80%;
        } 

    </style>
    
<body>
	
	<div class="Header">
		
		<img src="Design Template/images/DLSL-logo.png" class="logo" width="100px" height="100px">
		
		<div class="Title">ICTC ONLINE </div>
		<div class="SubTitle">De La Salle Lipa </div>
		
	</div>

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


<center>


<div class="main-body">
	
	<div class="ServiceTitle">
	
	Online Borrowing and Returning of Equipment
	
</div><br>
	<table border=1>
		<form action="#" method="POST">
			<th colspan='2'><center>Equipment Request Form</center></th>
			<tr>
				<td><label>Name of Requestor:</label></td>
				<td><input type="text" name="name" value=<?php echo $_SESSION['fullname']; ?>></td>
			</tr>
			<tr>
				<td><label>Request Date:</label></td>
				<td><input type="date" name="date_rqstd" required/></td>
			</tr>
			<tr>
				<td><label>Time:</label></td>
				<td><input type="time" name="time_r" id="request_time" required></td>
			</tr>
			<tr>
				<td><label>Room:</label></td>
				<td><input type="text" name="room" placeholder="Room"></td>
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
				<td></td>
			</tr>
			<tr>
				<td><label>Item Description:</label></td>
				<td></td>
			</tr>
			<tr>
				<td><label>Quantity:</label></td>
				<td></td>
			</tr>
			<tr>
				<td><label>Purpose:</label></td>
				<td><textarea rows='2' cols='30' name="purpose" placeholder="Write your purpose here!!!" required/></textarea></td>
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
							<button name="Cancel"><b>Cancel Request</b></button>
						</center>
					</p>
				</td>
			</tr>

			<script type="text/javascript">
				Enable = function(checkbox, submit)
			    {
			        document.getElementById(submit).disabled = !chcekbox.checked; // ← !
			    }
			</script>
			<?php
				if(isset($_POST['submit']))
				{
					$rqstr_name=$_POST['rqstr_name'];
					$date_rqstd=$_POST['date_rqstd'];
					$time_r=$_POST['time_r'];
					$room=$_POST['room'];
					$college=$_POST['college'];
					$purpose=$_POST['purpose'];
					$date_rtrn=$_POST['date_rtrn'];

					$sql_insert="INSERT INTO request ('','$_SESSION[user_ID]','$_SESSION[fullname]','')";
				}
			?>
		</form>	
	</table>
</div>
</center>

</div>

<br>
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