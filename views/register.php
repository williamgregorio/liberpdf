<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  require '../middleware/db.php';

  $username = $_POST['username'];
  $password = $_POST['password'];
  $email = $_POST['email'];
}
?>
