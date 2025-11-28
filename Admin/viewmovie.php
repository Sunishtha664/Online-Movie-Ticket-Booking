<?php
session_start();

if (empty($_SESSION["admin_username"])) {
    header("Location:index.php");
} else {

    include("admin_header.php");
?>

<style>
  table {
    width: 100%;
    border-collapse: collapse;
    table-layout: fixed; /* makes columns align properly */
}

th, td {
    padding: 10px;
    text-align: left;
    border: 1px solid #ddd;
    vertical-align: top;
    word-wrap: break-word; /* long text control */
}

th {
    background-color: lightcyan;
    color: black;
    font-weight: 600;
    text-align: center; /* makes headings look proper */
}

tr:nth-child(even) {
    background-color: #f9f9f9;
}

tr:hover {
    background-color: #e6e6e6;
}
</style>
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
                            <th>Name</th>
                            <th>Banner</th>
                            <th>Description</th>
                            <th>Release Date</th>
                            <th>Industry</th>
                            <th>Genre</th>
                            <th>Language</th>
                            <th>Movie Duration</th>
                            <th>Director</th>
                            <th>Cast</th>
                            <th>Age Rating</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td scope="row"></td>
                            <td></td>
                            <td></td>
                        </tr>
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