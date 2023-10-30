<?php
session_start();
require"../system/sistem.php";
dbConnect();
//Session Placing ak.1452019
	$time = $_SERVER['REQUEST_TIME'];
	if (isset($_SESSION['LAST_ACTIVITY']) &&  ($time - $_SESSION['LAST_ACTIVITY']) > $_SESSION['TIME_DURATION']) {
		session_unset();
		session_destroy();
		session_start();
		header( "Location:index.php?pesan=Session Timeout" );
	}
	else if (isset($_SESSION['ses_username'])) 
{
	if ($_SESSION['ses_hak']!='administrator')
	{
		header( "Location:index.php?pesan=Forbidden Access!" );
	}
	else
	{
		if(isset($_GET['eximid']) and ctype_digit((string)$_GET['eximid']))
		{
			if (isset($_GET['cmd']))
			{
				$cmd=$_GET['cmd'];
				if ($_GET['cmd']=='del')
				{
					$eximid=$_GET['eximid'];
					$perintah="DELETE FROM export WHERE exportid=$eximid";
					$hapus=mysqli_query($dbconn,$perintah);
					header( "Location:exportview.php?pesan=Delete Done!" );
				}
				elseif ($_GET['cmd']=='edit')
				{
					$eximid=$_GET['eximid'];
					$res = mysqli_query($dbconn,"SELECT * FROM export WHERE exportid=$eximid");
					$jml = @mysqli_num_rows($res);
					if ($jml==0)
					{
						header( "Location:exportview.php?pesan=Could not find!" );			
					}
					else
					{				
						while($rows = mysqli_fetch_assoc($res))
						{
							$fsubject=$rows['ExportName'];
							$fcontact=$rows['ExportContactPerson'];
							$faddress=$rows['ExportAddress'];
							$femail=$rows['ExportEmail'];
							$fphone=$rows['ExportPhone'];
							$fwebsite=$rows['ExportWebsite'];
							$fdesc=$rows['ExportProductDesc'];
							$fphoto=$rows['ExportProductPhoto1'];
							$fdate=$rows['DateInsert'];
							$fcat=$rows['categoryid'];
							$ftag=$rows['TagLine'];
						}
					}
					
					if(isset($_GET['pesan']))
					{
						$pesan=$_GET['pesan'];
					}
					else
					{
						$pesan="";
					}
				}
			}
			else
			{
				header( "Location:index.php?pesan=Forbidden Access!" );
			}
		}
		else
		{
			header( "Location:index.php?pesan=Forbidden Access!" );
		}
		
		
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
<div class="div-bg bg-primary">
			<h4 class="h4-bg text-center"><span class="h4-bg-white">FORM EXPORTERS</span></h4>
		</div>
		<hr>	
		<form name="myForm" method="post" action="exporteditcontrol.php" onsubmit="return validateForm()" enctype="multipart/form-data">
			<div class="col-md-12 col-md-offset-2 custyle">
				<input type="hidden" name="frm_nid" value="<?php echo $eximid; ?>">
				<input type="hidden" name="frm_last" value="<?php echo date("Y-m-d H:i:s"); ?>">
				<input type="hidden" name="frm_photo1" value="<?php echo $fphoto; ?>">
				<div class="form-group">
				<label class="col-md-12 control-label" style="color:red"><?php echo $pesan;?></label>
				<label class="col-md-12 control-label" for="name">Company Name</label>
					<div class="col-md-12">
						<input name="frm_subject" maxlength="300" required value="<?php echo $fsubject; ?>" type="text" placeholder="Type Company Name" class="form-control">
					</div>
				</div>
				<div class="form-group">
				<label class="col-md-12 control-label" for="name">Contact Person</label>
					<div class="col-md-12">
						<input name="frm_contact" required maxlength="300" value="<?php echo $fcontact; ?>" type="text" placeholder="Type Contact Person" class="form-control">
					</div>
				</div>
				
				
				<div class="form-group">
				<label class="col-md-12 control-label" for="name">Company Address</label>
					<div class="col-md-12">
						<input name="frm_address" maxlength="300" value="<?php echo $faddress; ?>" type="text" placeholder="Type Address" class="form-control">
					</div>
				</div>
				<div class="form-group">
				<label class="col-md-12 control-label" for="name">Email</label>
					<div class="col-md-12">
						<input name="frm_email" maxlength="300" value="<?php echo $femail; ?>" type="text" placeholder="Type Email" class="form-control">
					</div>
				</div>
				<div class="form-group">
				<label class="col-md-12 control-label" for="name">Phone</label>
					<div class="col-md-12">
						<input name="frm_phone" maxlength="100" value="<?php echo $fphone; ?>" type="text" placeholder="Type Phone" class="form-control">
					</div>
				</div>
				<div class="form-group">
				<label class="col-md-12 control-label" for="name">Website URL | Format (http://www.website.com)</label>
					<div class="col-md-12">
						<input name="frm_website" maxlength="100" value="<?php echo $fwebsite; ?>" type="url" placeholder="Type Website Url" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-12 control-label" for="name">Product Category</label>&nbsp;
					<div class="col-md-12">
					<select name="frm_category" id="frm_category" class="form-control">
								<?php
								$sqln="SELECT * FROM productcategory";
								$resn = mysqli_query($dbconn,$sqln);
								$jmln = @mysqli_num_rows($resn);
								if ($jmln==0)
								{
									echo "no data...";
								}
								else
								{				
									while ($rowsn = mysqli_fetch_assoc($resn)) 
									{
										if ($rowsn['categoryid']==$fcat)
										{
											echo "<option value='$rowsn[categoryid]' selected class='form-control'>$rowsn[category]</option>";
										}
										else
										{
											echo "<option value='$rowsn[categoryid]' class='form-control'>$rowsn[category]</option>";
										}	
										
									}
								}
								?>
							</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-12 control-label" for="content">Product Description</label>
					<div class="col-md-12">
						<textarea rows="4" name="frm_desc" cols="100"  placeholder="Type Product Description" class="form-control"><?php echo $fdesc; ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-12 control-label" for="content">Tag Line</label>
					<div class="col-md-12">
						<input name="frm_tag" maxlength="300" value="<?php echo $ftag; ?>" type="text" placeholder="Type Tag Line" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-12 control-label" for="content">Company Product</label>
					<div class="col-md-12">
						
						<label for="file">Filename:</label>
						<input type="file" style="display:block;" name="frm_fileToUpload" accept="application/pdf">
						<label for="file" style="display:block;color:red">Support File Type : .PDF</label>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-12 text-right">
						<button type="submit" class="btn btn-primary btn-lg">Submit</button>
					</div>
				</div>
			</div>
        </form>
</body>
</html>
<?php 
}
else
{
	header( "Location:index.php?pesan=Forbidden Access!" );
}
?>