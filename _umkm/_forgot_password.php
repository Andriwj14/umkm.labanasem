<?php
// session_unset(); // Menghapus data sesi
// session_destroy();

use PHPMailer\PHPMailer\PHPMailer;

require "../system/PHPMailer/src/Exception.php";
require "../system/PHPMailer/src/PHPMailer.php";
require "../system/PHPMailer/src/SMTP.php";

$mail = new PHPMailer(true);
$mail->IsSMTP();
$mail->SMTPSecure = 'ssl';
$mail->Host = "smtp.gmail.com"; // Host masing-masing penyedia email
$mail->SMTPDebug = 1;
$mail->Port = 465;
$mail->SMTPAuth = true;
// * GANTI DENGAN AKUN YANG TERDAFTAR
$mail->Username = "tiooluciferr666@gmail.com"; // Alamat email
$mail->Password = "wydxgdgzuxevthrw"; // Kata sandi email
$mail->SetFrom("tiooluciferr666@gmail.com"); // Set email pengirim

session_start();
require "../system/sistem.php";
dbConnect();

$email = $_POST['email'];

// Tambahkan pemeriksaan waktu terakhir permintaan reset password
$now = time();
$minTimeBetweenRequests = 300; // 60 detik (1 menit)
$maxRequestCount = 3; // Maksimal 3 percobaan dalam waktu berdekatan

// Hapus data yang lebih tua dari satu menit
$query = "DELETE FROM reset_password_requests WHERE request_time < NOW() - INTERVAL 1 MINUTE";
mysqli_query($dbconn, $query);

// Setelah menghapus data yang lebih tua, Anda dapat melanjutkan dengan kode pembatasan waktu permintaan reset password

$result = mysqli_query($dbconn, "SELECT * FROM register WHERE email='$email'");
$res = mysqli_fetch_assoc($result);

if ($res == null) {
    $_SESSION['msg'] = "Email tidak ditemukan!";
    header("Location:forgot_password.php");
} else {
    // Hitung berapa kali pengguna telah meminta reset password dalam waktu berdekatan
    $requestCount = mysqli_query($dbconn, "SELECT COUNT(*) as count FROM reset_password_requests WHERE email='$email' AND request_time >= NOW() - INTERVAL $minTimeBetweenRequests SECOND");
    $countRow = mysqli_fetch_assoc($requestCount);
    $requestCount = $countRow['count'];

    // echo $requestCount;
    // die;

    if ($requestCount >= $maxRequestCount) {
        $_SESSION['msg'] = "Anda telah mencoba reset password terlalu sering. Harap tunggu beberapa saat sebelum mencoba lagi.";
        header("Location:forgot_password.php");
    } else {
        // Periksa waktu terakhir permintaan reset password
        $result = mysqli_query($dbconn, "SELECT request_time FROM reset_password_requests WHERE email = '$email' ORDER BY request_time DESC LIMIT 1");
        $row = mysqli_fetch_assoc($result);
        $lastRequestTime = strtotime($row['request_time']);

        if ($lastRequestTime + $minTimeBetweenRequests > $now) {
            $_SESSION['msg'] = "Permintaan reset password terlalu sering. Harap tunggu 5 menit sebelum mengirim permintaan baru.";
            header("Location:forgot_password.php");
        } else {
            // Tambahkan permintaan reset password baru
            $query = "INSERT INTO reset_password_requests (email, request_time) VALUES ('$email', NOW())";
            mysqli_query($dbconn, $query);

            $pass = rand();
            $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);
            $query = "UPDATE register SET password='$hashedPassword' WHERE email='$email'";
            mysqli_query($dbconn, $query);

            $pesan = "<html>
            <head>
              <title>Password Reset</title>
            </head>
            <body>
              <p>Halo,</p>
              <p>Kami ingin memberitahu Anda bahwa password Anda yang baru sudah direset.</p>
              <p>Berikut adalah detail login Anda:</p>
              <ul>
                <li><strong>Username:</strong> " . $email . "</li> <!-- Gantilah dengan data pengguna yang sesuai -->
                <li><strong>Password Baru:</strong> " . $pass . "</li> <!-- Gunakan password baru yang telah di-reset atau di-generate -->
              </ul>
              <p>Silakan login dengan informasi di atas. Jika Anda memiliki pertanyaan atau memerlukan bantuan lebih lanjut, jangan ragu untuk menghubungi kami.</p>
              <p>Untuk keamanan Anda, kami sangat menyarankan Anda untuk segera mengganti password yang baru diberikan. Silakan masuk dan lakukan perubahan password Anda segera.</p>
              </body>
            </html>";

            $mail->Subject = "Password Reset"; // Subjek email
            $mail->Body = $pesan;
            $mail->IsHTML(true); // Set email sebagai HTML
            $mail->AddAddress("$email"); // Tujuan email

            if ($mail->Send()) {
                $_SESSION['msg'] = "Pesan berhasil dikirim";
            } else {
                $_SESSION['msg'] = "Pesan gagal dikirim: " . $mail->ErrorInfo;
            }

            header("Location:forgot_password.php");
        }
    }
}

// use PHPMailer\PHPMailer\PHPMailer;

// require "../system/PHPMailer/src/Exception.php";
// require "../system/PHPMailer/src/PHPMailer.php";
// require "../system/PHPMailer/src/SMTP.php";

