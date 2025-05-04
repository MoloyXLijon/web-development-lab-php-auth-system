<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
$username = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">My App</a>
        <div class="d-flex">
            <a href="logout.php" class="btn btn-outline-light btn-sm">Logout</a>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="text-center">
        <div class="card shadow-sm p-4">
            <h2 class="mb-3">Welcome, <span class="text-primary"><?php echo htmlspecialchars($username); ?></span> 👋</h2>
            <p class="lead">This is your dashboard. You can add more features here.</p>
            <hr>
            <div class="mt-4">
                <a href="profile.php" class="btn btn-outline-primary me-2">View Profile</a>
                <a href="settings.php" class="btn btn-outline-secondary">Settings</a>
            </div>
        </div>
    </div>
</div>

</body>
</html>
