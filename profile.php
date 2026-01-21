<?php
session_start();
include("conn.php");
$conn = new connec();

// Check if user is logged in
if (empty($_SESSION["cust_id"])) {
    header("Location: index.php");
    exit();
}

$customer_id = $_SESSION["cust_id"];

// Fetch customer data
$sql = "SELECT * FROM customer WHERE id = $customer_id";
$result = $conn->conn->query($sql);

if ($result->num_rows == 0) {
    header("Location: index.php");
    exit();
}

$customer = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - Movie Ticket Booking</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
            min-height: 100vh;
            color: #fff;
            margin: 0 !important;
            padding: 0 !important;
            padding-top: 0 !important;
        }

        .profile-container {
            max-width: 600px;
            margin: 30px auto;
            background: rgba(0, 0, 0, 0.7);
            border: 2px solid darkcyan;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 8px 32px rgba(0, 255, 255, 0.2);
        }

        .profile-header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid darkcyan;
            padding-bottom: 20px;
        }

        .profile-header h2 {
            color: #00ffff;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .profile-header p {
            color: #999;
            font-size: 14px;
        }

        .profile-avatar {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, darkcyan, #00ffff);
            border-radius: 50%;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            color: #000;
        }

        .form-group label {
            color: #00ffff;
            font-weight: 600;
            margin-top: 15px;
        }

        .form-control {
            background-color: rgba(255, 255, 255, 0.1);
            border: 1px solid darkcyan;
            color: #fff;
            border-radius: 8px;
            padding: 12px 15px;
            transition: all 0.3s;
        }

        .form-control:focus {
            background-color: rgba(255, 255, 255, 0.15);
            border-color: #00ffff;
            color: #fff;
            box-shadow: 0 0 10px rgba(0, 255, 255, 0.3);
        }

        .form-control::placeholder {
            color: #666;
        }

        .info-box {
            background: rgba(0, 255, 255, 0.1);
            border-left: 4px solid darkcyan;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .info-box strong {
            color: #00ffff;
        }

        .btn-update {
            background: linear-gradient(135deg, darkcyan, #00ffff);
            color: #000;
            border: none;
            padding: 12px 30px;
            border-radius: 25px;
            font-weight: bold;
            width: 100%;
            margin-top: 20px;
            transition: all 0.3s;
        }

        .btn-update:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(0, 255, 255, 0.4);
            color: #000;
            text-decoration: none;
        }

        .btn-back {
            background: transparent;
            color: #00ffff;
            border: 2px solid darkcyan;
            padding: 10px 20px;
            border-radius: 25px;
            font-weight: bold;
            margin-top: 15px;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-back:hover {
            background: darkcyan;
            color: #000;
            text-decoration: none;
        }

        .alert {
            border-radius: 8px;
            margin-bottom: 20px;
            border: 1px solid;
        }

        .alert-success {
            background: rgba(46, 204, 113, 0.1);
            border-color: #2ecc71;
            color: #2ecc71;
        }

        .alert-danger {
            background: rgba(231, 76, 60, 0.1);
            border-color: #e74c3c;
            color: #e74c3c;
        }

        .gender-options {
            display: flex;
            gap: 20px;
        }

        .form-check {
            margin-top: 10px;
        }

        .form-check-label {
            color: #fff;
            margin-left: 5px;
        }

        .form-check-input {
            border-color: darkcyan;
        }

        .form-check-input:checked {
            background-color: darkcyan;
            border-color: darkcyan;
        }

        .info-box {
            background: rgba(0, 255, 255, 0.1);
            border-left: 4px solid darkcyan;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            color: #fff;
        }

        .info-box strong {
            color: #00ffff;
            display: block;
            margin-bottom: 8px;
        }

        .info-box p {
            color: #ccc;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <?php include("header.php"); ?>

    <div class="profile-container">
        <div class="profile-header">
            <div class="profile-avatar">
                <i class="fa fa-user"></i>
            </div>
            <h2><?php echo htmlspecialchars($customer["fullname"]); ?></h2>
            <p>Customer ID: #<?php echo $customer["id"]; ?></p>
        </div>

        <div class="info-box">
            <strong><i class="fa fa-envelope"></i> Email Address</strong>
            <p style="margin: 5px 0 0 0;"><?php echo htmlspecialchars($customer["email"]); ?></p>
        </div>

        <div class="info-box">
            <strong><i class="fa fa-phone"></i> Phone Number</strong>
            <p style="margin: 5px 0 0 0;"><?php echo htmlspecialchars($customer["cellno"]); ?></p>
        </div>

        <div class="info-box">
            <strong><i class="fa fa-transgender"></i> Gender</strong>
            <p style="margin: 5px 0 0 0;"><?php echo ucfirst(htmlspecialchars($customer["gender"])); ?></p>
        </div>

        <a href="index.php" class="btn-back">
            <i class="fa fa-arrow-left"></i> Back to Home
        </a>
    </div>

    <?php include("footer.php"); ?>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
