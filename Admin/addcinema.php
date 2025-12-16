<?php
session_start();

if (empty($_SESSION["admin_username"])) {
    header("Location:index.php");
} else {

    include("admin_header.php");
    $conn = new connec();
    $tbl = "cinema";
    

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
                    <h5 class="text-center mt-2" style="color:maroon;">Add Cinema</h5>

                    <div class="table-responsive mt-4">
                    <form method="post">
                        <div class="container" style="color: #343a40;">
                        <center>
                            <h1>Admin LogIn</h1>
                        </center>
                        <hr>
                        <label for="email"><b>Email</b></label>
                        <input type="email" style="border-radius: 30px;" placeholder="Enter Email" name="log_email" id="email" required>
                        <label for="psw"><b>Password</b></label>
                        <input type="password" style="border-radius: 30px;" placeholder="Enter Password" name="log_psw" id="psw" required>
                        <button type="submit" name="btn_login" class="btn" style="background-color:darkcyan; color:white">Login</button>
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