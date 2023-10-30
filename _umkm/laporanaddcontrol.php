<?php
	session_start();
	require"../system/sistem.php";
	dbConnect();
	$cdate=$_POST['frm_date'];
	$csubject =$_POST['frm_judul'];
	$cdesc =$_POST['frm_isi'];
	$ccat =$_POST['frm_kategori'];
	$cstatus = "REQUEST";
	$umkmid=$_SESSION['ses_id'];
	/* Setting Folder */
	//Session Placing ak.1452019
	$time = $_SERVER['REQUEST_TIME'];
	if (isset($_SESSION['LAST_ACTIVITY']) &&  ($time - $_SESSION['LAST_ACTIVITY']) > $_SESSION['TIME_DURATION']) {
		session_unset();
		session_destroy();
		session_start();
		header( "Location:index.php?pesan=Session Expired!" );
	}
	else
	{
		if (trim($csubject)=='')
		{	
			header("Location:laporanaddform.php?pesan=Judul harus diisi!");
		}
		elseif (trim($cdesc)=='')
		{	
			header("Location:laporanaddform.php?pesan=Isi panjang harus diisi!");
		}
		else 
		{
			//Check Input
			$csubject=periksa_input($csubject);
			$cdesc=periksa_input($cdesc);
			$ccat=periksa_input($ccat);
			
			//******
			$query="INSERT INTO laporan(judul,tanggal,isi,kategori,status,dateinsert,umkmid) VALUES".
					  "('$csubject','$cdate','$cdesc','$ccat','$cstatus','$cdate',$umkmid)";
			$res1 = mysqli_query($dbconn,$query) or error( mysqli_error($dbconn) );
			if(!$res1)
			{
				//******
				header("Location:laporanaddform.php?pesan=Gagal Simpan!");
			}
			else
			{
				//******
				header("Location:laporanview.php?pesan=Berhasil Simpan!");
			}
									
		}
	}

?>