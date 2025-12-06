<?php
require_once "db.php";
require_once "header.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$id = $_GET['id'];

// fetch product
$sql = "SELECT * FROM products WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i",$id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

if(!$product) {
    echo "<div class='alert alert-danger'>Product not found.</div>";
    require_once "footer.php";
    exit;
}

$msg = "";

// add to cart
if(isset($_POST['add_cart'])) {

    if(!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit;
    }

    $uid = $_SESSION['user_id'];

    $sql = "INSERT INTO cart (user_id, product_id, quantity) 
            VALUES (?,?,1) 
            ON DUPLICATE KEY UPDATE quantity = quantity + 1";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii",$uid,$id);

    if($stmt->execute()){
        $msg = "Added to cart!";
    }
}
?>

<div class="row">

    <div class="col-md-5">
        <img src="<?= $product['image_url']; ?>" class="img-fluid mb-4">
    </div>

    <div class="col-md-7">
        <h3><?= $product['name']; ?></h3>
        <h4 class="text-success">$<?= $product['price']; ?></h4>
        <p><?= $product['description']; ?></p>

        <form method="post">
            <button name="add_cart" class="btn btn-dark">Add to Cart</button>
        </form>

        <?php if ($msg): ?>
            <div class="alert alert-success mt-3"><?= $msg ?></div>
        <?php endif; ?>

    </div>

</div>

<?php require_once "footer.php"; ?>
