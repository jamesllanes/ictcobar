<?php
	session_start();
	session_unset();
	session_destroy();
	$_SESSION=array();
?>
<html>
	<head>
		<meta http-equiv="refresh" content=".000001;url=index-new.php"/>
	</head>
</html>