<?php
	session_start();
	require"../system/sistem.php";
	dbConnect();
	
	$cid=$_POST['frm_nid'];
	$cketerangan =$_POST['frm_keterangan'];
	$cdate =$_POST['frm_last'];
	
	/* Setting Folder */
	//Session Placing ak.1452019
	$time = $_SERVER['REQUEST_TIME'];
	if (isset($_SESSION['LAST_ACTIVITY']) &&  ($time - $_SESSION['LAST_ACTIVITY']) > $_SESSION['TIME_DURATION']) {
		session_unset();
		session_destroy();
		session_start();
		header( "Location:index.php?pesan=Session Expired!" );
	}
	else if ($_SESSION['ses_hak']!='administrator')
	{
		header( "Location:index.php?pesan=Forbidden Access!" );
	}
	else
	{if (trim($cketerangan)=='')
		{	
			header("Location:pengajuaneditform.php?pesan=Keterangan harus diisi!&lid=$cid");
		}
		else 
		{
			
			$cdesc=periksa_input($cketerangan);
			//******
			
			$query="UPDATE laporan SET keterangan='$cdesc',lastupdate='$cdate' WHERE laporanid=$cid";
			$res1 = mysqli_query($dbconn,$query) or error( mysqli_error($dbconn) );
			if(!$res1)
			{
				//******
				header("Location:pengajuaneditform.php?pesan=Update Gagal!&lid=$cid");
			}
			else
			{
				//******
				header("Location:pengajuan.php?pesan=Update berhasil!&lid=$cid");
			}
				
		}
	}
?>