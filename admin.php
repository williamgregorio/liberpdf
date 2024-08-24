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
include 'db_connection.php';
?>

<?php
$conn = openCon();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['add_category'])) {
    $categoryName = $_POST['category_name'];
    $userId = $_POST['userId'];

    $stmt = $conn->prepare('INSERT into categories (user_id, name) VALUES (?,?)');
    $stmt->bind_param('is', $userId, $categoryName);
    
  }
}
?>
<h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></h1>

<h2>Add a category</h2>
<form method="post" action="">
  <label for="category_name">Category Name:</label>
  <input type="text" id="category_name" name="category_name" required>
  <button type="submit" name="add_category">Add Category</button>
</form>

<h2>Add a bookAdd a book</h2>
<form method="post" action="">
  <label for="title">Title:</label>
  <input type="text" id="title" name="title" required><br>

  <label for="author">Author:</label>
  <input type="text" id="author" name="author"><br>

  <label for="url">URL:</label>
  <input type="text" id="url" name="url" required><br>

  <label for="category_id">Category:</label>
  <select id="category_id" name="category_id" required>
<?php 
  $conn = openCon();
  $stmt = $conn->prepare('SELECT id, name FROM Categories WHERE user_id = ?');
  $stmt->bind_param('i', $_SESSION['user_id']);
  $stmt->execute();
  $result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
  echo '<option value="' . $row['id'] . '">' . htmlspecialchars($row['name']) . '</option>';
}
$stmt->close();
closeCon($conn);
?>
</select>
<button type="submit" name="add_book">Add book</button>
</form>


<?php include 'footer.php' ?>
