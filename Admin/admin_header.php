<?php
session_start();

if (empty($_SESSION["admin_username"])) {
    header("Location: index.php");
    exit();
}
?>
    <!doctype html>
    <html lang="en">

    <head>
        <title>Admin Panel - Online Movie Ticket</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>

    <body>

        <nav class="navbar navbar-expand-md navbar-dark" style="background-color: #000;">
            <a class="navbar-brand" href="index.php">
                <img src="../Images/Clapperboard.jpeg" alt="Logo" style="height: 40px;">
            </a>
            <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <h5>
                        <li class="nav-item"><a class="nav-link" href="dashboard.php">Admin Panel Online Movie Ticket Booking</a></li>
                    </h5>
                </ul>

                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>

         <section>
            <div class="continer">
                <div class="row">
                    <div class="col-md-2" style="background-color:#343a40;">
                    <?php include("admin_sidenavbar.php");?>
                    </div>
                
                    <div class="col-md-10">
                        <h5>Admin Dashboard</h5>


        
