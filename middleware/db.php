<?php

function getConnection() {
  $db_path = dirname(__DIR__) . '/data/db.sqlite3';
  $pdo = new PDO('sqlite:' . $db_path);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  return $pdo;
}
