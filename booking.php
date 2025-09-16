<?php
session_start();

if(empty($_SESSION["username"]))
{
    header("Location: index.php");
    exit();
}
include("header.php");
?>

<section class="mt-5 ">
    <h3 class="text-center" style="color:darkcyan;">Book Your Ticket Now</h3>

    <div class="container">
        <div class="row">
            <div class="col-md-6"></div>
            <div class="col-md-6"></div>
        </div>
    </div>


</section>
<?php
include("footer.php");
?>