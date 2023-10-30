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
	
		$ses_user=$_SESSION['ses_username'];
		$res = mysqli_query($dbconn,"SELECT * FROM register WHERE email='$ses_user'");
		$rows = mysqli_fetch_assoc($res);
		
		if (isset($_GET['pesan']))
		{
			$pesan="<div class='form-group'><div class='col-md-12 alert alert-dark'>".periksa_input($_GET['pesan'])."</div></div>";
		}
		else
		{
			$pesan="";
		}
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>DASHBOARD UMKM</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="navbar-fixed-left.min.css">
	<link rel="stylesheet" href="css/formumkm.css">
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
	<section class="sec-pad">
		<div class="div-bg bg-success">
			<h4 class="h4-bg text-center"><span class="h4-bg-white">Ubah Password</span></h4>
		</div>
		<hr>
		<div class="col-md-12 col-md-offset-2 custyle">
		  
				<form name="input" action="change_password2.php" method="post">
					<input type="hidden" name="kodehidden" value="<?php echo $rows['umkmid']; ?>">
                    
					<?php 
					echo $pesan; 
					if (!ISSET($_SESSION['ses_password']))
					{
						$_SESSION['ses_password']=$rows['password'];
					}
					
					?>
					  

					  

					<div class="form-group">
					  <label class="col-md-12 control-label text-success" for="name">Password Lama</label>
					  <div class="col-md-12">
						<input id="oldpassword" name="oldpassword"  required type="password" minlength="8" placeholder="Masukkan Password Lama" class="form-control1">
					  </div>
					</div>
					<br><br>
					<div class="form-group">
					  <label class="col-md-12 control-label text-success" for="name">Password Baru</label>
					  <div class="col-md-12">
						<input id="newpassword" name="newpassword" required minlength="8" type="password" placeholder="Masukkan Password Baru" class="form-control1">
					  </div>
					</div>
					<br><br>
					<div class="form-group"> 
					  <label class="col-md-12 control-label text-success" for="name">Password Baru Lagi</label>
					  <div class="col-md-12">
						<input id="renewpassword" name="renewpassword"  required minlength="8" type="password" placeholder="Masukkan Password Baru Lagi" class="form-control1">
					  </div>
					</div>
					<br><br><br>
					<div class="form-group">
					  <div class="col-md-12 text-left">
						<button type="submit" class="btn btn-success btn-lg">SIMPAN</button>
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
else
{
	header( "Location:index.php?pesan=Forbidden Access!" );
}

?>