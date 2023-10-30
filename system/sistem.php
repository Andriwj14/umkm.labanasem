<?php
//system.php
$dbHost = "localhost"; // Database host
$dbName = "db_umkm"; // Database
$dbUser = "root"; // Database user
$dbPasswd = ""; // Database password
$kode = ""; // Kode Kunci database admin
global $globalParamNews;
global $servertime;
$servertime = $_SERVER['REQUEST_TIME'];
// fungsi koneksi ke database
function dbConnect()
{
    global $dbHost, $dbUser, $dbPasswd, $dbName, $dbconn;
    $dbconn = mysqli_connect($dbHost, $dbUser, $dbPasswd, $dbName) or error(mysqli_error());
}
function error($error)
{
    echo $error;
    mysqli_query($dbconn, "INSERT into error_log (ErrorDetail) VALUES('$error')");
}
function periksa_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = str_replace("'", "''", $data);
    $data = htmlentities($data);
    return $data;
}
