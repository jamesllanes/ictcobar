<?php
	/*$connect=mysqli_connect("localhost","root","") or die("Unable to connect");*/
	
	$connnect=mysqli_init(); mysqli_ssl_set($con, NULL, NULL, {ca-cert filename}, NULL, NULL); mysqli_real_connect($con, "{ictc-obar.mysql.database.azure.com}", "{unknownmind@ictc-obar}", "{#P@ssw0rd}", "{ictc_obar}", 3306);

	mysqli_select_db($connect,"ictc_obar");
	if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
	}
?>