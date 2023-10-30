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
		header( "Location:index.php?pesan=Forbidden Access1!" );
	}
	else
	{
		if(isset($_GET['uid']) and ctype_digit((string)$_GET['uid']))
		{
			if (isset($_GET['cmd']))
			{
				$cmd=$_GET['cmd'];
				if ($_GET['cmd']=='del')
				{
					$eximid=$_GET['uid'];
					$perintah="UPDATE register SET status='inactive' WHERE umkmid=$eximid";
					$hapus=mysqli_query($dbconn,$perintah);
					header( "Location:umkmview.php?pesan=Delete Done!" );
				}
				elseif (($_GET['cmd']=='edit') or ($_GET['cmd']=='info'))
				{
					$parcmd=$_GET['cmd'];
					if ($parcmd=='edit')
					{
						$disabled= "";
					}
					else
					{
						$disabled= "readonly";
					}
					
					$eximid=$_GET['uid'];
					$res = mysqli_query($dbconn,"SELECT * FROM register WHERE umkmid=$eximid");
					$jml = @mysqli_num_rows($res);
					if ($jml==0)
					{
						header( "Location:umkmview.php?pesan=Could not find!" );			
					}
					else
					{				
						while($rows = mysqli_fetch_assoc($res))
						{
							$umkmid=$rows['umkmid'];
							$umkmkode=$rows['umkmkode'];
							$nama=$rows['nama'];
							$alamat=$rows['alamat'];
							$nik=$rows['nik'];
							$nohp=$rows['nohp'];
							$email=$rows['email'];
							$ig=$rows['ig'];
							$namausaha=$rows['namausaha'];
							$jenisusaha=$rows['jenisusaha'];
							$status=$rows['status'];
							$daftar=$rows['dateinsert'];
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
			}
			else
			{
				header( "Location:index.php?pesan=Forbidden Access!" );
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
	
</head>
<body>
<?php
		include "menu_samping.php";
?>
		<div class="div-bg" style="background-color:#00AA5B">
			<h4 class="h4-bg text-center"><span class="h4-bg-white">FORM UMKM</span></h4>
		</div>
		<hr>	
		<form name="myForm" method="post" action="umkmeditcontrol.php" onsubmit="return validateForm()" enctype="multipart/form-data">
			<div class="col-md-12 col-md-offset-2 custyle">
				<input type="hidden" name="frm_nid" value="<?php echo $umkmid; ?>">
				<input type="hidden" name="frm_last" value="<?php echo date("Y-m-d H:i:s"); ?>">
				<label class="col-md-12 control-label" style="color:red"><?php echo $pesan;?></label>
				<div class="form-group">
				<label class="col-md-12 control-label text-success" for="name">Kode UMKM</label>
					<div class="col-md-12">
						<input name="frm_subject" maxlength="300" readonly value="<?php echo $umkmkode; ?>" type="text" placeholder="Type Company Name" class="form-control1">
					</div>
				</div>
				<div class="form-group">
						
						<label class="col-md-12 control-label text-success">Nama</label>
						<div class="col-md-12">
							<input type="text" id="frm_name" class="form-control1"  <?php echo $disabled;?> value="<?php echo $nama; ?>" required maxlength="50" name="frm_name" placeholder="Masukkan Nama Anda">
						</div>
				</div>	
				<div class="form-group">
						<!-- label -->
						<label class="col-md-12 control-label text-success">NIK</label>
						<div class="col-md-12">
							<!-- text -->
							<input name="frm_nik"  required id="frm_nik" maxlength="20" type="input"   <?php echo $disabled;?> value="<?php echo $nik; ?>" class="form-control1" placeholder="Masukkan NIK">
						</div>
				</div>
				<div class="form-group">
						<!-- label -->
						<label class="col-md-12 control-label text-success">Alamat</label>
						<div class="col-md-12">
							<!-- text -->
							<input name="frm_alamat"  required id="frm_alamat" maxlength="150" <?php echo $disabled;?>  type="input" value="<?php echo $alamat; ?>" class="form-control1" placeholder="Masukkan Alamat">
						</div>
				</div>
				<div class="form-group">
							<!-- label -->
							<label class="col-md-12 control-label text-success" >Telepon</label>
							<div class="col-md-12">
								<!-- text -->
								<input name="frm_hp"  required id="frm_hp" maxlength="15" <?php echo $disabled;?>  value="<?php echo $nohp; ?>" type="input" class="form-control1" placeholder="Masukkan Telepon">
							</div>
				</div>
				<div class="form-group">
						<!-- label -->
						<label class="col-md-12 control-label text-success" for="Email">Email</label>
						<div class="col-md-12">
							<!-- text -->
							<input name="frm_email" required id="frm_email" maxlength="100" readonly value="<?php echo $email; ?>" type="input" class="form-control1" placeholder="Masukkan Email">
						</div>
				</div>
				<div class="form-group">
						<!-- label -->
						<label class="col-md-12 control-label text-success" for="Email">Instagram</label>
						<div class="col-md-12">
							<!-- text -->
							<input name="frm_ig" id="frm_ig" maxlength="50" type="input"  <?php echo $disabled;?> value="<?php echo $ig; ?>" class="form-control1" placeholder="Masukkan ID Instagram">
						</div>
				</div>
				<div class="form-group">
							<!-- label -->
							<label class="col-md-12 control-label text-success" >Nama Usaha</label>
							<div class="col-md-12">
								<!-- text -->
								<input name="frm_namausaha" required name="frm_namausaha"  <?php echo $disabled;?> value="<?php echo $namausaha; ?>" maxlength="100" type="input" class="form-control1" placeholder="Masukkan Nama Usaha">
							</div>
				</div>
				<div class="form-group">
							<!-- label -->
							<label class="col-md-12 control-label text-success" >Jenis Usaha</label>
							<div class="col-md-12">
								<select name="frm_jenisusaha" required id="frm_jenisusaha" <?php echo $disabled;?> class="form-control1 font-control-sm">
								<option value="fashion" <?php  if ($status=='fashion') { echo 'selected'; } ?> class="form-control1">Fashion</option>
								<option value="kerajinan" <?php  if ($status=='kerajinan') { echo 'selected'; } ?> class="form-control1">Kerajinan</option>
								<option value="kuliner" <?php  if ($status=='kuliner') { echo 'selected'; } ?> class="form-control1">Kuliner</option>
								<option value="jasa" <?php  if ($status=='jasa') { echo 'selected'; } ?> class="form-control1">Jasa</option>
								</select>
								<!-- text -->
							</div>
				</div>
				<div class="form-group">
							<!-- label -->
							<label class="col-md-12 control-label text-success" >Status</label>
							<div class="col-md-12">
								<!-- text -->
								<select name="frm_status" <?php echo $disabled;?> id="frm_status" class="form-control1 font-control-sm">
								<option value="onreview" class="form-control1" <?php  if ($status=='inactive') { echo 'selected'; } ?> >In Active</option>
								<option value="active" class="form-control1" <?php  if ($status=='active') { echo 'selected'; } ?> >Active</option>
								<option value="onreview" class="form-control1" <?php  if ($status=='onreview') { echo 'selected'; } ?> >On Review</option>
								
							</select>
							</div>
				</div>
				<div class="form-group">
							<!-- label -->
							<label class="col-md-12 control-label text-success" >Tanggal Daftar</label>
							<div class="col-md-12">
								<!-- text -->
								<input name="frm_tanggaldaftar" id="frm_tanggaldaftar" readonly value="<?php echo $daftar; ?>" maxlength="100" class="form-control1" placeholder="Tanggal Daftar">
							</div>
				</div>
				<br><br><br>
				<div class="form-group">
					<div class="col-md-12 text-left">
						<button type="submit" class="btn btn-success btn-lg" <?php if ($disabled=='readonly') echo 'disabled';?> >Submit</button>
					</div>
				</div>
			</div>
        </form>
		<div class="div-bg bg-success">
			<h4 class="h4-bg text-center"><span class="h4-bg-white">PRODUK UMKM</span></h4>
		</div>
		<div class="col-md-12 py-2">
		<table id="paging" class="table table-bordered table-sm">
			<thead class="bg" style="background-color:#00AA5B">
			   <tr>
					<th class='text-center' width="10%">No</th>
					<th class='text-center' width="35%">Nama Produk</th>
					<th class='text-center' width="15%">Harga</th>
					<th class='text-center' width="40%">Link</th>
				</tr>
			</thead>
				<?php 
					
					$sql="SELECT produknama, harga, produkid FROM produk WHERE umkmid=$eximid ORDER BY tanggalupload DESC";
					
					
					$res = mysqli_query($dbconn,$sql);
					$jml = @mysqli_num_rows($res);
					if ($jml==0)
					{
							echo "  <tr>";
							echo "		<td colspan=5 class='control' align='center'>Belum ada produk...</td>";					
							echo "  </tr>";
						//exit;
					}
					else
					{				
						$urut=1;
						while ($rows = mysqli_fetch_assoc($res)) 
						{
							echo "  <tr>";
							echo "	<td class='text-left'>$urut</td>";
							echo "	<td class='text-left'>$rows[produknama]</td>";
							echo "	<td class='text-center'>$rows[harga]</td>";
							echo "	<td class='text-left'>"."<a href='http://umkm.labanasem.id/product_detail.php?pid=$rows[produkid]' target='_blank'>$rows[produknama]</a>"."</td>";							
							echo "</tr>";
							$urut++;
						}
					}
						echo "</table>" ;   
					?>
					
					</table>
					 <link href="jquerydata/assets/css/jquery.dataTables.min.css" rel="stylesheet" media="screen">
							<script src="jquerydata/assets/js/jquery.js"></script>
							<script src="jquerydata/assets/js/jquery.dataTables.js"></script>
						  
							<script>
								$(document).ready(function() {
								$('#paging').DataTable({
								  columnDefs: [{
									"defaultContent": "-",
									"targets": "_all"
								  }]
								});
							} );
							$(function () {
							  $('[data-toggle="tooltip"]').tooltip()
							})
							</script>  
				
		</div>
</body>
</html>
<?php 
}
else
{
	header( "Location:index.php?pesan=Forbidden Access!" );
}
?>