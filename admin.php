<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
?>

<?php
$pageTitle = 'Admin';
include 'header.php';
require 'functions.php';

loadEnvironment();
isAuthenticated();

$database = database();

// create a category
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['add_category'])) {
    $categoryName = $_POST['category_name'];
    $userId = $_SESSION['user_id'];

    $sql = 'INSERT into categories (user_id, name) VALUES (?,?)';
    $params = [$userId, $categoryName];
    $types = 'is';
  
    if ($database->execute($sql, $params, $types)) {
      echo 'Category added successfully.';
      header('location: admin.php');
      exit();
    } else {
      echo 'Failed adding category: ' . $database->getConnection()->error;
    }
  }
}
?>

<?php
// add a book to a category
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['add_book'])) {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $book_url = $_POST['url'];
    $category_id = $_POST['category_id'];

    $sql = 'INSERT into books (title, author, url, category_id) VALUES (?,?,?,?)';
    $params = [$title, $author, $book_url, $category_id];
    $types = 'sssi';

    if ($database->execute($sql, $params, $types)) {
      echo 'Book added succesfully';
      header('Location: admin.php');
      exit();
    } else {
      echo 'Error adding book ' . $database->getConnection()->error;
    }
  }
}
?>

<?php 
// get all books from selected category
$selected_category_name = '';
$book_result = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['select_category'])) {
  $selected_category_id = $_POST['selected_category_id'];

  // get category name id
  $sql = 'SELECT name FROM categories WHERE id = ?';
  $params = [$selected_category_id];
  $types = 'i';

  $result = $database->query($sql, $params, $types);
  if ($result && !empty($result)) {
    $category_result = $result[0];
    $selected_category_name = htmlspecialchars($category_id['name']);
  } else {
    echo 'Error retrieving category.';
  }


  //get books on selected category id
  $sql = 'SELECT title, author, url FROM books WHERE category_id = ?';
  $params = [$selected_category_id];
  $types = 'i';

  $book_result = $database->query($sql, $params, $types);
}
?>

<h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
<?
echo $_SESSION['user_id'];

?>
<h2>Add a category</h2>
<form method="post" action="">
  <label for="category_name">Category Name:</label>
  <input type="text" id="category_name" name="category_name" required>
  <button type="submit" name="add_category">Add Category</button>
</form>

<h2>Add a book</h2>
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
  $sql = 'SELECT id, name FROM categories WHERE user_id = ?';
  $params = [$_SESSION['user_id']];
  $types = 'i';
  $categories = $database->query($sql, $params, $types);
    if ($categories) {
      foreach ($categories as $category) {
        echo '<option value="' . $category['id'] . '">' . htmlspecialchars($category['name']) . '</option>';
      }
    } else {
      echo 'Error retrieving categories.';
    }
?>
</select>
<button type="submit" name="add_book">Add book</button>
</form>

<h2>Select category to view your books</h2>
<form method="post" action="">
  <label for="selected_category_id">Category:</label>
  <select id="selected_category_id" name="selected_category_id" required>
<?php
    $categories = $database->query($sql, $params, $types);
    foreach ($categories as $category) {
      echo '<option value="' . $category['id'] . '">' . htmlspecialchars($category['name']) . '</option>';
    }
?>
  </select>
  <button type="submit" name="select_category">View Books</button>
</form>

<?php if ($book_result): ?>
<h2>Category selected: <?php echo $selected_category_name; ?> </h2>
<table cellspacing="0" cellpadding="0" border="1">
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
