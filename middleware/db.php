<?php
function getConnection() {
  $db_path = dirname(__DIR__) . '/data/db.sqlite3';
  $pdo = new PDO('sqlite:' . $db_path);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  return $pdo;
}

function isEmailUnique($email) {
  $pdo = getConnection(); 
  $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
  $stmt->bindParam(":email", $email);
  $stmt->execute();
  return $stmt->fetchColumn() === 0;
}



function createUser() {

}


