<?php 
	if (isset($_SERVER['HTTP_REFERER']))
	{
		require "system/sistem.php";
		dbConnect();	
		
		$par_name= trim($_POST['frm_name']);
		$par_email=trim($_POST['frm_email']);
		$par_hp=trim($_POST['frm_hp']);
		$par_alamat=$_POST['frm_alamat'];
		$par_namausaha=$_POST['frm_namausaha'];
		$par_jenisusaha=$_POST['frm_jenisusaha'];
		$par_kategori=$_POST['frm_category'];
		$par_lokasi=$_POST['frm_lokasiusaha'];
		$par_periodemulai=$_POST['frm_periodemulai'];
		$par_ip=$_POST['frm_ip'];
		$par_date=date("Y-m-d");
		
			if($par_name == "")
			{
				header("Location:registrasi.php?pesan=Name harus diisi !");
			}
			elseif($par_email == "" ) 
			{
				header("Location:registrasi.php?pesan=Email harus diisi!");
			}
			elseif( $par_hp == "" )
			{
				header("Location:registrasi.php?pesan=No. HP harus diisi!");
			}
			elseif( $par_alamat == "" )
			{
				header("Location:registrasi.php?pesan=Alamat harus diisi!");
			}
			elseif (!filter_var($par_email, FILTER_VALIDATE_EMAIL)) 
			{
				header("Location:registrasi.php?pesan=Format email salah!");
			}
			else
			{
				$par_name = periksa_input($par_name);
				$par_email = periksa_input($par_email);
				$par_hp = periksa_input($par_hp);
				$par_alamat = periksa_input($par_alamat);
				$par_namausaha = periksa_input($par_namausaha);
				$par_jenisusaha= periksa_input($par_jenisusaha);
				$par_kategori= periksa_input($par_kategori);
				$par_lokasi= periksa_input($par_lokasi);
				$par_umkmkode= get_number($dbconn);
				$sql_query=	"INSERT INTO umkm(umkmkode,namalengkap, alamat, email, nohp, namausaha, jenisusaha, categoryid, lokasiusaha, periodeusaha, dateinsert, password, ipaddress) VALUES ('$par_umkmkode','$par_name','$par_alamat','$par_email','$par_hp','$par_namausaha','$par_jenisusaha',$par_kategori,'$par_lokasi','$par_periodemulai','$par_date','".randomPassword()."','$par_ip')";
				$res1 = mysqli_query($dbconn,$sql_query) or error( mysqli_error());
				if(!$res1)
				{
					$_SESSION['pesan'] = 'Silahkan periksa lagi data yang anda masukkan!';
					header("Location:registrasi.php");
				}
				else
				{
					$_SESSION['pesan'] = 'Data anda sudah dikirim!';
					header("Location:registrasi.php");
				}
			}
	}
	else
	{
		header("Location:registrasi.php");
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
		$sqlnum="SELECT max(umkmid) + 1 as 'autonom' FROM umkm";
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
