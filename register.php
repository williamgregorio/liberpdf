<?php

include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD']) == 'POST' {
  $username = $_POST['username'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  $conn = openCon();

  $stmt = $conn->prepare('INSERT INTO accounts (username, password) VALUES (?,?)');
  $stmt->bind_param('ss', $username, $password);


    

}
