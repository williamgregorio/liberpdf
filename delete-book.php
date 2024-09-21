<?php

include 'header.php';
require 'functions.php';

loadEnvironment();
isAuthenticated();

$database = database();

function validateBookId($id) {
  return isset($id) && is_numeric($id);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['book_id'])) {
  $book_id = $_POST['book_id'];

  if (validateBookId($book_id)) {
    $sql = 'DELETE FROM books WHERE id = ?';
    $params = [$book_id];
    $types = 'i';

    if ($database->query($sql, $params, $types)) {
      header('Location: view-all-books.php');
      exit();
    } else { 
      'Error deleting book ' . $database->getConnection()->error;
    }
  } else {
   echo 'Invalid book ' . $database->getConnection()->error; 
  }
} else {
  echo 'Invalid request';
}
