<?php 
include "top.php";
require "system/sistem.php";
dbConnect();
?>
<!-- branch -->
    <div class="container container-shadow rounded">
		<div class="row text-center py-2 px-2">
			<div class="col-md-12 px-2 py-2">
				<div class="row">
					<div class='col-md-3 px-2 py-2'>
						<a class="btn btn-lg btn-success col-md-12 text-left py-2 " href="product.php?cat=jasa" role="button">JASA</a>
					</div>
					<div class="col-md-3 px-2 py-2">
						<a class="btn btn-lg btn-primary col-md-12 text-left py-2" href="product.php?cat=kuliner" role="button">KULINER</a>
					</div>
					<div class="col-md-3 px-2 py-2">
						<a class="btn btn-lg btn-warning col-md-12 text-left py-2" href="product.php?cat=fashion" role="button">FASHION</a>
					</div>
					<div class="col-md-3 px-2 py-2">
						<a class="btn btn-lg btn-danger col-md-12 text-left py-2" href="product.php?cat=kerajinan" role="button">KERAJINAN</a>
					</div>
				</div>
			</div>
			<div class="col-md-12 px-2" >
				<div class="row">
				
			<?php 
				if(isset($_GET['cat']))
				{
					$parcat=periksa_input($_GET['cat']);
					if ($parcat=='all')
					{
						$sqlpar="";
					}
					else
					{
						$sqlpar=" and kategori='".$parcat."'";
					}
				}
				else
				{
					$sqlpar="";
				}
				
				$sqlg="SELECT * from produk where status='enable'".$sqlpar;
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
									<div><img src="img/ukm.png" width="20px" alt="">
									<?php
									$sqlu="SELECT nama from register where umkmid=".$rowsg['umkmid']."";
									$resu = mysqli_query($dbconn,$sqlu);
									$jmlu = @mysqli_num_rows($resu);
									if ($jmlu==0)
									{
											echo "";
									}
									else
									{		
										while ($rowsu = mysqli_fetch_assoc($resu)) 
										{
												echo $rowsu['nama'];
										}
									}
									?>
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
	
<?php 
include "bottom.php";

function curfor($nominal){
	
	$resultval = number_format($nominal,0,',','.');
	return "IDR ".$resultval;
}
?>