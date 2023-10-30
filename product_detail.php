<?php 
require "system/sistem.php";
dbConnect();

if(isset($_GET['pid']))
{
	$galid=$_GET['pid'];
	$res = mysqli_query($dbconn,"SELECT * FROM produk WHERE produkid='$galid'");
	$jml = @mysqli_num_rows($res);
	if ($jml==0)
	{
		$pesan="could not find	!";				
	}
	else
	{				
		while($rows = mysqli_fetch_assoc($res))
		{
			$id=$rows['produkid'];	
			$kode=$rows['produkkode'];	
			$nama=$rows['produknama'];
			$satuan=$rows['harga'];
			$grosir=$rows['grosir'];
			$deskripsi=$rows['produkdeskripsi'];
			$preorder=$rows['preorder'];
			$sale=$rows['sale'];
			$saleamount=$rows['saleamount'];
			$photo1=$rows['photo1'];
			$photo2=$rows['photo2'];
			$photo3=$rows['photo3'];
			$photo4=$rows['photo4'];
			$video=$rows['video'];
			$kategori=$rows['kategori'];
			$umkmid=$rows['umkmid'];
		}
?>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv='Content-Type' content='Type=text/html; charset=utf-8'/>
    <meta name="language" content="id" />
    <title>UMKM Website</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="css/agency.min.css" rel="stylesheet">
	<link href="css/custom.css" rel="stylesheet">
	<link href="css/glass.css" rel="stylesheet">
	<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="js/zoom.js"></script>
	<link href="css/addon.css" rel="stylesheet">
	  </head>
  <body id="page-top">
    <!-- Navigation -->
<nav class="navbar">
  <div class="container" >
	<div class="col-md-12 text-center">
			<a class="navbar-brand" href="index.php">
				<img class="logo" src="img/logo.png" alt="UMKM Labanasem">
			</a>
	</div>
  </div>
</nav>
<nav class="navbar navbar-expand-md">
  <div class="container">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mx-auto">
				<li class="nav-item">
				  <a class="nav-link mx-2" href="index.php">Beranda</a>
				</li>
				<li class="nav-item">
					<a class="nav-link mx-2" href="product.php">Produk</a>
				</li>
				<li class="nav-item">
					<a class="nav-link mx-2" href="news.php">Berita</a>
				</li>
				<li class="nav-item">
					<a class="nav-link mx-2" href="register.php">Registrasi UMKM</a>
				</li>
      </ul>
    </div>
  </div>
</nav>
<script>
const $dropdown = $(".dropdown");
const $dropdownToggle = $(".dropdown-toggle");
const $dropdownMenu = $(".dropdown-menu");
const showClass = "show";
 
$(window).on("load resize", function() {
  if (this.matchMedia("(min-width: 768px)").matches) {
    $dropdown.hover(
      function() {
        const $this = $(this);
        $this.addClass(showClass);
        $this.find($dropdownToggle).attr("aria-expanded", "true");
        $this.find($dropdownMenu).addClass(showClass);
      },
      function() {
        const $this = $(this);
        $this.removeClass(showClass);
        $this.find($dropdownToggle).attr("aria-expanded", "false");
        $this.find($dropdownMenu).removeClass(showClass);
      }
    );
  } else {
    $dropdown.off("mouseenter mouseleave");
  }
});
</script>
<hr>
<!-- branch -->
    <div class="container container-shadow rounded">
		<div class="row text-center">
			<div class="col-md-6 py-2">
				<ul id="glasscase" class="gc-start">
					<li><img src="<?php echo $photo1; ?>" alt="Text" /></li>
					<li><img src="<?php echo $photo2; ?>" alt="Text" /></li>
					<li><img src="<?php echo $photo3; ?>" alt="Text" /></li>    
					<li><img src="<?php echo $photo4; ?>" alt="Text" /></li>    					
				</ul>
			</div>
			<script type="text/javascript">
				$(document).ready( function () {
					//If your <ul> has the id "glasscase"
					$('#glasscase').glassCase({ 'thumbsPosition': 'bottom', 'widthDisplay' : 580});
				});
			</script>	
			<div class="col-md-6  py-2">
				<div class="row">
					<div class="descpro">
						<div class="row">
							<div class="descpro-title">
								<h5 style="color:#000000;"><?php echo $nama; ?></h5>
							</div>
							<div class="descpro-price">
								<h6><?php echo curfor($satuan); ?></h6>
							</div>
							<div class="descpro-description" style="padding-right:40px;">
								<label><?php echo $deskripsi; ?></label>
							</div>
							
							<div class="descpro-color">
								<label style="display:block;"><strong>Harga Grosir</strong></label>
							</div>
							<div class="descpro-price">
								<h6><?php echo curfor($grosir); ?></h6>
							</div>
							<div class="descpro-color-detail">
								
								<div class="form-check form-check-inline">
									<label class="text-dark font-weight-bold"><input type="checkbox" disabled <?php  if ($preorder=='Yes') { echo 'checked'; } ?>  name="frm_ckpo"> Pre Order</label>
									  
								</div>
								<div class="form-check form-check-inline">
									<label class="text-dark font-weight-bold">
									<input type="checkbox" disabled  <?php  if ($sale=='Yes') { echo 'checked'; } ?>   name="frm_cksale" onclick="fkSale()" id="ckSale"> Sale</label>
								</div>
								<div class="form-check form-check-inline">
									<input id="frm_sale" readonly  onkeypress="return IsDigit(event,this.id)" maxlength="10"  value="<?php echo $saleamount?>" name="frm_saleamount" type="text" placeholder="Masukkan diskon (%)"  style="font-size:11pt;" class="form-control form-control-sm">
								</div>

							</div>
						</div>
					</div>
				</div>
				<form class="" action="order.php" method="get">
				<input type="hidden" name="product_id" value="<?php echo $id; ?>">
				<input type="hidden" name="umkm_id" value="<?php echo $umkmid; ?>">
				<input type="hidden" name="product_name" value="<?php echo $nama; ?>">
					<button class="btn-success btn-block btn-lg mx-2 my-4" type="submit">
						Buat Pesanan
					</button>
				</form>
			</div>
			<hr class="text-dark"/>
			<div class="col-md-12 px-2 py-2 text-left">
				<span>Related Products</span>
			</div>
			
			<div class="col-md-12 px-2 py-2">
				<div class="row"> 	
					<?php 
				$sqlg="SELECT * from produk where status='enable'";
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
					while ($rowsg = mysqli_fetch_assoc($resg)) 
					{
						?>
						<div class="cardpro col-md-3 px-2 py-2">
							<div class="product">
								<p><a href="product_detail.php?pid=<?php echo $rowsg['produkid'];?>"><img src="<?php echo $rowsg['photo1'] ;?>" width="360" height="400"></a></p>
							<div>
							</div>
							</div>
							<div class="product-info-wrap pos-relative">
								<div class="product-info text-left margin-bottom20">
									<div class="product-name">
									<a href="product_detail.php?pid=<?php echo $rowsg['produkid'];?>"><?php echo $rowsg['produknama']?> (Pre Order)</a>
									</div>
									<div class="product-price"> 
									<?php echo curfor($rowsg['harga']); ?>
									</div>
								</div>
								<?php 
								if ($rowsg['preorder']=='Yes')
								{
									echo "<div class='product-special-icon'><span class='backorder'>Pre Order</span></div>";
								}
								
								if ($rowsg['sale']=='Yes')
								{
									echo "<div class='soldout-bg'><span class='soldout'>"."Sale ".$rowsg['saleamount']."%"."</span></div>";
								}
								?>
								
								
							</div>
						</div>
					<?php 
					}
				}
					?>
					
				</div>
			</div>	
		</div>
	</div>
	<br><hr>
 <footer>
      <div class="container">
        <div class="row">
			<div class="col-md-2 py-2 px-2">
				<div class="botlogo text-left">
					<img src="img/logo bottom.png" alt="">
				</div>
            </div>
			<div class="col-md-3 py-2 px-2">
				<div class="botmenu" style="color:#000;">
					<div class="text-left font-weight-bold">
						MENU
					</div>
					<a class="footer" href='index.php'>> Beranda</a><br/>
					<a class="footer" href='product.php'>> Produk</a><br/>
					<a class="footer" href='news.php'>> Berita</a><br/>
					<a class="footer" href='register.php'>> Registrasi</a>
				</div>
			</div>
			<div class="col-md-4  py-2 px-2">
				<div class="text-left font-weight-bold" style="color:#000;">
						KONTAK KAMI
				</div>
				<div class="text-left" style="color:#000;">
					<div class="row">
						<div class="col-md-2">
							<i class="fa fa-map-marker" aria-hidden="true" style="font-size:12pt;"></i>
						</div>
						<div class="col-md-10 py-2">
								<span>Jalan Raya Jember KM 13 
								<br>Banyuwangi  68461, 
								<br>Jawa Timur – Indonesia
								<br>
								+62 (0333) 636780</span>
						</div>
					</div>
				</div>
				<div class="text-left" style="color:#000;">
					<div class="row">
						<div class="col-md-2">
							<i class="fa fa-tablet" aria-hidden="true" style="font-size:12pt;"></i>
						</div>
						<div class="col-md-10  py-2">
						+62 (0333) 636780
						</div>
					</div>
				</div>
				<div class="text-left" style="color:#000;">
					<div class="row">
						<div class="col-md-2">
							<i class="fa fa-envelope" aria-hidden="true" style="font-size:12pt;"></i>
						</div>
						<div class="col-md-10  py-2">
							umkm@labanasem.ac.id
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3 py-2 px-2" style="color:#000;">
				<div class="row">
					<div class="col-md-12 text-left font-weight-bold">
							LOKASI
					</div>
					<div class="col-md-12 py-2">
							<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3948.086613966064!2d114.30438637491635!3d-8.29417918342291!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd156d7d86bef9b%3A0x4cb09a70b9109740!2sPoliteknik%20Negeri%20Banyuwangi!5e0!3m2!1sen!2sid!4v1693722319095!5m2!1sen!2sid" width="280" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
					</div>
				
				</div>
			</div>
			<div class="col-md-12">
				<hr>
			</div>
			<div class="col-md-9 copyright px-2 text-left">
					<span style="color:#333;font-size:0.8em;">Copyright &copy; <?php echo date("Y"); ?> UMKM Labanasem - Banyuwangi </span>
			</div>
			<div class="col-md-3">
				<div class="botsocial text-right">
					<a href="#" target="_blank"><img src="img/ig.png" alt=""></a>
					<a href="#" target="_blank"><img src="img/wa.png" alt=""></a>
					<a href="#"  target="_blank"><img src="img/email.png" alt=""></a>
				</div>
			</div>
        </div>
      </div>
    </footer>

  </body>

</html> 
<?php
	}
}
else
{
	header( "Location:product.php?pesan=Produk tidak dapat ditemukan!" );
}
function curfor($nominal){
	
	$resultval = number_format($nominal,0,',','.');
	return "Rp".$resultval;
}
?>