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
		if (isset($_GET['pesan'])) 
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
    <script src="js/jquery-3.2.1.slim.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/docs.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
	<script src="../silider/sss.min.js"></script>
	<link rel="stylesheet" href="../silider/sss.css" type="text/css" media="all">
	<script>jQuery(function($) {$('.slider').sss();});</script>
	
</head>

<body>
	<?php
		include "menu_samping.php";
	?>
	<section class="sec-pad">
		<div class="div-bg bg-primary">
			<h4 class="h4-bg text-center"><span class="h4-bg-white">PRODUK</span></h4>
		</div>
		<hr>
		<div class="col-md-12 col-md-offset-2 custyle">
		<div class="row text-center px-3">
			<div class='col-md-12'>
				<a class='btn btn-primary btn-xs pull-right' href='galleryaddform.php'><strong>+</strong>&nbsp;Tambah Produk</a>
			</div>
			<?php 
				$sqlg="SELECT * from produk";
				$resg = mysqli_query($dbconn,$sqlg);
				$jmlg = @mysqli_num_rows($resg);
				if ($jmlg==0)
				{
						echo "<div class='col-md-12' style='padding:5px;background-color:white;'>";
						echo "	<h6 style='color:#666'>Belum ada data produk!</h6>";
						echo "</div>";
				}
				else
				{		
					echo "<div class='row text-center' style='background-color:white;margin-bottom:5px;padding:5px;'>";
					while ($rowsg = mysqli_fetch_assoc($resg)) 
					{
						
						echo "<div class='col-md-3 bg-light py-2 my-2' style='border:solid 2px #fff;'>
						<div class='slider'>";
						//Start Produk Foto
						$sqldet="select * from produkfoto where produkkode='$rowsg[produkkode]'";
						$resdet = mysqli_query($dbconn,$sqldet);
						$jmldet = @mysqli_num_rows($resdet);
						if ($jmldet==0)
						{
							echo "no data";
						}
						else
						{
							while ($rowsdet = mysqli_fetch_assoc($resdet))
							{
								if ($rowsdet['fotofile'] =='')
								{
									echo "<img style='line-height:40px;' src='img/noimage.png'>";
								}
								else
								{
									echo "<img style='line-height:40px; max-width:280px;' src='../$rowsdet[fotofile]' alt='$rowsg[produknama]'>";
								}
								
							}
						}
						//Start Produk Foto
						echo "</div>";
						echo "<span class='text-left' style='display:block;line-height:20px; font-size:0.8em; color:#000; font-weight:800'>Kode Produk :</span><span class='text-left' style='display:block;line-height:30px; font-size:0.8em; color:#000;'>$rowsg[produkkode]</span>";
						echo "<span class='text-left' style='display:block;line-height:20px; font-size:0.8em; color:#000; font-weight:800'>Nama Produk :</span><span class='text-left' style='display:block;line-height:30px; font-size:0.8em; color:#000;'>$rowsg[produknama]</span>";
						echo "<span class='text-left' style='display:block;line-height:20px; font-size:0.8em; color:#000; font-weight:800'>Harga Satuan :</span><span class='text-left' style='display:block;line-height:30px; font-size:0.8em; color:#000;'>".curfor($rowsg['harga'])."</span>";
						echo "<span class='text-left' style='display:block;line-height:20px; font-size:0.8em; color:#000; font-weight:800'>Harga Grosir : </span><span class='text-left' style='display:block;line-height:30px; font-size:0.8em; color:#000;'>".curfor($rowsg['grosir'])."</span>";
						
						echo "<a class='btn btn-success btn-xs pull-center' href='galleryeditform.php?gid=$rowsg[produkkode]&cmd=edit'>Ubah</a>&nbsp;<a class='btn btn-danger btn-xs pull-center' href='galleryeditform.php?gid=$rowsg[produkkode]&cmd=del'>Hapus</a>";
						echo "</div>";	
																		
					}
					echo "</div>";	
				}					
			?>
	
			
		</div>
		
	
					
		
		
</div>
	  </div>
	</section>
</body>
</html>
<?php 
}
else
{
	header( "Location:index.php?pesan=Tidak memiliki akses!" );
}
function curfor($nominal){
	
	$resultval = number_format($nominal,0,',','.');
	return "Rp. ".$resultval;
 
}
?>