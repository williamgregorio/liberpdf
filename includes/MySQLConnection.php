<?php

use PHPUnit\Exception;

class MySQLConnection {

  private $mysqli;
  private $hostname;
  private $username;
  private $password;
  private $database;

  public function __construct($hostname, $username, $password, $database) {
    $this->hostname = $hostname;
    $this->username = $username;
    $this->password = $password;
    $this->database = $database;

    $this->connect();
  }

  private function connect() {
    $this->mysqli = new mysqli($this->hostname, $this->username, $this->password, $this->database);

    if ($this->mysqli->connect_error) {
      die('Connection Error (' . $this->mysqli->connect_errno . ') ' . $this->mysqli->connect_error);
    }
  }

  public function getConnection() {
    return $this->mysqli;
  }

  public function query($sql, $params = [], $types = '') {
    $stmt = $this->mysqli->prepare($sql);

    if ($stmt === false ) {
      throw new Exception('Preparation failed: ' . $this->mysqli->error);
    }
 
    if ($params) {
      $stmt->bind_param($types, ...$params);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    $data =  $result ? $result->fetch_all(MYSQLI_ASSOC) : [];

    $stmt->close();
    return $data;
  }

  public function execute($sql, $params = [], $types = '') {
    $stmt = $this->mysqli->prepare($sql);

    if ($stmt === false) {
      throw new Excepetion('Preparation failed: ' . $this->mysqli->error);
    }

    if ($params) {
      $stmt->bind_param($types, ...$params);
    }

    $result = $stmt->execute();
    $stmt->close();
    return $result;
  }

  public function close() {
    $this->mysqli->close();
  }
}

?>
