<?php
require_once("vendor/autoload.php");

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$DB_HOST = $_ENV['DB_HOST'];
$DB_USER = $_ENV['DB_USER'];
$DB_PASS = $_ENV['DB_PASS'];
$DB_NAME = $_ENV['DB_NAME'];

$conn = mysql_connect($DATABASE_HOST, $DB_USER, $DB_PASS, $DB_NAME);
if (mysql_connect_errno()) {
  exit("Failed to connect " . mysql_connect_errno());
}



