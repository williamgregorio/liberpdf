<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<?php 
$pageTitle = "Login";
include 'templates/header.php';  
?>

<form method="post" action="">
  Username: <input type="text" name="username" required><br>
  Password: <input type="password" name="password" required><br>
  <button type="submit">Login</button>
</form>

<?php include 'templates/footer.php'; ?>
