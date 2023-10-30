<?php

use PHPMailer\PHPMailer\PHPMailer;

require "./system/PHPMailer/src/Exception.php";
require "./system/PHPMailer/src/PHPMailer.php";
require "./system/PHPMailer/src/SMTP.php";

session_start();
$password = bin2hex(random_bytes(8));

if (isset($_SERVER['HTTP_REFERER'])) {
    require "system/sistem.php";
    dbConnect();

    $par_name = trim($_POST['frm_name']);
    $par_nik = trim($_POST['frm_nik']);
    $par_hp = trim($_POST['frm_hp']);
    $par_email = trim($_POST['frm_email']);
    $par_ig = trim($_POST['frm_ig']);
    $par_namausaha = $_POST['frm_namausaha'];
    $par_jenisusaha = $_POST['frm_kategori'];
    $par_alamat = $_POST['frm_alamat'];
    $par_ip = $_POST['frm_ip'];
    $par_date = date("Y-m-d");

    if ($par_name == "") {
        header("Location: register.php?pesan=Name harus diisi !");
    } elseif ($par_email == "") {
        header("Location: registrasi.php?pesan=Email harus diisi!");
    } elseif ($par_nik == "") {
        header("Location: register.php?pesan=NIK harus diisi!");
    } elseif ($par_hp == "") {
        header("Location: register.php?pesan=No. HP harus diisi!");
    } elseif (!filter_var($par_email, FILTER_VALIDATE_EMAIL)) {
        header("Location: register.php?pesan=Format email salah!");
    } else {
        $par_name = periksa_input($par_name);
        $par_nik = periksa_input($par_nik);
        $par_hp = periksa_input($par_hp);
        $par_email = periksa_input($par_email);
        $par_ig = periksa_input($par_ig);
        $par_namausaha = periksa_input($par_namausaha);
        $par_jenisusaha = periksa_input($par_jenisusaha);
        $par_alamat = periksa_input($par_alamat);
        $par_umkmkode = get_number($dbconn);

        $password = bin2hex(random_bytes(8));
        $hashedPassword = hashPassword($password);

        // Check if the email already exists in the database
        $email_check_query = "SELECT COUNT(*) as email_count FROM register WHERE email = '$par_email'";
        $result = mysqli_query($dbconn, $email_check_query);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $email_count = $row['email_count'];

            if ($email_count > 0) {
                // Email already exists, so redirect with an error message
                $_SESSION['pesan'] = 'Alamat email sudah terdaftar. Silakan gunakan alamat email lain!';
                header("Location: register.php");
            } else {
                // Email is unique, proceed with registration
                $sql_query = "INSERT INTO register(umkmkode, nama, nik, nohp, namausaha, jenisusaha, dateinsert, password, ipaddress, email, ig, alamat, usercreated, status) VALUES ('$par_umkmkode', '$par_name', '$par_nik', '$par_hp', '$par_namausaha', '$par_jenisusaha', '$par_date', '$hashedPassword', '$par_ip', '$par_email', '$par_ig', '$par_alamat', 'owner', 'onreview')";

                $res1 = mysqli_query($dbconn, $sql_query) or error(mysqli_error());
                if (!$res1) {
                    $_SESSION['pesan'] = 'Silakan periksa lagi data yang anda masukkan!';
                    header("Location: register.php");
                } else {
                    // Send the email and display success or error message
                    $mail = new PHPMailer(true);
                    $mail->IsSMTP();
                    $mail->SMTPSecure = 'ssl';
                    $mail->Host = "smtp.gmail.com"; // host masing-masing provider email
                    $mail->SMTPDebug = 1;
                    $mail->Port = 465;
                    $mail->SMTPAuth = true;
                    $mail->Username = "tiooluciferr666@gmail.com"; // user email
                    $mail->Password = "wydxgdgzuxevthrw"; // password email
                    $mail->SetFrom("tiooluciferr666@gmail.com"); // set email pengirim

                    $pesan = "
                    <html>
                    <head>
                        <title>Password Reset</title>
                    </head>
                    <body>
                        <p>Halo,</p>
                        <p>Kami ingin memberitahu Anda bahwa password Anda yang baru telah dibuat.</p>
                        <p>Berikut adalah detail login Anda:</p>
                        <ul>
                        <li><strong>Username:</strong> " . $par_email . "</li>
                        <li><strong>Password Baru:</strong> " . $password . "</li>
                        </ul>
                        <p>Silakan login dengan informasi di atas. Jika Anda memiliki pertanyaan atau memerlukan bantuan lebih lanjut, jangan ragu untuk menghubungi kami.</p>
                        <p>Untuk keamanan Anda, kami sangat menyarankan Anda untuk segera mengganti password yang baru diberikan. Silakan masuk dan lakukan perubahan password Anda segera.</p>
                    </body>
                    </html>
                            ";

                    $mail->Subject = "Password Anda"; // Subjek email
                    $mail->Body = $pesan;
                    $mail->IsHTML(true); // Set email sebagai HTML
                    $mail->AddAddress($par_email); // Tujuan email

                    $sendEmail = $mail->Send();
                    if ($sendEmail) {
                        $_SESSION['msg'] = 'Data anda berhasil dikirim!';
                        header("Location: register.php");
                    } else {
                        $_SESSION['msg'] = "Pesan gagal dikirim: " . $mail->ErrorInfo;
                    }
                }
            }
        } else {
            // Handle the database query error
            $_SESSION['pesan'] = 'Terjadi kesalahan dalam memeriksa email.';
            header("Location: register.php");
        }
    }
} else {
    header("Location: register.php");
}

function hashPassword($pass)
{
    $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);
    return $hashedPassword;
}

function get_number($numConn)
{
    $sqlnum = "SELECT max(umkmid) + 1 as 'autonom' FROM register";
    $resnum = mysqli_query($numConn, $sqlnum);
    $jmlnum = @mysqli_num_rows($resnum);

    if ($jmlnum != 0) {
        $rowsnum = mysqli_fetch_assoc($resnum);
        $autonumeric = sprintf('%03s', $rowsnum['autonom']);
        return "UMKM-" . $autonumeric;
    }
}
