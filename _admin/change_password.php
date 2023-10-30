<?php 
require"../system/sistem.php";
dbConnect();
session_start();	
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
	if ($_SESSION['ses_hak']!='administrator' && $_SESSION['ses_hak']!='leader')
	{
		header( "Location:index.php?pesan=Forbidden Access!" );
	}
	else
	{
		$ses_user=$_SESSION['ses_username'];
		$res = mysqli_query($dbconn,"SELECT * FROM member WHERE username='$ses_user'");
		$rows = mysqli_fetch_assoc($res);
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
	<link rel="stylesheet" href="css/formumkm.css">
    <script src="js/jquery-3.2.1.slim.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/docs.js"></script>
</head>

<body>
	<?php
		include "menu_samping.php";
	?>
	<section class="bg-light sec-pad">
		<div class="div-bg" style="background-color:#00AA5B">
			<h4 class="h4-bg text-center"><span class="h4-bg-white">UBAH PASSWORD</span></h4>
		</div>
		<hr>
	<div class="col-md-12 col-md-offset-2 custyle">
		  
				<form name="input" action="change_password2.php" method="post">
					<input type="hidden" name="kodehidden" value="<?php echo $rows['kodeuser']; ?>">
                     <div class="form-group">
					  <label class="col-md-12 control-label text-dark" for="name">Old Password</label>
					  <div class="col-md-12">
						<input id="oldpassword" name="oldpassword"  required type="password" minlength="8" placeholder="Type Old Password" class="form-control1">
					  </div>
					</div>
					<div class="form-group">
					  <label class="col-md-12 control-label text-dark" for="name">New Password</label>
					  <div class="col-md-12">
						<input id="newpassword" name="newpassword" required minlength="8" type="password" placeholder="Type New Password" class="form-control1">
					  </div>
					</div>
					<div class="form-group">
					  <label class="col-md-12 control-label text-dark" for="name">Re-Type New Password</label>
					  <div class="col-md-12">
						<input id="renewpassword" name="renewpassword"  required minlength="8" type="password" placeholder="Re-Type New Password" class="form-control1">
					  </div>
					</div>
					<div class="form-group">
					  <div class="col-md-12 text-right">
						<button type="submit" class="btn btn-succes btn-lg">Submit</button>
					  </div>
					</div>
                </form>
                    <?php
					if(empty($_GET["pesan"]))
						{
							$pesan="";
						}
						else
						{
						$pesan=$_GET['pesan'];
						}
					?>
				
	</div>
	  </div>
	</section>

</body>
</html>
<?php 
	}
}
else
{
	header( "Location:index.php?pesan=Forbidden Access!" );
}

?>