<?php
session_start();

if (empty($_SESSION["admin_username"])) {
    header("Location:index.php");
} else {

    include("admin_header.php");
    $conn = new connec();
    $tbl = "movie";
    $result = $conn->select_all($tbl);
?>


    <section>
        <div class="container-fluid" style="overflow: hidden;"> <!-- Prevent scrolling -->
            <div class="row">
                <div class="col-md-2" style="background-color:black;">
                    <?php include('admin_sidenavbar.php'); ?>
                </div>
                <div class="col-md-10">
                    <h5 class="text-center mt-2" style="color:maroon;">Movie Details </h5>
                    <a href="addmovie.php" style="color:brown;">Add Movie</a>

                    <table class="table mt-5">
                        <thead>
                            <tr>
                                <th>Banner</th>
                                <th>Name</th>
                                <th>Release Date</th>
                                <th>Industry</th>
                                <th>Genre</th>
                                <th>Language</th>
                                <th>Movie Duration</th>
                                <th>Director</th>
                                <th>Cast</th>
                                <th>Age Rating</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                            ?>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><a href="editmovie.php?id=">Edit</a>
                                            <a href="deletemovie.php?id=">Delete</a>
                                        </td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </section>

<?php
    include("admin_footer.php");
}
?>