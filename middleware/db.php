<?php
function getConnection() {
  $db_path = dirname(__DIR__) . '/data/db.sqlite3';
  $pdo = new PDO('sqlite:' . $db_path);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  return $pdo;
}

function logout() {
  session_start();
  session_destroy();
  header('Location: /');
  exit;
}

function login($username, $password) {
  $pdo = getConnection();
  $stmt = $pdo->prepare("SELECT password FROM users WHERE username = :username");
  $stmt->bindParam(':username', $username);
  $stmt->execute();

  $hashed_password = $stmt->fetchColumn();
  if ($hashed_password && password_verify($password, $hashed_password)) {
    return true;
  }
  return false;
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
  return preg_match('/^(?=.*[A-Z])(?=.*\d).{8,}$/', $password);
}

function createUser($username, $password, $password2, $email) {
  if ($password !== $password2) {
    echo 'Passwords do not match.';
    return false;
  }

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

  $pdo = getConnection();
  $hashed_password = password_hash($password, PASSWORD_DEFAULT);
  $stmt = $pdo->prepare("INSERT INTO users (username, password, email) VALUES (:username, :password, :email)");
  $stmt->bindParam(':username', $username);
  $stmt->bindParam(':password', $hashed_password);
  $stmt->bindParam(':email', $email);

  return $stmt->execute();
}

function checkUsernameById($username) {
  $pdo = getConnection();
  $stmt = $pdo->prepare("SELECT id FROM users WHERE username = :username");
  $stmt->bindParam(':username', $username);
  $stmt->execute();
  return $stmt->fetchColumn();
}

function createBook($username, $title, $author, $url) {
  $user_id = checkUsernameById($username);
  if (!$user_id) {
    echo 'username does not match this user id';
    return false;
  }

  $pdo = getConnection();
  $stmt = $pdo->prepare("INSERT INTO books (user_id, title, author, url) VALUES (:user_id, :title, :author, :url)");
  $stmt->bindParam(':user_id', $user_id);
  $stmt->bindParam(':title', $title);
  $stmt->bindParam(':author', $author);
  $stmt->bindParam(':url', $url);
  return $stmt->execute();
}

function createCategory($username, $name) {
  $user_id = checkUsernameById($username);
  if (!$user_id) {
    echo 'username does not match this user id';
  }

  $pdo = getConnection();
  $stmt = $pdo->prepare("INSERT INTO categories (user_id, name) VALUES (:user_id, :name)");
  $stmt->bindParam(':user_id', $user_id);
  $stmt->bindParam(':name', $name);
  return $stmt->execute();
}

function getCategories($username) {
  $user_id = checkUsernameById($username);
  if (!$user_id) {
    echo 'username does not match this user id';
  }

  $pdo = getConnection();
  $stmt = $pdo->prepare("SELECT * FROM categories WHERE user_id = :user_id");
  $stmt->bindParam(':user_id', $user_id);

  if ($stmt->execute()) {
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  } else {
    return [];
  }
}
