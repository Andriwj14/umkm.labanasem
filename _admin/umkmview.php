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
			<h4 class="h4-bg text-center"><span class="h4-bg-white">DATA UMKM</span></h4>
		</div>
		<hr>
			<div class="col-md-12 col-md-offset-2 custyle">
			<a href="register.php" class="btn btn-xs pull-right text-white my-2 py-2" style="background-color:#00AA5B"><b>+</b> Daftar UMKM</a>
			<table id="paging" class="table table-bordered table-sm">
			<thead class="bg" style="background-color:#00AA5B">
			   <tr class="text-white">
					<th class='text-center' width="10%">ID</th>
					<th class='' width="35%">Nama UMKM</th>
					<th class='' width="30%">Pemilik</th>
					<th class='' width="10%">Tahun Daftar</th>
					<th class="" width="15%">Aksi</th>
				</tr>
			</thead>
				<?php echo "<span style='color:red; font-weight:bold;'>".$pesan."</span>";
					
					$username = $_SESSION['ses_username'];
					
					$sql="SELECT umkmid, umkmkode, nama, namausaha, year(dateinsert) as 'tahun' FROM register ORDER BY dateinsert DESC";
					
					
					$res = mysqli_query($dbconn,$sql);
					$jml = @mysqli_num_rows($res);
					if ($jml==0)
					{
							echo "  <tr>";
							echo "		<td colspan=5 class='control' align='center'>No Data...</td>";					
							echo "  </tr>";
						//exit;
					}
					else
					{				
						while ($rows = mysqli_fetch_assoc($res)) 
						{
							echo "  <tr>";
							echo "	<td class='text-center'>$rows[umkmkode]</td>";
							echo "	<td class='text-left'>$rows[namausaha]</td>";
							echo "	<td class='text-left'>$rows[nama]</td>";
							echo "	<td class='text-left'>$rows[tahun]</td>";
							echo " 	<td class='text-center'><a class='btn btn-info btn-sm' href='umkmeditform.php?uid=$rows[umkmid]&cmd=info'><span class='glyphicon glyphicon-edit'></span> Info</a> <a class='btn btn-success btn-sm' href='umkmeditform.php?uid=$rows[umkmid]&cmd=edit'><span class='glyphicon glyphicon-edit'></span> Edit</a> <a href='umkmeditform.php?uid=$rows[umkmid]&cmd=del' class='btn btn-danger btn-sm'><span class='glyphicon glyphicon-remove'></span> Del</a></td>";
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