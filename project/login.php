<?php
session_start();
include 'config/db.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = $_POST['input'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? OR phone = ?");
    $stmt->bind_param("ss", $input, $input);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user['username'];
        header("Location: dashboard.php");
        exit;
    } else {
        $message = "<div class='alert alert-danger'>Invalid credentials. Please try again.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow rounded">
                <div class="card-header bg-primary text-white text-center">
                    <h4>Login</h4>
                </div>
                <div class="card-body">

                    <?php if ($message) echo $message; ?>

                    <form method="POST" novalidate>
                        <div class="mb-3">
                            <label for="input" class="form-label">Email or Phone</label>
                            <input type="text" name="input" id="input" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </form>
                </div>
                <div class="card-footer text-muted text-center">
                    Don't have an account? <a href="register.php">Register</a> |
                    <a href="forgot_password.php">Forgot Password?</a>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
