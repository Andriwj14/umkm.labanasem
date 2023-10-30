<?php
session_start();
require"../system/sistem.php";
dbConnect();

//Session Placing ak.1452019
	$time = $_SERVER['REQUEST_TIME'];
	if (isset($_SESSION['LAST_ACTIVITY']) &&  ($time - $_SESSION['LAST_ACTIVITY']) > $_SESSION['TIME_DURATION']) {
		session_unset();
		session_destroy();
		session_start();
		header( "Location:index.php?pesan=Session Expired!" );
	}
	else if (isset($_SESSION['ses_username'])) 
	{
		$email=$_SESSION['ses_username'];
		$res = mysqli_query($dbconn,"SELECT * FROM register WHERE email='$email'");
		$jml = @mysqli_num_rows($res);
		if ($jml==0)
		{
			$pesan="could not find	!";				
		}
		else
		{				
			while($rows = mysqli_fetch_assoc($res))
			{
				$par_id=$rows['umkmid'];	
				$par_nama=$rows['nama'];	
				$par_alamat=$rows['alamat'];
				$par_nik=$rows['nik'];
				$par_nohp=$rows['nohp'];
				$par_email=$rows['email'];
				$par_ig=$rows['ig'];
				$par_namausaha=$rows['namausaha'];
				$par_jenisusaha=$rows['jenisusaha'];
			}
		}
			
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
    <title>DASHBOARD UMKM</title>
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
		<div class="div-bg bg-success">
			<h4 class="h4-bg text-center"><span class="h4-bg-white">Biodata Diri</span></h4>
		</div>
		<hr>	
		
			<div class="row">
				<div class="col-md-4 py-4 px-4">
					<div class="row mx-1">
						<div class="col-md-12 py-2 text-center">
							<img id="preview1" class="rounded img-thumbnail" alt="thumbnail" style='max-width:220px;'>
						</div>
						<div class="col-md-12">
							<label class="btn btn-light btn-md col-md-12 text-dark font-weight-bold">PILIH
									<input type="file" id="frm_fileToUpload1" name="frm_fileToUpload1" id="file" style="display:none;" accept="image/x-png,image/jpeg">
							</label>
						</div>
						<div class="col-md-12">
							<button type="submit" class="btn btn-light btn-md col-md-12 text-dark font-weight-bold" style="width:100%">Hapus Foto</button>
						</div>
					</div>
					
				</div>
				<script>
					$(function()
					{
					   $("#frm_fileToUpload1").on('change', function(){
					   // Display image on the page for viewing
							var fileExtension = ['jpeg', 'jpg', 'png'];
							if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) 
							{
								alert("Format file yang diperbolehkan : "+fileExtension.join(', '));
							}
							else
							{ 
								readURL(this,"preview1");
							}

					   });
					 });

					function readURL(input , tar) 
					{  
						if (input.files && input.files[0]) { // got sth

						// Clear image container
						$("#" + tar ).removeAttr('src'); 

						$.each(input.files , function(index,ff)  // loop each image 
						{
							var reader = new FileReader();

							// Put image in created image tags
							reader.onload = function (e) {
								$('#' + tar).attr('src', e.target.result);
							}
							reader.readAsDataURL(ff);

						});
						}
					}
					</script>
				<div class="col-md-8  py-1 px-1">
					<form method="post" action="profile_control.php" enctype="multipart/form-data">
					<div class="row mx-1">
						<input type="hidden" name="frm_date" value=<?php echo date("Y-m-d H:i:s"); ?>>
						<input type="hidden" name="frm_lblhiddenid" value=<?php echo $par_id; ?>>
						<div class="col-md-12 form-control">
							<h4 class="h4-bg text-left text-dark">BIODATA DIRI</span></h4>
						</div>
						
						<div class="col-md-12 form-control">
							<div class="row">
								<label class="col-md-3 text-success font-weight-bold" for="name">Nama</label>
								<div class="col-md-9 px-5">
									<input id="frm_nama" style="font-size:11pt;" readonly  name="frm_nama" maxlength="50" type="text" placeholder="Masukkan Judul" class="form-control1 form-control-sm" value="<?php echo $par_nama; ?>">
								</div>
							</div>
						</div>
						<div class="col-md-12 form-control">
							<div class="row">
								<label class="col-md-3 text-success font-weight-bold" for="name">NIK</label>
								<div class="col-md-9 px-5">
									<input id="frm_nik" style="font-size:11pt;" readonly  value='<?php echo $par_nik; ?>' maxlength="50" name="frm_nik" type="text" class="form-control1 form-control-sm">
								</div>
							</div>
						</div>
						<div class="col-md-12 form-control">
							<div class="row">
								<label class="col-md-3 text-success font-weight-bold" for="name">Alamat</label>
								<div class="col-md-9 px-5">
									<input id="frm_alamat" style="font-size:11pt;" readonly  value='<?php echo $par_alamat; ?>' maxlength="150" name="frm_alamat" type="text" class="form-control1 form-control-sm">
								</div>
							</div>
						</div>
						<div class="col-md-12 form-control">
							<div class="row">
								<label class="col-md-3 text-success font-weight-bold"  for="content">Email</label>
								<div class="col-md-9 px-5">
									<input id="frm_email" style="font-size:11pt;" readonly  value='<?php echo $par_email; ?>' maxlength="100" name="frm_email" type="text" class="form-control1 form-control-sm">
								</div>
							</div>
						</div>
						
						<div class="col-md-12 form-control">
							<div class="row">
								<label class="col-md-3 text-success font-weight-bold"  for="content">Telepon</label>
								<div class="col-md-9 px-5">
									<input id="frm_nohp" style="font-size:11pt;" readonly  value='<?php echo $par_nohp; ?>' name="frm_nohp" type="text" class="form-control1  form-control-sm">
								</div>
							</div>
						</div>
						<div class="col-md-12 form-control">
							<div class="row">
								<label class="col-md-3 text-success font-weight-bold"  for="content">Instagram</label>
								
								<div class="col-md-9 px-5">
									<input id="frm_ig"  style="font-size:11pt;"  readonly  value='<?php echo $par_ig; ?>' name="frm_ig" type="text" class="form-control1  form-control-sm">
								</div>
							</div>
						</div>
						<div class="col-md-12 form-control">
							<div class="row">
								<label class="col-md-3 text-success font-weight-bold" for="name">Nama Usaha</label>
								<div class="col-md-9 px-5">
									<input id="frm_namausaha"  style="font-size:11pt;"  readonly  value='<?php echo $par_namausaha; ?>' name="frm_namausaha" type="text" class="form-control1  form-control-sm">
								</div>
							</div>
						</div>
						<div class="col-md-12 form-control">
							<div class="row">
								<label class="col-md-3 text-success font-weight-bold" for="name">Jenis Usaha</label>
								<div class="col-md-9 px-5">
									<select name="frm_jenisusaha" required id="frm_jenisusaha" <?php echo $disabled;?> class="form-control1 font-control-sm">
										<option value="fashion" <?php  if ($par_jenisusaha=='fashion') { echo 'selected'; } ?> class="form-control">Fashion</option>
										<option value="kerajinan" <?php  if ($par_jenisusaha=='kerajinan') { echo 'selected'; } ?> class="form-control">Kerajinan</option>
										<option value="kuliner" <?php  if ($par_jenisusaha=='kuliner') { echo 'selected'; } ?> class="form-control">Kuliner</option>
										<option value="jasa" <?php  if ($par_jenisusaha=='jasa') { echo 'selected'; } ?> class="form-control">Jasa</option>
									</select>
								</div>
							</div>
						</div>
						
						<div class="col-md-12 form-control">
								<a href="#" id="prof" class="btn btn-success btn-md" onclick="enable_disable()">Ubah Data</a>
								<button type="submit" class="btn btn-success btn-md" disabled id="btnSimpan">Simpan</button>
						</div>
						<div class="col-md-12 form-control">
							<label class="text-warning"><?php echo $pesan;?></label>
						</div>
						 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
						<script>
							function enable_disable() 
							{
								var x = $('#prof').text();
								//$("input").prop('disabled', false);
								//$('#prof').text('My New Link Text');
								//var x = document.getElementById("prof");
								//alert(x);
								if (x === "Ubah Data") 
								{
									$('#prof').text('Batal');
									$("#frm_nama").prop('readonly', false);
									$('#frm_nik').prop('readonly', false);
									$('#frm_alamat').prop('readonly', false);
									$('#frm_email').prop('readonly', true);
									$('#frm_nohp').prop('readonly', false);
									$('#frm_ig').prop('readonly', false);
									$('#frm_namausaha').prop('readonly', false);
									$('#frm_jenisusaha').prop('disabled', false);
									$('#btnSimpan').prop('disabled', false);
								} 
								else if (x === "Batal") 
								{
									$('#prof').text('Ubah Data');
									$("#frm_nama").prop('readonly', true);
									$('#frm_nik').prop('readonly', true);
									$('#frm_alamat').prop('readonly', true);
									$('#frm_email').prop('readonly', true);
									$('#frm_nohp').prop('readonly', true);
									$('#frm_ig').prop('readonly', true);
									$('#frm_namausaha').prop('readonly', true);
									$('#frm_jenisusaha').prop('disabled', true);
									$('#btnSimpan').prop('disabled', true);
								} 
							}
						</script>

					</div>
					</form>
				</div>
			</div>
        
</body>
</html>
<?php 
	
}
else
{
	header( "Location:index.php?pesan=Forbidden Access!" );
}
function curfor($nominal){
	
	$resultval = number_format($nominal,0,'.',',');
	return $resultval;
 
}
?>
		