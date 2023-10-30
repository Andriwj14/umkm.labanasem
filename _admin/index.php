<?php
session_start();
session_unset();
session_destroy();

$ip=$_SERVER['REMOTE_ADDR'];
$device=$_SERVER['HTTP_USER_AGENT'];
if(empty($_GET["pesan"]))
	{
		$pesan="";
	}
	else
	{
	$pesan=$_GET['pesan'];
	}
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<!-- <link href="css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->
<!-- <link href="css/login.css" rel="stylesheet" id="bootstrap-css"> -->
<!-- <script src="js/bootstrap.min.js"></script>
<script src="js/jquery.min.js"></script> -->
<!------ Include the above in your HEAD tag ---------->

<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Icon -->
    <div class="fadeIn first">
		<br>
    </div>
	
    <!-- Login Form -->
    <!-- <form action="_login.php" method="post">
	  <input type="hidden" name="frm_ip" value="<?php echo $ip; ?>">
	  <input type="hidden" name="frm_device" value="<?php echo $device; ?>">
	  <input type="text" id="useradmin" class="fadeIn second" name="useradmin" placeholder="Input Username">
      <input type="password" id="passwordadmin" class="fadeIn third" name="passwordadmin" placeholder="Input Password">
      <input type="submit" class="fadeIn fourth" value="Log In">
    </form> -->

	
  </div>
</div>

<section class="vh-100 gradient-custom">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card text-white" style="border-radius: 1rem;background-color:#00AA5B;">
          <div class="card-body p-5 text-center">

		  <form action="_login.php" method="post">
            <div class="mb-md-5 mt-md-4 pb-5">
			<input type="hidden" name="frm_ip" value="<?php echo $ip; ?>">
	  		<input type="hidden" name="frm_device" value="<?php echo $device; ?>">
			<div class="text" >
				<span style="color:white;"><?php echo $pesan; ?></span>
			</div>

              <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
              <p class="text-white-50 mb-5">Please enter your username and password!</p>

              <div class="form-outline form-white mb-4">
                <input type="text" id="useradmin" name="useradmin" class="form-control text-center form-control-lg" />
                <label class="form-label" for="useradmin">Username</label>
				
              </div>

              <div class="form-outline form-white mb-4">
                <input type="password" id="passwordadmin" name="passwordadmin" class="form-control text-center form-control-lg" />
                <label class="form-label" for="passwordadmin">Password</label>
              </div>

              <button class="btn btn-outline-light btn-lg px-5" type="submit">Login</button>

            </div>
		  </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>