<?php
session_start();
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

    $email_id = $_POST["log_email"];
    $paswrd_log = $_POST["log_psw"];

    $result = $conn->select_login("customer", $email_id);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if ($row["email"] == $email_id && $row["password"] == $paswrd_log) {
            $_SESSION["username"] = $row["fullname"];
            $_SESSION["cust_id"] = $row["id"];
            $_SERVER["ul"] = '<li class="nav-item"><a class="nav-link">Hello' . $_SESSION["username"] . '</a></li> <li class="nav-item"><a class="nav-link" href="index.php?action=logout">LogOut</a></li>';
        } else {
            echo '<script> alert("Invalid Password");</script>';
        }
    } else {
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
        input[type=email],
        input[type=date],
        input[type=number] {
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

        .modal-body {

            overflow-y: auto;
            /* scroll inside modal */
        }

        section {
            background-image: url('Images/theatrepic.jpeg');
            /* your background image */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
            padding: 60px 0;
            color: #000;
            /* text color */
        }

        /* Make background slightly lighter but still visible */
        section::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.3);
            /* 0.3 = lighter overlay */
            z-index: 1;
        }

        /* Keep content above overlay */
        section>* {
            position: relative;
            z-index: 2;
        }

        /* Remove default body margin */
        body {
            margin: 0;
            padding: 0;
        }

        /* Fix space below or above navbar */
        .navbar {
            margin-bottom: 0;
        }

        /* Ensure carousel starts right after navbar */
        #carouselId {
            margin-top: 0 !important;
            padding-top: 0 !important;
        }

        /* Optional: remove extra top padding from section */
        section:first-of-type {
            margin-top: 0 !important;
            padding-top: 0 !important;
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
    <!-- Register Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document"> <!-- 👈 scrollable added -->
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

                            <label><b>Select Gender</b></label><br>
                            <input type="radio" value="male" name="reg_gender_txt" required> Male
                            <input type="radio" value="female" name="reg_gender_txt" style="margin-left:5%;" required> Female
                            <input type="radio" value="others" name="reg_gender_txt" style="margin-left:5%;" required> Others

                            <br><br>

                            <label for="psw"><b>Password</b></label>
                            <input type="password" style="border-radius: 30px;" placeholder="Enter Password" name="reg_psw" id="psw" required>

                            <label for="psw-repeat"><b>Repeat Password</b></label>
                            <input type="password" style="border-radius: 30px;" placeholder="Repeat Password" name="psw_repeat" id="psw-repeat" required>

                            <button type="submit" class="btn" name="btn_reg" style="background-color:darkcyan; color:white">Register</button>
                            <hr>
                        </div>
                        <div class="container">
                            <p>Already have an account?
                                <a data-toggle="modal" data-target="#modelId1" style="color:gray; cursor:pointer;">Log In</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Login Modal -->
    <!-- Login Modal -->
    <div class="modal fade" id="modelId1" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document"> <!-- 👈 scrollable added -->
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
                        <div class="container signin">
                            <p>Don't have an account?
                                <a data-toggle="modal" data-target="#modelId" style="color: gray; cursor:pointer;">Register</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Switch from Login to Register
            $('[data-target="#modelId"]').on('click', function(e) {
                $('#modelId1').modal('hide');
                setTimeout(function() {
                    $('#modelId').modal('show');
                }, 400);
            });

            // Switch from Register to Login
            $('[data-target="#modelId1"]').on('click', function(e) {
                $('#modelId').modal('hide');
                setTimeout(function() {
                    $('#modelId1').modal('show');
                }, 400);
            });

            // Auto focus first input when modal is opened
            $('#modelId, #modelId1').on('shown.bs.modal', function() {
                $(this).find('input:first').trigger('focus');
            });
        });
    </script>

</body>

</html>