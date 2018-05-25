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
	$request_selected=$_POST['request_selected'];
	$_SESSION['checker']=$_POST['checker'];
	
	$query_select="SELECT * FROM request WHERE request_ID = '$request_selected'";
	$result=mysqli_query($connect,$query_select);
	if(mysqli_num_rows($result)>0)
	{

		$row=mysqli_fetch_array($result);
		$query_insert="INSERT INTO for_approval VALUES ('','$row[request_ID]','$row[user_ID]','$row[rqstr_name]','$row[date_from]','$row[date_to]','$row[time_rqstd]','$row[room]','$row[college]','$row[item_name]','$row[quantity]','$row[purpose]','$row[return_date]','$row[return_time]','$row[status]','$_SESSION[fullname]', ' ')";
		$query=mysqli_query($connect,$query_insert);

		$query_update="UPDATE request SET received_by ='$_SESSION[fullname]'";
		$query_update=mysqli_query($connect,$query_update);


		if($query && $query_update)
		{
			echo '<script type="text/javascript"> alert("Request has been successfully submitted!"); window.location = "view_requests.php"; </script>';
		}
		else
		{
			echo '<script type="text/javascript"> alert("ERROR update!") </script>';
			echo (mysql_error());
		}
	}
	else
	{
		echo '<script type="text/javascript"> alert("ERROR inventory") </script>';
		echo (mysql_error());
	}
?>