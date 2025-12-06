<?php
require_once "../db.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$error = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];

    if ($password !== $confirm) {
        $error = "Passwords do not match!";
    } else {

        $hash = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (name, email, password, is_admin)
                VALUES (?,?,?,1)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss",$name,$email,$hash);

        if($stmt->execute()){
            $success = "Admin account created successfully!";
        } else {
            $error = "Email already exists!";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

</head>

<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">

        <div class="col-md-4">

            <div class="card p-4 shadow">

                <h3 class="text-center mb-3">Admin Register</h3>

                <?php if ($success): ?>
                    <div class="alert alert-success"><?= $success ?></div>
                <?php endif; ?>

                <?php if ($error): ?>
                    <div class="alert alert-danger"><?= $error ?></div>
                <?php endif; ?>

                <form method="post">

                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" name="name"
                               class="form-control" required>
                    </div>

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

                    <div class="mb-3">
                        <label>Confirm Password</label>
                        <input type="password" name="confirm"
                               class="form-control" required>
                    </div>

                    <button class="btn btn-dark w-100">Register</button>

                </form>

                <p class="mt-3 text-center">
                    <a href="login.php">Go to login</a>
                </p>

                <p class="text-center">
                    <a href="../index.php">Back to Website</a>
                </p>

            </div>

        </div>

    </div>
</div>

</body>
</html>
