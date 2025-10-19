<?php

include("header.php");
require_once("conn.php");

if (!isset($_GET['movie_id']) || !is_numeric($_GET['movie_id'])) {
    header("Location: commingsoon.php");
    exit();
}
$movie_id = (int)$_GET['movie_id'];

$conn = new connec();
$sql = "SELECT m.*,
               ind.industry_name,
               g.genre_name,
               lg.lang_name
        FROM movie m
        LEFT JOIN industry ind ON m.industry_id = ind.id
        LEFT JOIN genre g ON m.genre_id = g.id
        LEFT JOIN `language` lg ON m.lang_id = lg.id
        WHERE m.id = $movie_id
        LIMIT 1";
$res = $conn->select_by_query($sql);

if (!$res || $res->num_rows == 0) {
    echo '<div class="container mt-5"><div class="alert alert-warning">Movie not found.</div></div>';
    include("footer.php");
    exit();
}

$row = $res->fetch_assoc();

// safe values / fallbacks
$name        = htmlspecialchars($row['name'] ?? 'Untitled');
$banner      = !empty($row['landscape_img']) ? $row['landscape_img'] : (!empty($row['movie_banner']) ? $row['movie_banner'] : 'Images/default_landscape.jpg');
$description = nl2br(htmlspecialchars($row['movie_desc'] ?? $row['description'] ?? 'No description available.'));
$director    = htmlspecialchars($row['director'] ?? '—');
$cast        = htmlspecialchars($row['cast'] ?? '—');
$duration    = htmlspecialchars($row['duration'] ?? '—');
$genre       = htmlspecialchars($row['genre_name'] ?? ($row['genre'] ?? '—'));
$rel_date    = htmlspecialchars($row['rel_date'] ?? '—');
$age_rating  = htmlspecialchars($row['age_rating'] ?? '—');
$language    = htmlspecialchars($row['lang_name'] ?? ($row['language'] ?? '—'));
$industry    = htmlspecialchars($row['industry_name'] ?? '—');
?>
<section class="py-5">
    <div class="container">
        <a href="commingsoon.php" class="btn btn-link mb-3">&larr; Back</a>
        <div class="card shadow-sm">
            <div class="card-header" style="background-color:darkcyan; color:#fff;">
                <h4 class="mb-0"><?php echo $name; ?></h4>
            </div>
            <div class="card-body" style="padding:1.5rem;">
                <div class="row">
                    <div class="col-lg-7">
                        <img src="<?php echo htmlspecialchars($banner); ?>"
                             alt="<?php echo $name; ?>"
                             style="width:100%; max-height:320px; object-fit:cover; border-radius:12px; box-shadow:0 6px 18px rgba(0,0,0,0.12); margin-bottom:18px;">
                        <div style="font-size:1rem; color:#333;">
                            <p><strong>Description:</strong><br><?php echo $description; ?></p>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <ul class="list-unstyled" style="font-size:1rem; color:#222;">
                            <li><strong>Director:</strong> <?php echo $director; ?></li>
                            <li class="mt-2"><strong>Cast:</strong> <?php echo $cast; ?></li>
                            <li class="mt-2"><strong>Duration:</strong> <?php echo $duration; ?></li>
                            <li class="mt-2"><strong>Genre:</strong> <?php echo $genre; ?></li>
                            <li class="mt-2"><strong>Release Date:</strong> <?php echo $rel_date; ?></li>
                            <li class="mt-2"><strong>Age Rating:</strong> <?php echo $age_rating; ?></li>
                            <li class="mt-2"><strong>Language:</strong> <?php echo $language; ?></li>
                            <li class="mt-2"><strong>Industry:</strong> <?php echo $industry; ?></li>
                        </ul>

                        <div class="mt-4">
                            <?php if (!empty($_SESSION['username'])): ?>
                                <a href="booking.php?movie_id=<?php echo $movie_id; ?>" class="btn btn-block" style="background-color:darkcyan;color:#fff;">Book Ticket</a>
                            <?php else: ?>
                                <button class="btn btn-block" style="background-color:darkcyan;color:#fff;" data-toggle="modal" data-target="#modelId1">Login to Book</button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
include("footer.php");
?>