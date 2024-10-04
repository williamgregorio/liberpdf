<?php
$root_path = dirname(__DIR__);

$db_path = $root_path . '/data/db.sqlite3';
$tables_dir = $root_path . '/build/tables/';

if (file_exists($db_path)) {
  echo 'Database already exists in path.';
  exit;
}

try {
  $pdo = new PDO('sqlite:' . $db_path);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  function readAndExecuteSQL($pdo, $sql_file) {
    $sql = file_get_contents($sql_file);
    echo $sql;
    $pdo->exec($sql);
  }

  $user_sql_file = $tables_dir . 'user.sql';
  $category_sql_file = $tables_dir . 'category.sql';
  $book_sql_file = $tables_dir . 'book.sql';

  readAndExecuteSQL($pdo, $user_sql_file);
  readAndExecuteSQL($pdo, $category_sql_file);
  readAndExecuteSQL($pdo, $book_sql_file);

  echo 'Database was created successfully.' . '\n';
} catch(PDOException $error) {
  echo 'catch and fail';
  echo 'Database error: ' . $error->getMessage();
}
