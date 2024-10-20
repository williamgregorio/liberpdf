<?php
$pageTitle = 'Dashboard';
require 'templates/header.php';
$root = dirname(__DIR__);
$middleware = $root . '/middleware/db.php';
require $middleware;

$username = $_SESSION['username'];
$categories = getCategories($username);
$books = getBooks($username);
?>

<h1>Dashboard, <?php echo $username;?></h1>

<h2>Create a new book</h2>
<form method="POST" action="/create-book">
  <label for="title">Book title:</label>
  <input type="text" name="title" required />
  <br>
  <label for="category">Select category:</label>
  <select type="select" name="category">
  <option value="">--Choose and option--</option>
  <?php
    if (!empty($categories)) {
      foreach ($categories as $category) {
        $name = $category['name'];
        $category_id = $category['id'];
        echo '<option value="'.$category_id.'">';
          echo $name;
        echo '</option>';
      }
    }
  ?>
   </select>
  <br>
  <label for="author">Author:</label>
  <input type="text" name="author" required />
  <br>
  <label for="url">Book URL:</label>
  <input type="url" name="url" required />
  <button type="submit">Create</button>
</form>
<hr>
<h3>Create new category</h3>
<form method="POST" action="/add-category">
  <label for="name">Add new category:</label>
  <input type="text" name="name" required />
  <button type="submit">Add</button>
</form>
<hr>
<section>
  <h2>Books</h2>
  <div class="books">
    <div>
     <a href="#">Edit</a> 
    </div>
    <table border="1">
      <thead>
        <tr>
          <th scope="col">Title</th>
          <th scope="col">Category</th>
          <th scope="col">Author</th>
          <th scope="col">URL</th>
        </tr>
      </thead>
      <tbody>
    <?php
      foreach ($books as $book) {
        echo '<tr'.' id='.'"'.$book['id'].'">';
          echo '<th>'.$book['title'].'</th>';
          echo '<th>'.$book['category_id'].'</th>';
          echo '<th>'.$book['author'].'</th>';
          echo '<th><a href="'.$book['url'].'">'.'View'.'</a></th>';
        echo '</tr>';
      }
    ?>
      </tbody>
    </table>
  </div>
</section>
<?php
?>
<?php require 'templates/footer.php' ?>
