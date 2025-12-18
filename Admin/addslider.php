<?php
session_start();

 /* if(isset($_POST["btn_update"])){

         include("../conn.php");
        $name = $_POST["cinema_name_txt"];
        $location = $_POST["cinema_location_txt"];
        $city = $_POST["city_name_txt"];

        $id = $_GET["id"];
        $conn = new connec();
        $sql = "update cinema set name='$name', location='$location', city='$city' where id=$id";

        $conn->update($sql, "Cinema Updated Successfully");
        header("Location: viewcinema.php");
    }
*/
if (empty($_SESSION["admin_username"])) {
    header("Location:index.php");
} else {
     include("admin_header.php");

    
?>

    <style>
        /* Make table scrollable horizontally */
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        /* Reduce font size */
        table.table th,
        table.table td {
            font-size: 14px;
            /* Adjust font size */
            white-space: nowrap;
            /* Prevent text from breaking */
        }

        /* Reduce row height & spacing */
        table.table tr {
            height: 10px !important;
        }

        /* Make header bold & small */
        table.table th {
            font-weight: 600;
            font-size: 15px;
        }

        /* Make action buttons smaller */
        .btn {
            padding: 3px 8px;
            font-size: 12px;
        }
    </style>

    <section>
        <div class="container-fluid" style="overflow: hidden;"> <!-- Prevent scrolling -->
            <div class="row">
                <div class="col-md-2" style="background-color:black;">
                    <?php include('admin_sidenavbar.php'); ?>
                </div>
                <div class="col-md-10">
                    <h5 class="text-center mt-2" style="color:maroon;">Add Slider</h5>

                    <div class="table-responsive mt-4">
                    <form method="post" enctype="multipart/form-data" class="mt-5">
                        <div class="container" style="color: #343a40;">
                        
                        <label for="text"><b>Select Image</b></label>
                        <input type="file" style="border-radius: 30px;"  name="fileToUpload" id="fileToUpload" required><br><br>

                       <label for="text"><b>Alternate Text</b></label>
                        <input type="text" style="border-radius: 30px;" placeholder="Enter Alternate Text" name="slider_alt_text" required>
                       

                        <button type="submit" name="btn_insert" class="btn" style="background-color:darkcyan; color:white">Insert</button>
                    </div>
                    </form>

                    </div>
                </div>
            </div>
    </section>

<?php
    include("admin_footer.php");
}
?>
