<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <meta name="description" content="" />
  <link rel="stylesheet" href="style.css" >
  <?php if (isset($pageTitle )) : ?>
  <title><?php echo htmlspecialchars($pageTitle, ENT_QUOTES, "UTF-8"); ?></title>
  <?php else : ?>
  <title>Default Title - Dev</title>
  <?php endif; ?>
</head>
<body>
<nav>
  <a href="/"><img src="assets/liberpdf-logo.png" alt="logo" /></a>
  <ul>
<?php
    if (isset($_SESSION['username'])) {
      echo '<li><a href="/dashboard">Dashboard</a></li>';
      echo '
        <form method="POST" action="/logout" style="margin-top:12px;">
          <button style="background:none;border:none;cursor:pointer;padding:0;margin:0;" type="submit">Logout</button>
        </form>
      ';
    } else {
      echo '<li><a href="/">Home</a></li>';
      echo '<li><a href="/register">Register</a></li>';
      echo '<li><a href="/login">Login</a></li>';
    }
?>
  </ul>
</nav>
<main>
<div class="gcse-search"></div>

