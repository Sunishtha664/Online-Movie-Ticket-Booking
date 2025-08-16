<?php
include("header.php");
include("conn.php");
?>

<section style="min-height: 450px;">
<div id="carouselId" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselId" data-slide-to="0" class="active"></li>
        <li data-target="#carouselId" data-slide-to="1"></li>
        <li data-target="#carouselId" data-slide-to="2"></li>
                <li data-target="#carouselId" data-slide-to="3"></li>

    </ol>
    <div class="carousel-inner" role="listbox">
        <div class="carousel-item active">
            <img src="Images/banner1.jpeg" alt="First slide" style="width: 100%; height: 500px;">
        </div>
        <div class="carousel-item">
            <img src="Images/banner2.jpeg" alt="Second slide" style="width: 100%; height: 500px;">
        </div>
        <div class="carousel-item">
            <img src="Images/banner3.jpeg" alt="Third slide" style="width: 100%; height: 500px;">
        </div>
           <div class="carousel-item">
            <img src="Images/banner4.jpeg" alt="Fourth slide" style="width: 100%; height: 500px;">
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselId" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselId" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>






</section>





<?php
include("footer.php");
?>