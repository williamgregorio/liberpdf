<?php
require_once("vendor/autoload.php");
require_once 'includes/MySQLConnection.php';

use Dotenv\Dotenv;

function loadEnvironment() {
  $dotenv = Dotenv::createImmutable(__DIR__);
  return $dotenv->load();
}

function database() {
  $hostname = $_ENV['DB_HOST'];
  $username = $_ENV['DB_USER'];
  $password = $_ENV['DB_PASS'];
  $database = $_ENV['DB_NAME'];

  $connection = new MySQLConnection($hostname, $username, $password, $database);
  return $connection;
}

function isAuthenticated() {
  if(!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header('location: login.php');
    exit();
  }
}

