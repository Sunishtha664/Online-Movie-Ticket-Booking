<?php
session_start();
include("conn.php");
// optional config
if (file_exists(__DIR__ . '/esewa_config.php')) include_once(__DIR__ . '/esewa_config.php');

$conn = new connec();

// Fallback credentials if config not present
if (!defined('ESEWA_GATEWAY_URL')) define('ESEWA_GATEWAY_URL', 'https://uat.esewa.com.np/api/epay/main/v2/form');
if (!defined('ESEWA_MERCHANT_CODE')) define('ESEWA_MERCHANT_CODE', 'EPAYTEST');
if (!defined('ESEWA_MERCHANT_SECRET')) define('ESEWA_MERCHANT_SECRET', '8gBm/:&EnhH.1/q');

if (!isset($_SESSION["booking_id"])) {
    header("Location: booking.php");
    exit();
}

$booking_id = $_SESSION["booking_id"];
$total_amount = $_SESSION["booking_total"];
$customer_id = $_SESSION["cust_id"];

// Get booking details
$booking_result = $conn->select_by_query("SELECT * FROM booking WHERE id = $booking_id");
$booking = $booking_result->fetch_assoc();

// Unique transaction code
$transaction_uuid = md5(time() . $booking_id . $customer_id);

// Create signature
$message = "total_amount=$total_amount,transaction_uuid=$transaction_uuid,product_code=EPAYTEST";
$signature = hash_hmac('sha256', $message, ESEWA_MERCHANT_SECRET, true);
$signature_base64 = base64_encode($signature);

// Store transaction info in session for verification
$_SESSION["esewa_uuid"] = $transaction_uuid;
$_SESSION["esewa_amount"] = $total_amount;

    // Prepare form for auto-submission
?>
<!DOCTYPE html>
<html>
<head>
    <title>Processing eSewa Payment...</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f5f5f5;
        }
        .container {
            text-align: center;
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .spinner {
            border: 4px solid #f3f3f3;
            border-top: 4px solid darkcyan;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
            margin: 20px auto;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Processing eSewa Payment...</h2>
        <div class="spinner"></div>
        <p>Please wait while we redirect you to eSewa for payment.</p>
        <p style="color: #666; font-size: 14px;">Amount: Rs. <?php echo $total_amount; ?></p>
        <p style="color: #666; font-size: 14px;">Booking ID: #<?php echo $booking_id; ?></p>
    </div>

    <!-- eSewa Payment Form - Auto Submit -->
    <form id="esewa_form" action="<?php echo ESEWA_GATEWAY_URL; ?>" method="POST" target="_blank">
        <input type="hidden" name="amount" value="<?php echo $total_amount; ?>">
        <input type="hidden" name="tax_amount" value="0">
        <input type="hidden" name="total_amount" value="<?php echo $total_amount; ?>">
        <input type="hidden" name="transaction_uuid" value="<?php echo $transaction_uuid; ?>">
        <input type="hidden" name="product_code" value="EPAYTEST">
        <input type="hidden" name="product_service_charge" value="0">
        <input type="hidden" name="product_delivery_charge" value="0">
        <input type="hidden" name="success_url" value="<?php echo "http://" . $_SERVER['HTTP_HOST'] . "/Online-Movie-Ticket-Booking/payment_success.php"; ?>">
        <input type="hidden" name="failure_url" value="<?php echo "http://" . $_SERVER['HTTP_HOST'] . "/Online-Movie-Ticket-Booking/payment_failure.php"; ?>">
        <input type="hidden" name="signed_field_names" value="total_amount,transaction_uuid,product_code">
        <input type="hidden" name="signature" value="<?php echo $signature_base64; ?>">
        <input type="hidden" name="merchant_code" value="<?php echo ESEWA_MERCHANT_CODE; ?>">
    </form>
    </form>

    <div style="text-align:center; margin-top:20px;">
        <p style="color:#666;">If your browser fails to reach eSewa (some test endpoints are unreachable from local networks), use one of the developer shortcuts below to simulate a result.</p>
        <div style="display:flex; gap:12px; justify-content:center; max-width:600px; margin:0 auto;">
            <a href="payment_success.php?transaction_uuid=<?php echo urlencode($transaction_uuid); ?>&status=COMPLETE&product_code=EPAYTEST&total_amount=<?php echo urlencode($total_amount); ?>" class="btn" style="background-color:#2ecc71; color:#fff; padding:10px 14px; border-radius:6px; text-decoration:none;">Simulate Success</a>
            <a href="payment_failure.php?status=FAILED" class="btn" style="background-color:#e74c3c; color:#fff; padding:10px 14px; border-radius:6px; text-decoration:none;">Simulate Failure</a>
            <button id="open_gateway" class="btn" style="background-color:#3498db; color:#fff; padding:10px 14px; border-radius:6px; border:none;">Open eSewa (new tab)</button>
        </div>
        <p style="color:#999; font-size:12px; margin-top:8px;">Use the "Open eSewa" button to try opening the gateway in a new tab; if DNS fails, use simulate buttons.</p>
    </div>

    <script>
        // Try to auto-submit form; also provide fallback actions
        try {
            document.getElementById('esewa_form').submit();
        } catch (e) {
            // ignore
        }

        document.getElementById('open_gateway').addEventListener('click', function(e){
            e.preventDefault();
            var w = window.open('', '_blank');
            var form = document.getElementById('esewa_form');
            // submit the form to the new window by setting target
            form.target = w.name || '_blank';
            form.submit();
        });
    </script>
</body>
</html>
