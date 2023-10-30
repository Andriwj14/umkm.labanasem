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
		$uid=$_SESSION['ses_id'];
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
    <title>DASHBOARD UMKM</title>
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
	<section class="sec-pad">
		<div class="div-bg bg-success">
			<h4 class="h4-bg text-center"><span class="h4-bg-white">Produk</span></h4>
		</div>
		<hr>
		<div class="col-md-12 col-md-offset-2 custyle py-2">
			<div class="row text-center px-3">
			<div class='col-md-12'>
				<a class='btn btn-success btn-xs pull-right' href='galleryaddform.php'><strong>+</strong>&nbsp;Tambah Produk</a>
			</div>
			<div class='col-md-12'>
			<?php 
				$sqlg="SELECT * from produk where umkmid=$uid";
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
					echo "<div class='row text-center'>";
					while ($rowsg = mysqli_fetch_assoc($resg)) 
					{
						
						echo "<div class='col-md-4 rounded py-1 px-1'>
						<div class='col-md-12 bg-light px-1 py-1 rounded'>
						<div class='slider py-2 px-2'>";
						
						// if ($rowsg['photo1'] =='')
						// {
						// 	echo "<img class='img-fluid rounded img-thumbnail' style='max-height:250px; max-width: 200px;  object-fit: cover;' src='img/noimage.png'>";
						// }
						// else
						// {
						// 	echo "<img id='preview1' class=' img-fluid rounded img-thumbnail' src='../$rowsg[photo1]' alt='thumbnail' style='max-height:250px; max-width:200px; object-fit: cover;'>";
						// }
						// ...

						if ($rowsg['photo1'] == '') {
							echo "<img class='img-fluid rounded img-thumbnail' style='max-height:250px; max-width: 200px; object-fit: cover;' src='img/noimage.png'>";
						} else {
							echo "<img id='preview1' class='img-fluid rounded img-thumbnail' src='../$rowsg[photo1]' alt='thumbnail' style='width: 200px; height: 200px; object-fit: cover;'>";
						}

// ...

						//Start Produk Foto
						echo "</div>";
						echo "<span class='text-left' style='display:block;line-height:20px; padding-left: 20px; font-size:1em; color:#000; font-weight:800'>Kode Produk :</span><span class='text-left' style='display:block;line-height:30px; font-size:1em; color:#000; padding-left: 20px;'>$rowsg[produkkode]</span>";
						echo "<span class='text-left' style='display:block;line-height:20px; padding-left: 20px; font-size:1em; color:#000; font-weight:800'>Nama Produk :</span><span class='text-left' style='display:block;line-height:30px; font-size:1em; color:#000; padding-left: 20px;'>$rowsg[produknama]</span>";
						echo "<span class='text-left' style='display:block;line-height:20px; padding-left: 20px; font-size:1em; color:#000; font-weight:800'>Harga Satuan :</span><span class='text-left' style='display:block;line-height:30px; font-size:1em; color:#000; padding-left: 20px;'>".curfor($rowsg['harga'])."</span>";
						echo "<span class='text-left' style='display:block;line-height:20px; padding-left: 20px; font-size:1em; color:#000; font-weight:800'>Harga Grosir : </span><span class='text-left' style='display:block;line-height:30px; font-size:1em; color:#000; padding-left: 20px;'>".curfor($rowsg['grosir'])."</span>";
						?>
						<label style="font-weight: bold; padding-left: 20px; font-size: 1em; display:block; text-align:left">
						<input type="checkbox"
						<?php  if ($rowsg['preorder']=='Yes') { echo 'checked'; } ?> name="frm_ckpo" > Pre Order</label>
						<label style="font-weight: bold; padding-left: 20px; font-size: 1em; display:block; text-align:left">
						<input type="checkbox"
						<?php  if ($rowsg['sale']=='Yes') { echo 'checked'; } ?> name="frm_ckpo"> Sale</label>
						<label style="font-weight: bold;  padding-left: 20px; font-size:  1em;text-align:left; display:block; ">Sale Amount : <?php echo $rowsg['saleamount']?>%</label>
						<?php 
						echo "<a class='btn btn-success btn-xs pull-center' href='galleryeditform.php?gid=$rowsg[produkid]&cmd=edit'>Ubah</a>&nbsp;<a class='btn btn-danger btn-xs pull-center' href='galleryeditform.php?gid=$rowsg[produkid]&cmd=del'>Hapus</a>";
						echo "</div></div>";	
																		
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