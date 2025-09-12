<?php
require_once("conn.php");
  $conn = new connec();

// Handle logout
if (isset($_GET["action"]) && $_GET["action"] == "logout") {
    session_destroy();
    header("Location: index.php");
    exit();
}

// Handle login (replace with your own authentication logic)
if (isset($_POST["btn_login"])) {

    $email_id=$_POST["log_email"];
    $paswrd_log=$_POST["log_psw"];

    $result = $conn->select_login("customer", $email_id);

    if($result->num_rows > 0){
        $row=$result->fetch_assoc();

        if($row["email"]==$email_id && $row["password"]==$paswrd_log){
        $_SESSION["username"] = $row["fullname"];
        $_SERVER["ul"]= '<li class="nav-item"><a class="nav-link">Hello'.$_SESSION["username"].'</a></li> <li class="nav-item"><a class="nav-link" href="index.php?action=logout">LogOut</a></li>';
        }
        else{
            echo '<script> alert("Invalid Password");</script>';
        }
    }
    else{
            echo '<script> alert("Invalid Email Id");</script>';
        }

    
    
}


if (isset($_POST["btn_reg"])) {

    $name = $_POST["reg_full_name"];
    $email = $_POST["reg_email"];
    $cellno = $_POST["reg_number_txt"];
    $gender = $_POST["reg_gender_txt"];
    $paswrd = $_POST["reg_psw"];
    $cnfrm_paswrd = $_POST["psw_repeat"];

    if ($paswrd == $cnfrm_paswrd) {

        $sql = "insert into customer values(0,'$name','$email','$cellno','$gender','$cnfrm_paswrd')";
      

        $conn->insert($sql, "Customer Registered! Now You can Login");
    } else {
?>
        <script>
            alert("Confirm Password not match");
        </script>
<?php

    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>Online Movie Ticket Booking</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="icon" href="Images/Clapperboard.jpeg">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        * {
            box-sizing: border-box
        }

        .container {
            padding: 16px;
        }

        textarea,
        input[type=text],
        input[type=password],
        input[type=tel],
        input[type=email] {
            width: 100%;
            padding: 15px;
            margin: 5px 0 22px 0;
            display: inline-block;
            border: none;
            background: #f1f1f1;
            border-radius: 30px;
            transition: box-shadow 0.2s;
        }

        textarea:focus,
        input[type=text]:focus,
        input[type=password]:focus,
        input[type=tel]:focus,
        input[type=email]:focus {
            background-color: #ddd;
            outline: none;
            box-shadow: 0 0 0 2px #17a2b8;
        }

        hr {
            border: 1px solid #f1f1f1;
            margin-bottom: 25px;
        }

        .registerbtn {
            background-color: maroon;
            color: white;
            padding: 16px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 50%;
            opacity: 0.9;
        }

        .registerbtn:hover {
            opacity: 1;
        }

        a {
            color: dodgerblue;
        }

        .signin {
            background-color: #f1f1f1;
            text-align: center;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark" style="background-color: #343a40;">
        <a class="navbar-brand" href="index.php">
            <img src="Images/Clapperboard.jpeg" alt="Logo" style="height: 40px;">
        </a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Movies</a>
                    <div class="dropdown-menu" aria-labelledby="dropdownId">
                        <a class="dropdown-item" href="commingsoon.php">Coming Soon</a>
                        <a class="dropdown-item" href="nowshowing.php">Now showing</a>
                    </div>
                </li>
                <li class="nav-item"><a class="nav-link" href="offer.php">Offers</a></li>
                <li class="nav-item"><a class="nav-link" href="booking.php">Book Ticket</a></li>
                <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
            </ul>
            <ul class="navbar-nav">
                <?php if (empty($_SESSION["username"])): ?>
        <li class="nav-item">
            <a class="nav-link" data-toggle="modal" data-target="#modelId">Register</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="modal" data-target="#modelId1">Login</a>
        </li>
    <?php else: ?>
        <li class="nav-item">
            <a class="nav-link">Hello <?php echo htmlspecialchars($_SESSION["username"]); ?></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php?action=logout">Logout</a>
        </li>
    <?php endif; ?>
            </ul>
        </div>
    </nav>

    <!-- Register Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color:darkcyan; color:black">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post">
                        <div class="container" style="color:#343a40">
                            <center>
                                <h1>Customer Register</h1>
                                <p>Please fill in this form to create an account</p>
                            </center>
                            <hr>
                            <label for="username"><b>Full Name</b></label>
                            <input type="text" style="border-radius: 30px;" placeholder="Enter Your Name" name="reg_full_name" id="username" required>

                            <label for="email"><b>Email</b></label>
                            <input type="email" style="border-radius: 30px;" placeholder="Enter Email" name="reg_email" id="email" required>

                            <label for="number"><b>Cell Number</b></label>
                            <input type="tel" style="border-radius: 30px;" placeholder="Enter Number" name="reg_number_txt" id="number" required>

                            <label for="number"><b>Select Gender</b></label><br>
                            <input type="radio" style="border-radius: 30px; margin-right: 2%;" value="male" name="reg_gender_txt" id="gender" required>Male
                            <input type="radio" style="border-radius: 30px; margin-left: 5%; margin-right: 2%;" value="female" name="reg_gender_txt" id="gender" required>Female
                            <input type="radio" style="border-radius: 30px; margin-left: 5%; margin-right: 2%;" value="others" name="reg_gender_txt" id="gender" required>Others

                            <br><br>


                            <label for="psw"><b>Password</b></label>
                            <input type="password" style="border-radius: 30px;" placeholder="Enter Password" name="reg_psw" id="psw" required>

                            <label for="psw-repeat"><b>Repeat Password</b></label>
                            <input type="password" style="border-radius: 30px;" placeholder="Repeat Password" name="psw_repeat" id="psw-repeat" required>

                            <button type="submit" class="btn " name="btn_reg" style="background-color:darkcyan; color:white">Register</button>
                            <hr>
                        </div>
                        <div class="container">
                            <p>Already have an account? <a data-toggle="modal" data-target="#modelId1" data-dismiss="modal" style="color:gray; cursor:pointer;">Log In</a>.</p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Login Modal -->
    <div class="modal fade" id="modelId1" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color:darkcyan; color:black">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <div class="container" style="color: #343a40;">
                            <center>
                                <h1>LogIn</h1>
                            </center>
                            <hr>
                            <label for="email"><b>Email</b></label>
                            <input type="email" style="border-radius: 30px;" placeholder="Enter Email" name="log_email" id="email" required>
                            <label for="psw"><b>Password</b></label>
                            <input type="password" style="border-radius: 30px;" placeholder="Enter Password" name="log_psw" id="psw" required>
                            <button type="submit" name="btn_login" class="btn" style="background-color:darkcyan; color:white">Login</button>
                        </div>
                        <!-- <div class="container signin">
                            <p>Don't have an account? <a data-toggle="modal" data-target="#modelId" data-dismiss="modal" style="color: gray;">Sign Up</a>.</p>
                        </div> -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>