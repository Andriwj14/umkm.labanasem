<?php
session_start();
require"../system/sistem.php";
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
				}
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

			<!-- branch -->
				<div class="div-bg bg-success">
			<h4 class="h4-bg text-center"><span class="h4-bg-white">Detail Berita</span></h4>
		</div>
		<hr>	
		
			<div class="row">
				<div class="col-md-12 py-4 px-4">
					<div class="row text-center"> 
						<!-- Isi -->
						 <div class="col-md-12 text-left">
							<div class="row">
							
								<div class="col-md-12">
									<?php 
									if (!empty($ppic))
											{
											?>
												<div class="col-md-12 text-center">
													<img src="<?php echo "../".$ppic; ?>" style="height:400px; width:auto;">
												</div>
											<?php
											}
									?>
									
									<div style="padding:5px;" class="text-justify text-dark"><h5 class="text-dark"><?php echo $psubject; ?></h5></div>
									<div style="padding:5px;"><span style="color:#666; font-weight:800;display:block; font-size:.8em"><i class="fa fa-calendar"></i>&nbsp;Posted Date : <?php echo $pdate; ?></span><hr></div>
									<div style="padding:5px;" class="text-justify"><span><?php echo html_entity_decode($pdesc); ?></span></div>
								</div>
								
							</div>
						 </div>
					</div>       
				  </div>
			</div>
							  
<?php 
	}
	else
	{
		
		header( "Location:index.php?pesan=Forbidden Access!" );
	}
}
else
{
	header( "Location:index.php?pesan=Forbidden Access!" );
}
?> 
</body>
</html>