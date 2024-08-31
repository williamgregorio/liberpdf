<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<?php 
$pageTitle = 'Register';
include 'header.php'
require 'functions.php';

loadEnvironment();

$database = database();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $email = $_POST['email'];

  $sql = 'SELECT id FROM users WHERE username = ? OR email = ?';
  $params = [$username, $email];
  $types = 'ss';
  
  $existingUsers = $database->query($sql, $params, $types);

  if(!empty($existingUsers)) {
    echo 'Username or email already exists.';
  } else {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $sql = 'INSERT INTO users (username, password, email) VALUES (?,?,?)';
    $params = [$username, $hashedPassword, $email];
    $types = 'sss';

    if ($database->execute($sql, $params, $types)) {
      $userId = $database->getConnection()->insert_id;

      session_start();
      $_SESSION['authenticated'] = true;
      $_SESSION['user_id'] = $userId;
      $_SESSION['username'] = $username;

      header('location: admin.php');
      exit();
    } else {
      echo 'Registration failed: ' . $database->getConnection()->error;
    }
  } 
}
?>

<form method="post" action="">
  Username: <input type="text" name="username" required><br>
  Email: <input type="email" name="email" required><br>
  Password: <input type="password" name="password" required><br>
  <button type="submit">Register</button>
</form>

<?php include 'footer.php' ?>
