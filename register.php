<?php 
	session_start();
	require('dbconfig/config.php');
	
	if(isset($_POST['register']))
	{
		$fullname=$_POST['fullname'];
		$gender=$_POST['gender'];
		$bday=$_POST['bday'];
		$contact_num=$_POST['contact_num'];
		$email=$_POST['email'];
		$username=$_POST['username'];
		$password=$_POST['password'];
		$cpassword=$_POST['cpassword'];

		if($password==$cpassword)
		{

			$look="SELECT * FROM userinfotable WHERE username='$username' AND password='$password'";
			$success_look=mysqli_query($connect,$look);

			if(mysqli_num_rows($success_look)>0)
			{
				//there is already an existing same username
				echo '<script type="text/javascript"> alert("User already exists...try another username") </script>';
				?><meta http-equiv="refresh" content=".000001;url=../OBaR/index.php"/><?php
			}
			else
			{
				$insert_query="INSERT INTO userinfotable VALUES ('','$fullname','$gender','$bday','$contact_num','$email','$username','$password','Requestor')";
				$query_run_sucessful=mysqli_query($connect,$insert_query);

				if($query_run_sucessful)
				{
					echo '<script type="text/javascript"> alert("User Registered...Redirecting to the login page.") </script>';
					?><meta http-equiv="refresh" content=".000001;url=../index.php"/><?php
				}
				else
				{
					echo '<script type="text/javascript"> alert("ERROR!") </script>';
				}   
			}
		}
		else
		{
		echo '<script type="text/javascript"> alert("Password does not match!") </script>';
		}    
	}
?>