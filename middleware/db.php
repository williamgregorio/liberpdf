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

function isUsernameUnique($username) {
  $pdo = getConnection();
  $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = :username");
  $stmt->execute();
  return $stmt->fetchColumn() === 0;
}

function isPasswordStrong($password) {
  return preg_match('/^(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$/', $password);
}

function createUser($username, $password, $email) {
  if (!isEmailUnique($email)) {
    echo 'Email already exists.';
    return false;
  }

  if (!isUsernameUnique($username)) {
    echo 'Username already exists.';
    return false;
  }

  if (!isPasswordStrong($password)) {
   echo 'Password must be atleast 8 characters long, contain at least one uppercase letter, and one number.';
    return false;
  }


}


