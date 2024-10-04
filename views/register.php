<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<?php
require 'templates/header.php';
?>

<h1>Create an account</h1>
<form method="POST" action="/register">
  <input type="text" name="username" placeholder="Username" required>
  <input type="password" name="password" placeholder="Password" required>
  <input type="password" name="password2" placeholder="Confirm Password" required>
  <input type="email" name="email" placeholder="Email" required>
  <button type="submit">Register</button>
</form>
