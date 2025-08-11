<?php
include("header.php");
?>





<section style="min-height: 450px;">
    <div class="container">
        <div class=" col-md-12"  style="margin-top: 20px; text-align: center; color: #343a40;">
            <center>
                <h1>Contact Us</h1>
                <h5>GET IN TOUCH</h5>
                <p>We'd love to talk about how we can work together. Send us a message below and we'll respond as soon as possible</p>
            </center>
        </div>
        <div class="row">
                <div class="col-md-6 mt-5 mb-5" style="border-radius: 30px; background-color:#343a40; color: white; padding: 20px;">
                    <h2 class="mt-5 pl-5" style="color: white;">Contact Information</h2>
                    <p class="mt-1 pl-5">Our Team will get back to you within 24 hours</p>

                </div>
            <div class="col-md-6">
                <form method="post">
                    <div class="container" style="color:#343a40">


                
                        <label for="username"><b>Your Name</b></label>
                        <input type="text" style="border: radius 30px;" placeholder="Enter Name" name="name" id="username" required>

                        <label for="email"><b>Email</b></label>
                        <input type="email" style="border: radius 30px;" placeholder="Enter Email" name="email" id="email" required>


                        <label for="number"><b>Number</b></label>
                        <input type="tel" style="border: radius 30px;" placeholder="Enter Number" name="number" id="number" required>

                        <label for="message"><b>Message</b></label>
                        <textarea name="message" id="message" rows="10" style="resize:none"></textarea>
                        <button type="submit" class="btn " style="background-color:darkcyan; color:white">Send Message</button>

                        <hr>
                    </div>



                </form>
            </div>
        
        </div>
    </div>
</section>



<?php
include("footer.php");
?>