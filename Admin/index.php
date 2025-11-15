<?php
session_start();
$error = "";

// If already logged in, go to dashboard
if (!empty($_SESSION["admin_username"])) {
    header("Location: dashboard.php");
    exit();
}

if (isset($_POST["btn_login"])) {

    $email_id = $_POST["log_email"];
    $paswrd_log = $_POST["log_psw"];

    if ($email_id === "admin@gmail.com") {
        if ($paswrd_log === "admin1234") {

            // STORE SESSION HERE (THIS WAS MISSING)
            $_SESSION["admin_username"] = "admin";

            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Invalid Password";
        }
    } else {
        $error = "Invalid Email";
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>Admin Panel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6" style="margin:auto;">
                <form action="" method="post">
                    <div class="container" style="color: #343a40;">
                        <center><h1>Admin LogIn</h1></center>
                        <hr>

                        <label><b>Email</b></label>
                        <input type="email" placeholder="Enter Email" name="log_email" required>

                        <label><b>Password</b></label>
                        <input type="password" placeholder="Enter Password" name="log_psw" required>

                        <button type="submit" name="btn_login" class="btn btn-info">Login</button>
                    </div>
                </form>

                <p style="color:maroon; font-weight:bold"><?php echo $error; ?></p>
            </div>
        </div>
    </div>
</body>
</html>
