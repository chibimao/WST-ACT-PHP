<?php
/**
 * index.php - Entry point that redirects to login.php
 * In the original project this was the login page (index.html)
 * Now it serves as the entry point, redirecting to the modular login page
 */

// Redirect to login page
header("Location: login.php");
exit();
?>
