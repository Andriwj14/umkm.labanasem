<?php
// Sesuai dengan kode Anda, kita mendapatkan email dan password yang dimasukkan saat login
$useradmin = $_POST['useradmin'];
$passwordadmin = $_POST['passwordadmin'];

// Menghasilkan hash password
$hashedPassword = password_hash($passwordadmin, PASSWORD_DEFAULT);
echo $hashedPassword;
die;


// Sesuai dengan kode Anda, kita mendapatkan alamat IP dan perangkat yang digunakan
$ip = $_POST['frm_ip'];
$device = $_POST['frm_device'];

// Sekarang kita periksa pengguna dengan email yang sesuai dalam database
$result = mysqli_query($dbconn, "SELECT * FROM umkm WHERE email='$useradmin'") or error(mysqli_error());
if (mysqli_num_rows($result) != 1) {
    $pesan = "Wrong username!";
    header("Location:index.php?pesan=$pesan");
} else {
    while ($show = mysqli_fetch_assoc($result)) {
        // Sekarang kita membandingkan hash password yang dimasukkan oleh pengguna dengan yang ada di database
        if ($show["password"] == $hashedPassword) {
            // Sesuai dengan kode Anda, kita simpan history login
            $query = "INSERT INTO loginhistory(username,ipaddress,useragent) VALUES" .
                "('" . $show["email"] . "','$ip','$device')";
            mysqli_query($dbconn, $query);

            // Sesuai dengan kode Anda, kita set session untuk pengguna yang berhasil login
            $_SESSION['LAST_ACTIVITY'] = $time;
            $_SESSION['TIME_DURATION'] = $timeout_duration;
            $_SESSION['ses_username'] = $show["email"];
						$_SESSION['ses_password'] = $show["password"];
            $_SESSION['ses_nama'] = $show["namalengkap"];
            $_SESSION['ses_kode'] = $show["umkmkode"];

            header("Location:product.php");
        } else {
            $pesan = "Wrong password!";
            header("Location:index.php?pesan=$pesan");
        }
    }
}
?>



<?php
	// $time = $_SERVER['REQUEST_TIME'];
	// $timeout_duration = 3000;

	// session_start();
	// require ("system/sistem.php");
	// dbConnect();

  //   $useradmin = $_POST['useradmin'];
  //   $passwordadmin = $_POST['passwordadmin'];
	// $ip=$_POST['frm_ip'];
	// $device=$_POST['frm_device'];
	// $password=$passwordadmin;

	// if($useradmin == "" )
	// {
	//  	$pesan="Username required!";
	// 	header( "Location:index.php?pesan=$pesan");
	// }
  //   elseif($passwordadmin == "")
	// {
	// 	$pesan="Password required!!";
	// 	header( "Location:index.php?pesan=$pesan");
	// }
	// else
	// {
	// 	$result = mysqli_query($dbconn,"SELECT * FROM umkm WHERE email='$useradmin'" ) or error( mysqli_error() );
	// 	if(mysqli_num_rows($result) != 1)
	// 	{
	// 		$pesan="Wrong username!";
	// 		header( "Location:index.php?pesan=$pesan");
	// 	}
	// 	else
	// 	{
	// 		while($show=mysqli_fetch_assoc($result))
	// 		{
	// 			if ($show["password"]==$password)
	// 			{
	// 				$_SESSION['LAST_ACTIVITY'] = $time;
	// 				$_SESSION['TIME_DURATION'] = $timeout_duration;
	// 				$_SESSION['ses_username']=$show["email"];
	// 				$_SESSION['ses_nama']=$show["namalengkap"];
	// 				$_SESSION['ses_kode']=$show["umkmkode"];

	// 				//save history
	// 				$query="INSERT INTO loginhistory(username,ipaddress,useragent) VALUES".
	// 				"('".$show["email"]."','$ip','$device')";
	// 				mysqli_query($dbconn,$query);
	// 				header( "Location:product.php" );
	// 			}
	// 			else
	// 			{
	// 				$pesan ="Wrong password!";
	// 				header( "Location:index.php?pesan=$pesan" );
	// 			}
	// 		}
	// 	}
	// }
?>
