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
	if ($_SESSION['ses_hak']!='administrator')
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
    <title>Dashboard Administrator</title>
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
	<section class="bg-light">
      <div class="container">
		<div class="row bg-light text-center">
		<div class="div-bg bg-primary">
			<h4 class="h4-bg text-center"><span class="h4-bg-white">Welcome To Administrator Dashboard</span></h4>
		</div>
		<div class="col-md-12">
			<div class="row" style="padding:10px;">
				<div class="col-sm-6">
				   <!-- Histats.com  (div with counter) --><div id="histats_counter"></div>
					<!-- Histats.com  START  (aync)-->
					<script type="text/javascript">var _Hasync= _Hasync|| [];
					_Hasync.push(['Histats.start', '1,4267211,4,28,115,60,00011111']);
					_Hasync.push(['Histats.fasi', '1']);
					_Hasync.push(['Histats.track_hits', '']);
					(function() {
					var hs = document.createElement('script'); hs.type = 'text/javascript'; hs.async = true;
					hs.src = ('//s10.histats.com/js15_as.js');
					(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(hs);
					})();</script>
					<noscript><a href="/" target="_blank"><img  src="//sstatic1.histats.com/0.gif?4267211&101" alt="free stats" border="0"></a></noscript>
					<!-- Histats.com  END  -->
				</div>
				<div class="col-sm-6">
					<figcaption class="info-wrap">
						<h5 class="caption" style="color:#666;font-size:14pt;">New Register Exporters</h5>
					</figcaption>
					<figure class="card card-product">
						<table class="table table-striped">
							<thead>
								<tr>
									<th class='text-center'>Company Name</th>
									<th class='text-center'>Contact</th>
									<th class='text-center'>Email</th>
								</tr>
							</thead>
								<?php 
									
									$sqlcom="SELECT * FROM inquiry ORDER BY DateInsert DESC LIMIT 5";
									
									
									$rescom = mysqli_query($dbconn,$sqlcom);
									$jmlcom = @mysqli_num_rows($rescom);
									if ($jmlcom==0)
									{
											echo "  <tr>";
											echo "		<td colspan=5 class='control' align='center'>No Data...</td>";					
											echo "  </tr>";
										//exit;
									}
									else
									{				
										while ($rowscom = mysqli_fetch_assoc($rescom)) 
										{
											echo "  <tr>";
											echo "	<td class='text-left'>$rowscom[CompanyName]</td>";
											echo "	<td class='text-center'>$rowscom[ContactPerson]</td>";
											echo "	<td class='text-center'>$rowscom[Email]</td>";
											echo "</tr>";
										}
									}
										echo "</table>" ;   
									?></table>
						<div class="bottom-wrap">
							<span style='display:block; padding:10px;' class='text-left'><a href="inquiryview.php" class="link" style="font-size:12pt;">More Detail >></a></span>
						</div>
					</figure>
				</div>
				<div class="col-sm-6">
					<figcaption class="info-wrap">
						<h5 class="caption" style="color:#666;font-size:14pt;">Recent Exporter</h5>
					</figcaption>
					<figure class="card card-product">
						<table class="table table-striped">
							<thead>
								<tr>
									<th class='text-center'>Company Name</th>
									<th class='text-center'>Type</th>
								</tr>
							</thead>
								<?php 
									
									$sql="SELECT * FROM export ORDER BY DateInsert DESC LIMIT 5";
									
									
									$res = mysqli_query($dbconn,$sql);
									$jml = @mysqli_num_rows($res);
									if ($jml==0)
									{
											echo "  <tr>";
											echo "		<td colspan=5 class='control' align='center'>No Data...</td>";					
											echo "  </tr>";
										//exit;
									}
									else
									{				
										while ($rows = mysqli_fetch_assoc($res)) 
										{
											echo "  <tr>";
											echo "	<td class='text-left'>$rows[ExportName]</td>";
											echo "	<td class='text-center'>$rows[ExportContactPerson]</td>";
											echo "</tr>";
										}
									}
										echo "</table>" ;   
									?></table>
						<div class="bottom-wrap">
							<span style='display:block; padding:10px;' class='text-left'><a href="eximview.php" class="link" style="font-size:12pt;">More Detail >></a></span>
						</div>
					</figure>
				</div>
				
				
				<div class="col-sm-6">
					<figcaption class="info-wrap">
						<h5 class="caption" style="color:#666;font-size:14pt;">Recent Contact</h5>
					</figcaption>
					<figure class="card card-product">
						<table class="table table-striped">
							<thead>
								<tr>
									<th class='text-center'>Name</th>
									<th class='text-center'>Subject</th>
								</tr>
							</thead>
								<?php 
									
									$sql1="SELECT * FROM contact ORDER BY senddate DESC LIMIT 5";
									
									
									$res1 = mysqli_query($dbconn,$sql1);
									$jml1 = @mysqli_num_rows($res1);
									if ($jml1==0)
									{
											echo "  <tr>";
											echo "		<td colspan=5 class='control' align='center'>No Data...</td>";					
											echo "  </tr>";
										//exit;
									}
									else
									{				
										while ($rows1 = mysqli_fetch_assoc($res1)) 
										{
											echo "  <tr>";
											echo "	<td class='text-left'>$rows1[name]</td>";
											echo "	<td class='text-center'>$rows1[subject]</td>";
											echo "</tr>";
										}
									}
										echo "</table>" ;   
									?></table>
						<div class="bottom-wrap">
							<span style='display:block; padding:10px;' class='text-left'><a href="contactview.php" class="link" style="font-size:12pt;">More Detail >></a></span>	
						</div>
					</figure>
				</div>
				<div class="col-sm-6">
					<figcaption class="info-wrap">
						<h5 class="caption" style="color:#666;font-size:14pt;">Exporter / Importer Data</h5>
					</figcaption>
					<figure class="card card-product">
						<table class="table table-striped">
							<thead>
								<tr>
									<th class='text-center'>Type</th>
									<th class='text-center'>Total</th>
								</tr>
							</thead>
								<?php 
									$username = $_SESSION['ses_username'];
									
									$sqlEx="SELECT * FROM export";
									$resEx = mysqli_query($dbconn,$sqlEx);
									$jmlEx = @mysqli_num_rows($resEx);
									
									$sqlIm="SELECT * FROM import";
									$resIm = mysqli_query($dbconn,$sqlIm);
									$jmlIm = @mysqli_num_rows($resIm);
								?>
							<tr>
								<td class='text-left'>Importer</td>
								<td class='text-center'><?php echo $jmlIm; ?></td>
							</tr>
							<tr>
								<td class='text-left'>Exporter</td>
								<td class='text-center'><?php echo $jmlEx; ?></td>
							</tr>
						</table>
						
					</figure>
				</div>
				
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