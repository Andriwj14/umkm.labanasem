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
			<h4 class="h4-bg text-center"><span class="h4-bg-white">NEWS DATA</span></h4>
		</div>
		<hr>
	<div class="col-md-12 col-md-offset-2 custyle">
	<?php echo "<span style='color:green; font-weight:bold;'>".$pesan."</span>"; ?>
	<table id="paging" class="table table-bordered">
    <thead >
		<a href="newsaddform.php" class="btn btn-light btn-sm pull-right my-2 py-2" style="background-color:#00AA5B"><b>+</b> Tambah Berita</a>
        <tr class="text-white" >
			<th class='text-center bg' style="background-color:#00AA5B" style="width:10%;">Gambar</th>
            <th class='text-center bg' style="background-color:#00AA5B" style="width:55%;">Judul Berita</th>
            <th class='text-center bg' style="background-color:#00AA5B" style="width:15%;">Tanggal</th>
            <th class="text-center bg" style="background-color:#00AA5B" style="width:20%;">Action</th>
        </tr>
    </thead>
			<?php 
			
			$username = $_SESSION['ses_username'];
			
			$sql="SELECT * FROM news ORDER BY newsdate";
			$res = mysqli_query($dbconn,$sql);
			$jml = @mysqli_num_rows($res);
			if ($jml==0)
			{
					echo "  <tr>";
					echo "		<td colspan=4 class='text-center' align='center'>Belum ada berita...</td>";					
					echo "  </tr>";
				//exit;
			}
			else
			{				
				while ($rows = mysqli_fetch_assoc($res)) 
				{
					echo "  <tr>";
					echo "  <td class='text-center'><img src='../$rows[newspicture]' width='150' alt=$rows[newssubject]></td>";
					echo "	<td class='text-justify'>$rows[newssubject]</td>";
					echo "	<td class='text-center'>$rows[newsdate]</td>";
					//$_SESSION['ParamBerita'] = $rows[KodeBerita];
					echo "<td class='text-center'><a class='btn btn-success btn-sm' href='newseditform.php?nid=$rows[newsid]&cmd=edit'><span class='glyphicon glyphicon-edit'></span> Edit</a> <a class='btn btn-primary btn-sm' href='eventeditform.php?nid=$rows[newsid]&cmd=edit'><span class='glyphicon glyphicon-edit'></span> Jadwalkan</a></td>";
					echo "</tr>";
				}
			}
				echo "</table>" ;   
			?><a href="newsaddform.php" class="btn btn-light btn-sm pull-right my-2 py-2" style="background-color:#00AA5B"><b>+</b> Tambah Berita</a>
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