<?php
session_start();

// Redirect if admin is not logged in
if (empty($_SESSION["admin_username"])) {
    header("Location: index.php");
    exit();
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>Admin Panel - Online Movie Ticket</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>

    <nav class="navbar navbar-expand-md navbar-dark" style="background-color: #000;">
        <a class="navbar-brand" href="dashboard.php">
            <img src="../Images/Clapperboard.jpeg" alt="Logo" style="height: 40px;">
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <h5><a class="nav-link" href="dashboard.php">Admin Panel - Online Movie Ticket Booking</a></h5>
                </li>
            </ul>

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

</body>
</html>
