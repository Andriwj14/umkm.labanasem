<?php 
	if (isset($_SERVER['HTTP_REFERER']))
	{
		require "../system/sistem.php";
		dbConnect();	
		$par_id= trim($_POST['frm_lblhiddenid']);
		$par_name= trim($_POST['frm_nama']);
		$par_email=trim($_POST['frm_email']);
		$par_hp=$_POST['par_nohp'];
		$par_alamat=$_POST['frm_alamat'];
		$par_namausaha=$_POST['frm_namausaha'];
		$par_jenisusaha=$_POST['frm_jenisusaha'];
		$par_kategori=$_POST['frm_category'];
		$par_lokasi=$_POST['frm_lokasi'];
		$par_periodemulai=$_POST['frm_periode'];
		$par_profile=$_POST['frm_deskripsi'];
		$par_date=date("Y-m-d");
		
			if($par_name == "")
			{
				header("Location:profile.php?pesan=Name harus diisi !");
			}
			elseif($par_email == "" ) 
			{
				header("Location:profile.php?pesan=Email harus diisi!");
			}
			elseif( $par_hp == "" )
			{
				header("Location:profile.php?pesan=No. HP harus diisi!");
			}
			elseif( $par_alamat == "" )
			{
				header("Location:profile.php?pesan=Alamat harus diisi!");
			}
			elseif (!filter_var($par_email, FILTER_VALIDATE_EMAIL)) 
			{
				header("Location:profile.php?pesan=Format email salah!");
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
				$par_profile= periksa_input($par_profile);
				$sql_query=	"UPDATE umkm SET namalengkap='$par_name', alamat='$par_alamat', email='$par_email', nohp='$par_hp', namausaha='$par_namausaha', jenisusaha='$par_jenisusaha', categoryid=$par_kategori, lokasiusaha='$par_lokasi', periodeusaha='$par_periodemulai', lastupdate='$par_date',profile='$par_profile' WHERE umkmid=$par_id";
				$res1 = mysqli_query($dbconn,$sql_query) or error( mysqli_error());
				if(!$res1)
				{
					$_SESSION['pesan'] = 'Silahkan periksa lagi data yang anda masukkan!';
					header("Location:profile.php");
				}
				else
				{
					$_SESSION['pesan'] = 'Data anda sudah dikirim!';
					header("Location:profile.php");
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
