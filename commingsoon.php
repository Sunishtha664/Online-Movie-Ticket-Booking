<?php
include("header.php");
include("conn.php");

$conn = new connec();
$tbl = "movie";
$result = $conn->select_all($tbl);

?>

<section class="mt-5 ">
    <h5 class="text-center">Comming soon</h5>

    <div class="container">
        <div class="row">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>
                    <div class="col-md-3">
                        <img src="" alt="" style="width: 100%; height: 250px;">
                        <h6 class="text-center mt-2">Movie Name</h6>
                        <p><b>Release Date:</b></p>
                        <p><b>Industry:</b></p>
                        <p><b>Language:</b></p>
                        <p><b>Genre:</b></p>
                    </div>
            <?php

                }
            }

            ?>

        </div>
    </div>
</section>
<?php
include("footer.php");
?>