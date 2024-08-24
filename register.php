<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<?php 
$pageTitle = 'Register';
include 'header.php'
?>

<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $email = $_POST['email'];

  $conn = openCon();

  $stmt = $conn->prepare('SELECT id FROM users WHERE username = ? OR email = ?');
  $stmt->bind_param('ss', $username, $email);
  $stmt->execute();
  $stmt->store_result();

  if ($stmt->num_rows > 0) {
    echo 'Username or email already exists.';
    $stmt->close();
  } else {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare('INSERT INTO users (username, password, email) VALUES (?,?,?)');

    if ($stmt === false) {
      die('Preparation failed: ' . $conn->error);
    }

    $stmt->bind_param('sss', $username, $hashedPassword, $email);

    if ($stmt->execute()) {
      header('Location: admin.php');
      exit();
    } else {
      echo 'Registration failed: ' . $stmt->error;
    }

    $stmt->close();
  }

  closeCon($conn);
}
?>

<form method="post" action="">
  Username: <input type="text" name="username" required><br>
  Email: <input type="email" name="email" required><br>
  Password: <input type="password" name="password" required><br>
  <button type="submit">Register</button>
</form>


<?php include 'footer.php' ?>
