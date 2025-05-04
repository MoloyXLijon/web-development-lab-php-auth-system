<?php
session_start();
include 'config/db.php';
include 'helpers/functions.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email      = $_POST['email'];
    $phone      = $_POST['phone'];
    $username   = $_POST['username'];
    $password   = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $first_name = $_POST['first_name'];
    $last_name  = $_POST['last_name'];
    $address    = $_POST['address'];

    // Username uniqueness check
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $message = "<div class='alert alert-danger'>Username already taken. Please choose another.</div>";
    } else {
        // Send OTP and store temp data
        $otp = rand(100000, 999999);
        $_SESSION['temp_user'] = [
            'email' => $email,
            'phone' => $phone,
            'username' => $username,
            'password' => $password,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'address' => $address
        ];
        $_SESSION['otp'] = $otp;

        sendOTP($email, $otp);
        $message = "<div class='alert alert-success'>OTP sent to $email. <a href='verify_otp.php' class='btn btn-success btn-sm'>Verify Now</a></div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register | Auth System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow rounded">
                <div class="card-header bg-primary text-white text-center">
                    <h4>User Registration</h4>
                </div>
                <div class="card-body">

                    <?php if ($message): echo $message; endif; ?>

                    <form method="POST" novalidate>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>First Name</label>
                                <input type="text" name="first_name" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Last Name</label>
                                <input type="text" name="last_name" class="form-control" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label>Address</label>
                            <textarea name="address" class="form-control" rows="2" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label>Email Address</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Phone Number</label>
                            <input type="text" name="phone" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Register & Send OTP</button>
                    </form>
                </div>
                <div class="card-footer text-center">
                    Already have an account? <a href="login.php">Login</a>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
