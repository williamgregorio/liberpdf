<?
$db_path = __DIR__ . '../data/db.sqlite3';

if (file_exist($db_path)) {
  echo 'Database already exists in path.';
  exit;
}

try {
  $pdo = new PDO('sqlite:' . $db_path);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRORMODE_EXCEPTION);

  echo 'Database created successfully.\n';
} catch(PDOException $error) {
  echo 'Database error: ' . $error->getMessage() . '\n';
}
