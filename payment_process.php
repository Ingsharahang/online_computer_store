<?php
session_start();
require_once "db.php";

if (!isset($_POST['total'])) {
    header("Location: checkout.php");
    exit;
}

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$total = $_POST['total'];

// 1. Insert into orders table
$sql = "INSERT INTO orders (user_id, total_price, order_date) VALUES (?, ?, NOW())";
$stmt = $conn->prepare($sql);
$stmt->bind_param("id", $user_id, $total);
$stmt->execute();

// get new order ID
$order_id = $conn->insert_id;

// 2. Insert order items
$sql = "SELECT cart.product_id, cart.quantity, products.price 
        FROM cart 
        JOIN products ON cart.product_id = products.id
        WHERE cart.user_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i",$user_id);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $pid = $row['product_id'];
    $qty = $row['quantity'];
    $price = $row['price'];

    $sql2 = "INSERT INTO order_items (order_id, product_id, quantity, price) 
             VALUES (?, ?, ?, ?)";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->bind_param("iiid", $order_id, $pid, $qty, $price);
    $stmt2->execute();
}

// 3. clear cart
$sql = "DELETE FROM cart WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i",$user_id);
$stmt->execute();

// redirect to success page
header("Location: payment_success.php?order=".$order_id);
exit;
