<?php
session_start();
require"../system/sistem.php";

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
	
		dbConnect();
		if(isset($_GET['pesan']))
		{
			$pesan=$_GET['pesan'];
		}
		else
		{
			$pesan="";
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
	<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" > -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
	<script src="js/jquery-3.2.1.slim.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/docs.js"></script>
	<script type="text/javascript" src="../vendor/tiny_mce/tinymce.min.js"></script>
	<script type="text/javascript">
		tinymce.init({selector:'textarea#frm_desc'});
	</script>
	<link rel="stylesheet" href="css/tempusdominus-bootstrap-4.min.css" />
<script type="text/javascript" src="js/moment.min.js"></script>
<script type="text/javascript" src="js/tempusdominus-bootstrap-4.min.js"></script>
</head>
<body>
<?php
		include "menu_samping.php";
?>
<div class="div-bg bg-success">
			<h4 class="h4-bg text-center"><span class="h4-bg-white">FORM LAPORAN / PENGAJUAN</span></h4>
		</div>
		<hr>	
		<form method="post" action="laporanaddcontrol.php" enctype="multipart/form-data">
			<div class="col-md-12 col-md-offset-2 custyle">
				<input type="hidden" name="frm_date" value="<?php echo date("Y-m-d H:i:s"); ?>">
				<div class="form-group">
				<label class="col-md-12 control-label" style="color:red"><?php echo $pesan;?></label>
					<label class="col-md-12 control-label text-success" for="name">Judul</label>
					<div class="col-md-12">
						<input id="frm_judul" name="frm_judul" required maxlength="100" type="text" placeholder="Masukkan Judul" class="form-control1">
					</div>
				</div>
				<br><br>
				<div class="form-group">
					<label class="col-md-12 control-label text-success" for="content">Isi</label>
					<div class="col-md-12">
						<textarea rows="5" id="frm_isi" name="frm_isi" maxlength="300" cols="100"  placeholder="Masukkan Isi" class="form-control1"></textarea>
					</div>
				</div>
				<br><br><br>
				<div class="form-group">
					<label class="col-md-12 control-label text-success" for="name">Kategori</label>
					<div class="col-md-12">
						<select name="frm_kategori"  id="frm_kategori" class="form-control1">
								<option value="pengajuan" class="form-control1">Pengajuan</option>
								<option value="laporan" class="form-control1">Laporan</option>
							</select>
					</div>
				</div>
				<br><br><br>
				<div class="form-group">
					<div class="col-md-12 text-left">
						<button type="submit" class="btn btn-success btn-lg">Simpan</button>
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