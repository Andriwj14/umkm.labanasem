<?php include "top.php";
require "system/sistem.php";
dbConnect();

if(isset($_GET['nid']) and ctype_digit((string)$_GET['nid']))
{
	$psubject='';
	$pdesc='';	
	$ppic='';
	$pdate='';
	
	$nid=$_GET['nid'];
	$res = mysqli_query($dbconn,"SELECT * FROM news WHERE newsid=".$nid);
	$jml = @mysqli_num_rows($res);
	if (mysqli_num_rows($res) > 0)
	{
		while ($rows = mysqli_fetch_assoc($res)) 
		{
			$psubject=$rows['newssubject'];
			$pdesc=html_entity_decode($rows['newsdesc']);	
			$ppic=$rows['newspicture'];
			$pdate=$rows['newsdate'];
?>  
<!-- branch -->
    
    <div class="container container-shadow rounded">
        <div class="row">
            	<div class="col-md-12">
					<h4 class="text-left text-dark">DETAIL <span class="text-success">BERITA</span></h4>
				</div>
				<div class="col-md-12">
					<?php 
					if (!empty($ppic))
					{
					?>
						<div class="col-md-12 text-center py-4">
							<img src="<?php echo $ppic; ?>" class="rounded thumbnail img-thumbnail" style="max-width:1024px;">
						</div>
					<?php
					}
					?>
					
					<div class="col-md-12 text-justify">
						<h5 style="line-height:30px;" class="text-success" ><?php echo $psubject; ?></h5>
					</div>
					<div>
						<span style="color:#666; font-weight:800;display:block; font-size:.9em">
						<i class='fa fa-calendar' style="font-size:14pt;"></i>&nbsp;Tanggal : <?php echo $pdate; ?></span>
					</div>
					<div class="text-justify col-md-12 py-2">
						<span><?php echo $pdesc; ?></span>
					</div>
				</div>
        </div>       
      </div>
                              
	<?php 
	}			
		}
		else
		{				
		?>
	
      <div class="container container-shadow rounded">
        <div class="row text-center"> 
			<!-- Isi -->
          	 <div class="col-md-8 text-left">
				<h4 class="text-left text-dark">DETAIL <span class="text-success">BERITA</span></h4>
					<div class="news-title  col-md-8" style="padding:10px;">
						<p>Oops :(</p> 
					</div>
			 </div>
        </div>       
      </div>
						<?php 
					}
		
}
else
{
   ?>
      <div class="container container-shadow rounded">
        <div class="row text-center"> 
			<!-- Isi -->
          	 <div class="col-md-8 text-left">
				<h4 class="text-left text-dark">DETAIL <span class="text-success">BERITA</span></h4>
					<div class="news-title  col-md-8" style="padding:10px;">
						<p>Oops :(</p> 
					</div>
			 </div>
        </div>       
      </div>
   <?php
}
include "bottom.php";
?> 