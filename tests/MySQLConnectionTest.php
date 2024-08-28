<?php

use PHPUnit\Framework\TestCase;
use Dotenv\Dotenv;

require 'includes/MySQLConnection.php';

class MySQLConnectionTest extends TestCase {
  private $db;

  protected function setUp(): void {
    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();
  }


}
