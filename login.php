<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<?php 
$pageTitle = "Login";
include 'header.php';  
?>

<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $conn = openCon();

  $stmt = $conn->prepare('SELECT id, password FROM users WHERE username = ?');
  $stmt->bind_param('s', $username);
  $stmt->execute();
  $stmt->store_result();

  if ($stmt->num_rows > 0) {
    $stmt->bind_result($userId, $hashedPassword);
    $stmt->fetch();

    if (password_verify($password, $hashedPassword)) {
      session_start();
      $_SESSION['authenticated'] = true;
      $_SESSION['user_id'] = $userId;
      $_SESSION['username'] = $username;

      header('Location: admin.php');
      exit();
    } else {
      echo 'Invalid username or password.';
    } 
  } else {
    echo 'Invalid username or password.';
  }
  
  $stmt->close();
  closeCon($conn);
}
?>

<form method="post" action="">
  Username: <input type="text" name="username" required><br>
  Password: <input type="password" name="password" required><br>
  <button type="submit">Login</button>
</form>

<?php include 'footer.php'; ?>

