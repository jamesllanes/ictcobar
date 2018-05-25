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

	$cancel_ID=$_POST['cancel_ID'];
	//print_r($_POST['cancel_ID']);

	$query_select="SELECT * FROM request WHERE request_ID = '$cancel_ID'";
	$result_query=mysqli_query($connect,$query_select);
	if(mysqli_num_rows($result_query)>0)
	{			
		while($row=mysqli_fetch_array($result_query))
		{
			if(($row['status'] == 'PENDING') || ($row['status'] == 'Request for Cancellation'))
			{
				$query_request="UPDATE request SET status='Request for Cancellation' WHERE request_ID = '$cancel_ID'";
				$query_update=mysqli_query($connect,$query_request);

				if($query_update)
				{
					echo "<script type=text/javascript> alert('Request for cancellation has been successfully submitted!'); window.location = 'view_status.php'; </script>";
				}
				else
				{
					echo '<script type="text/javascript"> alert("ERROR update!") </script>';
					echo (mysqli_error());
				}
			}
			elseif($row['status'] == 'APPROVED')
			{
				$query_request="UPDATE request SET status='Request for Cancellation' WHERE request_ID = '$cancel_ID'";
				$query_update=mysqli_query($connect,$query_request);

				$query_apprv="UPDATE for_approval SET status ='Request for Cancellation' WHERE request_ID = '$cancel_ID'";
				$query_update_apprv=mysqli_query($connect,$query_apprv);
							
				if($query_update && $query_update_apprv)
				{
					echo "<script type=text/javascript> alert('Request for cancellation has been successfully submitted!'); window.location = 'view_status.php'; </script>";
				}
				else
				{
					echo '<script type="text/javascript"> alert("ERROR update!") </script>';
					echo (mysqli_error());
				}
			}
		}
	}
	else
	{
		echo '<script type="text/javascript"> alert("ERROR inventory") </script>';
		//echo (mysqli_error());
	}
?>