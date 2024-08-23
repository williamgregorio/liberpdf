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
  <ul>
    <li><a href="index.php">Home</a></li>
    <li><a href="register.php">Register</a></li>
  </ul>
</nav>
<div class="gcse-search"></div>

