<?php
session_start();
require"../system/sistem.php";
dbConnect();
$ip=$_SERVER['REMOTE_ADDR'];
	$device=$_SERVER['HTTP_USER_AGENT'];
	$config['base_url'] = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
	$config['base_url'] .= "://".$_SERVER['HTTP_HOST'];
	$config['base_url'] .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
	$_url = $config['base_url'];
if (isset($_SESSION['msg'])) 
{
	$pesan=	$_SESSION['msg'];
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
    <title>Masuk</title>
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
	 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="css/docs.css">
    <script src="js/jquery-3.2.1.slim.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/docs.js"></script>
	<script type="text/javascript" src="js/moment.min.js"></script>
	<script type="text/javascript" src="js/tempusdominus-bootstrap-4.min.js"></script>
	<style>
			.input-icon{
		  position: absolute;
		  left: 3px;
		  top: calc(50% - 0.5em); /* Keep icon in center of input, regardless of the input height */
		}
		input{
		  padding-left: 17px;
		}
		.input-wrapper{
		  position: relative;
		}
			.img-thumbnail {
		border: 0;
		}
	</style>
</head>
<body>
		
      <div style="max-width: 1000px;" class="mx-auto px-5x py-5">
		<div class="col-md-12 col-md-offset-2 custyle">
        <div class="row">
				<div class="col-md-6 py-5 px-5">
					<img src="img/img-log.png" class="img-thumbnail" alt="thumbnail">
				</div>
				<div class="col-md-6 py-5 px-5">
					<form method="post" action="_forgot_password.php" enctype="multipart/form-data">
					<input type="hidden" name="frm_date" value="<?php echo date("Y-m-d H:i:s"); ?>">
					<input type="hidden" name="frm_ip" value="<?php echo $ip; ?>">
					<input type="hidden" name="frm_device" value="<?php echo $device; ?>">
					<input type="hidden" name="frm_url" value="<?php echo $_url; ?>">
					<div class="form-group">
						<label class="col-md-12 font-weight-bold" style="font-size:16pt;" for="name">Lupa Password</label>
						<label class="col-md-12 text-justify" style="font-size:12pt;" for="name">Silakan masukkan email Anda untuk kami kirimkan kata sandi yang baru.</label>
						
						<label class="col-md-12" style="font-size:11pt; font-weight:bold;" for="email">Email</label>
						<div class="col-md-12">
							<input type="email" id="email" class="form-control" maxlength="50" name="email" placeholder="Masukkan Email Anda">
						</div>
					</div>	
					<!-- <div class="form-group">
						<label class="col-md-12" style="font-size:11pt; font-weight:bold;" for="content">Password</label>
						<div class="col-md-12">
							<input type="password" id="passwordadmin" class="form-control" maxlength="50" name="passwordadmin" placeholder="Masukkan Nama Anda">
						</div>
					</div>		 -->
					<div class="form-group">
						<div class="col-md-12 text-left">
							<button class="btn btn-success btn-lg rounded" style="width:100%">Kirim</button>
							<p class="" style="font-weight: bold">
								<a href="index.php">Kembali Login</a>
							</p>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-12 text-success font-weight-bold" for="content"><?php 
							echo $pesan; 
							unset($_SESSION['msg']);
						?></label>
						</div>
					</form>
				</div>
			</div>
			</div>
        
		</div>
</body>
</html>