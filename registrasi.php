<?php
session_start();
require"system/sistem.php";
dbConnect();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Registrasi</title>
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
				<form name="contact" style="width: 100%;" action="registrasi2.php" method="post">
				<input type="hidden" name="frm_ip" value="<?php echo $ip; ?>">
				<div class="form-group">
						<label class="col-md-12 font-weight-bold" style="font-size:16pt;">Register UMKM</label>
						<label class="col-md-12" style="font-size:11pt; font-weight:bold;">Nama</label>
						<div class="col-md-12">
							<input type="text" id="frm_name" class="form-control" maxlength="50" name="frm_name" placeholder="Masukkan Nama Anda">
						</div>
				</div>	
				<div class="form-group">
						<!-- label -->
						<label class="col-md-12" style="font-size:11pt; font-weight:bold;">Email</label>
						<div class="col-md-12">
							<!-- text -->
							<input name="frm_email" id="frm_email" maxlength="100" type="input" class="form-control" placeholder="Masukkan Email">
						</div>
				</div>
				<div class="form-group">
							<!-- label -->
							<label class="col-md-12" style="font-size:11pt; font-weight:bold;" >No. HP</label>
							<div class="col-md-12">
								<!-- text -->
								<input name="frm_hp" id="frm_hp" maxlength="15" type="input" class="form-control" placeholder="Masukkan No. HP">
							</div>
				</div>
				<div class="form-group">
							<!-- label -->
							<label class="col-md-12" style="font-size:11pt; font-weight:bold;" >Alamat</label>
							<div class="col-md-12">
								<!-- text -->
								<input name="frm_alamat"  id="frm_alamat" maxlength="100" type="input" class="form-control" placeholder="Masukkan Alamat">
							</div>
				</div>
				<div class="form-group">
							<!-- label -->
							<label class="col-md-12" style="font-size:11pt; font-weight:bold;" >Nama Usaha</label>
							<div class="col-md-12">
								<!-- text -->
								<input name="frm_namausaha" name="frm_namausaha" maxlength="100" type="input" class="form-control" placeholder="Masukkan Nama Usaha">
							</div>
				</div>
				<div class="form-group">
							<!-- label -->
							<label class="col-md-12" style="font-size:11pt; font-weight:bold;" >Jenis Usaha</label>
							<div class="col-md-12">
								<!-- text -->
								<input name="frm_jenisusaha" id="frm_jenisusaha" maxlength="100" class="form-control" placeholder="Masukkan Jenis Usaha">
							</div>
				</div>
				<div class="form-group">
							<!-- label -->
							<label class="col-md-12" style="font-size:11pt; font-weight:bold;" >Kategori Produk</label>
							<div class="col-md-12">
								<!-- text -->
								<select name="frm_category" id="frm_category" class="form-control">
								<?php
								$sqln="SELECT * FROM productcategory";
								$resn = mysqli_query($dbconn,$sqln);
								$jmln = @mysqli_num_rows($resn);
								if ($jmln==0)
								{
									echo "no data...";
								}
								else
								{				
									while ($rowsn = mysqli_fetch_assoc($resn)) 
									{

										echo "<option value='$rowsn[categoryid]'  class='form-control'>$rowsn[category]</option>";
									}
								}
								?>
								</select>
							</div>
				</div>
				<div class="form-group">
							<!-- label -->
							<label class="col-md-12" style="font-size:11pt; font-weight:bold;" >Lokasi Tempat Usaha</label>
							<div class="col-md-12">
								<!-- text -->
								<input name="frm_lokasiusaha" id="frm_lokasiusaha" maxlength="100" type="input" class="form-control" placeholder="Masukkan Lokasi Tempat Usaha">
							</div>
				</div>
				<div class="form-group">
							<!-- label -->
							<label class="col-md-12" style="font-size:11pt; font-weight:bold;" >Periode Mulai Usaha</label>
							<div class="col-md-12">
								<!-- text -->
								<input name="frm_periodemulai" id="frm_periodemulai" type="date" class="form-control" placeholder="Masukkan Periode Mulai Usaha">
							</div>
				</div>
						<div class="form-group">
							<input type="submit" class="btn btn-success btn-lg rounded" style="width:100%" value="Daftar" />
						</div>
					</form> 
			 </div>
        </div>  
		</div>  		
      </div>
</body>
</html>