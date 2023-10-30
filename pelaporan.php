<?php
include"top.php";
session_start();
require"system/sistem.php";

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
?>
<div class="container">
        <div class="row">
			<!-- Isi -->
          <div class="col-md-12 col-md-offset-2 custyle">
			<?php
				if (isset($_GET['pesan'])) 
				{
					$pesan=periksa_input($_GET['pesan']);
					echo "<span style='color:green; font-weight:bold;'>".$pesan."</span>"; 
				}
			?>
			<span style="display:block">History Pelaporan/Pengajuan</span>
			<table id="paging" class="table table-bordered table-sm">
			<thead class="bg-primary text-uppercase">
				<tr>
					<th class="text-center" width="20%">Nama</th>
					<th class="text-center" width="30%">Judul</th>
					<th class="text-center" width="20%">Email</th>
					<th class="text-center" width="10%">Tanggal</th>
					<th class="text-center" width="10%">IP Address</th>
					<th class="text-center" width="10%">Action</th>
				</tr>
			</thead>
			<?php 
							
				$res = mysqli_query($dbconn,"SELECT * FROM contact ORDER BY senddate DESC");
				$jml = @mysqli_num_rows($res);
				if ($jml==0)
				{
						echo "<tr>";
						echo "	<td class='control' colspan=6 align='center'>No Data...</td>";				
						echo "</tr>";
				}
				else
				{			
					while ($rows = mysqli_fetch_assoc($res)) 
					{			
						echo "<tr>";	  
						echo "<td>$rows[name]</td>";	
						echo "<td class='text-justify'>$rows[subject]</td>";	
						echo "<td class='text-left'>$rows[email]</td>";
						echo "<td align='center'>$rows[senddate]</td>";
						echo "<td align='center'>$rows[ipaddress]</td>";
						echo "<td align='center'><a class='btn btn-info btn-sm' href='contactform.php?cid=$rows[contactid]&cmd=view'><span class='glyphicon glyphicon-edit'></span>View</a> <a href='contactform.php?cid=$rows[contactid]&cmd=del' class='btn btn-danger btn-sm'><span class='glyphicon glyphicon-remove'></span> Del</a></td>";
					}
				}  
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
      </div>
                  
<?php 
include"bottom.php";
	
}
else
{
	header( "Location:index.php?pesan=Forbidden Access!" );
}
?>