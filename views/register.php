<?php
require 'templates/header.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  require '../middleware/db.php';

  $username = $_POST['username'];
  $password = $_POST['password'];
  $email = $_POST['email'];

  if (createUser($username,$password, $email)) {
    echo 'New account created successfully..redirect user please';
  } else {
   echo 'Account will not be created at this time.'; 
  }
}
?>

<h1>Register</h1>

<form method="POST" action="register.php">
  <input type="text" name="username" placeholder="Username" required>
  <input type="password" name="password" placeholder="Password" required>
  <input type="email" name="email" placeholder="Email" required>
  <button type="submit">Register</button>
</form>
