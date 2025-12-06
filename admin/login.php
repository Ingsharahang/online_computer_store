<?php
require_once "../db.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $sql = "SELECT id, name, password, is_admin FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {

        // must be admin
        if ($row['is_admin'] != 1) {
            $error = "Access denied: Not an admin account.";
        }
        elseif (password_verify($password, $row['password'])) {

            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['is_admin'] = 1;

            header("Location: dashboard.php");
            exit;

        } else {
            $error = "Incorrect password";
        }

    } else {
        $error = "Account not found";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">

        <div class="col-md-4">

            <div class="card p-4 shadow">
                <h3 class="text-center mb-3">Admin Login</h3>

                <?php if ($error): ?>
                    <div class="alert alert-danger"><?= $error ?></div>
                <?php endif; ?>

                <form method="post">

                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email"
                               class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" name="password"
                               class="form-control" required>
                    </div>

                    <button class="btn btn-dark w-100">Login</button>

                </form>

                <p class="mt-3 text-center">
                    <a href="register.php">Create admin account</a>
                </p>

                <p class="text-center mt-2">
                    <a href="../index.php">Back to Website</a>
                </p>

            </div>

        </div>

    </div>
</div>

</body>
</html>
