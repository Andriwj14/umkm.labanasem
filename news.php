<?php
session_start();
include "top.php";
require"system/sistem.php";
dbConnect();
		
?>
<!-- branch -->
	<div class="container container-shadow rounded">
        <div class="row">
			<!-- Isi -->
          	<div class="col-md-12 py-2">
				<div class="col-md-12">
					<h4 class="text-left text-success">BERITA</h4>
				</div>
					<div class="list-group  list-group-flush">
						<?php
						$sqln="SELECT * FROM news ORDER BY newsdate Desc";
						//echo $sqln;
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
								echo "	<div class='media my-1 py-2'>";
								if (!empty($rowsn['newspicture']))
								{
									echo "		<div class='media-left px-2' style='max-width:200px;'>";
									echo "			<img src='$rowsn[newspicture]' class='rounded img-thumbnail'  style='max-width:200px;' class='media-object' alt='$rowsn[newssubject]'>";
									echo "		</div>";
								}
								echo "		<div class='media-body px-4'>";
								echo "			<h6 class='media-heading font-weight-bold' style='color:#000000;font-size:12pt'>$rowsn[newssubject]</h6>";
								echo "			<span style='display:block;line-height:30px;font-size:.9em;color:#333;'><i class='fa fa-calendar' style='font-size:12pt;'></i>&nbsp;<b>Tanggal </b>:&nbsp;$rowsn[newsdate]</span>";
								$string = $rowsn['newsshortdesc']."... <a href='news_detail.php?nid=$rowsn[newsid]' class='productlink text-success'>Baca disini</a>";
								echo "			<span class='text-justify' style='display:block;line-height:30px;'>$string</span>";
								echo "		</div>";
								echo "	</div>";
							}
						}
					?>
						
		            </div>
					
			 </div>
            
        </div>       
      </div>
                  
<?php 
include"bottom.php";
?>