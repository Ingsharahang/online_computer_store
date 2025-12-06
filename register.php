<?php
require_once "db.php";
require_once "header.php";

$error = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];

    if ($password !== $confirm) {
        $error = "Passwords do not match!";
    } else {

        $hash = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (name, email, password) VALUES (?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $name, $email, $hash);

        if ($stmt->execute()) {
            $success = "Registration successful! You can now login.";
        } else {
            $error = "Email already exists!";
        }
    }
}
?>

<div class="row justify-content-center">
    <div class="col-md-5">

        <h3 class="mb-4 text-center">Register</h3>

        <?php if ($error): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="alert alert-success"><?= $success ?></div>
        <?php endif; ?>

        <form method="post">

            <div class="mb-3">
                <label>Name</label>
                <input type="text" required class="form-control" name="name">
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" required class="form-control" name="email">
            </div>

            <div class="mb-3">
                <label>Password</label>
                <input type="password" required class="form-control" name="password">
            </div>

            <div class="mb-3">
                <label>Confirm Password</label>
                <input type="password" required class="form-control" name="confirm">
            </div>

            <button class="btn btn-dark w-100">Register</button>

        </form>

        <p class="mt-3 text-center">
            Already registered? <a href="login.php">Login</a>
        </p>

    </div>
</div>

<?php require_once "footer.php"; ?>
