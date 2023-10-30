<?php
session_start();

require"system/sistem.php";
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>UMKM Register</title>
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css"/>
	 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="css/docs.css">
    <script src="js/jquery-3.2.1.slim.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.js"></script>
    <script src="js/docs.js"></script>
	<script type="text/javascript" src="js/moment.min.js"></script>
	<script type="text/javascript" src="js/tempusdominus-bootstrap-4.min.js"></script>
	<style>
		.input-icon
		{
		  position: absolute;
		  left: 3px;
		  top: calc(50% - 0.5em); /* Keep icon in center of input, regardless of the input height */
		}
		input
		{
		  padding-left: 17px;
		}
		.input-wrapper
		{
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
			<!-- Isi -->
				<div class="col-md-6 py-5 px-5 ">
					<img src="img/reg-log.png" class="img-thumbnail" alt="thumbnail">
				</div>
				<div class="col-md-6 py-5 px-5 border rounded">
				<form name="contact" style="width: 100%;" action="register2.php" method="post">
				<input type="hidden" name="frm_ip" value="<?php echo $ip; ?>">
				
				<div class="form-group">
						<label class="col-md-12 font-weight-bold" style="font-size:16pt;">Register UMKM</label>
						<label class="col-md-12" style="font-size:11pt; font-weight:bold;">Nama <span class="text-danger">*)</span></label>
						<div class="col-md-12">
							<input type="text" id="frm_name" class="form-control" maxlength="50" name="frm_name" placeholder="Masukkan Nama Anda">
						</div>
				</div>	
				<div class="form-group">
						<!-- label -->
						<label class="col-md-12" style="font-size:11pt; font-weight:bold;">NIK <span class="text-danger">*)</span></label>
						<div class="col-md-12">
							<!-- text -->
							<input name="frm_nik" id="frm_nik" maxlength="20" required type="input" class="form-control" placeholder="Masukkan NIK">
						</div>
				</div>
				<div class="form-group">
						<!-- label -->
						<label class="col-md-12" style="font-size:11pt; font-weight:bold;">Alamat <span class="text-danger">*)</span></label>
						<div class="col-md-12">
							<!-- text -->
							<input name="frm_alamat" id="frm_alamat" required maxlength="150" type="input" class="form-control" placeholder="Masukkan Alamat">
						</div>
				</div>
				<div class="form-group">
							<!-- label -->
							<label class="col-md-12" style="font-size:11pt; font-weight:bold;" >Telepon <span class="text-danger">*)</span></label>
							<div class="col-md-12">
								<!-- text -->
								<input name="frm_hp" id="frm_hp" required maxlength="20" type="input" class="form-control" placeholder="Masukkan Telepon">
							</div>
				</div>
				<div class="form-group">
						<!-- label -->
						<label class="col-md-12" style="font-size:11pt; font-weight:bold;" for="Email">Email <span class="text-danger">*)</span></label>
						<div class="col-md-12">
							<!-- text -->
							<input name="frm_email" id="frm_email" required maxlength="100" type="input" class="form-control" placeholder="Masukkan Email">
						</div>
				</div>
				<div class="form-group">
						<!-- label -->
						<label class="col-md-12" style="font-size:11pt; font-weight:bold;" for="Email">Instagram</label>
						<div class="col-md-12">
							<!-- text -->
							<input name="frm_ig" id="frm_ig" maxlength="100" type="input" class="form-control" placeholder="Masukkan ID Instagram">
						</div>
				</div>
				<div class="form-group">
							<!-- label -->
							<label class="col-md-12" style="font-size:11pt; font-weight:bold;" >Nama Usaha <span class="text-danger">*)</span></label>
							<div class="col-md-12">
								<!-- text -->
								<input name="frm_namausaha" name="frm_namausaha" required maxlength="100" type="input" class="form-control" placeholder="Masukkan Nama Usaha">
							</div>
				</div>
				<div class="form-group">
							<!-- label -->
							<label class="col-md-12" style="font-size:11pt; font-weight:bold;" >Jenis Usaha <span class="text-danger">*)</span></label>
							<div class="col-md-12">
								<!-- text -->
							<select name="frm_kategori" required id="frm_kategori" class="form-control font-control-sm">
								<option value="fashion" class="form-control">Fashion</option>  
								<option value="jasa" class="form-control">Jasa</option>  
								<option value="kerajinan" class="form-control">Kerajinan</option>
								<option value="kuliner" class="form-control">Kuliner</option>
							</select>
							</div>
				</div>
				<div class="form-group">
					<small class="text-danger">*) wajib diisi</small>
				</div>
				<div class="form-group">
					<input type="submit" class="btn btn-success btn-lg rounded" style="width:100%" value="Daftar" />
				</div>
				<div class="form-group">
					<label class="col-md-12 control-label" style="color:red"><?php echo $pesan;?></label>
				</div>
						
					</form> 
			 </div>
        </div>  
		</div>  		
      </div>
</body>
</html>