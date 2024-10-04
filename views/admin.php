<?php
session_start();

if (!isset($_SESSION['username'])) {
  header('Location: /login');
  exit;
}
?>

<?php require 'templates/header.php';?>
<h1>Dashboard</h1>
