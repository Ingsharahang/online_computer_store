<?php
require_once "../db.php";
require_once "../header.php";
require_once "../auth.php";

require_admin();

$result = $conn->query("
    SELECT orders.id, users.name, orders.total_price, orders.order_date
    FROM orders
    JOIN users ON orders.user_id = users.id
    ORDER BY orders.order_date DESC
");
?>

<h3 class="mb-4">All Orders</h3>

<table class="table table-bordered">
<tr>
    <th>Order ID</th>
    <th>Customer</th>
    <th>Total</th>
    <th>Date</th>
    <th></th>
</tr>

<?php while ($row = $result->fetch_assoc()): ?>
<tr>
    <td><?= $row['id']; ?></td>
    <td><?= $row['name']; ?></td>
    <td>$<?= $row['total_price']; ?></td>
    <td><?= $row['order_date']; ?></td>
    <td>
        <a href="order_view.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-dark">
            View
        </a>
    </td>
</tr>
<?php endwhile; ?>

</table>

<?php require_once "../footer.php"; ?>
