<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<?php 
$pageTitle = "Login";
include 'header.php';  
require 'functions.php';

loadEnvironment();
$database = database();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $sql = 'SELECT id, password FROM users WHERE username = ?';
  $params = [$username];
  $types = 's';
  $result = $database->query($sql, $params, $types);

  if (!empty($result)) {
    $user = $result[0];
    $userId = $user['id'];
    $hashedPassword = $user['password'];

    if (password_verify($password, $hashedPassword)) {
      session_start();
      $_SESSION['authenticated'] = true;
      $_SESSION['user_id'] = $userId;
      $_SESSION['username'] = $username;

      header('location: admin.php');
      exit();
    } else {
      echo 'Invalid username or password.';
      }
   }
} else {
    echo 'Invalid username or password.';
}
?>

<form method="post" action="">
  Username: <input type="text" name="username" required><br>
  Password: <input type="password" name="password" required><br>
  <button type="submit">Login</button>
</form>

<?php include 'footer.php'; ?>
