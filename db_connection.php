<?php

require_once("vendor/autoload.php");

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

function openCon() {
  $dbhost = $_ENV['DB_HOST'];
  $dbuser = $_ENV['DB_USER'];
  $dbpass = $_ENV['DB_PASS'];
  $dbname = $_ENV['DB_NAME'];

  $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname$) or die("Connection failed %s\n" . $conn -> error);
  return $conn;
}


function closeCon($conn){
  $conn -> close();
}
