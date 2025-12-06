<?php
require_once "../db.php";
require_once "../header.php";
require_once "../auth.php";

require_admin();

$id = $_GET['id'];

$sql = "SELECT * FROM products WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i",$id);
stmt->execute();
$product = $stmt->get_result()->fetch_assoc();

if(!$product){
    echo "<div class='alert alert-danger'>Product not found.</div>";
    require_once "../footer.php";
    exit;
}

if($_POST){

    $sql = "UPDATE products SET name=?,description=?,price=?,image_url=?,category=?,stock=? WHERE id=?";

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

    if($stmt->execute()){
        header("Location: products.php");
        exit;
    }
}
?>

<h3 class="mb-3">Edit Product</h3>

<form method="post">

<input class="form-control mb-2" name="name" value="<?= $product['name']; ?>">

<textarea class="form-control mb-2" name="description"><?= $product['description']; ?></textarea>

<input class="form-control mb-2" name="price" value="<?= $product['price']; ?>">

<input class="form-control mb-2" name="image_url" value="<?= $product['image_url']; ?>">

<input class="form-control mb-2" name="category" value="<?= $product['category']; ?>">

<input class="form-control mb-2" name="stock" type="number" value="<?= $product['stock']; ?>">

<button class="btn btn-dark">Update</button>

</form>

<?php require_once "../footer.php"; ?>
