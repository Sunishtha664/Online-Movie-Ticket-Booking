<?php
include("header.php");

$conn=new connec();
$tbl="movie_ticket_booking.show";
$result= $conn->select_all($tbl);

$sql_query = "SELECT
    movie_ticket_booking.show.id,
    movie_ticket_booking.show.show_date,
    movie_ticket_booking.show.ticket_price,
    movie_ticket_booking.show.no_seat,
    movie.name,
    show_time.time,
    cinema.name
FROM
    movie_ticket_booking.show,
    movie,
    show_time,
    cinema
WHERE
    movie_ticket_booking.show.movie_id = movie.id
    AND movie_ticket_booking.show.show_time_id = show_time.id
    AND movie_ticket_booking.show.cinema_id = cinema.id
    AND  movie_ticket_booking.show.id =1;";

if (isset($_POST["btn_booking"])) {
    $conn = new connec();

    $cust_id = $_POST["cust_id"];
    $show_id = $_POST["show_id"];
    $no_tikt = $_POST["no_ticket"];
    $bkng_date = $_POST["booking_date"];
    $total_amnt = 250 * $no_tikt;

    $seat_number = $_POST["seat_dt"];
    $seat_arr = explode(", ", $seat_number);

    foreach ($seat_arr as $item) {
        $sql = "insert into seat_reserved values(0,$show_id,$cust_id,'$item','true')";
        $abc = $conn->insert_lastid($sql);
    }

    $sql = "insert into seat_detail values(0,$cust_id,$show_id,$no_tikt)";
    $seat_dt_id = $conn->insert_lastid($sql);

    $sql = "insert into booking values(0,$cust_id,$show_id,$no_tikt,$seat_dt_id,'$bkng_date',$total_amnt)";
    $conn->insert($sql, "Your Ticket is Booked");
}
?>

<script>
    $(document).ready(function() {
        for (i = 1; i <= 4; i++) {
            for (j = 1; j <= 10; j++) {
                $('#seat_chart').append('<div class="col-md-2 mt-2 mb-2 ml-2 mr-2 text-center" style="background-color:grey;color:white"><input type="checkbox" value="R' + (i + 'S' + j) + '" name="seat_chart[]" class="mr-2  col-md-2 mb-2" onclick="checkboxtotal();" >R' + (i + 'S' + j) + '</div>');
            }
        }
    });

    function checkboxtotal() {
        var seat = [];
        $('input[name="seat_chart[]"]:checked').each(function() {
            seat.push($(this).val());
        });
        var st = seat.length;
        document.getElementById('no_ticket').value = st;

        var total = "Rs. "+(st * 250);
        $('#price_details').text(total);
        $('#seat_details').text(seat.join(", "));
        $('input[name="seat_dt"]').val(seat.join(", "));
    }
</script>

<section class="mt-5 ">
    <?php if (empty($_SESSION["username"])): ?>
        <div class="container d-flex justify-content-center align-items-center" style="min-height: 400px;">
            <div class="card shadow p-4" style="max-width: 400px; width: 100%; border-radius: 20px;">
                <div class="text-center mb-3">
                    <i class="fa fa-lock fa-3x" style="color: darkcyan;"></i>
                </div>
                <h4 class="text-center mb-3" style="color:darkcyan;">Please log in to book your ticket</h4>
                <div class="text-center">
                    <button class="btn btn-info" data-toggle="modal" data-target="#modelId1">
                        <i class="fa fa-sign-in"></i> Login
                    </button>
                </div>
            </div>
        </div>
    <?php else: ?>
        <h3 class="text-center" style="color:darkcyan;">Book Your Ticket Now</h3>
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div id="seat-map" id="seatCharts">
                        <h3 class="text-center mt-5" style="color: darkcyan">Select Seats</h3>
                        <hr>
                        <label class="text-center" style="width:100%; background-color:darkcyan; color:white; padding:2%">
                            SCREEN
                        </label>
                        <div class="row" id="seat_chart"></div>
                        <div class="mt-3" style="color:darkcyan;">
                            <b>Selected Seats:</b> <span id="seat_details"></span>
                        </div>
                    </div>

                    <h5 class="mt-5" style="color: darkcyan">Total Ticket Price</h5>
                    <p class="mt-1" id="price_details"></p>

                </div>
                <div class="col-md-5">
                    <form action="" method="post" class="mt-5">
                        <div class="container" style="color:darkcyan;">
                            <center>
                                <p style="color: black;">Please fill this form to book your ticket</p>
                            </center>
                            <hr>
                            <label for="cust_id"><b>Customer ID</b></label>
                            <input type="number" style="border-radius: 30px;" name="cust_id" required value="<?php echo isset($_SESSION["cust_id"]) ? $_SESSION["cust_id"] : ''; ?>"><br>

                            <label for="show_id"><b>Show</b></label>
                            <input type="text" style="border-radius: 30px;" name="show_id" required><br>

                            <label for="no_ticket"><b>Number of Tickets</b></label>
                            <input type="number" style="border-radius: 30px;" id="no_ticket" name="no_ticket" required readonly><br>

                            <label for="seat_dt"><b>Seat Details</b></label>
                            <input type="text" style="border-radius: 30px;" name="seat_dt" id="seat_dt" readonly required><br>

                            <label for="booking_date"><b>Booking Date</b></label>
                            <input type="date" style="border-radius: 30px;" name="booking_date" required>

                            <button type="submit" name="btn_booking" class="btn" style="background-color:darkcyan; color: white;">Confirm Booking</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endif; ?>
</section>
<?php
include("footer.php");
?>