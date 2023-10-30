<?php
session_start();
require"../system/sistem.php";

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
			$pesan=periksa_input($_GET['pesan']);
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
    <title>DASHBOARD ADMINISTRATOR</title>
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
	<section class="sec-pad">
		<div class="div-bg bg-success">
			<h4 class="h4-bg text-center"><span class="h4-bg-white">Pelaporan / Pengajuan</span></h4>
		</div>
		<hr>
	<div class="col-md-12 col-md-offset-2 custyle">
	<?php echo "<span style='color:green; font-weight:bold;'>".$pesan."</span>"; ?>
	<h5 class="text-success text-left">History Pelaporan / Pengajuan</h5>
		
	<table id="paging" class="table table-bordered table-sm">
	<table class="table table-striped table-sm">
    <thead>
		<a href="laporanaddform.php" class="btn btn-success btn-sm pull-left my-2 py-3"><b>+</b> Pengajuan</a>
        <tr>
		    <th class='text-center text-success' style="width:5%;">no</th>
            <th class='text-left text-success' style="width:35%;">Judul</th>
			<th class='text-center text-success' style="width:15%;">Kategori</th>
            <th class='text-center text-success' style="width:10%;">Tanggal</th>
            <th class='text-center text-success' style="width:10%;">Status</th>
            <th class="text-center text-success" style="width:25%;">Keterangan</th>
        </tr>
    </thead>
			<?php 
			
			$username = $_SESSION['ses_username'];
			$no_urut = 0;
			$sql="SELECT * FROM laporan";
			$res = mysqli_query($dbconn,$sql);
			$jml = @mysqli_num_rows($res);
			if ($jml==0)
			{
					echo "  <tr>";
					echo "		<td colspan=4 class='text-center' align='center'>No Data...</td>";					
					echo "  </tr>";
				//exit;
			}
			else
			{				
				while ($rows = mysqli_fetch_assoc($res)) 
				{
					$no_urut++;
					echo "  <tr>";
					echo "	<td class='text-center'>$no_urut</td>";
					echo "	<td class='text-justify'>$rows[judul]</td>";
					echo "	<td class='text-center'>$rows[kategori]</td>";
					echo "  <td class='text-center'>$rows[tanggal]</td>";
					echo "  <td class='text-center'>$rows[status]</td>";
					echo "  <td class='text-justify'>".html_entity_decode($rows['keterangan'])."</td>";
					
					echo "</tr>";
				}
			}
				echo "</table>" ;   
			?>
                      </table>
		<link href="jquerydata/assets/css/jquery.dataTables.min.css" rel="stylesheet" media="screen">
					<script src="jquerydata/assets/js/jquery.js"></script>
					<script src="jquerydata/assets/js/jquery.dataTables.js"></script>
				  
					<script>
						$(document).ready(function() {
							$('#paging').DataTable();
						} );
					</script>  
		
</div>
	  </div>
	</section>
</body>
</html>
<?php 
	
}
else
{
	header( "Location:index.php?pesan=Forbidden Access!" );
}
?>