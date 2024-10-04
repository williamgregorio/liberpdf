<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<?php
require 'templates/header.php';
if ($_SERVER['REQUEST_URI'] === '/register' && $_SERVER['REQUEST_METHOD'] === 'POST') {
  $root = dirname(__DIR__);
  require $root . '/middleware/db.php';

  $username = $_POST['username'];
  $password = $_POST['password'];
  $password2 = $_POST['password2'];
  $email = $_POST['email'];

  if (createUser($username,$password, $password2, $email)) {
    echo 'New account created successfully.';
    $_SESSION['username'] = $username;
    header('Location: /dashboard');
    exit;
  } else {
   echo 'Account will not be created at this time.'; 
  }
}
?>

<h1>Create an account</h1>
<form method="POST" action="/register">
  <input type="text" name="username" placeholder="Username" required>
  <input type="password" name="password" placeholder="Password" required>
  <input type="password" name="password2" placeholder="Confirm Password" required>
  <input type="email" name="email" placeholder="Email" required>
  <button type="submit">Register</button>
</form>
