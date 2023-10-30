<?php 
	require"../system/sistem.php";
	dbConnect();	
	session_start();
	//Session Placing ak.1452019
	$time = $_SERVER['REQUEST_TIME'];
	if (isset($_SESSION['LAST_ACTIVITY']) &&  ($time - $_SESSION['LAST_ACTIVITY']) > $_SESSION['TIME_DURATION']) {
		session_unset();
		session_destroy();
		session_start();
		header( "Location:index.php?pesan=Session Expired!" );
	}
	else if (isset($_SESSION['ses_username'])) 
	{
		if ($_SESSION['ses_hak']!='administrator' && $_SESSION['ses_hak']!='leader')
		{
			header( "Location:index.php?pesan=Forbidden Access!" );
		}
		else
		{
			$ses_id=$_SESSION['ses_id'];
			
			$oldpassword= trim($_POST['oldpassword']);
			$newpassword=trim($_POST['newpassword']);
			$renewpassword=trim($_POST['renewpassword']);
			$kodehidden=$_POST['kodehidden'];
			$reoldpassword=$oldpassword;
			
			if( $oldpassword== "" )
			{
				$pesan="Old Password Required !!!";
			}
			elseif( $newpassword == "" ) 
			{
				$pesan="New Password Required!!";
			}
			elseif( $renewpassword == "" )
			{
				$pesan="Re Type New Password Required!!";
			}
			elseif($newpassword!=$renewpassword)
			{
				$pesan="Different password!!";
			}
			else
			{	
				$renewpassword=periksa_input($renewpassword);
				$newestpassword=$renewpassword;
				$res=mysqli_query($dbconn,"UPDATE member SET password='".md5($newestpassword)."' WHERE kodeuser=$ses_id") or error( mysqli_error($dbconn));
				
				if (!$res)
				{	
					header("Location:change_password.php?pesan=Cannot change password!");
				}
				else
				{
					$pesan="Password Changed!";
					header("Location:logout.php");
				}
				
			}
		}
}
else
{
	header( "Location:index.php?pesan=Forbidden Access!" );
}
?>
