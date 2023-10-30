<?php
if(isset($_POST['upload'])){
				$filename = $_FILES["frm_fileToUpload"]["name"];
				$location="uploads/category/".$filename;
				$file_basename = substr($filename, 0, strripos($filename, '.')); // get file extention
				$file_extension = pathinfo("../".$location, PATHINFO_EXTENSION);
				$file_extension = strtolower($file_extension);
				$filesize = $_FILES["frm_fileToUpload"]["size"];
				$allowed_file_types = array('png','jpeg','jpg');
				
				if (!in_array($file_extension,$allowed_file_types) && !empty($file_basename))
				{	
					//******
					header("Location:categoryaddform.php?pesan=File not allowed");
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
												
						$query="INSERT INTO productcategory(category,preview,dateinsert) VALUES ('$ccat','$photo','$cdate')";
						$res1 = mysqli_query($dbconn,$query) or error( mysqli_error() );
						if(!$res1)
						{
							//******
							header("Location:categoryaddform.php?pesan=Cannot insert data!");
						}
						else
						{
							//******
							header("Location:categoryview.php?pesan=Data added successfully");
						}
				}	

}

// Compress image
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
<form method='post' enctype='multipart/form-data'>
  <input type='file' name='frm_fileToUpload' >
  <input type='submit' value='Upload' name='upload'> 
</form>