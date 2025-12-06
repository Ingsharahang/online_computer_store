<?php
require_once "db.php";
require_once "header.php";
require_once "auth.php";

require_login();

$uid = $_SESSION['user_id'];

$sql = "SELECT * FROM orders WHERE user_id = ? ORDER BY order_date DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i",$uid);
$stmt->execute();
$result = $stmt->get_result();
?>

<h3 class="mb-4">My Orders</h3>

<?php if ($result->num_rows == 0): ?>
    <div class="alert alert-info">You have not placed any orders yet.</div>
<?php else: ?>

<table class="table table-bordered">
    <tr>
        <th>Order ID</th>
        <th>Total Price</th>
        <th>Date</th>
        <th></th>
    </tr>

    <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id']; ?></td>
            <td>$<?= $row['total_price']; ?></td>
            <td><?= $row['order_date']; ?></td>
            <td>
                <a href="order_details.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-dark">
                    View
                </a>
            </td>
        </tr>
    <?php endwhile; ?>

</table>

<?php endif; ?>

<?php require_once "footer.php"; ?>
