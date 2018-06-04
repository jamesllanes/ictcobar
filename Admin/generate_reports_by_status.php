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

	function fetch_data()  
	{  
		$output = '';
		$connect = mysqli_connect("localhost", "root", "", "ictc_obar");    
		$sql_query="SELECT * FROM request ORDER BY status ASC";  
		$result_query=mysqli_query($connect,$sql_query);

		if(mysqli_num_rows($result_query)>0)
		{
			while($row=mysqli_fetch_array($result_query))  
			{
				$request_ID=$row['request_ID'];
				$rqstr_name=$row['rqstr_name'];
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
				
				$output .= '<tr>
								<td class="info">'.$request_ID.'</td>
								<td class="info">'.$rqstr_name.'</td>
								<td>'.$date_from.'</td>
								<td>'.$date_to.'</td>
								<td>'.date("h:i A", strtotime($time_rqstd)).'</td>
								<td>'.$room.'</td>
								<td>'.$college.'</td>
								<td>'.$item_name.'</td>
								<td>'.$quantity.'</td>
								<td>'.$date_rtrn.'</td>
								<td>'.date("h:i A", strtotime($time_rtrn)).'</td>
								<td>'.$status.'</td>
							</tr>'; 
			}
		} 
		return $output;  
	} 

	if(isset($_POST["print"]))  
	{  
		require_once('../tcpdf/tcpdf.php');  
		$obj_pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
		$obj_pdf->SetCreator(PDF_CREATOR);  
		$obj_pdf->SetTitle("Summary of Requests Order By Status");
		$obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
		$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
		$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
		$obj_pdf->SetDefaultMonospacedFont('helvetica');  
		$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
		$obj_pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);  
		$obj_pdf->setPrintHeader(false);  
		$obj_pdf->setPrintFooter(false);  
		$obj_pdf->SetAutoPageBreak(TRUE, 10);  
		$obj_pdf->SetFont('helvetica', '', 12);  
		$obj_pdf->AddPage();  
		$content = '';  
		$content .= '  
		<h3 align="center">Summary of Requests</h3><br /><br />  
		<table border="1" cellspacing="0" cellpadding="6">  
		<tr>  
			<th>Request ID</th>
			<th>Name of Requestor</th>
			<th>Request Date From</th>
			<th>Request Date To</th>
			<th>Time</th>
			<th>Room</th>
			<th>College</th>
			<th>Item Name</th>
			<th>Quantity</th>
			<th>Return Date</th>
			<th>Return Time</th>			
			<th>Status</th> 
		</tr>  
		';  
		$content .= fetch_data();  
		$content .= '</table>';  
		$obj_pdf->writeHTML($content);  
		$obj_pdf->Output('sample.pdf', 'I');  
	}
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/view_requests.css">
    <link rel="stylesheet" href="../Design Template/custom.css">
    <link rel="stylesheet" href="../Design Template/css/bootstrap.min.css">
	<link href="../Design Template/local-fonts/Orbitron/Orbitron.css" rel="stylesheet">   
	<link href="../Design Template/local-fonts/Open-Sans/Open-Sans.css" rel="stylesheet">
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
			<table class="status_table" border=1>
				<th colspan='14'><center>Equipment Requests Summary </center></th>
				<tr>
					<td><label>Request ID</label></td>
					<td><label>Name of Requestor</label></td>
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
				</tr>
				<?php
					echo fetch_data();
				?>
			</table>
			<tr><td><button class="back_to_menu" onclick="location='manage_reports.php'"/>◄ Back to Manage Reports</button></td></tr><br>
			<form method="POST">
				<input type="submit" name="print" value="Generate PDF">
			</form>
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