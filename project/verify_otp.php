<?php
session_start();
include 'config/db.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['otp'] == $_SESSION['otp']) {
        $user = $_SESSION['temp_user'];

        $stmt = $conn->prepare("INSERT INTO users 
            (username, email, phone, password, first_name, last_name, address) 
            VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", 
            $user['username'], $user['email'], $user['phone'], 
            $user['password'], $user['first_name'], $user['last_name'], $user['address']
        );

        if ($stmt->execute()) {
            unset($_SESSION['otp']);
            unset($_SESSION['temp_user']);
            $message = "<div class='alert alert-success'>Registration successful! <a href='login.php' class='btn btn-sm btn-success'>Login</a></div>";
        } else {
            $message = "<div class='alert alert-danger'>Database error. Please try again.</div>";
        }
    } else {
        $message = "<div class='alert alert-danger'>Invalid OTP. Please try again.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verify OTP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow rounded">
                <div class="card-header bg-primary text-white text-center">
                    <h4>OTP Verification</h4>
                </div>
                <div class="card-body">

                    <?php if ($message) echo $message; ?>

                    <form method="POST" novalidate>
                        <div class="mb-3">
                            <label for="otp" class="form-label">Enter OTP</label>
                            <input type="text" name="otp" id="otp" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Verify</button>
                    </form>
                </div>
                <div class="card-footer text-muted text-center">
                    Didn't receive OTP? <a href="resend_otp.php">Resend</a>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
