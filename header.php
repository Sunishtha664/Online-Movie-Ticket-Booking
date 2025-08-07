<!doctype html>
<html lang="en">

<head>
    <title>Online Movie Ticket Booking</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="Images\Clapperboard.jpeg">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <style>
        * {
            box-sizing: border-box
        }

        /* Add padding to containers */
        .container {
            padding: 16px;
        }

        /* Full-width input fields */
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
            /* Added for rounded corners */
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
            /* Optional: blue focus ring */
        }

        /* Overwrite default styles of hr */
        hr {
            border: 1px solid #f1f1f1;
            margin-bottom: 25px;
        }

        /* Set a style for the submit/register button */
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

        /* Add a blue text color to links */
        a {
            color: dodgerblue;
        }

        /* Set a grey background color and center the text of the "sign in" section */
        .signin {
            background-color: #f1f1f1;
            text-align: center;
        }
    </style>

</head>

<body>

    <nav class="navbar navbar-expand-md navbar-dark" style="background-color: #343a40;">
        <a class="navbar-brand" href="index.php">
            <img src="Images\Clapperboard.jpeg" alt="Logo" style="height: 40px;">
        </a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item ">
                    <a class="nav-link" href="index.php">Home</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Movies</a>
                    <div class="dropdown-menu" aria-labelledby="dropdownId">
                        <a class="dropdown-item" href="#">Coming Soon</a>
                        <a class="dropdown-item" href="#">Now showing</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Offers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item"> <!-- Register Button trigger modal -->
                    <a class="nav-link" data-toggle="modal" data-target="#modelId">Register</a>
                </li>
                <li class="nav-item"><!-- Login Button trigger modal -->
                    <a class="nav-link" data-toggle="modal" data-target="#modelId1">Login</a>
                </li>
            </ul>
            <!-- <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="text" placeholder="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form> -->
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
                                <h1>Register</h1>
                                <p>Please fill in this form to create an account</p>
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
                <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    
            </div> -->
            </div>
        </div>
    </div>


    <!-- Login Modal -->
    <div class="modal fade" id="modelId1" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color:darkcyan; color:black">
                    <!-- <h5 class="modal-title">Login</h5> -->
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="container" style="color: #343a40;">
                            <center>
                                <h1>LogIn</h1>
                            </center>
                            <hr>

                            <label for="email"><b>Email</b></label>
                            <input type="email" style="border: radius 30px;" placeholder="Enter Email" name="email" id="email" required>
                            <label for="psw"><b>Password</b></label>
                            <input type="password" style="border: radius 30px;" placeholder="Enter Password" name="psw" id="psw" required>

                            <button type="submit" class="btn" style="background-color:darkcyan; color:white">Login</button>
                        </div>
                        <div class="container signin">
                            <p>Don't have an account? <a data-toggle="modal" data-target="#modelId" data-dismiss="modal" style="color: gray;">Sign Up</a>.</p>
                        </div>
                    </form>








                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn" style="background-color:darkcyan; color:white">Login</button>
                </div> -->
            </div>
        </div>
    </div>