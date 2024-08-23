<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<DOCTYPE html>
<html lang="en">
<head>
  <title>Register</title>
</head>
<body>
<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $email = $_POST['email'];

  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

  $conn = openCon();

  $stmt = $conn->prepare('INSERT INTO accounts (username, password, email) VALUES (?,?,?)');
  if ($stmt === false) {
    die('Prepare failed: ' . $conn->error);
  }

  $stmt->bind_param('sss', $username, $hashedPassword, $email);

  if ($stmt->execute()) {
    echo 'User registrated successfully';;
  } else {
    echo 'Registration failed.' . $stmt->error;
  }

  $stmt->close();
  closeCon($conn);
}
?>

<form method="post" action="">
  Username: <input type="text" name="username" required><br>
  Email: <input type="email" name="email" required><br>
  Password: <input type="password" name="password" required><br>
  <button type="submit">Register</button>
</form>
</body>
