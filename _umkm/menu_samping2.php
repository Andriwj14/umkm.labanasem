<style>
a.navmenu {
	padding:5px;
	font-size:1em;
	line-height:30px;
	font-weight:600;
	color:#2196F3;
}
a.navmenu:hover, a.navmenu:active 
{
  color: #fff;
  background-color: transparent;
  background-clip: text;
  text-decoration:none;
}
</style>
<?php 
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
	
?>
		  <!-- Navigation -->
<nav class="navbar">
  <div class="container" >
	<div class="col-md-12 text-center">
		<a class="navbar-brand" href="#">
				<img src="img/logo bottom.png" alt="UMKM Labanasem">
		</a>
	</div>
  </div>
</nav>
<nav class="navbar navbar-expand-md navbar-dark bg-success">
  <div class="container">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mx-auto">
				<li class="nav-item">
				  <a class="nav-link" href="produk.php">Beranda</a>
				</li>
				<li class="nav-item">
				  <a class="nav-link" href="prev_profile.php">Profile</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="galleryview.php">Produk</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="news.php">Berita</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="galleryview.php">Pelaporan/Pengajuan</a>
				</li>
				<li class="nav-item">
				  <a class="nav-link" href="logout.php">Logout</a>
				</li>
      </ul>
    </div>
  </div>
</nav>

<?php	
		
	}
?>