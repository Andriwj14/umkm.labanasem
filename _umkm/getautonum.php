<?php
	require_once ("../system/sistem.php");
	if(isset($_POST['tipe']))
	{
		$tipe = $_POST['tipe'];
		
		if($tipe == '')
		{
			 exit;
		}
		else
		{
			$cktipe = periksa_input($tipe);
			dbConnect();
			$sqlnum="SELECT urut + 1 as 'autonom' FROM series WHERE kategori='$cktipe'";
			$resnum= mysqli_query($dbconn,$sqlnum);
			$jmlnum = @mysqli_num_rows($resnum);
			//echo $sqlnum;
			if ($jmlnum!=0)
			{
				$rowsnum = mysqli_fetch_assoc($resnum);
				$autonumeric = sprintf('%03s', $rowsnum['autonom']);
				if ($tipe=='Jaket')
				{
					echo "JK".$autonumeric;
				}
				elseif ($tipe=='Sweater')
				{
					echo "SW".$autonumeric;
				}
				
				elseif ($tipe='Hoodie')
				{
					echo "HD".$autonumeric;
				}
				
			}
			 
		}
	}
	else
	{
		exit;
	}
?>