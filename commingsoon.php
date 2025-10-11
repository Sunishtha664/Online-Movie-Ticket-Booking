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
                    <div class="col-md-3 mb-4">
                        <img src="<?php echo $row["movie_banner"]; ?>" style="width: 100%; height: 350px; object-fit:cover;" />
                        <h6 class="text-center mt-2" style="height: 40px; color:azure"><?php echo $row["name"]; ?></h6>
                        <p style="height: 30px; color:azure"><b>Release Date: </b><?php echo $row["rel_date"]; ?></p>
                        <p style="height: 30px; color:azure"><b>Industry: </b><?php echo $indrow["industry_name"]; ?></p>
                        <p style="height: 30px; color:azure"><b>Language: </b><?php echo $langrow["lang_name"]; ?></p>
                        <p style="height: 30px; color:azure"><b>Genre: </b><?php echo $genrow["genre_name"]; ?></p>
                        <a class="btn" style="background-color:darkcyan; color:white; width:100%"
                            data-toggle="modal" data-target="#movieModal<?php echo $row['id']; ?>">
                            View Details
                        </a>
                    </div>

                    <!-- Movie Details Modal -->
                    <div class="modal fade" id="movieModal<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="movieModalLabel<?php echo $row['id']; ?>" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color:darkcyan; color:white;">
                                    <h5 class="modal-title" id="movieModalLabel<?php echo $row['id']; ?>"><?php echo $row["name"]; ?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true" style="color:white;">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <img src="<?php echo $row["landscape_img"]; ?>" style="width: 100%; max-height: 300px; object-fit: cover; border-radius: 10px; margin-bottom: 20px;" />

                                    <p><b>Description:</b> <?php echo $row["movie_desc"]; ?></p>
                                    <p><b>Director:</b> <?php echo $row["director"]; ?></p>
                                    <p><b>Cast:</b> <?php echo $row["cast"]; ?></p>
                                    <p><b>Duration:</b> <?php echo $row["duration"]; ?></p>
                                    <p><b>Genre:</b> <?php echo $genrow["genre_name"]; ?></p>
                                    <p><b>Release Date:</b> <?php echo $row["rel_date"]; ?></p>
                                    <p><b>Age Rating:</b> <?php echo $row["age_rating"]; ?></p>
                                    <p><b>Language:</b> <?php echo $langrow["lang_name"]; ?></p>
                                </div>
                            </div>
                        </div>
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