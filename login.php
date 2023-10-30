<?php
session_start();
require"system/sistem.php";
dbConnect();

?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Masuk</title>
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css"/>
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
					<form method="post" action="_login.php" enctype="multipart/form-data">
					<input type="hidden" name="frm_date" value="<?php echo date("Y-m-d H:i:s"); ?>">
					<div class="form-group">
						<label class="col-md-12 font-weight-bold" style="font-size:16pt;" for="name">Masuk</label>
						<label class="col-md-12 text-justify" style="font-size:12pt;" for="name">Jika anda belum memiliki akun, anda dapat <a href="registrasi.php" class="text-success">Registrasi</a> disini !</label>
						
						<label class="col-md-12" style="font-size:11pt; font-weight:bold;" for="name">Username</label>
						<div class="col-md-12">
							<input type="text" id="useradmin" class="form-control" maxlength="50" name="useradmin" placeholder="Masukkan Nama Anda">
						</div>
					</div>	
					<div class="form-group">
						<label class="col-md-12" style="font-size:11pt; font-weight:bold;" for="content">Password</label>
						<div class="col-md-12">
							<input type="password" id="passwordadmin" class="form-control" maxlength="50" name="passwordadmin" placeholder="Masukkan Nama Anda">
						</div>
					</div>		
					<div class="form-group">
						<p><small><a href="lupapassword.php">Lupa Password?</a></small></p>
					</div>		
					<div class="form-group">
						<div class="col-md-12 text-right">
							<button class="btn btn-success btn-lg rounded" style="width:100%">Masuk</button>
						</div>
					</div>
					</form>
				</div>
			</div>
			</div>
        
		</div>
</body>
</html>