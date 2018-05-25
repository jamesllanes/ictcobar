<?php
	$connect=mysqli_connect("localhost","root","") or die("Unable to connect");
	mysqli_select_db($connect,"ictc_obar");
	if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
	}
?>