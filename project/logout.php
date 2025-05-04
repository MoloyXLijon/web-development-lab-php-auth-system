<?php
session_start();
session_unset(); 
session_destroy();

// Redirecting to login page
header("Location: login.php");
exit;
?>
