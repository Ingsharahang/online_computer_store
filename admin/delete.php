<?php
require_once "../db.php";
require_once "../auth.php";

require_admin();

$id = $_GET['id'];

$conn->query("DELETE FROM products WHERE id=$id");

header("Location: products.php");
exit;
