<?php
	session_start();
	require"../system/sistem.php";
	dbConnect();
	
	$clast=$_POST['frm_last'];
	$cjudul=$_POST['frm_judul'];
	$tanggal=$_POST['frm_tanggal'];
	$waktu=$_POST['frm_waktu'];
	$cid=$_POST['frm_nid'];
	
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
	{
		if(empty($tanggal))
		{	
			header("Location:eventeditform.php?pesan=Tanggal pelaksanaan harus diisi!&nid=$cid&cmd=edit");
		}
		elseif (empty($waktu))
		{	
			header("Location:eventeditform.php?pesan=Waktu pelaksanaan harus diisi!&nid=$cid&cmd=edit");
		}
		else 
		{
			$cjudul=periksa_input($cjudul);
			$query="INSERT INTO event(newsid,tanggal,waktu,dateinsert,status,judul) values($cid,'$tanggal','$waktu','$clast','active','$cjudul')";
			$res1 = mysqli_query($dbconn,$query) or error( mysqli_error($dbconn) );
			if(!$res1)
			{
				//******
				header("Location:eventeditform.php?pesan=Gagal dijadwalkan&nid=$cid&cmd=edit");
			}
			else
			{
				//******
				header("Location:eventview.php?pesan=Berhasil dijadwalkan");
			}			
		}
	}
?>