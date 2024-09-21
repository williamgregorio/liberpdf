<?php 
ini_set('display_errors', 1);
ini_set('display_setup_errors', 1);
?>

<?php
$pageTitle = 'All books';
include 'header.php';
require 'functions.php';

loadEnvironment();
isAuthenticated();

$database = database();

$user_id = $_SESSION['user_id'];

$sql = 'SELECT books.id, books.title, books.author, books.url, categories.name AS category_name FROM books JOIN categories on books.category_id = categories.id WHERE categories.user_id = ?';
$params = [$user_id];
$types = 'i';

$all_books = $database->query($sql, $params, $types);
?>

<h2>All Books</h2>
<?php if ($all_books): ?>
<table cellspacing="0" cellpadding="0" border="1">
  <thead>
    <tr>
      <th>Title</th>
      <th>Author</th>
      <th>Category</th>
      <th>URL</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($all_books as $book): ?>
    <tr>
      <td><?php echo htmlspecialchars($book['title']); ?></td>
      <td><?php echo htmlspecialchars($book['author']); ?></td>
      <td><?php echo htmlspecialchars($book['category_name']); ?></td>
      <td><a href="<?php echo htmlspecialchars($book['url']); ?>" target="_blank">Link</a></td>
      <td>
        <form method="post" action="delete-book.php" style="display:inline;">
          <input type="hidden" name="book_id" value="<?php echo $book['id']; ?>">
          <button type="submit" onclick="return confirm('Are you sure you want to delete this book?');">Delete</button>
        </form>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?php else: ?>
<p>No books found for your account.</p>
<?php endif; ?>

<?php include 'footer.php'; ?>
