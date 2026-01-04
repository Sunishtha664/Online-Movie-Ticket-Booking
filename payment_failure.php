<?php
session_start();
include("header.php");
include("conn.php");

$conn = new connec();

// Get error details from eSewa response
$status = isset($_GET['status']) ? $_GET['status'] : 'FAILED';
$booking_id = isset($_SESSION['booking_id']) ? $_SESSION['booking_id'] : '';

// Update booking with failed payment status
if ($booking_id) {
    $sql = "UPDATE booking SET payment_status = 'failed', payment_method = 'esewa' WHERE id = $booking_id";
    $conn->update($sql, "Payment Status Updated");
}
?>

<section class="mt-5">
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 500px;">
        <div class="card shadow p-5" style="max-width: 500px; width: 100%; border-radius: 15px; text-align: center;">
            <div style="color: #e74c3c; margin-bottom: 20px;">
                <i class="fa fa-times-circle" style="font-size: 80px;"></i>
            </div>
            <h2 style="color: #e74c3c; margin-bottom: 15px;">Payment Failed</h2>
            <p style="color: #666; font-size: 16px; margin-bottom: 20px;">
                Your payment could not be processed.
            </p>
            <div style="background-color: #fff3cd; padding: 15px; border-radius: 8px; margin: 20px 0; border-left: 4px solid #e74c3c;">
                <p style="color: #856404; margin: 0;">
                    <strong>Status:</strong> <?php echo htmlspecialchars($status); ?>
                </p>
            </div>
            <p style="color: #666; margin: 20px 0;">
                You can try again with a different payment method or pay at the counter.
            </p>
            
            <div style="display: flex; gap: 10px; justify-content: center; margin-top: 30px;">
                <a href="booking.php" class="btn" style="background-color: darkcyan; color: white; padding: 12px 25px; border-radius: 25px; text-decoration: none; flex: 1;">
                    <i class="fa fa-refresh"></i> Try Again
                </a>
                <a href="index.php" class="btn" style="background-color: #95a5a6; color: white; padding: 12px 25px; border-radius: 25px; text-decoration: none; flex: 1;">
                    <i class="fa fa-home"></i> Home
                </a>
            </div>

            <p style="color: #999; font-size: 13px; margin-top: 30px;">
                If you continue to experience issues, please contact our support team.
            </p>
        </div>
    </div>
</section>

<?php
include("footer.php");
?>
