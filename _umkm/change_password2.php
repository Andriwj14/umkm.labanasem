<?php
require "../system/sistem.php";
dbConnect();
session_start();

$time = $_SERVER['REQUEST_TIME'];

if (isset($_SESSION['LAST_ACTIVITY']) && ($time - $_SESSION['LAST_ACTIVITY']) > $_SESSION['TIME_DURATION']) {
    session_unset();
    session_destroy();
    session_start();
    header("Location:index.php?pesan=Session Expired!");
} elseif (isset($_SESSION['ses_username'])) {
    $ses_id = $_SESSION['ses_id'];
    $oldpassword = trim($_POST['oldpassword']);
    $newpassword = trim($_POST['newpassword']);
    $renewpassword = trim($_POST['renewpassword']);

    // Pastikan Anda telah mengatur $_SESSION['ses_password'] saat pengguna login
    $ses_password = $_SESSION['ses_password'];

    if (!password_verify($oldpassword, $ses_password)) {
			// var_dump($ses_password, $oldpassword);
			// die;
        $pesan = "Password Lama Anda Tidak Sesuai!";
        header("Location:change_password.php?pesan=$pesan");
    } elseif ($oldpassword == "") {
        $pesan = "Masukkan Password Lama Anda!";
        header("Location:change_password.php?pesan=$pesan");
    } elseif ($newpassword == "") {
        $pesan = "Masukkan Password Baru!";
        header("Location:change_password.php?pesan=$pesan");
    } elseif ($renewpassword == "") {
        $pesan = "Masukkan Password Baru Lagi Kosong!";
        header("Location:change_password.php?pesan=$pesan");
    } elseif ($newpassword != $renewpassword) {
        $pesan = "Password Baru Yang Anda Masukkan Berbeda!";
        header("Location:change_password.php?pesan=$pesan");
    } else {
        // Securing the new password with password_hash
        $newestpassword = password_hash($renewpassword, PASSWORD_DEFAULT);
        $query = "UPDATE register SET password = '$newestpassword' WHERE umkmid = $ses_id";
        $res = mysqli_query($dbconn, $query) or error(mysqli_error($dbconn));

        if (!$res) {
            header("Location:change_password.php?pesan=Tidak dapat mengubah password!");
        } else {
            $pesan = "Password Berhasil diubah!";
            header("Location:logout.php");
        }
    }
} else {
    header("Location:index.php?pesan=Forbidden Access!");
}
