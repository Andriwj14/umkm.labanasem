<!-- 
	$time = $_SERVER['REQUEST_TIME'];
	$timeout_duration = 3000;
	
	session_start();
	require ("../system/sistem.php");
	dbConnect();
	
    $useradmin = $_POST['useradmin'];
    $passwordadmin = $_POST['passwordadmin'];
	$ip=$_POST['frm_ip'];
	$device=$_POST['frm_device'];
	$password=$passwordadmin;
	
	if($useradmin == "" )
	{
	 	$_SESSION['msg']="Username required!";
		header( "Location:index.php");
	}
    elseif($passwordadmin == "")
	{
		$_SESSION['msg']="Password required!";
		header( "Location:index.php");
	}
	else
	{
		$result = mysqli_query($dbconn,"SELECT * FROM register WHERE email='$useradmin'" ) or error( mysqli_error() );
		if(mysqli_num_rows($result) != 1)
		{
			$_SESSION['msg']="Wrong username or password!";
			header( "Location:index.php");
		}
		else
		{
			while($show=mysqli_fetch_assoc($result))
			{
				if ($show["password"]==$password)
				{	
					$_SESSION['LAST_ACTIVITY'] = $time;
					$_SESSION['TIME_DURATION'] = $timeout_duration;
					$_SESSION['ses_username']=$show["email"];
					$_SESSION['ses_nama']=$show["nama"];
					$_SESSION['ses_kode']=$show["umkmkode"];	
					$_SESSION['ses_id']=$show["umkmid"];					
					
					//save history
					$query="INSERT INTO loginhistory(username,ipaddress,useragent) VALUES".
					"('".$show["email"]."','$ip','$device')";
					mysqli_query($dbconn,$query);
					header( "Location:produk.php" );			
				}
				else
				{
					$_SESSION['msg']="Wrong username or password!";
					header( "Location:index.php");
				}
			}		 
		}
	} -->



<?php
$time = $_SERVER['REQUEST_TIME'];
$timeout_duration = 3000;

session_start();
require "../system/sistem.php";
dbConnect();

$useradmin = $_POST['useradmin'];
$passwordadmin = $_POST['passwordadmin'];
$ip = $_POST['frm_ip'];
$device = $_POST['frm_device'];

if ($useradmin == "") {
    $_SESSION['msg'] = "Username required!";
    header("Location:index.php");
} elseif ($passwordadmin == "") {
    $_SESSION['msg'] = "Password required!";
    header("Location:index.php");
} else {
    $result = mysqli_query($dbconn, "SELECT * FROM register WHERE email='$useradmin'") or error(mysqli_error());
    if (mysqli_num_rows($result) != 1) {
        $_SESSION['msg'] = "Wrong username or password!";
        header("Location:index.php");
    } else {
        $show = mysqli_fetch_assoc($result);
        $hashedPassword = password_hash($passwordadmin, PASSWORD_DEFAULT); // Menghasilkan hash password yang dimasukkan saat login

        if (password_verify($passwordadmin, $show["password"])) {
            $_SESSION['LAST_ACTIVITY'] = $time;
            $_SESSION['TIME_DURATION'] = $timeout_duration;
            $_SESSION['ses_username'] = $show["email"];
            $_SESSION['ses_nama'] = $show["nama"];
            $_SESSION['ses_kode'] = $show["umkmkode"];
            $_SESSION['ses_id'] = $show["umkmid"];

            // Simpan history
            $query = "INSERT INTO loginhistory(username, ipaddress, useragent) VALUES" .
                "('" . $show["email"] . "','$ip','$device')";
            mysqli_query($dbconn, $query);
            header("Location:produk.php");
        } else {
            $_SESSION['msg'] = "Wrong username or password!";
            header("Location:index.php");
        }
    }
}
