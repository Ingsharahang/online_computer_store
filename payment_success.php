<?php
require_once "header.php";

$total = $_GET['total'] ?? 0;
?>

<div class="container py-5 text-center" style="max-width:600px;">

    <div class="alert alert-success p-4 shadow-sm">
        <h3 class="fw-bold mb-2">Payment Successful!</h3>
        <p class="mb-4">Your order has been placed.</p>
        <h4 class="fw-bold text-success">$<?= number_format($total,2) ?></h4>
    </div>

    <a href="products.php" class="btn btn-dark mt-3">Continue Shopping</a>

</div>

<?php require_once "footer.php"; ?>
