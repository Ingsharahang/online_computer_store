<?php
session_start();

if (!isset($_POST['total'])) {
    header("Location: checkout.php");
    exit;
}

$total = $_POST['total'];

// simulate success
header("Location: payment_success.php?total=".urlencode($total));
exit;
