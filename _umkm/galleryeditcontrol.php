<?php
	session_start();
	require"../system/sistem.php";
	
	//==================================
	//Session Placing ak.1452019
	$time = $_SERVER['REQUEST_TIME'];
	if (isset($_SESSION['LAST_ACTIVITY']) &&  ($time - $_SESSION['LAST_ACTIVITY']) > $_SESSION['TIME_DURATION']) 
	{
		session_unset();
		session_destroy();
		session_start();
		header( "Location:index.php?pesan=Session Habis!" );
	}
	else
	{
			$cid=$_POST['frm_lblhiddenid'];
			$ctanggal=$_POST['frm_date'];
			$ckode=$_POST['frm_lblhiddenkode'];
			$cnama =$_POST['frm_nama'];
			$chargasatuan=$_POST['frm_hargasatuan'];
			$chargagrosir=$_POST['frm_hargagrosir'];
			$cdeskripsi=$_POST['frm_deskripsi'];
			$ckategori=$_POST['frm_kategori'];
			$cvideo=$_POST['frm_video'];
			$cfoto1 = $_POST['hiddenFoto1'];
			$cfoto2 = $_POST['hiddenFoto2'];
			$cfoto3 = $_POST['hiddenFoto3'];
			$cfoto4 = $_POST['hiddenFoto4'];
			//==================================
		
			if(ISSET($_POST['frm_ckpo'])) 
			{
				$cpo='Yes';
			}
			else
			{
				$cpo='No';
			}
			if(ISSET($_POST['frm_cksale'])) 
			{
				$csale='Yes';
			}
			else
			{
				$csale='No';
			}	
			
			if(ISSET($_POST['frm_saleamount'])) 
			{
				$csaleamount=str_replace(',','',$_POST['frm_saleamount']);
			}
			else
			{
				$csaleamount=0;
			}
	
		
			if (trim($cnama)=='')
			{	
				header("Location:galleryeditform.php?cmd=edit&pesan=Nama Tidak Boleh Kosong&aid=$cid");
			}
			elseif (trim($ckode)=='')
			{	
				header("Location:galleryeditform.php?cmd=edit&pesan=Kode Produk Tidak Boleh Kosong&aid=$cid");
			}
			else 
			{
				dbConnect();
				$re_nama=periksa_input($cnama);
				$re_kode=periksa_input($ckode);
				$re_deskripsi=periksa_input($cdeskripsi);
				$re_video=periksa_input($cvideo);
				
				//PHOTO1
				$file_name1 = $_FILES['frm_fileToUpload1']['name'];
				$temp1 = explode(".", $_FILES["frm_fileToUpload1"]["name"]);
				$file_ext1 = substr($file_name1, strripos($file_name1, '.'));	
				$newfilename1 = $ckode."-1.".end($temp1);
				$location1 = "uploads/umkm/produk/" . $newfilename1;
				
				if($_FILES['frm_fileToUpload1']['error'] > 0)
				{	
					$cphoto1 =$cfoto1;
				} 
				else
				{
					if(file_exists("../".$location1)) unlink("../".$location1);
					move_uploaded_file($_FILES["frm_fileToUpload"]["tmp_name"], "../".$location1);
					$cphoto1 =$location1;
				}	
				
				//PHOTO2
				$file_name2 = $_FILES['frm_fileToUpload2']['name'];
				$temp2 = explode(".", $_FILES["frm_fileToUpload2"]["name"]);
				$file_ext2 = substr($file_name2, strripos($file_name2, '.'));	
				$newfilename2 = $ckode."-2.".end($temp2);
				$location2 = "uploads/umkm/produk/" . $newfilename2;
				
				if($_FILES['frm_fileToUpload2']['error'] > 0)
				{	
					$cphoto2 =$cfoto2;
				} 
				else
				{
					if(file_exists("../".$location2)) unlink("../".$location2);
					move_uploaded_file($_FILES["frm_fileToUpload2"]["tmp_name"], "../".$location2);
					$cphoto2 =$location2;
				}	
				
				//PHOTO3
				$file_name3 = $_FILES['frm_fileToUpload3']['name'];
				$temp3 = explode(".", $_FILES["frm_fileToUpload3"]["name"]);
				$file_ext3 = substr($file_name3, strripos($file_name3, '.'));	
				$newfilename3 = $ckode."-3.".end($temp3);
				$location3 = "uploads/umkm/produk/" . $newfilename3;
				
				if($_FILES['frm_fileToUpload3']['error'] > 0)
				{	
					$cphoto3 =$cfoto3;
				} 
				else
				{
					if(file_exists("../".$location3)) unlink("../".$location3);
					move_uploaded_file($_FILES["frm_fileToUpload3"]["tmp_name"], "../".$location3);
					$cphoto3 =$location3;
				}	
				
				//PHOTO3
				$file_name4 = $_FILES['frm_fileToUpload4']['name'];
				$temp4 = explode(".", $_FILES["frm_fileToUpload4"]["name"]);
				$file_ext4 = substr($file_name4, strripos($file_name4, '.'));	
				$newfilename4 = $ckode."-4.".end($temp4);
				$location4 = "uploads/umkm/produk/" . $newfilename4;
				
				if($_FILES['frm_fileToUpload4']['error'] > 0)
				{	
					$cphoto4 =$cfoto4;
				} 
				else
				{
					if(file_exists("../".$location4)) unlink("../".$location4);
					move_uploaded_file($_FILES["frm_fileToUpload4"]["tmp_name"], "../".$location4);
					$cphoto4 =$location4;
				}	
				
				
				$sqlupdate="UPDATE produk SET produknama='$re_nama',harga=".str_replace(',','',$chargasatuan).",grosir=".str_replace(',','',$chargagrosir).",produkdeskripsi='$re_deskripsi',preorder='$cpo',sale='$csale',saleamount=$csaleamount,video='$re_video',kategori='$ckategori',photo1='$cphoto1',photo2='$cphoto2',photo3='$cphoto3',photo4='$cphoto4' WHERE produkid=$cid";
				echo $sqlupdate;
				$res1 = mysqli_query($dbconn,$sqlupdate) or die(mysqli_error($dbconn));
				if(!$res1)
				{
					header("Location:galleryeditform.php?cmd=edit&pesan=Gagal Update");
				}
				else
				{
					header("Location:produk.php?pesan=Update Berhasil");
				}		
			}
		
	}
?>