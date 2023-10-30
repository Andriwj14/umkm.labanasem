<?php 
session_start();
require "../system/sistem.php";
dbConnect();	
	$time = $_SERVER['REQUEST_TIME'];
	if (isset($_SESSION['LAST_ACTIVITY']) &&  ($time - $_SESSION['LAST_ACTIVITY']) > $_SESSION['TIME_DURATION']) {
		session_unset();
		session_destroy();
		session_start();
		header( "Location:index.php?pesan=Session Expired!" );
	}
	else if (isset($_SESSION['ses_username'])) 
	{
		
		$par_id= $_POST['frm_lblhiddenid'];
		$par_name= $_POST['frm_nama'];
		$par_nik=trim($_POST['frm_nik']);
		$par_alamat=$_POST['frm_alamat'];
		$par_email=trim($_POST['frm_email']);
		$par_hp=trim($_POST['frm_nohp']);
		$par_ig=trim($_POST['frm_ig']);
		$par_namausaha=$_POST['frm_namausaha'];
		$par_jenisusaha=$_POST['frm_jenisusaha'];
		$par_date=date("Y-m-d");
		
			if($par_name == "")
			{
				$_SESSION['pesan'] = "Name harus diisi !";
				header("Location:prev_profile.php");
			}
			elseif($par_email == "" ) 
			{
				$_SESSION['pesan'] = "Email harus diisi!";
				header("Location:prev_profile.php");
			}
			elseif( $par_hp == "" )
			{
				$_SESSION['pesan'] = "No. HP harus diisi!";
				header("Location:prev_profile.php");
			}
			elseif( $par_alamat == "" )
			{
				$_SESSION['pesan'] = "Alamat harus diisi!";
				header("Location:prev_profile");
			}
			elseif (!filter_var($par_email, FILTER_VALIDATE_EMAIL)) 
			{
				$_SESSION['pesan'] = "Format email salah!";
				header("Location:prev_profile.php");
			}
			else
			{
				$par_name = periksa_input($par_name);
				$par_email = periksa_input($par_email);
				$par_hp = periksa_input($par_hp);
				$par_alamat = periksa_input($par_alamat);
				$par_namausaha = periksa_input($par_namausaha);
				$par_jenisusaha= periksa_input($par_jenisusaha);
				
				$sql_query=	"UPDATE register SET nama='$par_name', alamat='$par_alamat',nik='$par_nik',nohp='$par_hp',email='$par_email',ig='$par_ig',namausaha='$par_namausaha',jenisusaha='$par_jenisusaha',lastupdate='$par_date' WHERE umkmid=$par_id";
				$res1 = mysqli_query($dbconn,$sql_query) or error( mysqli_error());
				if(!$res1)
				{
					//$_SESSION['pesan'] =$sql_query;
					$_SESSION['pesan'] = 'Silahkan periksa lagi data yang anda masukkan!';
					header("Location:prev_profile.php");
				}
				else
				{
					$_SESSION['pesan'] = 'Profile berhasil di update!';
					header("Location:prev_profile.php");
				}
			}
	}
?>
