<?php include "top.php";
require "system/sistem.php";
dbConnect();
?>
<!-- branch -->
    <section class="bg-light">
      <div class="container" style="background-color:#ffffff;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); margin-top:-15px;margin-bottom:-15px;">
        <div class="row text-center">
			<!-- Isi -->
          	<div class="col-md-12" style="margin-top:10px;margin-bottom:10px;">
					<div class="row">
						<?php 
						if (empty($_POST['p']))
						{
							$key = "";
						}
						else
						{
							$key = $_POST['p'];
							$c_key=periksa_input($key);
						$sqlall="SELECT * FROM produk WHERE produknama LIKE '%$c_key%'";
						echo $sqlall;
						$resall = mysqli_query($dbconn,$sqlall);
						$jmlall = @mysqli_num_rows($resall);
						if ($jmlall==0)
						{
							echo "<span style='line-height:300px;'>Produk yang anda cari tidak dapat ditemukan!</span>";
						}
						else
						{				
							while ($rowsall = mysqli_fetch_assoc($resall)) 
							{
								?>
								<div class="col-md-2 px-2 py-2">
									<div class="bg-light">
										<?php  
												$sqldetall="select * from produkfoto where produkid=$rowsall[produkid]";
												$resdetall = mysqli_query($dbconn,$sqldetall);
												$jmldetall = @mysqli_num_rows($resdetall);
												if ($jmldetall==0)
												{
													echo "<img style='width:100%;' src='img/non.jpg'>";
												}
												else
												{
													$rowsdetall = mysqli_fetch_assoc($resdetall);
													echo "<img style='width:100%;' src='$rowsdetall[fotofile]' alt='$rowsall[produknama]'>";
												}
										?>
										<div class="card-body">
											<h5 class="card-title text-info"><?php echo strtoupper($rowsall['produknama']); ?></h5>
											<p class="card-text"><?php echo rupiah($rowsall['harga']); ?></p>
											<a class="open-Detail produk" href="#detailDialog" data-id="<?php echo $rowsall['produkid']; ?>">Detail</a>
										</div>
									</div>
								</div>
								<?php
							}
						}
						}
						
						?>
					</div>
				</div>
        </div>       
      </div>
    </section>
   <script>
	$(document).on("click", ".open-Detail", function () {
    var kobar = $(this).data('id');
    //$(".modal-body #bookId").val( myBookId );
    $.post('sandet.php', {detailvalue: kobar}, function(data)
	{
		$('#detail_result').html(data);
	});
    $('#detailDialog').modal('show');
});
	</script>
	<div id="detailDialog" class="modal fade" tabindex="-1" role="dialog"> 
			<div class="modal-dialog modal-xl ">
				<div class="modal-content"> 
					<div class="modal-header"> 
						<h5 class="modal-title">DETAIL PRODUK</h5> 
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>   
					</div>
					<div class="modal-body">
						<div class="form-group">
						  <div class="col-md-12">
								<div id="detail_result"></div>
						  </div>
						  
						</div>
					</div>
				</div>
			</div>
	</div>          	
<?php include "bottom.php";
function rupiah($angka)
{
	$hasil_rupiah = "Rp " . number_format($angka,0,',','.');
	return $hasil_rupiah;
}

?>  