-- DATABASE SCHEMA UPDATES FOR eSEWA PAYMENT INTEGRATION
-- Run these SQL queries to update your booking table

-- Step 1: Add payment_status column (if not exists)
ALTER TABLE booking ADD COLUMN payment_status VARCHAR(50) DEFAULT 'pending' AFTER total_amnt;

-- Step 2: Add payment_method column (if not exists)
ALTER TABLE booking ADD COLUMN payment_method VARCHAR(50) DEFAULT 'counter' AFTER payment_status;

-- Step 3: Optional - Add transaction_id column for storing eSewa transaction reference
ALTER TABLE booking ADD COLUMN transaction_id VARCHAR(255) DEFAULT NULL AFTER payment_method;

-- Step 4: Optional - Add payment_date column to track when payment was made
ALTER TABLE booking ADD COLUMN payment_date DATETIME DEFAULT NULL AFTER transaction_id;

-- =====================================================
-- ALTERNATIVE: If you want to run this as a single query (recommended)
-- =====================================================
-- First, check current booking table structure:
-- DESCRIBE booking;

-- Then run the ALTER statements above one by one, or:
-- Create a new booking table with the new structure and migrate data:

ALTER TABLE booking MODIFY COLUMN total_amnt DECIMAL(10, 2);
ALTER TABLE booking ADD COLUMN payment_status VARCHAR(50) DEFAULT 'pending';
ALTER TABLE booking ADD COLUMN payment_method VARCHAR(50) DEFAULT 'counter';
ALTER TABLE booking ADD COLUMN transaction_id VARCHAR(255) DEFAULT NULL;
ALTER TABLE booking ADD COLUMN payment_date DATETIME DEFAULT NULL;

-- =====================================================
-- SAMPLE QUERIES FOR TESTING
-- =====================================================

-- Check all bookings with payment status:
-- SELECT id, no_ticket, total_amnt, payment_status, payment_method, payment_date FROM booking;

-- Check pending payments (need to collect from counter):
-- SELECT id, no_ticket, total_amnt FROM booking WHERE payment_method = 'counter' AND payment_status = 'pending';

-- Check completed eSewa payments:
-- SELECT id, no_ticket, total_amnt, transaction_id, payment_date FROM booking WHERE payment_method = 'esewa' AND payment_status = 'completed';

-- Update a specific booking's payment status:
-- UPDATE booking SET payment_status = 'completed', payment_date = NOW() WHERE id = 1 AND payment_method = 'counter';
