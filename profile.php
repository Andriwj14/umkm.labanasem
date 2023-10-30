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
		$res = mysqli_query($dbconn,"SELECT * FROM umkm WHERE email='$email'");
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
				$par_nama=$rows['namalengkap'];	
				$par_alamat=$rows['alamat'];	
				$par_email=$rows['email'];
				$par_nohp=$rows['nohp'];
				$par_namausaha=$rows['namausaha'];
				$par_jenisusaha=$rows['jenisusaha'];
				$par_kategori=$rows['categoryid'];
				$par_lokasi=$rows['lokasiusaha'];
				$par_periode=$rows['periodeusaha'];
				$par_profile=$rows['profile'];
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
<script type="text/javascript" src="../vendor/tiny_mce/tinymce.min.js"></script>
	<script type="text/javascript">
		tinymce.init({selector:'textarea'});
	</script>
</head>
<body>
<?php
		include "menu_samping.php";
?>
		<div class="div-bg bg-primary">
			<h4 class="h4-bg text-center"><span class="h4-bg-white">UBAH PROFILE</span></h4>
		</div>
		<hr>	
		<form method="post" action="profile_control.php" enctype="multipart/form-data">
			<div class="col-md-12 col-md-offset-2 custyle">
				<div class="row">
					<input type="hidden" name="frm_date" value=<?php echo date("Y-m-d H:i:s"); ?>>
					<input type="hidden" name="frm_lblhiddenid" value=<?php echo $par_id; ?>>
					<label class="col-md-12 control-label" style="color:red"><?php echo $pesan;?></label>
					
					
					<div class="form-group col-md-3">
						<label class="col-md-12 control-label" for="name">Nama</label>
						<div class="col-md-12">
							<input id="frm_nama" required value='<?php echo $par_nama; ?>' maxlength="100" name="frm_nama" type="text" class="form-control">
						</div>
					</div>
					<div class="form-group col-md-3">
						<label class="col-md-12 control-label" for="name">Alamat</label>
						<div class="col-md-12">
							<input id="frm_alamat" required value='<?php echo $par_alamat; ?>' maxlength="100" name="frm_alamat" type="text" class="form-control">
						</div>
					</div>
					<div class="form-group col-md-3">
						<label class="col-md-12 control-label"  for="content">Email</label>
						<div class="col-md-12">
							<input id="frm_email" readonly value='<?php echo $par_email; ?>' maxlength="100" name="frm_email" type="text" class="form-control">
						</div>
					</div>
					
					<div class="form-group col-md-3">
						<label class="col-md-12 control-label"  for="content">No. HP</label>
						<div class="col-md-12">
							<input id="par_nohp" required value='<?php echo $par_nohp; ?>' name="par_nohp" type="text" class="form-control">
						</div>
					</div>
					<div class="form-group col-md-3">
						<label class="col-md-12 control-label" for="name">Nama Usaha</label>
						<div class="col-md-12">
							<input id="frm_namausaha" required value='<?php echo $par_namausaha; ?>' name="frm_namausaha" type="text" class="form-control">
						</div>
					</div>
					<div class="form-group col-md-3">
						<label class="col-md-12 control-label" for="name">Jenis Usaha</label>
						<div class="col-md-12">
							<input id="frm_jenisusaha" required value='<?php echo $par_jenisusaha; ?>' name="frm_jenisusaha" type="text" class="form-control">
						</div>
					</div>
					<script>
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
						function ckSale() {
						  $("#frm_cksale").change(function() {
							if(this.checked) 
							{
								$('#frm_saleamount').removeAttr('disabled');
							}
							else
							{
								$('#frm_saleamount').attr('disabled', true); 
							}
							});
						}
					</script>
					
					
					<div class="form-group col-md-3">
						<label class="col-md-12 control-label" for="name">Kategori</label>
						<div class="col-md-12">
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

										if ($rowsn['categoryid']==$par_kategori)
										{
											$sel='selected'; 
										}
										else
										{
											$sel='';
										}
										
										echo "<option value='$rowsn[categoryid]' ".$sel." class='form-control'>$rowsn[category]</option>";
									}
								}
								?>
							</select>
						</div>
					</div>
					<div class="form-group col-md-3">
						<label class="col-md-12 control-label" for="name">Lokasi Usaha</label>
						<div class="col-md-12">
							<input id="frm_lokasi" readonly value='<?php echo $par_lokasi; ?>' required name="frm_lokasi" type="text" class="form-control">
						</div>
					</div>
						<div class="form-group col-md-3">
						<label class="col-md-12 control-label" for="name">Periode Usaha</label>
						<div class="col-md-12">
							<input id="frm_periode" readonly value='<?php echo $par_periode; ?>' required name="frm_periode" type="text" class="form-control">
						</div>
					</div>
					<div class="form-group col-md-12">
						<label class="col-md-12 control-label" for="name">Profile</label>
						<div class="col-md-12">
							<textarea id="frm_deskripsi" name="frm_deskripsi" rows="10" class="form-control"><?php echo html_entity_decode($par_profile); ?></textarea>
						</div>
					</div>
					
				
					<div class="col-md-12">
						<div class="col-md-12 text-left">
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