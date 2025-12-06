<?php
// auth.php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// require user login
function require_login() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }
}

// require admin login
function require_admin() {
    if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1) {
        header("Location: ../login.php");
        exit();
    }
}
?>
