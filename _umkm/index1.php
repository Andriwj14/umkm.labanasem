<?php
session_start();
session_unset();
session_destroy();

$ip=$_SERVER['REMOTE_ADDR'];
$device=$_SERVER['HTTP_USER_AGENT'];
if(empty($_GET["pesan"]))
	{
		$pesan="";
	}
	else
	{
	$pesan=$_GET['pesan'];
	}
?>
<link href="css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link href="css/login.css" rel="stylesheet" id="bootstrap-css">
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Icon -->
    <div class="fadeIn first">
		<br>
    </div>
	<div class="text-left" style="padding-left:35px;">
	<span style="color:red;"><?php echo $pesan; ?></span>
	</div>
    <!-- Login Form -->
    <form action="_login.php" method="post">
	  <input type="hidden" name="frm_ip" value="<?php echo $ip; ?>">
	  <input type="hidden" name="frm_device" value="<?php echo $device; ?>">
	 <label class="col-md-12 control-label" style="text-align:justify; font-family:century gothic; font-weight:600;"> Jika anda belum memiliki akun, anda dapat <a href="" style="color:#00AA5B;">Registrasi</a>  disini !</label>
	  <label class="col-md-12 control-label" style="text-align:justify; font-family:century gothic;">Username</label>
	  <input type="text" id="useradmin" class="fadeIn second" name="useradmin" placeholder="Masukkan Nama Anda">
	  <label class="col-md-12 control-label" style="text-align:justify; font-family:century gothic;">Password</label>
      <input type="password" id="passwordadmin" class="fadeIn third" name="passwordadmin" placeholder="Masukkan Password">
      <input type="submit" class="fadeIn fourth" value="Masuk">
    </form>
  </div>
</div>