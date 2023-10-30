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
	if ($_SESSION['ses_hak']!='administrator')
	{
		header( "Location:index.php?pesan=Forbidden Access!" );
	}
	else
	{
		if(isset($_GET['nid']) and ctype_digit((string)$_GET['nid']))
		{	
			if (isset($_GET['cmd']))
			{
				$cmd=$_GET['cmd'];
				if ($_GET['cmd']=='del')
				{
					$hid=$_GET['nid'];
					$perintah="UPDATE event SET status='inactive' WHERE eventid='$hid'";
					$hapus=mysqli_query($dbconn,$perintah);
					if(!$hapus)
					{
						header( "Location:eventview.php?pesan=Gagal dinonaktifkan!" );
					}
					else
					{
						header( "Location:eventview.php?pesan=Berhasil dinonaktifkan!" );
					}
					
				}
				elseif ($_GET['cmd']=='edit')
				{
					
					$newsid=$_GET['nid'];
					$res = mysqli_query($dbconn,"SELECT * FROM news WHERE newsid=$newsid");
					$jml = @mysqli_num_rows($res);
					if ($jml==0)
					{
						echo "could not find!";				
					}
					else
					{				
						while($rows = mysqli_fetch_assoc($res))
						{
							$fsubject=$rows['newssubject'];
							$fdesc=$rows['newsdesc'];
							$fsdesc=$rows['newsshortdesc'];
							$fphoto=$rows['newspicture'];
						}
					}
					
					if(isset($_GET['pesan']))
					{
						$pesan=periksa_input($_GET['pesan']);
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
		tinymce.init({selector:'textarea#frm_desc',readonly : 1});
	</script>
	<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
	<script>
	  $( function() {
		$("#frm_tanggal").datepicker({format: 'yyyy-mm-dd'});
	  } );
	  ;
	  
	</script>
</head>
<body>
<?php
		include "menu_samping.php";
?>
<div class="div-bg" style="background-color:#00AA5B">
			<h4 class="h4-bg text-center"><span class="h4-bg-white">FORM JADWAL PELATIHAN</span></h4>
		</div>
		<hr>	
		<form method="post" action="eventeditcontrol.php" enctype="multipart/form-data">
			<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="col-md-12 control-label text-success" for="content">Foto</label>
					<div class="col-md-12">
						<p class="text-center"><img src='<?php echo '../'.$fphoto; ?>' style="max-width:400px;"></p>	
					</div>
				</div>
			</div>
			<div class="col-md-6 col-md-offset-2 custyle">
				<input type="hidden" name="frm_last" value="<?php echo date("Y-m-d H:i:s"); ?>">
				<input type="hidden" name="frm_nid" value="<?php echo $newsid; ?>">
				<input type="hidden" name="frm_photo" value="<?php echo $fphoto; ?>">
				<div class="form-group">
				<label class="col-md-12 control-label" style="color:red"><?php echo $pesan;?></label>
				<label class="col-md-12 control-label text-success" for="name">Judul Berita</label>
					<div class="col-md-12">
						<input id="frm_subject" readonly maxlength="1000" name="frm_subject" value="<?php echo $fsubject; ?>" type="text" placeholder="Type Event Name" class="form-control1">
					</div>
				</div>
				<br><br><br>
				<div class="form-group">
					<label class="col-md-12 control-label text-success" for="content">Deskripsi Singkat</label>
					<div class="col-md-12">
						<textarea rows="3" readonly maxlength="300" name="frm_short" cols="100"  placeholder="Type Event Short Description" class="form-control1"><?php echo $fsdesc; ?></textarea>
					</div>
				</div>
				<br><br><br>
				<div class="form-group"> 
					<label class="col-md-12 control-label text-success" for="content">Deskripsi Panjang</label>
					<div class="col-md-12">
						<textarea rows="10" id="frm_desc" name="frm_desc" cols="100"  placeholder="Type Event Description" class="form-control"><?php echo $fdesc; ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-12 control-label text-success" for="content">Judul Pelatihan</label>
					<div class="col-md-12">
						<input id="frm_judul" required maxlength="1000" name="frm_judul" value="<?php echo $fjudul; ?>" type="text" placeholder="Masukkan judul pelatihan" class="form-control1">
					</div>
				</div>
				<br><br><br><br>
				<div class="form-group">
					<div class="row">
						<div class="col-md-6">
							<label class="col-md-12 control-label text-success">Tanggal Pelaksanaan</label>
							<div class="col-sm-12">
								<input type="text" name="frm_tanggal" required class="form-control1 datetimepicker-input" id="frm_tanggal" data-toggle="datetimepicker" data-target="#datetimepicker14"/>
							</div>
						</div>
						<div class="col-md-6">
							<label class="col-md-12 control-label text-success">Waktu Pelaksanaan <small class="text-muted">(Format hh:mm)</small></label>
							<div class="col-sm-12">
								<input type="text" onchange="validateHhMm(this);" name="frm_waktu"  id="frm_waktu" required class="form-control1"/>
							</div>
						</div>
				
						
						</div>
				</div>
				<script>
				
				function validateHhMm(inputField) {
					var isValid = /^([0-1]?[0-9]|2[0-4]):([0-5][0-9])(:[0-5][0-9])?$/.test(inputField.value);

					if (isValid) 
					{
						inputField.style.backgroundColor = '';
					} 
					else 
					{
						inputField.style.backgroundColor = '#fba';
						inputField.value='';
					}
					return isValid;
				  }
				</script>
				
				<div class="form-group">
					<div class="col-md-12 text-left">
						<button type="submit" class="btn btn-primary btn-lg">Submit</button>
						<button class="btn btn-success btn-lg" onclick="history.back()">Kembali</button>
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
?>