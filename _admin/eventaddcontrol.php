<?php
	session_start();
	require"../system/sistem.php";
	dbConnect();
	
	$cdate=$_POST['frm_date'];
	$sdate=$_POST['frm_sdate'];
	$edate=$_POST['frm_edate'];
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
			header("Location:eventaddform.php?pesan=Judul harus diisi!");
		}
		elseif (trim($cdesc)=='')
		{	
			header("Location:eventaddform.php?pesan=Isi panjang harus diisi!");
		}
		elseif (trim($csdesc)=='')
		{	
			header("Location:eventaddform.php?pesan=Isi singkat harus diisi!");
		}
		elseif (empty($sdate))
		{	
			header("Location:eventaddform.php?pesan=Pilih tanggal mulai!");
		}
		elseif (empty($edate))
		{	
			header("Location:eventaddform.php?pesan=Pilih tanggal selesai!");
		}
		else 
		{
				$filename = $_FILES["frm_fileToUpload"]["name"];
				$location="uploads/event/".$filename;
				$file_basename = substr($filename, 0, strripos($filename, '.')); // get file extention
				$file_extension = pathinfo("../".$location, PATHINFO_EXTENSION);
				$file_extension = strtolower($file_extension);
				$filesize = $_FILES["frm_fileToUpload"]["size"];
				$allowed_file_types = array('png','jpeg','jpg');
				
				if (!in_array($file_extension,$allowed_file_types) && !empty($file_basename))
				{	
					//******
					header("Location:eventaddform.php?pesan=File tidak support!");
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
						$csubject=periksa_input($csubject);
						$cdesc=periksa_input($cdesc);
						$csdesc=periksa_input($csdesc);
						$photo=periksa_input($photo);
						//******
						//******
						$query="INSERT INTO event(eventsubject,eventdesc,eventpicture,startdate,enddate,dateinsert,eventshortdesc) VALUES".
								  "('$csubject','$cdesc','$photo','$sdate','$edate','$cdate','$csdesc')";
						$res1 = mysqli_query($dbconn,$query) or error(mysqli_error($dbconn));
						if(!$res1)
						{
							header("Location:eventaddform.php?pesan=Gagal simpan!");
						}
						else
						{
							header("Location:eventview.php?pesan=Berhasil simpan!");
						}
				}
		}
	}
function compressImage($source, $destination, $quality) 
{

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