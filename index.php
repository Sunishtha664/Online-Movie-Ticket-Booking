<?php

include("header.php");


$conn = new connec();
$tbl = "slider";
$result = $conn->select_all($tbl);
$result1 = $conn->select_all($tbl);


if (!empty($_SESSION['show_login'])) {
?>
    <script>
        $(document).ready(function() {
            $("#modelId1").modal('show');
        });
    </script>
<?php
    unset($_SESSION['show_login']);
} elseif (empty($_SESSION["username"])) {
?>
    <script>
        $(document).ready(function() {
            $("#modelId1").modal('show');
        });
    </script>
<?php
}

?>



<section style="min-height: 450px;">
    <div id="carouselId" class="carousel slide" data-ride="carousel">
        <?php
        if ($result->num_rows > 0) {

            $i = 0;
            echo '<ol class="carousel-indicators">';

            while ($row = $result->fetch_assoc()) {
                if ($i == 0) {
                    echo '<li data-target="#carouselId" data-slide-to="' . $i . '" class="active"></li>';
                } else {
                    echo '<li data-target="#carouselId" data-slide-to="' . $i . '"></li>';
                }
                $i++;
            }
            echo '</ol>';
        }
        ?>
        <!-- <ol class="carousel-indicators">
        <li data-target="#carouselId" data-slide-to="0" class="active"></li>
        <li data-target="#carouselId" data-slide-to="1"></li>
        <li data-target="#carouselId" data-slide-to="2"></li>
                <li data-target="#carouselId" data-slide-to="3"></li>

    </ol> -->
        <div class="carousel-inner" role="listbox">
            <?php
            if ($result1->num_rows > 0) {

                $j = 0;
                while ($row1 = $result1->fetch_assoc()) {

                    if ($j == 0) {
            ?>
                        <div class="carousel-item active">
                            <img src="<?php echo $row1["img_path"]; ?>" alt="<?php echo $row1["alt"]; ?>" style="width: 100%; height: 500px;">
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="carousel-item">
                            <img src="<?php echo $row1["img_path"]; ?>" alt="<?php echo $row1["alt"]; ?>" style="width: 100%; height: 500px;">
                        </div>
            <?php
                    }
                    $j++;
                }
            }
            ?>
            <!-- 
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
         -->
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


    
<!-- Now Showing Section -->
<div class="container mt-5">
    <h3 class="text-center" style="color:darkcyan;">Now Showing</h3>
    <div class="row">
        <?php
        $nowshowing = $conn->select_by_query("SELECT * FROM movie WHERE rel_date <= CURDATE() AND DATE_ADD(rel_date, INTERVAL 1 MONTH) > CURDATE() ORDER BY rel_date DESC");
        if ($nowshowing->num_rows > 0) {
            while ($row = $nowshowing->fetch_assoc()) {
        ?>
            <div class="col-md-3 mb-4">
                <img src="<?php echo $row["movie_banner"]; ?>" style="width: 100%; height: 250px; object-fit:cover;" />
                <h6 class="text-center mt-2"><?php echo $row["name"]; ?></h6>
                <p><b>Release Date:</b> <?php echo $row["rel_date"]; ?></p>
                <?php if (!empty($_SESSION["username"])): ?>
                    <a href="booking.php" class="btn" style="background-color:darkcyan; color:white; width:100%">Book Ticket</a>
                <?php else: ?>
                    <button class="btn" style="background-color:darkcyan; color:white; width:100%" disabled>Login to Book</button>
                <?php endif; ?>
            </div>
        <?php
            }
        }
        ?>
    </div>
</div>

<!-- Coming Soon Section -->
<div class="container mt-5">
    <h3 class="text-center" style="color:darkcyan;">Coming Soon</h3>
    <div class="row">
        <?php
        $comingsoon = $conn->select_by_query("SELECT * FROM movie WHERE rel_date > CURDATE() ORDER BY rel_date ASC");
        if ($comingsoon->num_rows > 0) {
            while ($row = $comingsoon->fetch_assoc()) {
        ?>
            <div class="col-md-3 mb-4">
                <img src="<?php echo $row["movie_banner"]; ?>" style="width: 100%; height: 250px; object-fit:cover;" />
                <h6 class="text-center mt-2"><?php echo $row["name"]; ?></h6>
                <p><b>Release Date:</b> <?php echo $row["rel_date"]; ?></p>
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
                  <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
                    <img src="<?php echo $row["landscape_img"]; ?>" 
                         style="width: 100%; max-height: 200px; object-fit: cover; border-radius: 16px; margin-bottom: 20px; box-shadow: 0 4px 16px rgba(0,0,0,0.15);" />
                    <hr style="margin: 16px 0;">
                    <div style="font-size: 1.05rem;">
                        <p><b>Description:</b> <?php echo $row["description"]; ?></p>
                        <ul style="list-style:none; padding-left:0;">
                            <li><b>Director:</b> <?php echo $row["director"]; ?></li>
                            <li><b>Cast:</b> <?php echo $row["cast"]; ?></li>
                            <li><b>Duration:</b> <?php echo $row["duration"]; ?></li>
                            <li><b>Genre:</b> <?php echo $row["genre"]; ?></li>
                            <li><b>Release Date:</b> <?php echo $row["rel_date"]; ?></li>
                            <li><b>Age Rating:</b> <?php echo $row["age_rating"]; ?></li>
                            <li><b>Language:</b> <?php echo $row["language"]; ?></li>
                        </ul>
                    </div>
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