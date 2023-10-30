<style>
a.navmenu {
	padding:5px;
	font-size:1em;
	font-family: Arial, sans-serif;
	line-height:30px;
	font-weight:600;
	color:#000000;
}

.active {
    background-color: #00AA5B;
    color: #fff; /* Mengubah warna teks menjadi putih untuk kontras yang lebih baik */
    border-radius: 5px; /* Mengatur sudut elemen yang aktif menjadi sedikit lebih melengkung */
    transition: background-color 0.3s; /* Efek transisi saat mengubah warna latar belakang */
}

.active:hover {
    background-color: #009948; /* Warna latar belakang saat hover pada elemen yang aktif */
}


</style>

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
	
?>
	<!-- <link rel="stylesheet" href="css/sidebar.css"> -->

		<!-- <nav class="navbar navbar-expand-md bg-white">
		
			<div class="portfolio-caption  text-center">
			<div class="botlogo text-center">
					<img src="../img/logo bottom.png" alt="">
				<h4 class="mb-3" style="color:#00AA5B" > DASHBOARD UMKM</h4>
				</div>
			</div>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
					aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse " id="navbarsExampleDefault">
				<ul class="navbar-nav ">
					<li class="nav-item mb-4" >
						<a class="navmenu "  href="change_password.php"><span class="fa fa-exchange font-weight-bold text-uppercase"  style="font-size:16px;">&nbsp;&nbsp;Ubah Password</span></a>
					</li>
					
					<li class="nav-item mb-4">
						<a class="navmenu" href="prev_profile.php"><span class="fa fa-address-book font-weight-bold text-uppercase"  style="font-size:16px; margin-right: 15px;">&nbsp;&nbsp;Profile</span>  </a>
					</li>
					<li class="nav-item mb-4">
						<a class="navmenu" href="produk.php"><span class="fa fa-photo font-weight-bold text-uppercase"  style="font-size:16px; margin-right: 15px;">&nbsp;&nbsp;Produk</span>  </a>
					</li>
					<li class="nav-item mb-4">
						<a class="navmenu" href="news.php"><span class="fa fa-newspaper-o font-weight-bold text-uppercase"  style="font-size:16px; margin-right: 15px;">&nbsp;&nbsp;Berita</span>  </a>
					</li>
					<li class="nav-item mb-4">
						<a class="navmenu" href="laporanview.php"><span class="fa fa-chevron-circle-right font-weight-bold text-uppercase"  style="font-size:16px; margin-right: 15px;">&nbsp;&nbsp;Pengajuan</span>  </a>
					</li>
						<li class="nav-item mb-4">
						 <a class="navmenu" href="logout.php"><span class="fa fa-sign-out font-weight-bold text-uppercase"  style="font-size:16px; margin-right: 15px;">&nbsp;&nbsp;Logout</span>  </a>
					</li>
				</ul>
				
			
			</div>
		</nav> -->
<nav class="navbar navbar-expand-md bg-white">
<div class="botlogo text-center">
					<img src="../img/logo bottom.png" alt="">
				<h4 class="mb-3" style="color:#00AA5B" > DASHBOARD UMKM</h4>
				</div>
			</div>
    
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
        aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse " id="navbarsExampleDefault">
        <ul class="navbar-nav ">
            <li class="nav-item mb-4 <?php if ($current_page == 'change_password.php') echo 'active'; ?>">
                <a class="navmenu "  href="change_password.php"><span class="fa fa-exchange font-weight-bold text-uppercase"  style="font-size:16px;">&nbsp;&nbsp;Ubah Password</span></a>
            </li>
            
            <li class="nav-item mb-4 <?php if ($current_page == 'prev_profile.php') echo 'active'; ?>">
                <a class="navmenu" href="prev_profile.php" style="font-family: arial;"> <span class="fa fa-address-book font-weight-bold text-uppercase"  style="font-size:16px; margin-right: 15px;">&nbsp;&nbsp;Profile</span>  </a>
            </li>
            <li class="nav-item mb-4 <?php if ($current_page == 'produk.php') echo 'active'; ?>">
                <a class="navmenu" href="produk.php"><span class="fa fa-photo font-weight-bold text-uppercase"  style="font-size:16px; margin-right: 15px;">&nbsp;&nbsp;Produk</span>  </a>
            </li>
            <li class="nav-item mb-4 <?php if ($current_page == 'news.php') echo 'active'; ?>">
                <a class="navmenu" href="news.php"><span class="fa fa-newspaper-o font-weight-bold text-uppercase"  style="font-size:16px; margin-right: 15px;">&nbsp;&nbsp;Berita</span>  </a>
            </li>
            <li class="nav-item mb-4 <?php if ($current_page == 'laporanview.php') echo 'active'; ?>">
                <a class="navmenu" href="laporanview.php"><span class="fa fa-chevron-circle-right font-weight-bold text-uppercase"  style="font-size:16px; margin-right: 15px;">&nbsp;&nbsp;Pengajuan</span>  </a>
            </li>
            <li class="nav-item mb-4 <?php if ($current_page == 'logout.php') echo 'active'; ?>">
                <a class="navmenu" href="logout.php"><span class="fa fa-sign-out font-weight-bold text-uppercase"  style="font-size:16px; margin-right: 15px;">&nbsp;&nbsp;Logout</span>  </a>
            </li>
        </ul>
    </div>
</nav>


<?php	
}
else
{
	header( "Location:index.php?pesan=Tidak ada akses!" );
}
?>