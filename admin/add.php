<?php
require_once "../db.php";
require_once "../header.php";
require_once "../auth.php";

require_admin();

$msg = "";

if($_POST){
    $sql = "INSERT INTO products (name,description,price,image_url,category,stock)
            VALUES (?,?,?,?,?,?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdssi",
        $_POST['name'],
        $_POST['description'],
        $_POST['price'],
        $_POST['image_url'],
        $_POST['category'],
        $_POST['stock']
    );

    if($stmt->execute()){
        $msg = "Product added successfully!";
    }
}
?>

<h3 class="mb-3">Add Product</h3>

<?php if($msg): ?>
    <div class="alert alert-success"><?= $msg ?></div>
<?php endif; ?>

<form method="post">

<input class="form-control mb-2" name="name" placeholder="Name" required>

<textarea class="form-control mb-2" name="description" placeholder="Description"></textarea>

<input class="form-control mb-2" name="price" type="number" step="0.01" placeholder="Price" required>

<input class="form-control mb-2" name="image_url" placeholder="Image URL" required>

<input class="form-control mb-2" name="category" placeholder="Category">

<input class="form-control mb-2" name="stock" type="number" min="0" step="1" placeholder="Stock">

<button class="btn btn-dark">Save</button>

</form>

<?php require_once "../footer.php"; ?>
