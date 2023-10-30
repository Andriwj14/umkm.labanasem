<?php
session_start();
require "../system/sistem.php";

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
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv='Content-Type' content='Type=text/html; charset=utf-8'/>
    <meta name="language" content="id" />
    <title>Produk</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="css/agency.min.css" rel="stylesheet">
	<link href="css/custom.css" rel="stylesheet">
	<link href="css/glass.css" rel="stylesheet">
	<script src="js/bootstrap.bundle.min.js"></script>
	<script src="js/zoom.js"></script>
	<script src="js/docs.js"></script>
	<link href="css/addon.css" rel="stylesheet">
	<link rel="stylesheet" href="css/docs.css">
	  </head>
  <body>
   <?php
		include "menu_samping.php";
	?>

<!-- branch -->
    <div class="container">
		<div class="row text-center">
			<div class="col-md-4 py-2">
				<ul id="glasscase" class="gc-start">
					<li><img src="img/11.jpg" alt="Text" /></li>
					<li><img src="img/12.jpg" alt="Text" /></li>
					<li><img src="img/13.jpg" alt="Text" /></li>      
				</ul>
			</div>
			<script type="text/javascript">
				$(document).ready( function () {
					//If your <ul> has the id "glasscase"
					$('#glasscase').glassCase({ 'thumbsPosition': 'bottom', 'widthDisplay' : 580});
				});
			</script>	
			<div class="col-md-4 py-2">
				<div class="row">
					<div class="descpro">
						<div class="row">
							<div class="descpro-title" style="color:#000">
								<h5>Collection Name 1</h5>
							</div>
							<div class="descpro-price">
								<h6>IDR. 500.000</h6>
							</div>
							<div class="descpro-description col-md-12">
								<label>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean bibendum augue at purus feugiat, aliquet lobortis ligula volutpat. Pellentesque iaculis purus ut velit auctor vulputate. Nulla ornare tristique elit, eget eleifend leo pharetra posuere. Quisque in pretium magna. Curabitur facilisis imperdiet rhoncus. In iaculis posuere lorem, in pharetra nunc ultricies ac. Vestibulum dictum elit a augue congue, nec vestibulum ex luctus</label>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
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