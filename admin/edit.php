<?php
require_once "../db.php";
require_once "../header.php";
require_once "../auth.php";

require_admin();

// Get product ID safely
$id = $_GET['id'] ?? 0;

// Fetch product
$sql = "SELECT * FROM products WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$product = $stmt->get_result()->fetch_assoc();

if (!$product) {
    echo "<div class='alert alert-danger'>Product not found.</div>";
    require_once "../footer.php";
    exit;
}

// Handle form submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $sql = "UPDATE products 
            SET name=?, description=?, price=?, image_url=?, category=?, stock=? 
            WHERE id=?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("ssdssii",
        $_POST['name'],
        $_POST['description'],
        $_POST['price'],
        $_POST['image_url'],
        $_POST['category'],
        $_POST['stock'],
        $id
    );

    if ($stmt->execute()) {
        header("Location: products.php?msg=updated");
        exit;
    } else {
        echo "<div class='alert alert-danger'>Failed to update product.</div>";
    }
}
?>

<h3 class="mb-3">Edit Product</h3>

<form method="post">

    <input class="form-control mb-2" name="name" value="<?= htmlspecialchars($product['name']); ?>">

    <textarea class="form-control mb-2" name="description"><?= htmlspecialchars($product['description']); ?></textarea>

    <input class="form-control mb-2" name="price" type="number" step="0.01" value="<?= $product['price']; ?>">

    <input class="form-control mb-2" name="image_url" value="<?= htmlspecialchars($product['image_url']); ?>">

    <input class="form-control mb-2" name="category" value="<?= htmlspecialchars($product['category']); ?>">

    <input class="form-control mb-2" name="stock" type="number" min="0" value="<?= $product['stock']; ?>">

    <button class="btn btn-dark">Update</button>

</form>

<?php require_once "../footer.php"; ?>
