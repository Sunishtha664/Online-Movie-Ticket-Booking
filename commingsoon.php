<?php
include("header.php");
require_once("conn.php");

$conn = new connec();
$tbl = "movie";
$result = $conn->select_by_query("SELECT * FROM movie WHERE rel_date > CURDATE() ORDER BY rel_date ASC");

?>

<section class="mt-5 ">
    <h3 class="text-center" style="color:darkcyan;">Coming soon</h3>

    <div class="container">
        <div class="row">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {

                    $ind = $conn->select("industry", $row["industry_id"]);
                    $indrow = $ind->fetch_assoc();

                    $lang = $conn->select("language", $row["lang_id"]);
                    $langrow = $lang->fetch_assoc();

                    $gen = $conn->select("genre", $row["genre_id"]);
                    $genrow = $gen->fetch_assoc();
            ?>
                    <div class="col-md-3">
                        <img src="<?php echo $row["movie_banner"]; ?>" style="width: 100%; height: 300px;" />
                        <h6 class="text-center mt-2" style="height: 40px;"><?php echo $row["name"]; ?></h6>
                        <p><b>Release Date: </b><?php echo $row["rel_date"]; ?></p>
                        <p><b>Industry: </b><?php echo $indrow["industry_name"]; ?></p>
                        <p><b>Language: </b><?php echo $langrow["lang_name"]; ?></p>
                        <p><b>Genre: </b><?php echo $genrow["genre_name"]; ?></p>
                        <a class="btn" style="background-color:darkcyan; color:white; width:100%" href="booking.php">Book Ticket</a>
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