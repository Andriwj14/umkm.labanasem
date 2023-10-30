<?php
session_start();
require"../system/sistem.php";

//Session Placing ak.1452019
	$time = $_SERVER['REQUEST_TIME'];
	if (isset($_SESSION['LAST_ACTIVITY']) &&  ($time - $_SESSION['LAST_ACTIVITY']) > $_SESSION['TIME_DURATION']) {
		session_unset();
		session_destroy();
		session_start();
		header( "Location:index.php?pesan=Session Timeout!" );
	}
	else if (isset($_SESSION['ses_username'])) 
{
	if ($_SESSION['ses_hak']!='administrator')
	{
		header( "Location:index.php?pesan=Forbidden Access!" );
	}
	else
	{
		dbConnect();
		$ip=$_SERVER['REMOTE_ADDR'];
		if (isset($_SESSION['pesan'])) 
		{
			$pesan=	$_SESSION['pesan'];
			$_SESSION['pesan']='';
		}
		else
		{
			$pesan='';
		}
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>DASHBOARD ADMINISTRATOR</title>
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="navbar-fixed-left.min.css">
	 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="css/docs.css">
	<link rel="stylesheet" href="css/formumkm.css">
    <script src="js/jquery-3.2.1.slim.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/docs.js"></script>
</head>

<body>
	<?php
		include "menu_samping.php";
	?>
	<section class="bg-light sec-pad">
		<div class="div-bg" style="background-color:#00AA5B">
			<h4 class="h4-bg text-center"><span class="h4-bg-white">DAFTAR UMKM</span></h4>
		</div>
		<hr>
		<div class="col-md-12 col-md-offset-2 custyle">
        <div class="row">
			<!-- Isi -->
				<div class="col-md-12 ">
				<form name="contact" style="width: 100%;" action="register2.php" method="post">
				<input type="hidden" name="frm_ip" value="<?php echo $ip; ?>">
				
				<div class="form-group">
						
						<label class="col-md-12 control-label text-dark">Nama</label>
						<div class="col-md-12">
							<input type="text" id="frm_name" class="form-control1" maxlength="50" name="frm_name" placeholder="Masukkan Nama Anda">
						</div>
				</div>	
				<div class="form-group">
						<!-- label -->
						<label class="col-md-12 control-label text-dark">NIK</label>
						<div class="col-md-12">
							<!-- text -->
							<input name="frm_nik" id="frm_nik" maxlength="20" type="input" class="form-control1" placeholder="Masukkan NIK">
						</div>
				</div>
				<div class="form-group">
						<!-- label -->
						<label class="col-md-12 control-label text-dark">Alamat</label>
						<div class="col-md-12">
							<!-- text -->
							<input name="frm_alamat" id="frm_alamat" maxlength="20" type="input" class="form-control1" placeholder="Masukkan Alamat">
						</div>
				</div>
				<div class="form-group">
							<!-- label -->
							<label class="col-md-12 control-label text-dark" >Telepon</label>
							<div class="col-md-12">
								<!-- text -->
								<input name="frm_hp" id="frm_hp" maxlength="15" type="input" class="form-control1" placeholder="Masukkan Telepon">
							</div>
				</div>
				<div class="form-group">
						<!-- label -->
						<label class="col-md-12 control-label text-dark" for="Email">Email</label>
						<div class="col-md-12">
							<!-- text -->
							<input name="frm_email" id="frm_email" maxlength="100" type="input" class="form-control1" placeholder="Masukkan Email">
						</div>
				</div>
				<div class="form-group">
						<!-- label -->
						<label class="col-md-12 control-label text-dark" for="Email">Instagram</label>
						<div class="col-md-12">
							<!-- text -->
							<input name="frm_ig" id="frm_ig" maxlength="100" type="input" class="form-control1" placeholder="Masukkan ID Instagram">
						</div>
				</div>
				<div class="form-group">
							<!-- label -->
							<label class="col-md-12 control-label text-dark" >Nama Usaha</label>
							<div class="col-md-12">
								<!-- text -->
								<input name="frm_namausaha" name="frm_namausaha" maxlength="100" type="input" class="form-control1" placeholder="Masukkan Nama Usaha">
							</div>
				</div>
				<div class="form-group">
							<!-- label -->
							<label class="col-md-12 control-label text-dark" >Jenis Usaha</label>
							<div class="col-md-12">
								<!-- text -->
								<input name="frm_jenisusaha" id="frm_jenisusaha" maxlength="100" class="form-control1" placeholder="Masukkan Jenis Usaha">
							</div>
				</div>
				<br><br><br>
				<div class="form-group">
					  <div class="col-md-12 text-left">
						<input type="submit" class="btn btn-success btn-lg rounded" value="Daftar" />
					  </div>
					</div>
				
				<div class="form-group">
					<label class="col-md-12 control-label" style="color:green"><?php echo $pesan;?></label>
				</div>
					</form> 
			 </div>
        </div>  
		</div> 
</section>
</body>
</html>
<?php 
	}
}
else
{
	header( "Location:index.php?pesan=Forbidden Access!" );
}
?>