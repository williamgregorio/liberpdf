<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <meta name="description" content="" />
  <link rel="icon" href="favicon.png">
  <link rel="stylesheet" href="style.css" >
<?php if (isset($pageTitle)) : ?>
<title><?php echo htmlspecialchars($pageTitle, ENT_QUOTES, "UTF-8"); ?></title>
<?php else : ?>
  <title>Default Title</title>
<?php endif; ?>
</head>
<body>
<main>
<nav>
  <a href="/"><img src="assets/liberpdf-logo.png" alt="logo" /></a>
  <ul>
    <li><a href="index.php">Home</a></li>
<?php
    session_start();

    if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) {
      echo '<li><a href="admin.php">Admin</a></li>';
      echo '<li><a href="view-all-books.php">View all books</a></li>';
      echo '<li><a href="logout.php">Logout</a></li>';
    } else {
      echo '<li><a href="register.php">Register</a></li>';
      echo '<li><a href="login.php">Login</a></li>';
    }
?>
  </ul>
</nav>
<div class="gcse-search"></div>

