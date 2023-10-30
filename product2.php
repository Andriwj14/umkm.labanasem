<?php 
include "top.php";
require "system/sistem.php";
dbConnect();
?>
<!-- branch -->
    <div class="container container-shadow rounded">
		<div class="row text-center py-2 px-2">
			<div class="col-md-3 sidebar px-2 py-2">
				<div class="sidebar-box">
					<h4 class="sidebar-title">CATEGORIES</h4>
					<div class="categories col-md-12">
						<div class="categories-titles">
							<ul class="mastercategories">
                                 <li><a href="#" class="" data-abc="true">Category 1 </a></li>
                                 <li><a href="#" data-abc="true">Category 2 </a></li>
                                 <li><a href="#" data-abc="true">Category 3 </a></li>
								 <ul class="subcategories">
									 <li><a href="#" data-abc="true">Sub Category 1 </a></li>
									 <li><a href="#" data-abc="true">Sub Category 2 </a></li>
									 <li><a href="#" data-abc="true">Sub Category 3 </a></li>
									 <li><a href="#" data-abc="true">Sub Category 4 </a></li>
								</ul>
                                 <li><a href="#" data-abc="true">Category 4 </a></li>
                                 <li><a href="#" data-abc="true">Category 5 </a></li>
                             </ul>
						</div>
					</div>
					<hr>
					<h4 class="sidebar-title">SORT BY</h4>
					<div class="categories col-md-12">
						<select class="categories-sort">
							<option>Sort By Name Asc</option>
							<option>Sort By Name Desc</option>
							<option>Sort By Low Price</option>
							<option>Sort By High Price</option>
						</select>
					</div>
				</div>
						
			</div>
			<div class="col-md-9 px-2" >
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
						<div class="cardpro col-md-4 px-2 py-2">
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
	
<?php 
include "bottom.php";

function curfor($nominal){
	
	$resultval = number_format($nominal,0,',','.');
	return "IDR ".$resultval;
}
?>