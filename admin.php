<?php
session_start();

if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
  header('Location: login.php');
  exit();
}

?>

<?php
$pageTitle = 'Admin';
include 'header.php';
?>

<h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></h1>

<?php include 'footer.php' ?>
