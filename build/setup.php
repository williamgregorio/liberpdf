<?
$db_path = __DIR__ . '/../data/db.sqlite3';
$tables_dir = __DIR__ . '/../tables/';

if (file_exists($db_path)) {
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

  function executeSQL() {
    readAndExecuteSQL($pdo, $user_sql_file);
    readAndExecuteSQL($pdo, $category_sql_file);
    readAndExecuteSQL($pdo, $book_sql_file);
  }

  executeSQL();
  echo 'Database was created successfully.\n';
} catch(PDOException $error) {
  echo 'Database error: ' . $error->getMessage() . '\n';
}
