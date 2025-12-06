<?php
require_once "db.php";
require_once "header.php";
require_once "auth.php";

require_login();

$order_id = $_GET['id'];
$uid = $_SESSION['user_id'];

// verify order belongs to logged in user
$sql = "SELECT * FROM orders WHERE id=? AND user_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii",$order_id,$uid);
$stmt->execute();
$order = $stmt->get_result()->fetch_assoc();

if(!$order){
    echo "<div class='alert alert-danger'>Order not found.</div>";
    require_once "footer.php";
    exit;
}
?>

<h3 class="mb-4">Order #<?= $order_id; ?></h3>

<h5>Total Paid: $<?= $order['total_price']; ?></h5>
<h6>Date: <?= $order['order_date']; ?></h6>

<hr>

<table class="table table-bordered">
    <tr>
        <th>Product</th>
        <th>Qty</th>
        <th>Price (each)</th>
        <th>Subtotal</th>
    </tr>

<?php
$sql = "SELECT products.name, order_items.quantity, order_items.price 
        FROM order_items 
        JOIN products ON order_items.product_id = products.id
        WHERE order_items.order_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i",$order_id);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()):
    $sub = $row['quantity'] * $row['price'];
?>
    <tr>
        <td><?= $row['name']; ?></td>
        <td><?= $row['quantity']; ?></td>
        <td>$<?= $row['price']; ?></td>
        <td>$<?= $sub; ?></td>
    </tr>

<?php endwhile; ?>

</table>

<a href="orders.php" class="btn btn-dark">Back to Orders</a>

<?php require_once "footer.php"; ?>
