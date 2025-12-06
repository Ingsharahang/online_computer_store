<?php
require_once "../db.php";
require_once "../auth.php";

require_admin();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

</head>
<body class="bg-light">

<div class="container mt-5">

    <h2 class="mb-4 text-center">Admin Dashboard</h2>

    <div class="row">

        <!-- Product Management -->
        <div class="col-md-4 mb-4">
            <a href="products.php" class="text-decoration-none text-dark">
                <div class="card shadow p-4 text-center">
                    <h4>Manage Products</h4>
                    <p>Add, edit, and delete products</p>
                </div>
            </a>
        </div>

        <!-- Order Management -->
        <div class="col-md-4 mb-4">
            <a href="orders.php" class="text-decoration-none text-dark">
                <div class="card shadow p-4 text-center">
                    <h4>View Orders</h4>
                    <p>See all customer orders</p>
                </div>
            </a>
        </div>

        <!-- Create Admin Account -->
        <div class="col-md-4 mb-4">
            <a href="register.php" class="text-decoration-none text-dark">
                <div class="card shadow p-4 text-center">
                    <h4>Create Admin</h4>
                    <p>Register new admin users</p>
                </div>
            </a>
        </div>

    </div>

    <div class="text-center mt-4">
        <a href="../logout.php" class="btn btn-danger">Logout</a>
    </div>

</div>

</body>
</html>
