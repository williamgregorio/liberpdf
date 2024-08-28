<?php

use PHPUnit\Framework\TestCase;
use Dotenv\Dotenv;

require '../includes/MySQLConnection.php';

class MySQLConnectionTest extends TestCase {
  private $db;

  protected function setUp(): void {
    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    $hostname = $_ENV['DB_HOST'];
    $username = $_ENV['DB_USER'];
    $password = $_ENV['DB_PASS'];
    $database = $_ENV['DB_NAME'];

    $this->db = new MySQLConnection($hostname, $username, $password, $database);
  }

  protected function tearDown(): void {
      $this->db->close();
  }


}
