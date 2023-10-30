<?php 
$current_page = basename($_SERVER['SCRIPT_FILENAME']);
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
	if ($_SESSION['ses_hak']!='administrator')
	{
		header( "Location:index.php?pesan=Forbidden Access!" );
	}
	else
	{
		if($_SESSION['ses_hak']=='administrator')
		{  
?>
<style>
	.active {
    background-color: #00AA5B;
    color: #fff; /* Mengubah warna teks menjadi putih untuk kontras yang lebih baik */
    border-radius: 5px; /* Mengatur sudut elemen yang aktif menjadi sedikit lebih melengkung */
    transition: background-color 0.1s; /* Efek transisi saat mengubah warna latar belakang */
}

.active:hover {
    background-color: #009948; /* Warna latar belakang saat hover pada elemen yang aktif */
}
</style>

<!-- <link rel="stylesheet" href="sidebar.css"> -->
		<nav class="navbar navbar-expand-md navbar-dark bg-white fixed-top">
			<div class="portfolio-caption  text-center">
			<div class="botlogo text-center">
					<img src="../img/logo bottom.png" alt="">
				<h4 class="text" style="color:#00AA5B"> ADMIN DASHBOARD</h4>
				</div>	
			</div>
			
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
					aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarsExampleDefault">
				<ul class="navbar-nav">
					<li class="nav-item <?php echo ($current_page == 'admin_show.php') ? 'active' : ''; ?>">
					<!-- <i class="fa fa-dashboard"></i>  -->
						<a class="nav-link text-dark font-weight-bold text-uppercase" href="admin_show.php">
							<span class="fa fa-dashboard"  style="font-size:20px; margin-right: 15px;"></span>
							    Dashboard</a>
					</li>
					<li class="nav-item <?php echo ($current_page == 'change_password.php') ? 'active' : ''; ?>">
						<a class="nav-link text-dark font-weight-bold text-uppercase" href="change_password.php">
							<span class="fa fa-key"  style="font-size:20px; margin-right: 15px;"></span> Ubah Password</a>
					</li>
					<li class="nav-item <?php echo ($current_page == 'umkmview.php') ? 'active' : ''; ?>">
						<a class="nav-link text-dark font-weight-bold text-uppercase" href="umkmview.php">
							<span class="fa fa-database"  style="font-size:20px; margin-right: 15px;"></span> UMKM</a>
					</li>
					 <li class="nav-item <?php echo ($current_page == 'newsview.php') ? 'active' : ''; ?>">
						<a class="nav-link text-dark font-weight-bold text-uppercase" href="newsview.php">
							<span class="cil-newspaper"  style="font-size:20px; margin-right: 15px;"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M168 80c-13.3 0-24 10.7-24 24V408c0 8.4-1.4 16.5-4.1 24H440c13.3 0 24-10.7 24-24V104c0-13.3-10.7-24-24-24H168zM72 480c-39.8 0-72-32.2-72-72V112C0 98.7 10.7 88 24 88s24 10.7 24 24V408c0 13.3 10.7 24 24 24s24-10.7 24-24V104c0-39.8 32.2-72 72-72H440c39.8 0 72 32.2 72 72V408c0 39.8-32.2 72-72 72H72zM176 136c0-13.3 10.7-24 24-24h96c13.3 0 24 10.7 24 24v80c0 13.3-10.7 24-24 24H200c-13.3 0-24-10.7-24-24V136zm200-24h32c13.3 0 24 10.7 24 24s-10.7 24-24 24H376c-13.3 0-24-10.7-24-24s10.7-24 24-24zm0 80h32c13.3 0 24 10.7 24 24s-10.7 24-24 24H376c-13.3 0-24-10.7-24-24s10.7-24 24-24zM200 272H408c13.3 0 24 10.7 24 24s-10.7 24-24 24H200c-13.3 0-24-10.7-24-24s10.7-24 24-24zm0 80H408c13.3 0 24 10.7 24 24s-10.7 24-24 24H200c-13.3 0-24-10.7-24-24s10.7-24 24-24z"/></svg></span> Berita</a>
					</li>
					 <li class="nav-item <?php echo ($current_page == 'eventview.php') ? 'active' : ''; ?>">
						<a class="nav-link text-dark font-weight-bold text-uppercase" href="eventview.php">
							<span class="fa fa-training"  style="font-size:20px; margin-right: 15px;"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M256 64A64 64 0 1 0 128 64a64 64 0 1 0 128 0zM152.9 169.3c-23.7-8.4-44.5-24.3-58.8-45.8L74.6 94.2C64.8 79.5 45 75.6 30.2 85.4s-18.7 29.7-8.9 44.4L40.9 159c18.1 27.1 42.8 48.4 71.1 62.4V480c0 17.7 14.3 32 32 32s32-14.3 32-32V384h32v96c0 17.7 14.3 32 32 32s32-14.3 32-32V221.6c29.1-14.2 54.4-36.2 72.7-64.2l18.2-27.9c9.6-14.8 5.4-34.6-9.4-44.3s-34.6-5.5-44.3 9.4L291 122.4c-21.8 33.4-58.9 53.6-98.8 53.6c-12.6 0-24.9-2-36.6-5.8c-.9-.3-1.8-.7-2.7-.9z"/></svg></span> Pelatihan</a>
					</li>
					
					<li class="nav-item <?php echo ($current_page == 'laporan.php') ? 'active' : ''; ?>">
						<a class="nav-link text-dark font-weight-bold text-uppercase" href="laporan.php">
							<span class="fa fa-file"  style="font-size:20px; margin-right: 15px;"></span> Laporan</a>
					</li>
					<li class="nav-item <?php echo ($current_page == 'pengajuan.php') ? 'active' : ''; ?>">
						<a class="nav-link text-dark font-weight-bold text-uppercase" href="pengajuan.php">
							<span class="fa fa"  style="font-size:20px; margin-right: 15px;"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V428.7c-2.7 1.1-5.4 2-8.2 2.7l-60.1 15c-3 .7-6 1.2-9 1.4c-.9 .1-1.8 .2-2.7 .2H240c-6.1 0-11.6-3.4-14.3-8.8l-8.8-17.7c-1.7-3.4-5.1-5.5-8.8-5.5s-7.2 2.1-8.8 5.5l-8.8 17.7c-2.9 5.9-9.2 9.4-15.7 8.8s-12.1-5.1-13.9-11.3L144 381l-9.8 32.8c-6.1 20.3-24.8 34.2-46 34.2H80c-8.8 0-16-7.2-16-16s7.2-16 16-16h8.2c7.1 0 13.3-4.6 15.3-11.4l14.9-49.5c3.4-11.3 13.8-19.1 25.6-19.1s22.2 7.8 25.6 19.1l11.6 38.6c7.4-6.2 16.8-9.7 26.8-9.7c15.9 0 30.4 9 37.5 23.2l4.4 8.8h8.9c-3.1-8.8-3.7-18.4-1.4-27.8l15-60.1c2.8-11.3 8.6-21.5 16.8-29.7L384 203.6V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM549.8 139.7c-15.6-15.6-40.9-15.6-56.6 0l-29.4 29.4 71 71 29.4-29.4c15.6-15.6 15.6-40.9 0-56.6l-14.4-14.4zM311.9 321c-4.1 4.1-7 9.2-8.4 14.9l-15 60.1c-1.4 5.5 .2 11.2 4.2 15.2s9.7 5.6 15.2 4.2l60.1-15c5.6-1.4 10.8-4.3 14.9-8.4L512.1 262.7l-71-71L311.9 321z"/></svg></span> Pengajuan</a>
					</li>
					<li class="nav-item" <?php echo ($current_page == 'logout.php') ? 'active' : ''; ?>>
						 <a class="nav-link text-dark font-weight-bold text-uppercase" href="logout.php">
							<span class="fa fa"  style="font-size:20px; margin-right: 15px;"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"/></svg></span> Logout</a>
					</li>
				</ul>
			
			</div>
		</nav>



<?php	
		}
		else
		{
			header( "Location:index.php?pesan=Forbidden Access!" );
		}
	}
}
else
{
	header( "Location:index.php?pesan=Forbidden Access!" );
}
?>

