<?php 
session_start();
include "top.php";
require "system/sistem.php";
dbConnect();
$_SESSION['ses_username']="joko";
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
<!-- branch -->
    <div class="container">
		<div class="row text-center">
			
				<div class="col-md-4  py-3 px-3">
					<div class="row mx-1">
						<div class="col-md-12">
							<img src="img/img-log.png" class="rounded float-left img-thumbnail" alt="thumbnail">
						</div>
						<div class="col-md-12">
							<button type="submit" class="btn btn-dark btn-md col-md-12" style="width:100%">Pilih Foto</button>
						</div>
						<div class="col-md-12">
							<button type="submit" class="btn btn-dark btn-md col-md-12" style="width:100%">Hapus Foto</button>
						</div>
					</div>
					
				</div>
				<div class="col-md-8  py-1 px-1">
					<form method="post" action="profile_control.php" enctype="multipart/form-data">
					<div class="row mx-1">
						<input type="hidden" name="frm_date" value=<?php echo date("Y-m-d H:i:s"); ?>>
						<input type="hidden" name="frm_lblhiddenid" value=<?php echo $par_id; ?>>
						<label class="col-md-12 control-label" style="color:red"><?php echo $pesan;?></label>
						
						<div class="col-md-12 form-control">
							<div class="row">
								<label class="col-md-3 text-success font-weight-bold" for="name">Nama</label>
								<label class="col-md-9" for="name"><?php echo $par_nama; ?></label>
							</div>
						</div>
						<div class="col-md-12 form-control">
							<div class="row">
								<label class="col-md-3 text-success font-weight-bold" for="name">Alamat</label>
								<label class="col-md-9" for="name"><?php echo $par_alamat; ?></label>
							</div>
						</div>
						<div class="col-md-12 form-control">
							<div class="row">
								<label class="col-md-3 text-success font-weight-bold"  for="content">Email</label>
								<label class="col-md-9"  for="content"><?php echo $par_email; ?></label>
							</div>
						</div>
						
						<div class="col-md-12 form-control">
							<div class="row">
								<label class="col-md-3 text-success font-weight-bold"  for="content">No. HP</label>
								<label class="col-md-9"  for="content"><?php echo $par_nohp; ?></label>
							</div>
						</div>
						<div class="col-md-12 form-control">
							<div class="row">
								<label class="col-md-3 text-success font-weight-bold" for="name">Nama Usaha</label>
								<label class="col-md-9"  for="content"><?php echo $par_namausaha; ?></label>
							</div>
						</div>
						<div class="col-md-12 form-control">
							<div class="row">
								<label class="col-md-3  text-success font-weight-bold" for="name">Jenis Usaha</label>
								<label class="col-md-9" for="name"><?php echo $par_jenisusaha; ?></label>
							</div>
						</div>
						<div class="col-md-12 form-control">
							<div class="row">
							<label class="col-md-3 text-success font-weight-bold" for="name">Kategori</label>
							<select name="frm_category" id="frm_category" class="col-md-9">
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
						<div class="col-md-12  form-control">
							<div class="row">
								<label class="col-md-3  text-success font-weight-bold" for="name">Lokasi Usaha</label>
								<label class="col-md-9" for="name"><?php echo $par_lokasi; ?></label>
							</div>
						</div>
						<div class="col-md-12 form-control">
							<div class="row">
								<label class="col-md-3  text-success font-weight-bold" for="name">Periode Usaha</label>
								<label class="col-md-9" for="name"><?php echo $par_periode; ?></label>
							</div>
						</div>
						<div class="col-md-12 form-control">
							<div class="row">
								<label class="col-md-3  text-success font-weight-bold" for="name">Profile</label>
								<label class="col-md-9" for="name"><?php echo html_entity_decode($par_profile); ?></label>
							</div>
						</div>
						<div class="col-md-12 form-control">
								<button type="submit" class="btn btn-success btn-md">Ubah Data</button>
								<button type="submit" class="btn btn-success btn-md">Simpan</button>
						</div>
					</div>
					</form>
				</div>
		</div>
	</div>

<?php 
}
else
{
	header( "Location:index.php?pesan=Forbidden Access!" );
}
include "bottom.php";
function curfor($nominal)
{
	
	$resultval = number_format($nominal,0,'.',',');
	return $resultval;
 
}
?>