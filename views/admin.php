<?php
$pageTitle = 'Dashboard';
require 'templates/header.php';
?>

<h1>Dashboard, <?php echo $_SESSION['username'];?></h1>

<h2>Create a new book</h2>
<form method="POST" action="/create-book">
  <label for="title">Book title:</label>
  <input type="text" name="title" required />
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
