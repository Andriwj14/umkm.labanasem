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
	if ($_SESSION['ses_hak']!='administrator')
	{
		header( "Location:index.php?pesan=Forbidden Access!" );
	}
	else
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
<div class="div-bg" style="background-color:#00AA5B">
			<h4 class="h4-bg text-center"><span class="h4-bg-white">FORM TAMBAH BERITA</span></h4>
		</div>
		<hr>	
		<form method="post" action="newsaddcontrol.php" enctype="multipart/form-data">
			<div class="col-md-12 col-md-offset-2 custyle">
				<input type="hidden" name="frm_date" value="<?php echo date("Y-m-d H:i:s"); ?>">
				<div class="form-group">
				<label class="col-md-12 control-label" style="color:red"><?php echo $pesan;?></label>
				<label class="col-md-12 control-label text-dark" for="name">Judul</label>
					<div class="col-md-12">
						<input id="frm_subject" name="frm_subject" required maxlength="100" type="text" placeholder="Judul Berita" class="form-control1">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-12 control-label text-dark" for="content">Isi Pendek</label>
					<div class="col-md-12">
						<textarea rows="5" name="frm_short" maxlength="200" cols="100"  placeholder="Isi Pendek" class="form-control1"></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-12 control-label text-dark" for="content">Isi Panjang</label>
					<div class="col-md-12">
						<textarea rows="10" id="frm_desc" name="frm_desc" cols="100"  placeholder="Isi Panjang" class="form-control1"></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-12 control-label text-dark" for="content">Gambar</label>
					<div class="col-md-12">
						<label for="file">Filename:</label>
						<input type="file" name="frm_fileToUpload" id="file">
						<label for="file" style="display:block;color:red">Support File Type : JPG, JPEG, PNG</label>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-12 text-left">
						<button type="submit" class="btn btn-primary btn-lg">Submit</button>
						<button class="btn btn-success btn-lg" onclick="history.back()">Kembali</button>
					</div>
				</div>
			</div>
        </form>
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