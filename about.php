<?php
include("header.php");
include("conn.php");

$conn = new connec();
$tbl = "movie";
$result = $conn->select_movie($tbl, "now()");

?>

<section class="mt-5 ">
    <h3 class="text-center" style="color:darkcyan;">Comming soon</h3>


</section>
<?php
include("footer.php");
?>