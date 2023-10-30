<link href="../vendor/boostrap/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="../vendor/boostrap/js/bootstrap.min.js"></script>
<script src="../vendor/jquery/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<script src="slick.js"></script>
<style>
.slick-slide {
    margin: 0px 50px;
}
    
.slick-slide img {
    max-width: 100%;
}

.slick-slider
{
    position: relative;
	display: block;
    box-sizing: border-box;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
            user-select: none;
    -webkit-touch-callout: none;
    -khtml-user-select: none;
    -ms-touch-action: pan-y;
        touch-action: pan-y;
    -webkit-tap-highlight-color: transparent;
}

.slick-list
{
    position: relative;
    display: block;
    overflow: hidden;
    margin: 0;
    padding: 0;
}
.slick-list:focus
{
    outline: none;
}
.slick-list.dragging
{
    cursor: pointer;
    cursor: hand;
}

.slick-slider .slick-track,
.slick-slider .slick-list
{
    -webkit-transform: translate3d(0, 0, 0);
       -moz-transform: translate3d(0, 0, 0);
        -ms-transform: translate3d(0, 0, 0);
         -o-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
}

.slick-track
{
    position: relative;
    top: 0;
    left: 0;
    display: block;
}
.slick-track:before,
.slick-track:after
{
    display: table;
    content: '';
}
.slick-track:after
{
    clear: both;
}
.slick-loading .slick-track
{
    visibility: hidden;
}

.slick-slide
{
    display: none;
    float: left;
    height: 130px;
    min-height: 1px;
	
}
[dir='rtl'] .slick-slide
{
    float: right;
}
.slick-slide img
{
    display: block;
}
.slick-slide.slick-loading img
{
    display: none;
}
.slick-slide.dragging img
{
    pointer-events: none;
}
.slick-initialized .slick-slide
{
    display: block;
}
.slick-loading .slick-slide
{
    visibility: hidden;
}
.slick-vertical .slick-slide
{
    display: block;
    height: 130px;
	
    border: 1px solid transparent;
}
.slick-arrow.slick-hidden {
    display: none;
}
.zoom {
  zoom: 100%;
}
</style>
<script>
$(document).ready(function(){
    $('.customer-logos').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 5000,
        arrows: false,
        dots: false,
        pauseOnHover: false,
        responsive: [{
            breakpoint: 768,
            settings: {
                slidesToShow: 3
            }
        }, {
            breakpoint: 520,
            settings: {
                slidesToShow: 2
            }
        }]
    });
});
</script>
<div class="container">
   <section class="customer-logos slider">
      <div class="slide"><img src="../img/indonesianembassy-100x100.jpg"></div>
      <div class="slide"><img src="../img/bkpm-100x100.jpg"></div>
      <div class="slide"><img src="../img/kemendag-100x100-1.jpg"></div>
      <div class="slide"><img src="../img/tradeexpoindonesia-100x100.jpg"></div>
      <div class="slide"><img src="../img/wonderful-indonesia-100x100.jpg"></div>
   </section>
   
</div>