<?php

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

}

?>
