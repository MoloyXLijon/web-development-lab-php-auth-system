<?php
session_start();
include 'config/db.php';
include 'helpers/functions.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $otp = rand(100000, 999999);
    $_SESSION['otp'] = $otp;
    $_SESSION['reset_email'] = $email;

    // Pretend to send OTP or actually send via PHPMailer
    if (sendOTP($email, $otp)) {
        $message = "<div class='alert alert-info'>OTP sent to <strong>$email</strong>. <a href='reset_password.php' class='btn btn-sm btn-info mt-2'>Reset Password</a></div>";
    } else {
        $message = "<div class='alert alert-danger'>Failed to send OTP. Please try again later.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow rounded">
                <div class="card-header bg-warning text-dark text-center">
                    <h4>Forgot Password</h4>
                </div>
                <div class="card-body">
                    <?php if ($message) echo $message; ?>

                    <form method="POST" novalidate>
                        <div class="mb-3">
                            <label for="email" class="form-label">Enter your Email</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-warning w-100">Send OTP</button>
                    </form>
                </div>
                <div class="card-footer text-center text-muted">
                    Remembered your password? <a href="login.php">Login</a>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
