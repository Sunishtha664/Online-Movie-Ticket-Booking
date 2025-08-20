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
                        <img src="" alt="" style="width: 100%; height: 250px;"/>
                        <h6 class="text-center mt-2"><?php echo $row["name"];?></h6>
                        <p><b>Release Date :</b><?php echo $row["rel_date"];?></p>
                        <p><b>Industry:</b><?php echo $row["industry_id"];?></p>
                        <p><b>Language:</b><?php echo $row["lang_id"];?></p>
                        <p><b>Genre:</b><?php echo $row["genre_id"];?></p>
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