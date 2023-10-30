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
		$email=$_SESSION['ses_username'];
		$res = mysqli_query($dbconn,"SELECT * FROM umkm WHERE email='$email'");
		$jml = @mysqli_num_rows($res);
		if ($jml==0)
		{
			$pesan="could not find	!";				
		}
		else
		{				
			while($rows = mysqli_fetch_assoc($res))
			{
				$par_id=$rows['umkmid'];	
				$par_nama=$rows['namalengkap'];	
				$par_alamat=$rows['alamat'];	
				$par_email=$rows['email'];
				$par_nohp=$rows['nohp'];
				$par_namausaha=$rows['namausaha'];
				$par_jenisusaha=$rows['jenisusaha'];
				$par_kategori=$rows['categoryid'];
				$par_lokasi=$rows['lokasiusaha'];
				$par_periode=$rows['periodeusaha'];
				$par_profile=$rows['profile'];
			}
		}
			
		if(isset($_GET['pesan']))
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
	<section class="sec-pad">
		<div class="div-bg bg-success">
			<h4 class="h4-bg text-center"><span class="h4-bg-white">Berita</span></h4>
		</div>
		<hr>	
		
			<!-- Isi -->
          	<div class="col-md-12 py-3 px-3">
				<h4 class="service-heading-menu text-left text-success">Berita Terkini</span></h4>
					<div class="list-group  list-group-flush">
						<?php
						$sqln="SELECT * FROM news ORDER BY newsdate Desc";
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
									echo "		<div class='media-left' style='max-width:200px;'>";
									echo "			<img src='../$rowsn[newspicture]' style='max-width:150px;' class='img-thumbnail'  alt='$rowsn[newssubject]'>";
									echo "		</div>";
								}
								echo "		<div class='media-body px-3 py-1'>";
								echo "			<h6 class='media-heading text-success font-weight-bold' style='color:#289dcc; font-size:12pt;'>$rowsn[newssubject]</h6>";
								echo "			<span style='display:block;line-height:30px;font-size:.9em;color:#333;'><i class='fa fa-calendar'></i>&nbsp;<b>Tanggal Berita</b>&nbsp;:&nbsp;$rowsn[newsdate]</span>";
								$string = $rowsn['newsshortdesc']."... ";
								echo "			<span class='text-justify' style='display:block;line-height:30px;'>$string</span>";
								echo "			<span class='text-justify' style='display:block;line-height:30px;'><a href='news_detail.php?nid=$rowsn[newsid]' class='productlink text-success'>Baca disini</a></span>";
								echo "		</div>";
								echo "	</div>";
							}
						}
					?>
						
		            </div>
					
			 </div>
          
      </div>
                  
</body>
</html>
<?php 
	
}
else
{
	header( "Location:index.php?pesan=Forbidden Access!" );
}
function curfor($nominal){
	
	$resultval = number_format($nominal,0,'.',',');
	return $resultval;
 
}
?>