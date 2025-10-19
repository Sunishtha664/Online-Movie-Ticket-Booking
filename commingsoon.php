<?php
include("header.php");
require_once("conn.php");

$conn = new connec();
$result = $conn->select_by_query("SELECT * FROM movie WHERE rel_date > CURDATE() ORDER BY rel_date ASC");
?>

<section class="mt-5 ">
    <h3 class="text-center" style="color:darkcyan;">Coming soon</h3>

    <div class="container">
        <div class="row">
            <?php
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {

                    // safe related lookups
                    $indrow = [];
                    $langrow = [];
                    $genrow = [];

                    if (!empty($row["industry_id"])) {
                        $ind = $conn->select("industry", $row["industry_id"]);
                        if ($ind) $indrow = $ind->fetch_assoc() ?: [];
                    }
                    if (!empty($row["lang_id"])) {
                        $lang = $conn->select("language", $row["lang_id"]);
                        if ($lang) $langrow = $lang->fetch_assoc() ?: [];
                    }
                    if (!empty($row["genre_id"])) {
                        $gen = $conn->select("genre", $row["genre_id"]);
                        if ($gen) $genrow = $gen->fetch_assoc() ?: [];
                    }

                    $movieId      = (int)($row['id'] ?? 0);
                    $movieName    = htmlspecialchars($row['name'] ?? 'Untitled');
                    $movieBanner  = !empty($row['movie_banner']) ? htmlspecialchars($row['movie_banner']) : 'Images/default_poster.jpg';
                    $rel_date     = htmlspecialchars($row['rel_date'] ?? '');
                    $industryName = htmlspecialchars($indrow['industry_name'] ?? '');
                    $langName     = htmlspecialchars($langrow['lang_name'] ?? '');
                    $genreName    = htmlspecialchars($genrow['genre_name'] ?? '');
            ?>
                    <div class="col-md-3 mb-4">
                        <div class="card h-100 shadow-sm">
                            <img src="<?php echo $movieBanner; ?>" class="card-img-top" style="height: 260px; object-fit:cover;" alt="<?php echo $movieName; ?>" />
                            <div class="card-body">
                                <h6 class="card-title text-center" style="min-height:48px;"><?php echo $movieName; ?></h6>
                                <p class="card-text"><small><b>Release Date:</b> <?php echo $rel_date; ?></small></p>
                                <p class="card-text"><small><b>Language:</b> <?php echo $langName; ?></small></p>
                                <p class="card-text"><small><b>Genre:</b> <?php echo $genreName; ?></small></p>
                            </div>
                            <div class="card-footer bg-white border-0">
                                <!-- open details page (no modal) -->
                                <a class="btn btn-block" style="background-color:darkcyan; color:white;"
                                   href="movie_details.php?movie_id=<?php echo $movieId; ?>">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo '<div class="col-12"><p class="text-center">No upcoming movies found.</p></div>';
            }
            ?>
        </div>
    </div>
</section>

<?php
include("footer.php");
?>