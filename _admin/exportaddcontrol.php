<?php
	session_start();
	require"../system/sistem.php";
	dbConnect();
	
	
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
		$cdate=$_POST['frm_date'];
		$csubject =$_POST['frm_subject'];
		$ccontact =$_POST['frm_contact'];
		$caddress =$_POST['frm_address'];
		$cemail =$_POST['frm_email'];
		$cphone =$_POST['frm_phone'];
		$cwebsite =$_POST['frm_website'];
		$ccat =$_POST['frm_category'];
		$cdesc =$_POST['frm_desc'];
		$ctag =$_POST['frm_tag'];
		
		if (empty($csubject))
		{	
			header("Location:exportaddform.php?pesan=Company name required");
		}
		else if (empty($ccontact))
		{	
			header("Location:exportaddform.php?pesan=Contact required");
		}
		elseif (!empty($cwebsite) && !preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$cwebsite)) 
		{
			  header("Location:exportaddform.php?pesan=Wrong url format");
		}    
		else 
		{
				$filename = $_FILES["frm_fileToUpload"]["name"];
				$file_basename = substr($filename, 0, strripos($filename, '.')); // get file extention
				$file_ext = substr($filename, strripos($filename, '.')); // get file name
				$filesize = $_FILES["frm_fileToUpload"]["size"];
				
				if ((!$file_ext==".pdf") && !empty($file_basename))
				{	
					//******
					unlink($_FILES["frm_fileToUpload"]["tmp_name"]);
					header("Location:exportaddform.php?pesan=File Not Allow !");
				}			
				elseif ($filesize>1000000)
				{
					unlink($_FILES["frm_fileToUpload"]["tmp_name"]);
					header("Location:exportaddform.php?pesan=File Too Large!");
				}
				else
				{		
						if (empty($file_basename))
						{	
							$photo1 ="";
						} 
						else
						{
							//******
							$newfilename = $file_basename. $file_ext;
							if(file_exists( "../uploads/product/". $newfilename)) unlink("../uploads/product/" . $newfilename);
							move_uploaded_file($_FILES["frm_fileToUpload"]["tmp_name"], "../uploads/product/" . $newfilename);
							$photo1 ="uploads/product/".$newfilename;
						}	
					
						$csubject=periksa_input($csubject);
						$cdesc=periksa_input($cdesc);
						$photo1=periksa_input($photo1);
						$ccontact=periksa_input($ccontact);
						$caddress=periksa_input($caddress);
						$cemail=periksa_input($cemail);
						$cphone=periksa_input($cphone);
						$cwebsite=periksa_input($cwebsite);
						$ctag=periksa_input($ctag);
						
						$query="INSERT INTO export(ExportName,ExportContactPerson,ExportAddress,ExportEmail,ExportPhone,ExportProductDesc,ExportProductPhoto1,categoryid,DateInsert,ExportWebsite,TagLine) VALUES".
								  "('$csubject','$ccontact','$caddress','$cemail','$cphone','$cdesc','$photo1',$ccat,'$cdate','$cwebsite','$ctag')";
						$res1 = mysqli_query($dbconn,$query) or error( mysqli_error($dbconn) );
						if(!$res1)
						{
							header("Location:exportaddform.php?pesan=Cannot insert data!");
						}
						else
						{
							header("Location:exportview.php?pesan=Insert data success!");
						}		
					
				}
		}
	}
?>