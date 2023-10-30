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
		if(isset($_GET['lid']) and ctype_digit((string)$_GET['lid']))
		{
					$eximid=$_GET['lid'];
					$res = mysqli_query($dbconn,"SELECT l.laporanid as 'kd', r.nama as 'nm',l.tanggal as 'tgl', l.isi as 'isi' FROM laporan l INNER JOIN register r ON l.umkmid=r.umkmid WHERE l.kategori='pengajuan' and l.laporanid=$eximid");
					$jml = @mysqli_num_rows($res);
					if ($jml==0)
					{
						header( "Location:pengajuan.php?pesan=Tidak dapat ditemukan!" );			
					}
					else
					{				
						while($rows = mysqli_fetch_assoc($res))
						{
							$fid=$rows['kd'];
							$fnama=$rows['nm'];
							$ftanggal=$rows['tgl'];
							$fisi=$rows['isi'];
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
			header( "Location:index.php?pesan=Forbidden Access!" );
		}
		
		
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
	<script type="text/javascript" src="../vendor/tiny_mce/tinymce.min.js"></script>
	<script type="text/javascript">
		tinymce.init({selector:'textarea#frm_keterangan'});
	</script>
	
</head>
<body>
<?php
		include "menu_samping.php";
?>
<div class="div-bg" style="background-color:#00AA5B">
			<h4 class="h4-bg text-center"><span class="h4-bg-white">FORM PENGAJUAN</span></h4>
		</div>
		<hr>	
		<form name="myForm" method="post" action="pengajuaneditcontrol.php" onsubmit="return validateForm()" enctype="multipart/form-data">
			<div class="col-md-12 col-md-offset-2 custyle">
				<input type="hidden" name="frm_nid" value="<?php echo $fid; ?>">
				<input type="hidden" name="frm_last" value="<?php echo date("Y-m-d H:i:s"); ?>">
				<div class="form-group">
				<label class="col-md-12 control-label" style="color:red"><?php echo $pesan;?></label>
				<label class="col-md-12 control-label text-dark" for="name">Nama UMKM</label>
					<div class="col-md-12">
						<input name="frm_subject" readonly value="<?php echo $fnama; ?>" type="text" placeholder="Nama UMKM" class="form-control1">
					</div>
				</div>
				<div class="form-group">
				<label class="col-md-12 control-label text-dark" for="name">Tanggal Pengajuan</label>
					<div class="col-md-12">
						<input name="frm_contact" readonly value="<?php echo $ftanggal; ?>" type="text" placeholder="Tanggal Pengajuan" class="form-control1">
					</div>
				</div>
				
				
				<div class="form-group">
				<label class="col-md-12 control-label text-dark" for="name">Deskripsi Pengajuan</label>
					<div class="col-md-12">
						<input name="frm_deskripsi" id="frm_deskripsi" readonly value="<?php echo $fisi; ?>" type="text" placeholder="Deskripsi Pengajuan" class="form-control1">
					</div>
				</div>
				<div class="form-group">
				<label class="col-md-12 control-label text-dark" for="name">Keterangan</label>
					<div class="col-md-12">
						<textarea rows="10" id="frm_keterangan" name="frm_keterangan" cols="100"  placeholder="Isi Panjang" class="form-control"></textarea>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-12 text-right">
						<button type="submit" class="btn btn-succes btn-lg">Submit</button>
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
?>