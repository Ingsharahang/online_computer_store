<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Online Computer Store</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="/online_store/css/bootstrap.min.css">

    <?php
    // Determine project root automatically regardless of directory depth
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://";
    $host = $_SERVER['HTTP_HOST'];
    $path = explode("/", $_SERVER['PHP_SELF']);
    array_pop($path); // remove current file
    $base = implode("/", $path);

    // remove admin or other nested folders
    $base = preg_replace('/\/admin.*/', '', $base);
    $BASE_URL = $protocol . $host . $base;

?>
<link rel="stylesheet" href="<?= $protocol . $host . $base ?>/css/style.css">


</head>

<body class="bg-light">

<nav class="navbar navbar-expand-lg hybrid-nav sticky-top shadow-sm">
    <div class="container">

        <!-- LOGO -->
        <a class="navbar-brand hybrid-brand d-flex align-items-center" href="/online_store/index.php">
            <span>Computer Store</span>
        </a>

        <!-- MOBILE TOGGLE -->
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- MENU -->
        <div class="collapse navbar-collapse" id="navMenu">

            <!-- LEFT NAV -->
            <ul class="navbar-nav me-auto hybrid-left">

                <li class="nav-item">
                    <a class="nav-link" href="products.php"> Products
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/online_store/cart.php"></i> Cart
                    </a>
                </li>

                <?php if (isset($_SESSION['user_id']) && empty($_SESSION['is_admin'])): ?>
                    <!-- USER ORDERS -->
                    <li class="nav-item">
                        <a class="nav-link" href="/online_store/orders.php">
                            Orders
                        </a>
                    </li>
                <?php endif; ?>

                <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1): ?>
                    <!-- ADMIN ORDERS -->
                    <li class="nav-item">
                        <a class="nav-link" href="/online_store/admin/orders.php">
                            Orders
                        </a>
                    </li>
                <?php endif; ?>


                <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/online_store/admin/dashboard.php">
                        Admin
                        </a>
                    </li>
                <?php endif; ?>

            </ul>

            <!-- USER -->
            <?php if (isset($_SESSION['user_id'])): ?>
                <span class="navbar-text hybrid-user d-none d-lg-block">
                    Hi, <?= $_SESSION['user_name'] ?? 'User'; ?>
                </span>
            <?php endif; ?>

            <!-- RIGHT NAV -->
            <ul class="navbar-nav hybrid-right">

                <?php if (!isset($_SESSION['user_id'])): ?>

                    <li class="nav-item">
                        <a class="nav-link" href="login.php">
                            Login
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="register.php">
                           Register
                        </a>
                    </li>

                <?php else: ?>

                    <li class="nav-item">
                        <a class="nav-link logout-link" href="/online_store/logout.php">
                           Logout
                        </a>
                    </li>

                <?php endif; ?>

            </ul>
        </div>

    </div>
</nav>

<div class="container site-footer">
