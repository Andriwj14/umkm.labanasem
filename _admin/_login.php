<?php
	$time = $_SERVER['REQUEST_TIME'];
	$timeout_duration = 1800;
	
	session_start();
	require ("../system/sistem.php");
	dbConnect();
	
    $useradmin = $_POST['useradmin'];
    $passwordadmin = $_POST['passwordadmin'];
	$ip=$_POST['frm_ip'];
	$device=$_POST['frm_device'];
	$password=$passwordadmin;
	
	if($useradmin == "" )
	{
	 	$pesan="Username required!";
		header( "Location:index.php?pesan=$pesan");
	}
    elseif($passwordadmin == "")
	{
		$pesan="Password required!!";
		header( "Location:index.php?pesan=$pesan");
	}
	else
	{
		$result = mysqli_query($dbconn,"SELECT * FROM member WHERE username='$useradmin'" ) or error( mysqli_error() );
		if(mysqli_num_rows($result) != 1)
		{
			$pesan="Wrong username!";
			header( "Location:index.php?pesan=$pesan");
		}
		else
		{
			while($show=mysqli_fetch_assoc($result))
			{
				if ($show["password"]==md5($password))
				{	
					$_SESSION['LAST_ACTIVITY'] = $time;
					$_SESSION['TIME_DURATION'] = $timeout_duration;
					$_SESSION['ses_username']=$show["username"];
					$_SESSION['ses_nama']=$show["nama"];
					$_SESSION['ses_hak']=$show["hakakses"];	
					$_SESSION['ses_id']=$show["kodeuser"];			
					
					//save history
					$query="INSERT INTO loginhistory(username,ipaddress,useragent) VALUES".
					"('".$show["username"]."','$ip','$device')";
					mysqli_query($dbconn,$query) or error( mysqli_error() );
					header( "Location:admin_show.php" );			
				}
				else
				{
					$pesan ="Wrong password!";
					header( "Location:index.php?pesan=$pesan" );
				}
			}		 
		}
	}
?>



