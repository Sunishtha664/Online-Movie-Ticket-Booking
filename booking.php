<?php

include("header.php");
if (empty($_SESSION["username"])) {
    header("Location: index.php");
    exit();
}

?>

<script>
    $(document).ready(function(){
        for(i=1;i<=4;i++){
            $('seat_chart').append('<tr>')
            for(j=1;j<=10;j++){
                $('#seat_chart').append('<div class="col-md-2 mt-2 mb-2 ml-2 mr-2 text-center" style="background-color:grey;color:white"><input type="checkbox" id="seat" value="R'+(i+'S'+j)+'" name="seat_chart[]" class="mr-2  col-md-2 mb-2" onclick="checkboxtotal();" >R'+(i+'S'+j)+'</div>')
        }
    }

    });


    function checkboxtotal(){
        alert();
    }


</script>

<section class="mt-5 ">
    <h3 class="text-center" style="color:darkcyan;">Book Your Ticket Now</h3>

    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div id="seat-map" id=""seatCharts>
                    <h3 class="text-center mt-5" style="color: darkcyan">Select Seats</h3><hr>
                    <label for="" class="text-center" style="width:100%; background-color:darkcyan; color:white; padding:2%">
                        SCREEN
                    </label>
                    <div class="row" id="seat_chart">

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
                        <label for="username"><b>Customer ID</b></label>
                        <input type="number" style="border-radius: 30px;" name="cust_id" required value="<?php echo $_SESSION["cust_id"]; ?>"><br>

                        <label for="email"><b>Show</b></label>
                        <input type="text" style="border-radius: 30px;" name="show_id" required><br>

                        <label for="psw"><b>Number of Tickets</b></label>
                        <input type="number" style="border-radius: 30px;" name="no_ticket" required><br>

                        <label for="psw-repeat"><b>Seat Details</b></label>
                        <input type="text" style="border-radius: 30px;" name="seat_dt" required><br>

                        <label for="number"><b>Booking Date</b></label>
                        <input type="date" style="border-radius: 30px;" name="booking_date" required>

                        <button type="submit" name="btn_booking" class="btn" style="background-color:darkcyan; color: white;">Confirm Booking</button>

                    </div>
                </form>
            </div>
        </div>
    </div>


</section>
<?php
include("footer.php");
?>