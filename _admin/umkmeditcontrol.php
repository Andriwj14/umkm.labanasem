<?php
	session_start();
	require"../system/sistem.php";
	dbConnect();
	
	/* Setting Folder */
	//Session Placing ak.1452019
	$time = $_SERVER['REQUEST_TIME'];
	if (isset($_SESSION['LAST_ACTIVITY']) &&  ($time - $_SESSION['LAST_ACTIVITY']) > $_SESSION['TIME_DURATION']) {
		session_unset();
		session_destroy();
		session_start();
		header( "Location:index.php?pesan=Session Timeout" );
	}
	else if ($_SESSION['ses_hak']!='administrator')
	{
		header( "Location:index.php?pesan=Forbidden Access!" );
	}
	else
	{
		
		$cid=$_POST['frm_nid'];
		$cname =$_POST['frm_name'];
		$cnik=$_POST['frm_nik'];
		$calamat=$_POST['frm_alamat'];
		$cphone =$_POST['frm_hp'];
		$cig=$_POST['frm_ig'];
		$cnamausaha =$_POST['frm_namausaha'];
		$cjenisusaha =$_POST['frm_jenisusaha'];
		$cstatus =$_POST['frm_status'];
		$cdate=$_POST['frm_last'];
		
		if (empty($cname))
		{	
			header("Location:umkmeditform.php?uid=$cid&cmd=edit&pesan=Nama harus diisi!");
		}
		else if (empty($cnik))
		{	
			header("Location:umkmeditform.php?uid=$cid&cmd=edit&pesan=Nik harus diisi!");
		}
		else if (empty($calamat))
		{	
			header("Location:umkmeditform.php?uid=$cid&cmd=edit&pesan=Alamat harus diisi!");
		}
		else if (empty($cphone))
		{	
			header("Location:umkmeditform.php?uid=$cid&cmd=edit&pesan=No. Hp harus diisi!");
		}
		else if (empty($cnamausaha))
		{	
			header("Location:umkmeditform.php?uid=$cid&cmd=edit&pesan=Nama usaha harus diisi!");
		}
		else if (empty($cjenisusaha))
		{	
			header("Location:umkmeditform.php?uid=$cid&cmd=edit&pesan=Jenis usaha harus diisi!");
		}
		
		else 
		{
				
			$cname=periksa_input($cname);
			$cnik=periksa_input($cnik);
			$calamat=periksa_input($calamat);
			$cphone=periksa_input($cphone);
			$cig=periksa_input($cig);
			$cnamausaha=periksa_input($cnamausaha);
			$cjenisusaha=periksa_input($cjenisusaha);
			$cstatus=periksa_input($cstatus);
			
			$query="UPDATE register SET nama='$cname',
					nik='$cnik',
					alamat='$calamat',
					nohp='$cphone',
					ig='$cig',
					namausaha='$cnamausaha',
					jenisusaha='$cjenisusaha',
					status='$cstatus',
					lastupdate='$cdate' WHERE umkmid=$cid";
			$res1 = mysqli_query($dbconn,$query) or error( mysqli_error($dbconn) );
			if(!$res1)
			{
				header("Location:umkmeditform.php?uid=$cid&cmd=edit&pesan=Gagal update!");
			}
			else
			{
				// echo $cjenisusaha;
				header("Location:umkmview.php?pesan=Berhasil update!");
			}		
					
				
		}
	}
?>