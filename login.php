<?php
require_once "db.php";
require_once "header.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $sql = "SELECT id, name, password, is_admin FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {

        if (password_verify($password, $row['password'])) {

            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['is_admin'] = $row['is_admin'];

            header("Location: index.php");
            exit;
        } else {
            $error = "Incorrect password!";
        }

    } else {
        $error = "Email not found!";
    }
}
?>

<div class="row justify-content-center">
    <div class="col-md-5">

        <h3 class="mb-4 text-center">Login</h3>

        <?php if ($error): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <form method="post">

            <div class="mb-3">
                <label>Email</label>
                <input type="email" required class="form-control" name="email">
            </div>

            <div class="mb-3">
                <label>Password</label>
                <input type="password" required class="form-control" name="password">
            </div>

            <button class="btn btn-dark w-100">Login</button>

        </form>

        <p class="mt-3 text-center">
            Don't have an account? <a href="register.php">Register</a>
        </p>

    </div>
</div>

<?php require_once "footer.php"; ?>
