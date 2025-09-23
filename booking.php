<?php
include("header.php");

if(isset($_POST["btn_booking"]))
{
    $cust_id = $_POST["cust_id"];
    $show_id = $_POST["show_id"];
    $no_tikt = $_POST["no_ticket"];
    $bkng_date = $_POST["booking_date"];
   $total_amnt;

   $conn = new connec();
}
?>

<script>
    $(document).ready(function(){
        for(i=1;i<=4;i++){
            for(j=1;j<=10;j++){
                $('#seat_chart').append('<div class="col-md-2 mt-2 mb-2 ml-2 mr-2 text-center" style="background-color:grey;color:white"><input type="checkbox" value="R'+(i+'S'+j)+'" name="seat_chart[]" class="mr-2  col-md-2 mb-2" onclick="checkboxtotal();" >R'+(i+'S'+j)+'</div>');
            }
        }
    });

    function checkboxtotal(){
        var seat = [];
        $('input[name="seat_chart[]"]:checked').each(function(){
            seat.push($(this).val());
        });
        var st = seat.length;
        document.getElementById('no_ticket').value = st;
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
                        <h3 class="text-center mt-5" style="color: darkcyan">Select Seats</h3><hr>
                        <label class="text-center" style="width:100%; background-color:darkcyan; color:white; padding:2%">
                            SCREEN
                        </label>
                        <div class="row" id="seat_chart"></div>
                        <div class="mt-3" style="color:darkcyan;">
                            <b>Selected Seats:</b> <span id="seat_details"></span>
                        </div>
                    </div>
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
                            <input type="text" style="border-radius: 30px;" name="seat_dt" readonly required><br>

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