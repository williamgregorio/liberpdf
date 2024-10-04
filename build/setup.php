<?
$db_path = __DIR__ . '../data/db.sqlite3';
$tables_dir = __DIR__ . '../tables/';

if (file_exist($db_path)) {
  echo 'Database already exists in path.';
  exit;
}

try {
  $pdo = new PDO('sqlite:' . $db_path);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRORMODE_EXCEPTION);

  function readAndExecuteSQL($pdo, $sql_file) {
    $sql = file_get_contents($sql_file);
    $pdo->exec($sql);
  }

  $user_sql_file = $tables_dir . 'user.sql';
  $category_sql_file = $tables_dir . 'category.sql';
  $book_sql_file = $tables_dir . 'book.sql';

  echo 'Database created successfully.\n';
} catch(PDOException $error) {
  echo 'Database error: ' . $error->getMessage() . '\n';
}
