<?php
	session_start();
	require"../system/sistem.php";
	dbConnect();
	
	$cdate=$_POST['frm_last'];
	$csubject =$_POST['frm_subject'];
	$cdesc =$_POST['frm_desc'];
	$csdesc =$_POST['frm_short'];
	$ctype =$_POST['frm_type'];
	$cid=$_POST['frm_nid'];
	$cphoto=$_POST['frm_photo'];
	
	/* Setting Folder */
	//Session Placing ak.1452019
	$time = $_SERVER['REQUEST_TIME'];
	if (isset($_SESSION['LAST_ACTIVITY']) &&  ($time - $_SESSION['LAST_ACTIVITY']) > $_SESSION['TIME_DURATION']) {
		session_unset();
		session_destroy();
		session_start();
		header( "Location:index.php?pesan=Session Expired!" );
	}
	else if ($_SESSION['ses_hak']!='administrator')
	{
		header( "Location:index.php?pesan=Forbidden Access!" );
	}
	else
	{
		if (trim($csubject)=='')
		{	
			header("Location:newseditform.php?pesan=Judul harus diisi!&nid=$cid&cmd=edit");
		}
		elseif (trim($csdesc)=='')
		{	
			header("Location:newseditform.php?pesan=Isi pendek harus diisi!&nid=$cid&cmd=edit");
		}
		elseif (trim($cdesc)=='')
		{	
			header("Location:newseditform.php?pesan=Isi panjang harus diisi!&nid=$cid&cmd=edit");
		}
		else 
		{
				$filename = $_FILES["frm_fileToUpload"]["name"];
				$location="uploads/news/".$filename;
				$file_basename = substr($filename, 0, strripos($filename, '.')); // get file extention
				$file_extension = pathinfo("../".$location, PATHINFO_EXTENSION);
				$file_extension = strtolower($file_extension);
				$filesize = $_FILES["frm_fileToUpload"]["size"];
				$allowed_file_types = array('png','jpeg','jpg');
				$photo ="";
				
				if (!in_array($file_extension,$allowed_file_types) && !empty($file_basename))
				{	
					//******
					header("Location:newseditform.php?pesan=File tidak disupport!&nid=$cid&cmd=edit");
					unlink($_FILES["frm_fileToUpload"]["tmp_name"]);
				}						
				else
				{
						if (empty($file_basename))
						{	
							$photo =$cphoto;
						} 
						else
						{
							if(file_exists("../".$location)) unlink("../".$location);
							compressImage($_FILES['frm_fileToUpload']['tmp_name'],"../".$location,60);
							$photo =$location;
						}		
						
						$csubject=periksa_input($csubject);
						$cdesc=periksa_input($cdesc);
						$csdesc=periksa_input($csdesc);
						$photo=periksa_input($photo);
						//******
						
						$query="UPDATE news SET newssubject='$csubject',newsdesc='$cdesc',newspicture='$photo',lastupdate='$cdate',newsshortdesc='$csdesc' WHERE newsid=$cid";
						$res1 = mysqli_query($dbconn,$query) or error( mysqli_error($dbconn) );
						if(!$res1)
						{
							//******
							header("Location:newseditform.php?pesan=Gagal diubah!&nid=$cid&cmd=edit");
						}
						else
						{
							//******
							header("Location:newsview.php?pesan=Berhasil diubah!");
						}
				}	
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