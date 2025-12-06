<?php
require_once "db.php";
require_once "header.php";

// must be logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// cart items
$sql = "SELECT cart.quantity, products.price 
        FROM cart 
        JOIN products ON cart.product_id = products.id
        WHERE cart.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i",$user_id);
$stmt->execute();
$result = $stmt->get_result();

$subtotal = 0;

while ($row = $result->fetch_assoc()) {
    $subtotal += $row['quantity'] * $row['price'];
}

// fees
$shipping = 9.99;
$tax = $subtotal * 0.13;
$total = $subtotal + $shipping + $tax;

?>

<div class="container py-5" style="max-width:700px;">

    <h3 class="mb-4 fw-bold">Checkout</h3>

    <div class="card p-4 shadow-sm">

        <h5 class="fw-bold mb-3">Order Summary</h5>

        <div class="d-flex justify-content-between"><span>Subtotal:</span> <span>$<?= number_format($subtotal,2) ?></span></div>
        <div class="d-flex justify-content-between"><span>Shipping:</span> <span>$<?= number_format($shipping,2) ?></span></div>
        <div class="d-flex justify-content-between"><span>Tax (13%):</span> <span>$<?= number_format($tax,2) ?></span></div>

        <hr>

        <div class="d-flex justify-content-between fw-bold fs-5">
            <span>Total:</span>
            <span>$<?= number_format($total,2) ?></span>
        </div>

        <button class="btn btn-dark w-100 mt-4" id="payBtn">
            Pay with Debit / Credit
        </button>

    </div>
</div>

<!-- Payment Modal -->
<div class="modal fade" id="paymentModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content p-3">

      <h5 class="fw-bold mb-3 text-center">Payment Details</h5>

      <form action="payment_process.php" method="POST">

        <input type="hidden" name="total" value="<?= $total ?>">

        <div class="mb-3">
            <label class="form-label">Card Number</label>
            <input type="text" class="form-control" name="card_number" required placeholder="xxxx xxxx xxxx xxxx" maxlength="19">
        </div>

        <div class="row mb-3">
          <div class="col">
            <label class="form-label">Expiry</label>
            <input type="text" class="form-control" name="expiry" required placeholder="MM/YY" maxlength="5">
          </div>

          <div class="col">
            <label class="form-label">CVV</label>
            <input type="password" class="form-control" name="cvv" required placeholder="***" maxlength="3">
          </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Name on Card</label>
            <input type="text" class="form-control" name="card_name" required>
        </div>

        <button class="btn btn-primary w-100">
            Pay $<?= number_format($total,2) ?>
        </button>

      </form>

      <button class="btn btn-light w-100 mt-2" data-bs-dismiss="modal">Cancel</button>

    </div>
  </div>
</div>

<script>
document.getElementById("payBtn").addEventListener("click", function(){
    let modal = new bootstrap.Modal(document.getElementById("paymentModal"));
    modal.show();
});
</script>

<?php require_once "footer.php"; ?>
