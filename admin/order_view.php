<?php
require_once "../auth.php";
require_admin();

require_once "../db.php";
require_once "../header.php";

$order_id = $_GET['id'] ?? 0;

if(!is_numeric($order_id) || $order_id <= 0){
    echo "<div class='alert alert-danger'>Invalid order ID.</div>";
    require_once "../footer.php";
    exit;
}

// FETCH ORDER HEADER
$sql = "SELECT o.total_price, o.order_date, u.name
        FROM orders o
        JOIN users u ON o.user_id = u.id
        WHERE o.id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $order_id);
$stmt->execute();
$order = $stmt->get_result()->fetch_assoc();

if(!$order){
    echo "<div class='alert alert-danger'>Order not found.</div>";
    require_once "../footer.php";
    exit;
}
?>

<div class="container mb-4">

    <h3 class="mb-3">Order #<?= $order_id; ?></h3>

    <h5>Customer: <?= $order['name']; ?></h5>
    <h6>Total: $<?= number_format($order['total_price'], 2); ?></h6>
    <h6>Date: <?= $order['order_date']; ?></h6>

    <hr>

    <table class="table table-bordered">
        <tr>
            <th>Product</th>
            <th>Qty</th>
            <th>Price</th>
            <th>Subtotal</th>
        </tr>

    <?php
    $sql = "SELECT p.name, oi.quantity, oi.price
            FROM order_items oi
            JOIN products p ON oi.product_id = p.id
            WHERE oi.order_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()):
        $sub = $row['quantity'] * $row['price'];
    ?>
        <tr>
            <td><?= $row['name']; ?></td>
            <td><?= $row['quantity']; ?></td>
            <td>$<?= number_format($row['price'], 2); ?></td>
            <td>$<?= number_format($sub, 2); ?></td>
        </tr>

    <?php endwhile; ?>

    </table>

    <a href="orders.php" class="btn btn-dark">Back</a>

</div>

<?php require_once "../footer.php"; ?>
