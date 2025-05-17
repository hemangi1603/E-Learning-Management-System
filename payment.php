<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['order_id'] = $_POST['ORDER_ID'];
    $_SESSION['txn_amount'] = $_POST['TXN_AMOUNT'];
    $_SESSION['stu_email'] = $_POST['CUST_ID']; // Optional
} else {
    // Redirect back if no POST data is received
    header("Location: checkout.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }
        .payment-form {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .payment-form h2 {
            text-align: center;
        }
        .payment-form label {
            display: block;
            margin-top: 10px;
        }
        .payment-form input,
        .payment-form select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
        }
        .payment-form button {
            margin-top: 20px;
            width: 100%;
            padding: 12px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <form class="payment-form" action="paymentdone.php" method="POST">
        <h2>Make a Payment</h2>
        <input type="hidden" name="ORDER_ID" value="<?php echo $_SESSION['order_id']; ?>">
<input type="hidden" name="TXN_AMOUNT" value="<?php echo $_SESSION['txn_amount']; ?>">

        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>

        <label for="card">Card Number</label>
        <input type="text" id="card" name="card_number" maxlength="16" required>

        <label for="expiry">Expiry Date</label>
        <input type="month" id="expiry" name="expiry_date" required>

        <label for="cvv">CVV</label>
        <input type="password" id="cvv" name="cvv" maxlength="4" required>

        <label for="method">Payment Method</label>
        <select id="method" name="payment_method" required>
            <option value="">Select</option>
            <option value="credit">Credit Card</option>
            <option value="debit">Debit Card</option>
            <option value="upi">UPI</option>
            <option value="netbanking">Net Banking</option>
        </select>

        <button type="submit">Pay Now</button>
    </form>
</body>
</html>
