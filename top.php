
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv='Content-Type' content='Type=text/html; charset=utf-8'/>
    <title>UMKM Website</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="css/agency.min.css" rel="stylesheet">
	<link href="css/custom.css" rel="stylesheet">
	<link href="css/addon.css" rel="stylesheet">
	<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	</head>
  <body id="page-top">
    <!-- Navigation -->
<nav class="navbar">
  <!-- <div class="container" >
	<div class="col-md-12 text-center bg-success" style="height:150px">
    	<p class="font-weight-bold" style="color:#ffffff; font-size:40pt; vertical-align:center;line-height:150px;">UMKM LABANASEM</p>
	</div>
  </div> -->
</nav>
<nav class="navbar navbar-expand-md">
  <div class="container">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <div class="botlogo text-right">
					<img src="img/logo bottom.png" alt="">
				</div>
      <ul class="navbar-nav mx-auto">
				<li class="nav-item">
				  <a class="nav-link mx-0" href="index.php">Beranda</a>
				</li>
				<li class="nav-item">
					<a class="nav-link mx-2" href="product.php">Produk</a>
				</li>
				<li class="nav-item">
					<a class="nav-link mx-2" href="news.php">Berita</a>
				</li>
				<li class="nav-item">
					<a class="nav-link mx-2" href="register.php">Registrasi UMKM</a>
				</li>
      </ul>
    </div>
  </div>
</nav>
<script>
const $dropdown = $(".dropdown");
const $dropdownToggle = $(".dropdown-toggle");
const $dropdownMenu = $(".dropdown-menu");
const showClass = "show";
 
$(window).on("load resize", function() {
  if (this.matchMedia("(min-width: 768px)").matches) {
    $dropdown.hover(
      function() {
        const $this = $(this);
        $this.addClass(showClass);
        $this.find($dropdownToggle).attr("aria-expanded", "true");
        $this.find($dropdownMenu).addClass(showClass);
      },
      function() {
        const $this = $(this);
        $this.removeClass(showClass);
        $this.find($dropdownToggle).attr("aria-expanded", "false");
        $this.find($dropdownMenu).removeClass(showClass);
      }
    );
  } else {
    $dropdown.off("mouseenter mouseleave");
  }
});
</script>
<hr>