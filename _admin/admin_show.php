<?php
session_start();
require "../system/sistem.php";
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
	if ($_SESSION['ses_hak']!='administrator' && $_SESSION['ses_hak']!='leader')
	{
		header( "Location:index.php?pesan=Anda tidak mempunyai akses halaman ini!" );
	}
	else
	{
?>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>DASHBOARD ADMINISTRATOR</title>
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="navbar-fixed-left.min.css">
	 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="css/docs.css">
    <script src="js/jquery-3.2.1.slim.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/docs.js"></script>
</head>

<body>
	<?php
		include "menu_samping.php";
	?>
	<section class="bg-light sec-pad">
     
		<div class="row bg-light text-center">
		<div class="div-bg" style="background-color:#00AA5B">
			<h4 class="h4-bg text-center"><span class="h4-bg-white">Welcome To Administrator Dashboard</span></h4>
		</div>
		<div class="col-md-12">
			<div class="row" style="padding:10px;">
				
				<div class="col-sm-12">
					<figcaption class="info-wrap">
						<h5 class="caption" style="color:#666;font-size:14pt;">Daftar UMKM Baru</h5>
					</figcaption>
					<figure class="card card-product">
						<table class="table table-striped table-sm">
							<thead>
								<tr>
									<th class='text-center'>No</th>
									<th class=''>Pemilik</th>
									<th class=''>Nama UMKM</th>
								</tr>
							</thead>
								<?php 
									
									$sql="SELECT * FROM register ORDER BY DateInsert DESC LIMIT 5";
									$no_urut = 0;
									$res = mysqli_query($dbconn,$sql);
									$jml = @mysqli_num_rows($res);
									if ($jml==0)
									{
											echo "  <tr>";
											echo "		<td colspan=5 class='control' align=''>No Data...</td>";					
											echo "  </tr>";
										//exit;
									}
									else
									{	
													
										while ($rows = mysqli_fetch_assoc($res)) 
										
										{
											$no_urut++;
											echo "  <tr>";
											echo "	<td class='text-center'>$no_urut</td>";
											echo "	<td class=''>$rows[nama]</td>";
											echo "	<td class=''>$rows[namausaha]</td>";
											echo "</tr>";
										}
									}
										echo "</table>" ;   
									?>
									</table>
						<div class="bottom-wrap">
							<span style='display:block; padding:10px;' class='text-left'><a href="umkmview.php" class="link" style="font-size:12pt;color:#00AA5B">More Detail >></a></span>
						</div>
					</figure>
				</div>
				
				<div class="col-md-12 mt-3">
					<figcaption class="info-wrap">
						<h5 class="caption" style="color:#666;font-size:14pt;">Daftar Permohonan Bantuan Baru</h5>
					</figcaption>
					<figure class="card card-product">
						<table class="table table-striped table-sm">
							<thead>
								<tr>
								<th class='text-center'>No</th>
									<th class=''>Nama UMKM</th>
									<th class=''>Judul Pengajuan</th>
								</tr>
							</thead>
								<?php 
									
									$sql="SELECT l.laporanid as 'kd', r.namausaha as 'nm', l.judul as 'judul' FROM laporan l INNER JOIN register r ON l.umkmid=r.umkmid WHERE l.kategori='pengajuan' ORDER BY l.dateinsert LIMIT 0,5";
									
									$no_urut = 0;
									$res = mysqli_query($dbconn,$sql);
									$jml = @mysqli_num_rows($res);
									if ($jml==0)
									
									{
											echo "  <tr>";
											echo "		<td colspan=5 class='control' align='center'>Belum ada pengajuan...</td>";					
											echo "  </tr>";
										//exit;
									}
									else
									{				
										while ($rows = mysqli_fetch_assoc($res)) 
										{
											$no_urut++;
											echo "  <tr>";
											echo "	<td class='text-center'>$no_urut</td>";
											echo "	<td class=''>$rows[nm]</td>";
											echo "	<td class=''>$rows[judul]</td>";
											echo "</tr>";
										}
									}
										echo "</table>" ;   
									?></table>
						<div class="bottom-wrap">
							<span style='display:block; padding:10px;' class='text-left'><a href="pengajuan.php" class="link" style="font-size:12pt;color:#00AA5B">More Detail >></a></span>
						</div>
					</figure>
				</div>
			</div>
		</div>
		</div>
	</section>
</body>
</html>
<?php 
	}
}
else
{
	header( "Location:index.php?pesan=Forbidden Access!" );
} ?>