<?php
session_start();

if(empty($_SESSION["username"]))
{
    header("Location: index.php");
}
else{
include("header.php");
}

?>

<section class="mt-5 ">
    <h3 class="text-center" style="color:darkcyan;">Book Your Ticket Now</h3>

    <form action="" method="post" class="mt-5">
        <div class="container" style="color:darkcyan;">
            <center>
                <p style="color: black;">Please fill this form to book your ticket</p>
            </center>
            <hr>
            <label for="username"><b>Username</b></label>
            <input type="text" style="border: radius 30px;" placeholder="Enter Username" name="username" id="username" required>

            <label for="email"><b>Email</b></label>
            <input type="text" style="border: radius 30px;" placeholder="Enter Email" name="email" id="email" required>

            <label for="psw"><b>Password</b></label>
            <input type="text" style="border: radius 30px;" placeholder="Enter Password" name="psw" id="psw" required>

            <label for="psw-repeat"><b>Repeat Password</b></label>
            <input type="text" style="border: radius 30px;" placeholder="Repeat Password" name="psw-repeat" id="psw-repeat" required>

            <label for="number"><b>Number</b></label>
            <input type="text" style="border: radius 30px;" placeholder="Enter Number" name="number" id="number" required>

            <button type="submit" name="btn_booking" class="btn" style="background-color:darkcyan; color: white;">Confirm Booking</button>

        </div>
    </form>


</section>
<?php
include("footer.php");
?>