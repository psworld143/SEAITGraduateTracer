<?php
session_start();
session_unset(); // Remove all session variables
session_destroy(); // Destroy the session

// Clear the "Remember me" cookie
setcookie('user_id', '', time() - 3600, "/");

// Redirect to the login page
header('Location: ../index2.php');
exit;
?>
