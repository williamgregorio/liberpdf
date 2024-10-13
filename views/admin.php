<?php
$pageTitle = 'Dashboard';
require 'templates/header.php';
$root = dirname(__DIR__);
$middleware = $root . '/middleware/db.php';
require $middleware;

$username = $_SESSION['username'];
$categories = getCategories($username);
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
        echo '<option value="'.$name.'">';
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

<h3>Create new category</h3>
<form method="POST" action="/add-category">
  <label for="name">Add new category:</label>
  <input type="text" name="name" required />
  <button type="submit">Add</button>
</form>

<section>
  <div class="books">
  </div>
</section>
<?php require 'templates/footer.php' ?>
