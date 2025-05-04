<?php
session_start();
include 'config/db.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['otp'] == $_SESSION['otp']) {
        $newPassword = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
        $email = $_SESSION['reset_email'];

        $stmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
        $stmt->bind_param("ss", $newPassword, $email);
        $stmt->execute();

        $message = "<div class='alert alert-success'>Password reset successful! <a href='login.php' class='btn btn-sm btn-success mt-2'>Login</a></div>";
    } else {
        $message = "<div class='alert alert-danger'>Invalid OTP. Please try again.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow rounded">
                <div class="card-header bg-success text-white text-center">
                    <h4>Reset Password</h4>
                </div>
                <div class="card-body">

                    <?php if ($message) echo $message; ?>

                    <form method="POST" novalidate>
                        <div class="mb-3">
                            <label for="otp" class="form-label">Enter OTP</label>
                            <input type="text" name="otp" id="otp" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="new_password" class="form-label">New Password</label>
                            <input type="password" name="new_password" id="new_password" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-success w-100">Reset Password</button>
                    </form>
                </div>
                <div class="card-footer text-center text-muted">
                    Remember your password? <a href="login.php">Login</a>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
