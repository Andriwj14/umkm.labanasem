<?php
session_start();
require"../system/sistem.php";

//Session Placing ak.1452019
	$time = $_SERVER['REQUEST_TIME'];
	if (isset($_SESSION['LAST_ACTIVITY']) &&  ($time - $_SESSION['LAST_ACTIVITY']) > $_SESSION['TIME_DURATION']) {
		session_unset();
		session_destroy();
		session_start();
		header( "Location:index.php?pesan=Session Timeout!" );
	}
	else if (isset($_SESSION['ses_username'])) 
{
	if ($_SESSION['ses_hak']!='administrator')
	{
		header( "Location:index.php?pesan=Forbidden Access!" );
	}
	else
	{
		dbConnect();
			
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
	<section class="bg-light sec-pad">
		<div class="div-bg" style="background-color:#00AA5B">
			<h4 class="h4-bg text-center"><span class="h4-bg-white">DATA LAPORAN</span></h4>
		</div>
		<hr>
	<div class="col-md-12 col-md-offset-2 custyle">
	<table id="paging" class="table table-bordered table-sm">
    <thead class="bg" style="background-color:#00AA5B">
       <tr class="text-white">
            <th class='text-center' width="5%">No</th>
            <th class='text-center' width="30%">Nama UMKM</th>
            <th class='text-center' width="15%">Tanggal Pelaporan</th>
			<th class='text-center' width="50%">Deskripsi Laporan</th>
        </tr>
    </thead>
		<?php echo "<span style='color:red; font-weight:bold;'>".$pesan."</span>";
			
			$username = $_SESSION['ses_username'];
			
			$sql="SELECT l.laporanid as 'kd', r.nama as 'nm',l.tanggal as 'tgl', l.isi as 'isi' FROM laporan l INNER JOIN register r ON l.umkmid=r.umkmid WHERE l.kategori='laporan' ORDER BY l.dateinsert DESC";
			
			
			$res = mysqli_query($dbconn,$sql);
			$jml = @mysqli_num_rows($res);
			if ($jml==0)
			{
					echo "  <tr>";
					echo "		<td colspan=5 class='control' align='center'>Belum ada laporan...</td>";					
					echo "  </tr>";
				//exit;
			}
			else
			{			
				$urut=1;
				while ($rows = mysqli_fetch_assoc($res)) 
				{
					echo "  <tr>";
					echo "	<td class='text-center'>$urut</td>";
					echo "	<td class='text-left'>$rows[nm]</td>";
					echo "	<td class='text-center'>$rows[tgl]</td>";
					echo "	<td class='text-left'>$rows[isi]</td>";
					echo "</tr>";
					$urut++;
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
								$('#paging').DataTable({
								  columnDefs: [{
									"defaultContent": "-",
									"targets": "_all"
								  }]
								});
							} );
							$(function () {
							  $('[data-toggle="tooltip"]').tooltip()
							})
					</script>  
		
</div>
	  </div>
	</section>
</body>
</html>
<?php 
	}
}
else
{
	header( "Location:index.php?pesan=Forbidden Access!" );
}
?>