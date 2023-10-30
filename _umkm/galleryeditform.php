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
	
		if(isset($_GET['gid']))
		{
			if (isset($_GET['cmd']))
			{
				$cmd=$_GET['cmd'];
				if ($_GET['cmd']=='del')
				{
					$galid=$_GET['gid'];
					mysqli_query($dbconn,"update produk set status='disable' where produkid=$galid");
					header( "Location:produk.php?pesan=Delete Done!" );
				}
				elseif ($_GET['cmd']=='edit')
				{	
					$galid=$_GET['gid'];
					$res = mysqli_query($dbconn,"SELECT * FROM produk WHERE produkid='$galid'");
					$jml = @mysqli_num_rows($res);
					if ($jml==0)
					{
						$pesan="could not find	!";				
					}
					else
					{				
						while($rows = mysqli_fetch_assoc($res))
						{
							$id=$rows['produkid'];	
							$kode=$rows['produkkode'];	
							$nama=$rows['produknama'];
							$satuan=$rows['harga'];
							$grosir=$rows['grosir'];
							$deskripsi=$rows['produkdeskripsi'];
							$preorder=$rows['preorder'];
							$sale=$rows['sale'];
							$saleamount=$rows['saleamount'];
							$photo1=$rows['photo1'];
							$photo2=$rows['photo2'];
							$photo3=$rows['photo3'];
							$photo4=$rows['photo4'];
							$video=$rows['video'];
							$kategori=$rows['kategori'];
						}
					}
						
					if(isset($_GET['pesan']))
					{
						$pesan=$_GET['pesan'];
					}
					else
					{
						$pesan="";
					}
				}
				else
				{
					header( "Location:index.php?pesan=Tidak ada akses!" );
				}
			}
			else
			{
				header( "Location:index.php?pesan=Tidak ada akses!" );
			}
		}
		else
		{
			header( "Location:index.php?pesan=Tidak ada akses!" );
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
    <script src="js/jquery-3.2.1.slim.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/docs.js"></script>
	<link rel="stylesheet" href="css/tempusdominus-bootstrap-4.min.css" />
	<script type="text/javascript" src="js/moment.min.js"></script>
	<script type="text/javascript" src="js/tempusdominus-bootstrap-4.min.js"></script>
	
	<style>
		.container-produk {
  position: relative;
  text-align: center;
  color: #00AA5B;
}

/* Centered text */
.centered {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}
	</style>
</head>
<body>
<?php
		include "menu_samping.php";
?>
		<div class="div-bg bg-success">
			<h4 class="h4-bg text-center"><span class="h4-bg-white">UBAH PRODUK</span></h4>
		</div>
		<hr>	
		<form method="post" action="galleryeditcontrol.php" enctype="multipart/form-data">
			<div class="col-md-12 col-md-offset-2 custyle">
				<div class="row">
					<input type="hidden" name="frm_date" id="frm_date" value='<?php echo date("Y-m-d H:i:s"); ?>'>
					<input type="hidden" name="frm_lblhiddenid" id="frm_lblhiddenid" value=<?php echo $id; ?>>
					<input type="hidden" name="frm_lblhiddenkode" id="frm_lblhiddenkode" value=<?php echo $kode; ?>>
					<label class="col-md-12 control-label" style="color:red"><?php echo $pesan;?></label>
					<div class="col-md-12 py-2">
					<label class="text-dark">Hindari barang palsu dan gunakan produk asli yang dimiliki anda supaya customer percaya akan toko anda</label>
					</div>
					<div class="col-md-12 py-2">
						<div class="row">
							<div class="col-md-3">
								<label class="font-weight-bold text-success" for="content">Foto Produk</label>
								<label class="small text-justify">Besar file: maksimum 1 Mb (1000 Kb) Ekstensi file yang diperbolehkan: .JPG .JPEG .PNG</label>
							</div>
							<div class="col-md-9">
								<div class="row">
									<div class="col-md-3 text-left">
										<div class="container-produk">
										<img id="preview1" class='img-thumbnail' src="<?php echo "../".$photo1;?>" style='width:100px; height:100px; max-width:150px;'/>
										<input type="hidden" name="hiddenFoto1" value="<?php echo $photo1; ?>">
										<div class="centered">
											<label>
											<i class="fa fa-plus" style="font-size:30pt;"></i>
												<input type="file" id="frm_fileToUpload1" name="frm_fileToUpload1" id="file" style="display:none;" accept="image/x-png,image/jpeg">
											</label>
										</div>
										</div>
									</div>
									<div class="col-md-3">
										<div class="container-produk">
										<img id="preview2" class='img-thumbnail' src="<?php echo "../".$photo2;?>" style='width:100px; height:100px; max-width:150px;'/>
										<input type="hidden" name="hiddenFoto2" value="<?php echo $photo2; ?>">
										<div class="centered">
											<label>
											<i class="fa fa-plus" style="font-size:30pt;"></i>
												<input type="file" id="frm_fileToUpload2" name="frm_fileToUpload2" id="file" style="display:none;" accept="image/x-png,image/jpeg">
											</label>
										</div>
										</div>
									</div>
									<div class="col-md-3">
										<div class="container-produk">
										<img id="preview3" class='img-thumbnail' src="<?php echo "../".$photo3;?>" style='width:100px; height:100px; max-width:150px;'/>
										<input type="hidden" name="hiddenFoto3" value="<?php echo $photo3; ?>">
										<div class="centered">
											<label>
											<i class="fa fa-plus" style="font-size:30pt;"></i>
												<input type="file" id="frm_fileToUpload3" name="frm_fileToUpload3" id="file" style="display:none;" accept="image/x-png,image/jpeg">
											</label>
										</div>
										</div>
									</div>
									<div class="col-md-3">
										<div class="container-produk">
										<img id="preview4" class='img-thumbnail' src="<?php echo "../".$photo4;?>"  style='width:100px; height:100px; max-width:150px;'/>
										<input type="hidden" name="hiddenFoto4" value="<?php echo $photo4; ?>">
										<div class="centered">
											<label>
											<i class="fa fa-plus" style="font-size:30pt;"></i>
												<input type="file" id="frm_fileToUpload4" name="frm_fileToUpload4" id="file" style="display:none;" accept="image/x-png,image/jpeg">
											</label>
										</div>
										</div>
									</div>
									
									
								</div>
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
					    $("#frm_fileToUpload2").on('change', function(){
					   // Display image on the page for viewing
							var fileExtension = ['jpeg', 'jpg', 'png'];
							if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) 
							{
								alert("Format file yang diperbolehkan : "+fileExtension.join(', '));
							}
							else
							{ 
								readURL(this,"preview2");
							}

					   });
					    $("#frm_fileToUpload3").on('change', function(){
					   // Display image on the page for viewing
							var fileExtension = ['jpeg', 'jpg', 'png'];
							if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) 
							{
								alert("Format file yang diperbolehkan : "+fileExtension.join(', '));
							}
							else
							{ 
								readURL(this,"preview3");
							}

					   });
					    $("#frm_fileToUpload4").on('change', function(){
					   // Display image on the page for viewing
							var fileExtension = ['jpeg', 'jpg', 'png'];
							if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) 
							{
								alert("Format file yang diperbolehkan : "+fileExtension.join(', '));
							}
							else
							{ 
								readURL(this,"preview4");
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
					<div class="col-md-12 py-2">
						<div class="row">
							<div class="col-md-3">
								<label class="font-weight-bold text-success" for="content">Video Produk</label>
								<label class="small text-justify">File video yang disarankan menggunakan video yang diupload di kanal youtube, untuk memasukkan video dari Youtube pilih share pilih embed, kemudian copy embed video.</label>
								
							</div>
							<div class="col-md-9">
								<textarea id="frm_video" name="frm_video" value="" rows="3" placeholder="Masukkan Embed Video" style="font-size:11pt;" class="form-control font-control-sm"><?php echo $video;?></textarea>
							</div>
						</div>
					</div>
					<div class="col-md-12 py-2">
						<div class="row">
							<div class="col-md-3">
								<label class="text-success font-weight-bold" for="name">Nama Produk</label>
								<label class="small text-justify">cantukam maks. 40 karakter untuk nama produk anda dan gunakan nama yang sesuai, gunakan nama yang bisa menarik pembeli agar produk anda laris</label>
							</div>
							<div class="col-md-9">
								<input id="frm_nama" required maxlength="100" name="frm_nama" type="text" value="<?php echo $nama;?>" style="font-size:11pt;" class="form-control form-control-sm" placeholder="Masukkan Nama Produk">
							</div>
						</div>
					</div>
					<script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
					<script>
					$(document).ready(function()
					{
						$("#frm_kategori").ready(getKode);
						$("#frm_kategori").change(getKode);
					
						function getKode()
						{	
							var idkat = $("#frm_kategori").val();
								$.ajax({
									type: "POST",
									dataType: "html",
									url: "getautonum.php",
									data: "tipe="+idkat,
									success: function(msg)
									{
										$("#frm_kode").val(msg);
									}
							  });
						}
						
						
					});
					function fkSale() {
						  $("#ckSale").change(function() {
							if(this.checked) 
							{
								$('#frm_sale').removeAttr('disabled');
							}
							else
							{
								$('#frm_sale').attr('disabled', true); 
							}
							});
						}
					function IsDigit(evt, elementId)  
					{  
						var charCode = evt.charCode;  
						if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode != 46 && charCode != 0)  
						{  
							return false;  
						}  
						else  
						{  
							var len = document.getElementById(elementId).value.length;  
							var index = document.getElementById(elementId).value.indexOf('.');  
							if (charCode == 0)  
							{  
								return true;  
							}  
							if (index > 0 && charCode == 46)  
							{  
								return false;  
							}  
							if (index > 0)  
							{  
								var CharAfterdot = (len + 1) - index;  
								if (CharAfterdot > 3)  
								{  
									return false;  
								}  
							}  
						}  
						return true;  
					}  
					
					</script>
					
					<div class="col-md-12 py-2">
						<div class="row">
						<div class="col-md-3">
							<label class="text-success font-weight-bold" for="name">Deskripsi Produk</label>
							<label class="small text-justify">deskripsikan produk anda maks. 100 karakter. Buatlah deskripsi yang lengkap dan menarik agar pembeli tahu produk anda layak untuk dijual</label>
						</div>
						<div class="col-md-9">
							<textarea id="frm_deskripsi" name="frm_deskripsi" style="font-size:11pt;" rows="5" placeholder="Masukkan Deskripsi Produk" class="form-control font-control-sm"><?php echo $deskripsi;?></textarea>
						</div>
						</div>
					</div>
					<div class="col-md-12 py-2">
						<div class="row">
							<div class="col-md-3"></div>
							<div class="col-md-9">
								<div class="row">
									<div class="col-md-2"><label class="text-success font-weight-bold" for="name">Harga Satuan</label></div>
									<div class="col-md-4">
										<input id="frm_hargasatuan" required  onkeypress="return IsDigit(event,this.id)" style="font-size:11pt;" maxlength="10" name="frm_hargasatuan" value="<?php echo $satuan;?>"  type="text" placeholder="Masukkan harga satuan" class="form-control form-control-sm">
									</div>
									<div class="col-md-2">
										<label class="text-success font-weight-bold" for="name">Harga Grosir</label>
									</div>
									<div class="col-md-4">
										<input id="frm_hargagrosir" style="font-size:11pt;" required  onkeypress="return IsDigit(event,this.id)" maxlength="10" name="frm_hargagrosir" value="<?php echo $grosir;?>"  type="text" placeholder="Masukkan harga grosir" class="form-control form-control-sm">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12 py-2">
						<div class="row">
							<div class="col-md-3"></div>
							<div class="col-md-9">
								<div class="row">
									<div class="col-md-2">
										<label class="text-success font-weight-bold"><input type="checkbox"  <?php  if ($preorder=='Yes') { echo 'checked'; } ?>  name="frm_ckpo"> Pre Order</label>
									</div>	
									<div class="col-md-2">
										<label class="text-success font-weight-bold"><input type="checkbox"  <?php  if ($sale=='Yes') { echo 'checked'; } ?>   name="frm_cksale" onclick="fkSale()" id="ckSale"> Sale</label>
									</div>
									<div class="col-md-8">
										<input id="frm_sale"  <?php  if ($sale=='No') { echo 'disabled'; } ?>   onkeypress="return IsDigit(event,this.id)" maxlength="10"  value="<?php echo $saleamount?>" name="frm_saleamount" type="text" placeholder="Masukkan diskon (%)"  style="font-size:11pt;" class="form-control form-control-sm">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12 py-2">
						<div class="row">
							<div class="col-md-3">
								<label class="text-success font-weight-bold" for="name">Kategori Produk</label>
								<label class="small text-justify">Sesuaikan kategori produk anda jika tidak sesuai maka produk anda akan sangat jarang dibeli karena kesalahan dalam memilih ketegori produk</label>
							</div>
							<div class="col-md-9">
								<select name="frm_kategori"  id="frm_kategori" class="form-control font-control-sm">
								<option value="fashion" class="form-control" <?php  if ($kategori=='fashion') { echo 'selected'; } ?> >Fashion</option>
								<option value="kerajinan" class="form-control" <?php  if ($kategori=='kerajinan') { echo 'selected'; } ?> >Kerajinan</option>
								<option value="kuliner" class="form-control" <?php  if ($kategori=='kuliner') { echo 'selected'; } ?> >Kuliner</option>
								<option value="jasa" class="form-control" <?php  if ($kategori=='kuliner') { echo 'selected'; } ?> >Jasa</option>
							</select>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="text-left">
							<button type="submit" class="btn btn-success btn-lg">Simpan</button>
						</div>
					</div>
				</div>
			</div>
        </form>
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