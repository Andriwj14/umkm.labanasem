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
	if ($_SESSION['ses_hak']!='administrator')
	{
		header( "Location:index.php?pesan=Forbidden Access!" );
	}
	else
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
	<section class="bg-light sec-pad">
		<div class="div-bg" style="background-color:#00AA5B">
			
			<h4 class="h4-bg text-center"><span class="h4-bg-white">PELATIHAN UMKM</span></h4>
		</div>
		<hr>
	<div class="col-md-12 col-md-offset-2 custyle">
	<?php echo "<span style='color:green; font-weight:bold;'>".$pesan."</span>"; ?>
	<table id="paging" class="table table-bordered">
    <thead class="bg" style="background-color:#00AA5B"class="text-white">
        <tr class="text-white">
			<th class='text-center' style="width:10%;">No</th>
            <th class='' style="width:40%;">Judul Pelatihan</th>
            <th class='text-center' style="width:15%;">Tanggal Pelaksanaan</th>
			<th class='text-center' style="width:15%;">Waktu Pelaksanaan</th>
            <th class='text-center' style="width:10%;">Gambar</th>
            <th class="text-center" style="width:10%;">Action</th>
        </tr>
    </thead>
		<?php 
			
			$username = $_SESSION['ses_username'];
			$sql="SELECT e.eventid as 'kode',e.judul as 'judul',e.tanggal as 'tanggal' ,e.waktu as 'waktu', n.newspicture as 'gambar' , e.status as 'status' FROM event e INNER JOIN news n ON e.newsid=n.newsid ORDER BY e.dateinsert DESC";
			$res = mysqli_query($dbconn,$sql);
			$jml = @mysqli_num_rows($res);
			if ($jml==0)
			{
				echo "  <tr>";
				echo "		<td colspan=5 class='text-center' align='center'>No Data...</td>";					
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
					echo "	<td class='text-left'>$rows[judul]</td>";
					echo "	<td class='text-left'>$rows[tanggal]</td>";
					echo "	<td class='text-center'>$rows[waktu]</td>";
					echo "  <td class='text-center'><img src='../$rows[gambar]' width='150' alt=$rows[judul]></td>";
					//$_SESSION['ParamBerita'] = $rows[KodeBerita];
					if ($rows['status']=='inactive')
					{
						echo "<td class='text-center'><a href='eventeditform.php?nid=$rows[kode]&cmd=del' class='btn disabled btn-danger btn-sm'><span class='glyphicon glyphicon-remove'></span> Nonaktifkan</a></td>";
					}
					else
					{
						echo "<td class='text-center'><a href='eventeditform.php?nid=$rows[kode]&cmd=del' class='btn btn-danger btn-sm'><span class='glyphicon glyphicon-remove'></span> Nonaktifkan</a></td>";
					}
					
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
}
else
{
	header( "Location:index.php?pesan=Forbidden Access!" );
}
?>