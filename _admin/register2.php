<?php
	session_start();
	if (isset($_SERVER['HTTP_REFERER']))
	{
		require "../system/sistem.php";
		dbConnect();	
		
		$par_name= trim($_POST['frm_name']);
		$par_nik=trim($_POST['frm_nik']);
		$par_hp=trim($_POST['frm_hp']);
		$par_email=trim($_POST['frm_email']);
		$par_ig=trim($_POST['frm_ig']);
		$par_namausaha=$_POST['frm_namausaha'];
		$par_jenisusaha=$_POST['frm_jenisusaha'];
		$par_alamat=$_POST['frm_alamat'];
		$par_ip=$_POST['frm_ip'];
		$par_date=date("Y-m-d");
		
			if($par_name == "")
			{
				$_SESSION['pesan']="Name harus diisi !";
				header("Location:register.php");
			}
			elseif($par_email == "" ) 
			{
				$_SESSION['pesan']="Email harus diisi!";
				header("Location:registrasi.php");
			}
			elseif($par_nik == "" ) 
			{
				$_SESSION['pesan']="NIK harus diisi!";
				header("Location:register.php");
			}
			elseif( $par_hp == "" )
			{
				$_SESSION['pesan']="No. HP harus diisi!";
				header("Location:register.php");
			}
			elseif (!filter_var($par_email, FILTER_VALIDATE_EMAIL)) 
			{
				$_SESSION['pesan']="Format email salah!";
				header("Location:register.php");
			}
			else
			{
				$par_name = periksa_input($par_name);
				$par_nik = periksa_input($par_nik);
				$par_hp = periksa_input($par_hp);
				$par_email = periksa_input($par_email);
				$par_ig = periksa_input($par_ig);
				$par_namausaha = periksa_input($par_namausaha);
				$par_jenisusaha= periksa_input($par_jenisusaha);
				$par_alamat= periksa_input($par_alamat);
				$par_umkmkode= get_number($dbconn);
				
				$sql_query=	"INSERT INTO register(umkmkode,nama, nik, nohp, namausaha, jenisusaha, dateinsert, password, ipaddress,email, ig,alamat,usercreated,status) VALUES ('$par_umkmkode','$par_name','$par_nik','$par_hp','$par_namausaha','$par_jenisusaha','$par_date','".randomPassword()."','$par_ip','$par_email','$par_ig','$par_alamat','administrator','onreview')";
				
				$res1 = mysqli_query($dbconn,$sql_query) or error( mysqli_error());
				if(!$res1)
				{
					
					$_SESSION['pesan'] = 'Silahkan periksa lagi data yang anda masukkan!';
					header("Location:register.php");
				}
				else
				{
					$_SESSION['pesan'] = 'Data anda sudah dikirim!';
					header("Location:umkmview.php");
				}
			}
	}
	else
	{
		header("Location:register.php");
	}	
function randomPassword() 
{
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}	
function get_number($numConn)
{
		$sqlnum="SELECT max(umkmid) + 1 as 'autonom' FROM register";
		$resnum= mysqli_query($numConn,$sqlnum);
		$jmlnum = @mysqli_num_rows($resnum);
		
		if ($jmlnum!=0)
		{
			$rowsnum = mysqli_fetch_assoc($resnum);
			$autonumeric = sprintf('%03s', $rowsnum['autonom']);
			//$autonumeric = $rowsnum['autonom'];
			return "UMKM-".$autonumeric;
		}
}
?>
