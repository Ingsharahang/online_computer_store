<?php
require_once "../db.php";
require_once "../header.php";
require_once "../auth.php";

require_admin();

$result = $conn->query("SELECT * FROM products ORDER BY id DESC");
?>

<div class="d-flex justify-content-between mb-3">
    <h3>Products</h3>
    <a href="add.php" class="btn btn-dark">Add Product</a>
</div>

<table class="table table-bordered">
    <tr>
        <th>Name</th>
        <th>Price</th>
        <th>Stock</th>
        <th>Category</th>
        <th></th>
    </tr>

<?php while ($row = $result->fetch_assoc()): ?>
<tr>
    <td><?= $row['name']; ?></td>
    <td>$<?= $row['price']; ?></td>
    <td><?= $row['stock']; ?></td>
    <td><?= $row['category']; ?></td>
    <td>
        <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
        <a href="delete.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-danger"
           onclick="return confirm('Delete this product?')">
           Delete
        </a>
    </td>
</tr>
<?php endwhile; ?>

</table>

<?php require_once "../footer.php"; ?>
