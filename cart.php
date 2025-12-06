<?php
require_once "db.php";
require_once "header.php";
require_once "auth.php";

require_login();

$uid = $_SESSION['user_id'];

// update quantities
if(isset($_POST['update'])) {
    foreach($_POST['qty'] as $cid => $q){
        if($q <= 0){
            $conn->query("DELETE FROM cart WHERE id=$cid");
        } else {
            $conn->query("UPDATE cart SET quantity=$q WHERE id=$cid");
        }
    }
}

// remove item
if(isset($_GET['del'])){
    $cid = $_GET['del'];
    $conn->query("DELETE FROM cart WHERE id=$cid");
}

// fetch cart items
$sql = "SELECT cart.id, products.name, products.price, cart.quantity
        FROM cart
        JOIN products ON cart.product_id = products.id
        WHERE cart.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i",$uid);
$stmt->execute();
$result = $stmt->get_result();

$total = 0;
?>

<h3 class="mb-4">My Cart</h3>

<form method="post">

<table class="table table-bordered">
    <tr>
        <th>Product</th>
        <th>Price</th>
        <th width="130">Quantity</th>
        <th>Subtotal</th>
        <th></th>
    </tr>

    <?php while ($row = $result->fetch_assoc()): 
        $sub = $row['price'] * $row['quantity'];
        $total += $sub;
    ?>
    <tr>
        <td><?= $row['name']; ?></td>
        <td>$<?= $row['price']; ?></td>

        <td>
            <input type="number"
                   class="form-control"
                   name="qty[<?= $row['id']; ?>]"
                   value="<?= $row['quantity']; ?>"
                   min="0">
        </td>

        <td>$<?= $sub; ?></td>

        <td>
            <a href="cart.php?del=<?= $row['id']; ?>" 
               class="btn btn-sm btn-danger">X</a>
        </td>
    </tr>
    <?php endwhile; ?>

</table>

<button name="update" class="btn btn-dark">Update Cart</button>

</form>

<hr>

<h4>Total: <span class="text-success">$<?= $total; ?></span></h4>

<?php if ($total > 0): ?>
    <a href="checkout.php" class="btn btn-success">Proceed to Checkout</a>
<?php endif; ?>

<?php require_once "footer.php"; ?>
