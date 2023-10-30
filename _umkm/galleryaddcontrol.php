<?php
	session_start();
	require"../system/sistem.php";
	dbConnect();
	//==================================
	$cid=$_POST['frm_umkmid'];
	$ctanggal=$_POST['frm_date'];
	$cnama =$_POST['frm_nama'];
	$csatuan=$_POST['frm_hargasatuan'];
	$cgrosir=$_POST['frm_hargagrosir'];
	$cdeskripsi=$_POST['frm_deskripsi'];
	$cvideo =$_POST['frm_video'];
	$ckategori =$_POST['frm_kategori'];
	//==================================
	
	if(ISSET($_POST['ckPO'])) 
	{
		$cpo='Yes';
	}
	else
	{
		$cpo='No';
	}	
	if(ISSET($_POST['ckSale'])) 
	{
		$csale='Yes';
	}
	else
	{
		$csale='No';
	}	
	
	if(!empty($_POST['frm_sale']))
	{
		$csaleamount=$_POST['frm_sale'];
	}
	else
	{
		$csaleamount=0;
	}
	
	//Session Placing ak.1452019
	$time = $_SERVER['REQUEST_TIME'];
	if (isset($_SESSION['LAST_ACTIVITY']) &&  ($time - $_SESSION['LAST_ACTIVITY']) > $_SESSION['TIME_DURATION']) 
	{
		session_unset();
		session_destroy();
		session_start();
		header( "Location:index.php?pesan=Session Expired!" );
	}
	else
	{
		if (trim($cnama)=='')
		{	
			header("Location:galleryaddform.php?pesan=Nama Tidak Boleh Kosong&aid=$cid");
		}
		elseif(empty($_FILES['frm_fileToUpload1']))
		{
			header("Location:galleryaddform.php?pesan=Foto tidak boleh kosong!");
			exit;
		}
		else 
		{
				$otokode = get_number($dbconn);
				$re_nama=periksa_input($cnama);
				$re_deskripsi=periksa_input($cdeskripsi);
				$re_video=periksa_input($cvideo);
				$re_kode='P'.$cid."-".$otokode;
				
				//image 1
				$filename1 = $_FILES["frm_fileToUpload1"]["name"];
				
				$temp1 = explode(".", $_FILES["frm_fileToUpload1"]["name"]);
				$newfilename1 = "PROD-".$otokode."-1.".end($temp1);
				$location1 = "uploads/umkm/produk/" . $newfilename1;
				
				//$location1 ="uploads/umkm/produk/".$filename1;
				$file_basename1 = substr($filename1, 0, strripos($filename1, '.')); // get file extention
				//----------------------------------------------------------------
				$file_extension1 = pathinfo("../".$location1, PATHINFO_EXTENSION);
				$file_extension1 = strtolower($file_extension1);
				$filesize1 = $_FILES["frm_fileToUpload1"]["size"];
				
				//image 2
				$filename2 = $_FILES["frm_fileToUpload2"]["name"];
				
				$temp2 = explode(".", $_FILES["frm_fileToUpload2"]["name"]);
				$newfilename2 = "PROD-".$otokode."-2.".end($temp2);
				$location2 = "uploads/umkm/produk/" . $newfilename2;
				
				//$location2 ="uploads/umkm/produk/".$filename2;
				$file_basename2 = substr($filename2, 0, strripos($filename2, '.')); // get file extention
				//----------------------------------------------------------------
				$file_extension2 = pathinfo("../".$location2, PATHINFO_EXTENSION);
				$file_extension2 = strtolower($file_extension2);
				$filesize = $_FILES["frm_fileToUpload2"]["size"];
				
				//image 3
				$filename3 = $_FILES["frm_fileToUpload3"]["name"];
				
				$temp3 = explode(".", $_FILES["frm_fileToUpload3"]["name"]);	
				$newfilename3 = "PROD-".$otokode."-3.".end($temp3);
				$location3 = "uploads/umkm/produk/" . $newfilename3;
				
				//$location2 ="uploads/umkm/produk/".$filename2;
				$file_basename3 = substr($filename3, 0, strripos($filename3, '.')); // get file extention
				//----------------------------------------------------------------
				$file_extension3 = pathinfo("../".$location3, PATHINFO_EXTENSION);
				$file_extension3 = strtolower($file_extension3);
				$filesize3 = $_FILES["frm_fileToUpload3"]["size"];
				
				//image 4
				$filename4 = $_FILES["frm_fileToUpload4"]["name"];
				
				
				$temp4 = explode(".", $_FILES["frm_fileToUpload4"]["name"]);	
				$newfilename4 = "PROD-".$otokode."-4.".end($temp4);
				$location4 = "uploads/umkm/produk/" . $newfilename4;
				
				$file_basename4 = substr($filename4, 0, strripos($filename4, '.')); // get file extention
				//----------------------------------------------------------------
				$file_extension4 = pathinfo("../".$location4, PATHINFO_EXTENSION);
				$file_extension4 = strtolower($file_extension4);
				$filesize4 = $_FILES["frm_fileToUpload4"]["size"];
				
				$allowed_file_types = array('png','jpeg','jpg');
				
				//image 1
				//$temp = explode(".", $_FILES["frm_fileToUpload"]["name"]);
				//$newfilename = $re_kode.".".end($temp);
				
				if (!in_array($file_extension1,$allowed_file_types) && !empty($file_basename1))
				{	
					//******
					header("Location:galleryaddform.php?pesan=File not allowed&aid=$cid");
					unlink($_FILES["frm_fileToUpload1"]["tmp_name"]);
				}						
				else
				{
						if (empty($file_basename1))
						{	
							$photo1 ="";
						} 
						else
						{
							if(file_exists("../".$location1)) unlink("../".$location1);
							compressImage($_FILES['frm_fileToUpload1']['tmp_name'],"../".$location1,60);
							$photo1 =$location1;
						}
						$photo1=periksa_input($photo1);
				}	
				
				//image 2
				if (!in_array($file_extension2,$allowed_file_types) && !empty($file_basename2))
				{	
					//******
					header("Location:galleryaddform.php?pesan=File not allowed&aid=$cid");
					unlink($_FILES["frm_fileToUpload2"]["tmp_name"]);
				}						
				else
				{
						if (empty($file_basename2))
						{	
							$photo2 ="";
						} 
						else
						{
							if(file_exists("../".$location2)) unlink("../".$location2);
							compressImage($_FILES['frm_fileToUpload2']['tmp_name'],"../".$location2,60);
							$photo2 =$location2;
						}
						$photo2=periksa_input($photo2);
				}	
				
				//image 3
				if (!in_array($file_extension3,$allowed_file_types) && !empty($file_basename3))
				{	
					//******
					header("Location:galleryaddform.php?pesan=File not allowed&aid=$cid");
					unlink($_FILES["frm_fileToUpload3"]["tmp_name"]);
				}						
				else
				{
						if (empty($file_basename3))
						{	
							$photo3 ="";
						} 
						else
						{
							if(file_exists("../".$location3)) unlink("../".$location3);
							compressImage($_FILES['frm_fileToUpload3']['tmp_name'],"../".$location3,60);
							$photo3 =$location3;
						}
						$photo3=periksa_input($photo3);
				}	
				
				//image 4
				if (!in_array($file_extension4,$allowed_file_types) && !empty($file_basename4))
				{	
					//******
					header("Location:galleryaddform.php?pesan=File not allowed&aid=$cid");
					unlink($_FILES["frm_fileToUpload4"]["tmp_name"]);
				}						
				else
				{
						if (empty($file_basename4))
						{	
							$photo4 ="";
						} 
						else
						{
							if(file_exists("../".$location4)) unlink("../".$location4);
							compressImage($_FILES['frm_fileToUpload4']['tmp_name'],"../".$location4,60);
							$photo4 =$location4;
						}
						$photo4=periksa_input($photo4);
				}	
			
				
				
				mysqli_query($dbconn,"INSERT INTO produkfoto(produkkode,fotofile,tanggalinput) 
				VALUES('$re_kode','$location1','$ctanggal')");	
				
				$query="INSERT INTO produk(produkkode,produknama,harga,
											grosir,produkdeskripsi,tanggalupload,
											preorder,sale,saleamount, photo1,photo2,photo3,photo4,umkmid,video,kategori,status) 
											VALUES('$re_kode','$re_nama',$csatuan,
											$cgrosir,'$re_deskripsi','$ctanggal',
											'$cpo','$csale',$csaleamount,'$photo1','$photo2','$photo3','$photo4',$cid,'$re_video','$ckategori','enable')";
					
				//echo $query;
				$res1 = mysqli_query($dbconn,$query) or die(mysqli_error());
				if(!$res1)
				{
					header("Location:galleryaddform.php?pesan=Gagal Input");
				}
				else
				{
					//mysqli_query($dbconn,"UPDATE series SET urut=urut+1 WHERE kategori='$ckategori'") ;
					header("Location:produk.php");
				}
		}			
}
function get_number($numConn)
{
		$sqlnum="SELECT max(produkid) + 1 as 'autonom' FROM produk";
		$resnum= mysqli_query($numConn,$sqlnum);
		$jmlnum = @mysqli_num_rows($resnum);
		
		if ($jmlnum!=0)
		{
			$rowsnum = mysqli_fetch_assoc($resnum);
			$autonumeric = sprintf('%03s', $rowsnum['autonom']);
			//$autonumeric = $rowsnum['autonom'];
			return $autonumeric;
		}
}
function compressImage($source, $destination, $quality) {

  $info = getimagesize($source);

  if ($info['mime'] == 'image/jpeg') 
    $image = imagecreatefromjpeg($source);

  elseif ($info['mime'] == 'image/gif') 
    $image = imagecreatefromgif($source);

  elseif ($info['mime'] == 'image/png') 
    $image = imagecreatefrompng($source);

  imagejpeg($image, $destination, $quality);

}
?>