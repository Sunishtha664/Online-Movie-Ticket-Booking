<?php
include("header.php");
?>





<section style="min-height: 450px;">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <form method="post">
                    <div class="container" style="color:#343a40">
                        <center>
                            <h1>Contact Us</h1>
                            <h5>GET IN TOUCH</h5>
                            <p>We'd love to talk abouthow we can work together. Send us a message below and</p>
                        </center>

                        <hr>

                        <label for="username"><b>Username</b></label>
                        <input type="text" style="border: radius 30px;" placeholder="Enter Username" name="username" id="username" required>
                        <label for="email"><b>Email</b></label>
                        <input type="email" style="border: radius 30px;" placeholder="Enter Email" name="email" id="email" required>
                        <label for="psw"><b>Password</b></label>
                        <input type="password" style="border: radius 30px;" placeholder="Enter Password" name="psw" id="psw" required>
                        <label for="psw-repeat"><b>Repeat Password</b></label>
                        <input type="password" style="border: radius 30px;" placeholder="Repeat Password" name="psw-repeat" id="psw-repeat" required>
                        <label for="number"><b>Number</b></label>
                        <input type="tel" style="border: radius 30px;" placeholder="Enter Number" name="number" id="number" required>
                        <button type="submit" class="btn " style="background-color:darkcyan; color:white">Register</button>
                        <hr>
                    </div>


                    <div class="container signin">
                        <p>Already have an account? <a data-toggle="modal" data-target="#modelId1" data-dismiss="modal" style="color: gray;">Log In</a>.</p>
                    </div>
                </form>
            </div>
            <div class="col-md-6"></div>
        </div>
    </div>
</section>



<?php
include("footer.php");
?>