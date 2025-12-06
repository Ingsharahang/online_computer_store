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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <?php
    // Determine project root automatically regardless of directory depth
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://";
    $host = $_SERVER['HTTP_HOST'];
    $path = explode("/", $_SERVER['PHP_SELF']);
    array_pop($path); // remove current file
    $base = implode("/", $path);

    // remove admin or other nested folders
    $base = preg_replace('/\/admin.*/', '', $base);
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
                    <a class="nav-link" href="products.php">
                        <i class="bi bi-grid"></i> Products
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/online_store/cart.php">
                        <i class="bi bi-cart"></i> Cart
                    </a>
                </li>

                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="orders.php">
                            <i class="bi bi-box-seam"></i> Orders
                        </a>
                    </li>
                <?php endif; ?>

                <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/online_store/admin/dashboard.php">
                            <i class="bi bi-speedometer2"></i> Admin
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
                            <i class="bi bi-person"></i> Login
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="register.php">
                            <i class="bi bi-pencil-square"></i> Register
                        </a>
                    </li>

                <?php else: ?>

                    <li class="nav-item">
                        <a class="nav-link logout-link" href="logout.php">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </a>
                    </li>

                <?php endif; ?>

            </ul>
        </div>

    </div>
</nav>

<div class="container site-footer">
