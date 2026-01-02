<?php
session_start();

if (empty($_SESSION["admin_username"])) {
    header("Location:index.php");
} else {

    include("admin_header.php");
    $conn = new connec();
    $sql = "SELECT seat_reserved.id, seat_reserved.show_id, customer.fullname, seat_reserved.seat_number, seat_reserved.reserved
    FROM seat_reserved, customer
    WHERE seat_reserved.cust_id = cust_id;";

    $result = $conn->select_by_query($sql);
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
                    <h5 class="text-center mt-2" style="color:maroon;">Seat Reserved Details </h5>

                    <div class="table-responsive mt-4">
                        <table class="table table-bordered table-striped" s>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Customer Name</th>
                                    <th>Seat No.</th>
                                    <th>Status</th>
                               
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                ?>
                                        <tr>
                                            <td><?php echo $row["id"] ?></td>
                                            <td><?php echo $row["fullname"] ?></td>
                                            <td><?php echo $row["seat_number"] ?></td>
                                            <td><?php echo $row["reserved"] ?></td>
                                    
                                            <td><a href="editseat_reserved.php?id=<?php echo $row["id"]; ?>" class="btn btn-primary">Edit</a>
                                                <a href="deleteseat_reserved.php?id= <?php echo $row["id"]; ?>" class="btn btn-danger">Delete</a>
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