// $mail = new PHPMailer(true);
// $mail->IsSMTP();
// $mail->SMTPSecure = 'ssl';
// $mail->Host = "smtp.gmail.com"; //host masing2 provider email
// $mail->SMTPDebug = 1;
// $mail->Port = 465;
// $mail->SMTPAuth = true;
// //* NANTI DIGANTI AKUN YANG DIDAFTARKAN
// $mail->Username = "tiooluciferr666@gmail.com"; //user email
// $mail->Password = "wydxgdgzuxevthrw"; //password email
// $mail->SetFrom("tiooluciferr666@gmail.com"); //set email pengirim

// session_start();
// require "../system/sistem.php";
// dbConnect();

// $email = $_POST['email'];

// $result = mysqli_query($dbconn, "SELECT * FROM register WHERE email='$email'");
// $res = mysqli_fetch_assoc($result);

// //* Membuat fitur pembatasan pengiriman setiap 30 menit
// // $result = mysqli_query($dbconn, "SELECT last_email_sent_time FROM register WHERE email = '$email'");
// // $row = mysqli_fetch_assoc($result);
// // $lastSentTime = strtotime($row['last_email_sent_time']);

// if ($res == null) {
//     $_SESSION['msg'] = "Email tidak ditemukan!";
//     header("Location:forgot_password.php");
// } else {
//     $pass = rand();
//     $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);
//     $query = "UPDATE register SET password='$hashedPassword' WHERE email='$email'";
//     $result = mysqli_query($dbconn, $query);

//     $pesan = "<html>
// <head>
//   <title>Password Reset</title>
// </head>
// <body>
//   <p>Halo,</p>
//   <p>Kami ingin memberitahu Anda bahwa password Anda yang baru sudah direset.</p>
//   <p>Berikut adalah detail login Anda:</p>
//   <ul>
//     <li><strong>Username:</strong> " . $email . "</li> <!-- Gantilah dengan data pengguna yang sesuai -->
//     <li><strong>Password Baru:</strong> " . $pass . "</li> <!-- Gunakan password baru yang telah di-reset atau di-generate -->
//   </ul>
//   <p>Silakan login dengan informasi di atas. Jika Anda memiliki pertanyaan atau memerlukan bantuan lebih lanjut, jangan ragu untuk menghubungi kami.</p>
// </body>
// </html>";

//     $mail->Subject = "Password Reset"; // Subjek email
//     $mail->Body = $pesan;
//     $mail->IsHTML(true); // Set email sebagai HTML
//     $mail->AddAddress("$email"); // Tujuan email

//     if ($mail->Send()) {
//         $_SESSION['msg'] = "Pesan berhasil dikirim";
//     } else {
//         $_SESSION['msg'] = "Pesan gagal dikirim: " . $mail->ErrorInfo;
//     }

//     header("Location:forgot_password.php");
// }

// use PHPMailer\PHPMailer\PHPMailer;

// require "../system/PHPMailer/src/Exception.php";
// require "../system/PHPMailer/src/PHPMailer.php";
// require "../system/PHPMailer/src/SMTP.php";

// $mail = new PHPMailer(true);
// $mail->IsSMTP();
// $mail->SMTPSecure = 'ssl';
// $mail->Host = "smtp.gmail.com"; // Host masing-masing penyedia email
// $mail->SMTPDebug = 1;
// $mail->Port = 465;
// $mail->SMTPAuth = true;
// // * GANTI DENGAN AKUN YANG TERDAFTAR
// $mail->Username = "tiooluciferr666@gmail.com"; // Alamat email
// $mail->Password = "wydxgdgzuxevthrw"; // Kata sandi email
// $mail->SetFrom("tiooluciferr666@gmail.com"); // Set email pengirim

// session_start();
// require "../system/sistem.php";
// dbConnect();

// $email = $_POST['email'];

// $result = mysqli_query($dbconn, "SELECT * FROM register WHERE email='$email'");
// $res = mysqli_fetch_assoc($result);

// if ($res == null) {
//     $_SESSION['msg'] = "Email tidak ditemukan!";
//     header("Location:forgot_password.php");
// } else {
//     // Generate token unik
//     $token = md5(uniqid(rand(), true));

//     $query = "INSERT INTO password_reset_tokens (email, token, expiration_time) VALUES ('$email', '$token', NOW() + INTERVAL 1 HOUR)";
//     $result = mysqli_query($dbconn, $query);

//     //* Ini merupakan link contoh yang bisa diclick
//     $reset_link = "http://example.com/reset_password.php?email=" . urlencode($email) . "&token=" . $token;

//     $pesan = "<html>
//     <head>
//       <title>Reset Password</title>
//     </head>
//     <body>
//       <p>Halo,</p>
//       <p>Klik tautan berikut untuk mereset kata sandi Anda:</p>
//       <p><a href='$reset_link'>$reset_link</a></p>
//       <p>Tautan ini akan berlaku selama 1 jam.</p>
//       <p>Jika Anda tidak meminta reset password, abaikan email ini.</p>
//     </body>
//     </html>";

//     $mail->Subject = "Reset Password"; // Subjek email
//     $mail->Body = $pesan;
//     $mail->IsHTML(true); // Set email sebagai HTML
//     $mail->AddAddress("$email"); // Alamat email tujuan

//     if ($mail->Send()) {
//         $_SESSION['msg'] = "Tautan reset password telah dikirim ke email Anda. Silakan cek kotak masuk atau folder spam jika diperlukan.";
//     } else {
//         $_SESSION['msg'] = "Pesan gagal dikirim: " . $mail->ErrorInfo;
//     }

//     header("Location:forgot_password.php");
// }
