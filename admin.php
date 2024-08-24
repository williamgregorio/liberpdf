<?php
ini_set('display_errors', 1);
ini_set('display_startup_error', 1);
?>

<?php
$pageTitle = 'Admin';
include 'header.php';
include 'db_connection.php';
?>

<?php
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
  header('Location: login.php');
  exit();
}
?>

<?php
$conn = openCon();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['add_category'])) {
    $categoryName = $_POST['category_name'];
    $userId = $_SESSION['user_id'];

    $stmt = $conn->prepare('INSERT into categories (user_id, name) VALUES (?,?)');
    $stmt->bind_param('is', $userId, $categoryName);

    if ($stmt->execute()){
      echo 'Category added succesfully';
      header('Location: admin.php');
      exit();
    } else {
      echo 'Error adding category ' . $stmt->error;
    }
    $stmt->close();
  }
}
?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['add_book'])) {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $book_url = $_POST['url'];
    $category_id = $_POST['category_id'];

    $stmt = $conn->prepare('INSERT into books (title, author, url, category_id) VALUES (?,?,?,?)');
    $stmt->bind_param('sssi', $title, $author, $book_url, $category_id);

    if ($stmt->execute()) {
      echo 'Book added succesfully';
      header('Location: admin.php');
      exit();
    } else {
      echo 'Error adding book ' . $stmt->error;
    }
    $stmt->close();
  }
}
?>

<?php 
$selected_category_name = '';
if (isset($_POST['select_category'])) {
  $selected_category_id = $_POST['selected_category_id'];

  //category name get
  $stmt = $conn->prepare('SELECT name FROM categories WHERE id = ?');
  $stmt->bind_param('i', $selected_category);

  $stmt->execute();
  $category_result = $stmt->get_result();

  if ($category_result->num_rows > 0) {
    $category_row = $category_result->fetch_assoc();
    $selected_category_name = htmlspecialchars($category_name['name']);
    echo $selected_category_name;
  }
  $stmt->close();

  //get books on selected category id
  $stmt = $conn->prepare('SELECT title, author, url FROM books WHERE category_id = ?');
  $stmt->bind_param('i', $selected_category_id)
  $stmt->execute();
  $book_result = $stmt->get_result();
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
  $stmt = $conn->prepare('SELECT id, name FROM categories WHERE user_id = ?');
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

<h2>Select category to view your books</h2>
<form method="post" action="">
  <label for="selected_category_id">Category:</label>
  <select id="selected_category_id" name="selected_category_id" required>
<?php
  $conn = openCon();
  $stmt = $conn->prepare('SELECT id, name FROM categories WHERE user_id = ?');
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
  <button type="submit" name="select_category">View Books</button>
</form>

<?php if (isset($book_result)): ?>
<h2>Category selected: </h2>
<table>
  <thead>
    <tr>
      <th>Title</th>
      <th>Author</th>
      <th>URL</th>
    </tr>
  </thead>
<tbody>
<?php while ($book = $book_result->fetch_assoc()): ?>
    <tr>
      <td><?php echo htmlspecialchars($book['title']); ?></td>
      <td><?php echo htmlspecialchars($book['author']); ?></td>
      <td><a href="<?php echo htmlspecialchars($book['url']); ?>" target="_blank">Link</a></td>
    </tr>
<?php endwhile; ?>
</tbody>
</table>
<?php endif; ?>

<?php include 'footer.php' ?>
