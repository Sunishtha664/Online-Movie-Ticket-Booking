<?php
session_start();
include("header.php");
include("conn.php");

$conn = new connec();

// Get payment details from eSewa response
$transaction_uuid = isset($_GET['transaction_uuid']) ? $_GET['transaction_uuid'] : '';
$status = isset($_GET['status']) ? $_GET['status'] : '';
$product_code = isset($_GET['product_code']) ? $_GET['product_code'] : '';
$total_amount = isset($_GET['total_amount']) ? $_GET['total_amount'] : '';
$booking_id = isset($_SESSION['booking_id']) ? $_SESSION['booking_id'] : '';

$payment_successful = false;

// Verify payment with eSewa (optional but recommended)
if ($status == 'COMPLETE' && $transaction_uuid && $booking_id) {
    // Update booking with payment status
    $sql = "UPDATE booking SET payment_status = 'completed', payment_method = 'esewa' WHERE id = $booking_id";
    $conn->update($sql, "Payment Status Updated");
    
    $payment_successful = true;
    
    // Clear session variables
    unset($_SESSION['booking_id']);
    unset($_SESSION['booking_total']);
    unset($_SESSION['booking_seats']);
    unset($_SESSION['esewa_uuid']);
    unset($_SESSION['esewa_amount']);
}
?>

<section class="mt-5">
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 500px;">
        <div class="card shadow p-5" style="max-width: 500px; width: 100%; border-radius: 15px; text-align: center;">
            <?php if ($payment_successful): ?>
                <div style="color: #2ecc71; margin-bottom: 20px;">
                    <i class="fa fa-check-circle" style="font-size: 80px;"></i>
                </div>
                <h2 style="color: #2ecc71; margin-bottom: 15px;">Payment Successful!</h2>
                <p style="color: #666; font-size: 16px; margin-bottom: 10px;">
                    Your booking has been confirmed and payment received.
                </p>
                <div style="background-color: #f0f0f0; padding: 20px; border-radius: 8px; margin: 20px 0;">
                    <p style="color: #666; margin: 5px 0;">
                        <strong>Booking ID:</strong> #<?php echo htmlspecialchars($booking_id); ?>
                    </p>
                    <p style="color: #666; margin: 5px 0;">
                        <strong>Transaction ID:</strong> <?php echo htmlspecialchars(substr($transaction_uuid, 0, 20)); ?>...
                    </p>
                    <p style="color: #666; margin: 5px 0;">
                        <strong>Amount Paid:</strong> Rs. <?php echo htmlspecialchars($total_amount); ?>
                    </p>
                </div>
               
                <a href="index.php" class="btn" style="background-color: darkcyan; color: white; padding: 12px 30px; border-radius: 25px; text-decoration: none; margin-right: 10px;">
                    Back to Home
                </a>
                <a href="booking.php" class="btn" style="background-color: #3498db; color: white; padding: 12px 30px; border-radius: 25px; text-decoration: none;">
                    Book Another
                </a>
            <?php else: ?>
                <div style="color: #e74c3c; margin-bottom: 20px;">
                    <i class="fa fa-times-circle" style="font-size: 80px;"></i>
                </div>
                <h2 style="color: #e74c3c;">Payment Status: <?php echo htmlspecialchars($status); ?></h2>
                <p style="color: #666; font-size: 16px; margin: 20px 0;">
                    Thank you for your attempt. However, we could not verify your payment status.
                </p>
                <p style="color: #666; margin: 20px 0;">
                    Please contact our support team if you believe this is an error.
                </p>
                <a href="booking.php" class="btn" style="background-color: darkcyan; color: white; padding: 12px 30px; border-radius: 25px; text-decoration: none;">
                    Try Again
                </a>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php
include("footer.php");
?>
