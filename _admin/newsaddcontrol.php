<?php
	session_start();
	require"../system/sistem.php";
	dbConnect();
	$cdate=$_POST['frm_date'];
	$csubject =$_POST['frm_subject'];
	$cdesc =$_POST['frm_desc'];
	$csdesc =$_POST['frm_short'];
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
			header("Location:newsaddform.php?pesan=Judul harus diisi!");
		}
		elseif (trim($csdesc)=='')
		{	
			header("Location:newsaddform.php?pesan=Isi pendek harus diisi!");
		}
		elseif (trim($cdesc)=='')
		{	
			header("Location:newsaddform.php?pesan=Isi panjang harus diisi!");
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
					header("Location:newsaddform.php?pesan=File tidak disupport!");
					unlink($_FILES["frm_fileToUpload"]["tmp_name"]);
				}						
				else
				{
						if (empty($file_basename))
						{	
							$photo ="";
						} 
						else
						{
							if(file_exists("../".$location)) unlink("../".$location);
							compressImage($_FILES['frm_fileToUpload']['tmp_name'],"../".$location,60);
							$photo =$location;
						}	
						
						//Check Input
						$csubject=periksa_input($csubject);
						$cdesc=periksa_input($cdesc);
						$csdesc=periksa_input($csdesc);
						$photo=periksa_input($photo);
						
						//******
						$query="INSERT INTO news(newssubject,newsdesc,newspicture,newsdate,newsshortdesc) VALUES".
								  "('$csubject','$cdesc','$photo','$cdate','$csdesc')";
						$res1 = mysqli_query($dbconn,$query) or error( mysqli_error($dbconn) );
						if(!$res1)
						{
							//******
							header("Location:newsaddform.php?pesan=Gagal Simpan!");
						}
						else
						{
							//******
							header("Location:newsview.php?pesan=Berhasil Simpan!");
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