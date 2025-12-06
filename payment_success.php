<?php
require_once "header.php";

$order = $_GET['order'] ?? null;
?>

<div class="container py-5 text-center">

    <div class="alert alert-success p-4 shadow-sm">
        <h3 class="fw-bold mb-2">Payment Successful!</h3>
        <p>Your order has been placed.</p>

        <?php if ($order): ?>
            <p class="fw-bold">Order #: <?= $order ?></p>
        <?php endif; ?>
    </div>

    <a href="orders.php" class="btn btn-dark mt-3">View My Orders</a>

</div>

<?php require_once "footer.php"; ?>
