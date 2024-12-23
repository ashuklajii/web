<?php
session_start();
include 'db_connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: user_login.php");
    exit;
}

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    $query = "UPDATE purchases SET is_canceled = TRUE WHERE purchase_id = '$order_id' AND user_id = '{$_SESSION['user_id']}'";
    $result = mysqli_query($conn, $query);

    if ($result) {
      
        header("Location: user_orders.php?status=success");
    } else {

        echo "Failed to cancel the order: " . mysqli_error($conn);
    }
} else {
    echo "Invalid order ID.";
}
?>
